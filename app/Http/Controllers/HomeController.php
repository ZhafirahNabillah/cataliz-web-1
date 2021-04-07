<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Agenda_detail;
use App\Models\Plan;
use App\Models\Client;
use App\Models\User;
use App\Models\Coach;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use \Carbon\Carbon;
use DataTables;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index(Request $request)
  {

    if (auth()->user()->hasRole('coach')) {

      // return (auth()->user());
      // summary content
      // $class_id = Class_model::where('coach_id',Auth::user()->id)->pluck('id');
      // $class_has_clients = Class_has_client::whereIn('class_id', $class_id)->pluck('client_id');
      // $client = Client::whereIn('id', $class_has_clients)->count();

      // $agenda_detail = Agenda_detail::where(DB::raw("CONCAT(date,' ',time) + 1"), '<', $date_now)->pluck('id');
      // return $date_now;
      // $created_at_date = $agenda_detail->created_at->format('Y-m-d');
      // $created_at_time = $agenda_detail->created_at->format('H:i:s');


      $coach = Coach::where('user_id', auth()->user()->id)->first();
      $total_clients = $coach->clients->count();

      $plan_id = $coach->plan->pluck('id');
      $agenda_id = Agenda::whereIn('plan_id', $plan_id)->pluck('id');

      $agenda_detail = Agenda_detail::whereIn('agenda_id', $agenda_id)->get();
      $total_hours = $agenda_detail->where('status', 'finished')->sum('duration') / 60;
      $total_sessions = $agenda_detail->where('status', '!=', 'canceled')->count();
      $total_ratings = Feedback::whereIn('agenda_detail_id', $agenda_detail->pluck('id'))->where('from', 'coachee')->whereNotNull('rating')->count();

      // return $total_sessions;


      // $hours = Agenda::selectRaw('sum(agenda_details.duration)/60 as sum')
      //     ->join('agenda_details', 'agenda_id', '=', 'agendas.id')
      //     ->where([
      //         ['agendas.owner_id', Auth::user()->id],
      //         ['status', 'finished'],
      //     ])->first();
      // $session = Agenda::selectRaw('sum(session) as sum')->where('owner_id', Auth::user()->id)->first();

      // list upcoming
      // if ($request->ajax()) {
      //
      //     $data = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.time', 'agenda_details.session_name')
      //         ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
      //         ->join('clients', 'clients.id', '=', 'agendas.client_id')
      //         ->where('status', 'scheduled')
      //         ->where('clients.owner_id', Auth::user()->id)
      //         ->orderBy('date', 'asc')->orderBy('time', 'asc')
      //         ->get();
      //     return DataTables::of($data)
      //         ->addIndexColumn()
      //         ->make(true);
      // }

      return view('home', compact('total_clients', 'total_hours', 'total_sessions', 'total_ratings'));
    } elseif (auth()->user()->hasRole('admin')) {

      $total_coach = User::role('coach')->count();
      $total_coachee = User::role('coachee')->count();
      $total_plans = Plan::get()->count();
      $total_sessions = Agenda_detail::get()->count();

      // if ($request->ajax()) {
      //     //list all sessions
      //     $data = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.status')
      //         ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
      //         ->join('clients', 'clients.id', '=', 'agendas.client_id')
      //         ->orderBy('agenda_details.date', 'asc')
      //         ->get();
      //     return DataTables::of($data)
      //         ->addIndexColumn()
      //         ->make(true);
      // }

      return view('home', compact('total_coach', 'total_coachee', 'total_plans', 'total_sessions'));
    } elseif (auth()->user()->hasRole('coachee')) {

      $client = Client::where('user_id', auth()->user()->id)->first();
      // $total_clients = $coach->clients->count();
      $total_coach = $client->coaches->count();

      $plan_id = $client->plans->pluck('id');
      $agenda_id = Agenda::whereIn('plan_id', $plan_id)->pluck('id');

      $agenda_detail = Agenda_detail::whereIn('agenda_id', $agenda_id)->get();

      $total_hours = $agenda_detail->where('status', 'finished')->sum('duration') / 60;
      $total_sessions = $agenda_detail->where('status', '!=', 'canceled')->count();
      $total_ratings = Feedback::whereIn('agenda_detail_id', $agenda_detail->pluck('id'))->where('from', 'coachee')->where('user_id', auth()->user()->id)->whereNotNull('rating')->count();

      // return $plan_id;

      // $total_coach = User::role('coach')->count();
      // $session = Agenda::selectRaw('sum(session) as sum')
      //     ->join('clients', 'clients.id', '=', 'agendas.client_id')
      //     ->where('clients.user_id', Auth::user()->id)->first();
      //
      // $data = Client::select('clients.id', 'users.name', 'users.phone', 'users.email', 'clients.company', 'clients.occupation', 'clients.organization')
      //     ->join('users', 'users.id', '=', 'clients.user_id')
      //     ->where('clients.user_id', Auth::user()->id)
      //     ->first();

      return view('home', compact('total_hours', 'total_coach', 'total_sessions', 'total_ratings', 'client'));
    } elseif (auth()->user()->hasRole('trainer')) {
      return view('home');
    } else {
      return view('home');
    }
  }

  public function show_upcoming_individual_events(Request $request)
  {
    if (auth()->user()->hasRole('admin')) {
      $data = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.status', 'agenda_details.created_at')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('plans', 'plans.id', '=', 'agendas.plan_id')
        ->join('clients', 'plans.client_id', '=', 'clients.id')
        ->where('plans.group_id', null)
        ->where('agenda_details.status', 'scheduled')
        ->latest()
        ->get();
    } elseif (auth()->user()->hasRole('coach')) {
      $coach = Coach::where('user_id', auth()->user()->id)->first();

      $data = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.status', 'agenda_details.created_at')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('plans', 'plans.id', '=', 'agendas.plan_id')
        ->join('clients', 'plans.client_id', '=', 'clients.id')
        ->where('plans.group_id', null)
        ->where('agenda_details.status', 'scheduled')
        ->where('plans.owner_id', $coach->id)->latest()
        ->get();
    } elseif (auth()->user()->hasRole('coachee')) {
      $client = Client::where('user_id', auth()->user()->id)->first();

      $data = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.status', 'agenda_details.created_at')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('plans', 'plans.id', '=', 'agendas.plan_id')
        ->join('clients', 'plans.client_id', '=', 'clients.id')
        ->where('plans.group_id', null)
        ->where('agenda_details.status', 'scheduled')
        ->where('plans.client_id', $client->id)->latest()
        ->get();
    }

    if ($request->ajax()) {
      return DataTables::of($data)
        ->addIndexColumn()
        ->make(true);
    }
  }

  public function show_upcoming_group_events(Request $request)
  {
    if (auth()->user()->hasRole('admin')) {
      $data = Agenda_detail::select('agenda_details.id', 'plans.group_id as group', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.status', 'agenda_details.created_at')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('plans', 'plans.id', '=', 'agendas.plan_id')
        ->where('plans.client_id', null)
        ->where('agenda_details.status', 'scheduled')
        ->get();
    } elseif (auth()->user()->hasRole('coach')) {
      $coach = Coach::where('user_id', auth()->user()->id)->first();

      $data = Agenda_detail::select('agenda_details.id', 'plans.group_id as group', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.status', 'agenda_details.created_at')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('plans', 'plans.id', '=', 'agendas.plan_id')
        ->where('plans.client_id', null)
        ->where('agenda_details.status', 'scheduled')
        ->where('plans.owner_id', $coach->id)->latest()
        ->get();
    } elseif (auth()->user()->hasRole('coachee')) {
      $client = Client::where('user_id', auth()->user()->id)->first();

      $data = Agenda_detail::select('agenda_details.id', 'plans.group_id as group', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.status', 'agenda_details.created_at')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('plans', 'plans.id', '=', 'agendas.plan_id')
        ->join('client_plan', 'client_plan.plan_id', '=', 'plans.id')
        ->where('plans.client_id', null)
        ->where('agenda_details.status', 'scheduled')
        ->where('client_plan.client_id', $client->id)->latest()
        ->get();
    }

    if ($request->ajax()) {
      return DataTables::of($data)
        ->addIndexColumn()
        ->make(true);
    }
  }

  public function show_agenda_individual_events(Request $request)
  {
    if (auth()->user()->hasRole('admin')) {
      $data = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.status', 'agenda_details.created_at')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('plans', 'plans.id', '=', 'agendas.plan_id')
        ->join('clients', 'plans.client_id', '=', 'clients.id')
        ->where('plans.group_id', null)
        ->latest()
        ->get();
    } elseif (auth()->user()->hasRole('coach')) {
      $coach = Coach::where('user_id', auth()->user()->id)->first();

      $data = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.status', 'agenda_details.created_at')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('plans', 'plans.id', '=', 'agendas.plan_id')
        ->join('clients', 'plans.client_id', '=', 'clients.id')
        ->where('plans.group_id', null)
        ->where('plans.owner_id', $coach->id)->latest()
        ->get();
    } elseif (auth()->user()->hasRole('coachee')) {
      $client = Client::where('user_id', auth()->user()->id)->first();

      $data = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.status', 'agenda_details.created_at')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('plans', 'plans.id', '=', 'agendas.plan_id')
        ->join('clients', 'plans.client_id', '=', 'clients.id')
        ->where('plans.group_id', null)
        ->where('plans.client_id', $client->id)->latest()
        ->get();
    }

    if ($request->ajax()) {
      return DataTables::of($data)
        ->addIndexColumn()
        ->make(true);
    }
  }

  public function show_agenda_group_events(Request $request)
  {
    if (auth()->user()->hasRole('admin')) {
      $data = Agenda_detail::select('agenda_details.id', 'plans.group_id as group', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.status', 'agenda_details.created_at')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('plans', 'plans.id', '=', 'agendas.plan_id')
        ->where('plans.client_id', null)
        ->get();
    } elseif (auth()->user()->hasRole('coach')) {
      $coach = Coach::where('user_id', auth()->user()->id)->first();

      $data = Agenda_detail::select('agenda_details.id', 'plans.group_id as group', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.status', 'agenda_details.created_at')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('plans', 'plans.id', '=', 'agendas.plan_id')
        ->where('plans.client_id', null)
        ->where('plans.owner_id', $coach->id)->latest()
        ->get();
    } elseif (auth()->user()->hasRole('coachee')) {
      $client = Client::where('user_id', auth()->user()->id)->first();

      $data = Agenda_detail::select('agenda_details.id', 'plans.group_id as group', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.status', 'agenda_details.created_at')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('plans', 'plans.id', '=', 'agendas.plan_id')
        ->join('client_plan', 'client_plan.plan_id', '=', 'plans.id')
        ->where('plans.client_id', null)
        ->where('client_plan.client_id', $client->id)->latest()
        ->get();
    }

    if ($request->ajax()) {
      return DataTables::of($data)
        ->addIndexColumn()
        ->make(true);
    }
  }

  public function store_data(Request $request, $id)
  {
    $client = Client::find($id);
    $user = User::find($client->user_id);

    $this->validate($request, [
      'name'          => 'required',
      'phone'         => 'required|numeric|regex:/^[1-9][0-9]/|digits_between:10,12',
      'organization'  => 'required',
      'company'       => 'required',
      'occupation'    => 'required'
    ]);

    $user->name = $request->name;
    $user->phone = $request->phone;
    $user->update();

    $client->name = $user->name;
    $client->phone = $user->phone;
    $client->organization = $request->organization;
    $client->company = $request->company;
    $client->occupation = $request->occupation;
    $client->update();

    return redirect('/dashboard');
  }
}
