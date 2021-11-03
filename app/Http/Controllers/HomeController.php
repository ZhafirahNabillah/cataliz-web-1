<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Agenda_detail;
use App\Models\Plan;
use App\Models\Client;
use App\Models\User;
use App\Models\Coach;
use App\Models\Exam_result;
use App\Models\Feedback;
use App\Models\Topic;
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
      $total_ratings = Feedback::whereIn('agenda_detail_id', $agenda_detail->pluck('id'))->where('from', 'coachee')->whereNotNull('rating')->avg('rating');

      $today_events = collect([]);

      $today = Carbon::now()->format('Y-m-d');

      foreach ($agenda_detail->where('date', $today) as $session) {
        $client = null;
        $agenda = $session->agenda;
        $plan = $agenda->plan;
        if ($plan->client_id == null) {
          $client = $plan->group_id;
        } else {
          $client = $plan->client->name;
        }
        $today_events->push([
          'title'       => $session->session_name,
          'start'       => Carbon::parse($session->date.' '.$session->time)->format('Y-m-d H:i:s'),
          'end'         => Carbon::parse($session->date.' '.$session->time)->addMinutes($session->duration)->format('Y-m-d H:i:s'),
          'topic'       => $session->topic,
          'type'        => 'coaching',
          'coachee'     => $client,
          'id'          => $session->id,
          'url'         => route('agendas.show', $session->id),
          'status'      => $session->status
        ]);
      }

      if (is_null($coach->category_id) && is_null($coach->skill_id) && is_null($coach->skills_description_title) && is_null($coach->skills_description_overview) && is_null($coach->education) && is_null($coach->employment) && is_null($coach->language) && is_null($coach->location)) {
        $empty_profile = true;
      } else {
        $empty_profile = false;
      }

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

      return view('home', compact('total_clients', 'total_hours', 'total_sessions', 'total_ratings', 'today_events', 'empty_profile'));
    }elseif (auth()->user()->hasRole('coachmentor')) {

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
        $total_ratings = Feedback::whereIn('agenda_detail_id', $agenda_detail->pluck('id'))->where('from', 'coachee')->whereNotNull('rating')->avg('rating');
  
        $today_events = collect([]);
  
        $today = Carbon::now()->format('Y-m-d');
  
        foreach ($agenda_detail->where('date', $today) as $session) {
          $client = null;
          $agenda = $session->agenda;
          $plan = $agenda->plan;
          if ($plan->client_id == null) {
            $client = $plan->group_id;
          } else {
            $client = $plan->client->name;
          }
          $today_events->push([
            'title'       => $session->session_name,
            'start'       => Carbon::parse($session->date.' '.$session->time)->format('Y-m-d H:i:s'),
            'end'         => Carbon::parse($session->date.' '.$session->time)->addMinutes($session->duration)->format('Y-m-d H:i:s'),
            'topic'       => $session->topic,
            'type'        => 'coaching',
            'coachee'     => $client,
            'id'          => $session->id,
            'url'         => route('agendas.show', $session->id),
            'status'      => $session->status
          ]);
        }
  
        if (is_null($coach->category_id) && is_null($coach->skill_id) && is_null($coach->skills_description_title) && is_null($coach->skills_description_overview) && is_null($coach->education) && is_null($coach->employment) && is_null($coach->language) && is_null($coach->location)) {
          $empty_profile = true;
        } else {
          $empty_profile = false;
        }
  
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
  
        return view('home', compact('total_clients', 'total_hours', 'total_sessions', 'total_ratings', 'today_events', 'empty_profile'));
    } elseif (auth()->user()->hasRole('admin')) {

      $total_coach = User::role('coach')->count();
      $total_coachee = User::role('coachee')->count();
      $total_plans = Plan::get()->count();
      $total_sessions = Agenda_detail::get()->count();

      $agenda_detail = Agenda_detail::whereIn('status', ['scheduled','rescheduled', 'finished'])->get();

      $today_events = collect([]);

      $today = Carbon::now()->format('Y-m-d');

      foreach ($agenda_detail->where('date', $today) as $session) {
        $client = null;
        $agenda = $session->agenda;
        $plan = $agenda->plan;
        if ($plan->client_id == null) {
          $client = $plan->group_id;
        } else {
          $client = $plan->client->name;
        }
        $today_events->push([
          'title'       => $session->session_name,
          'start'       => Carbon::parse($session->date.' '.$session->time)->format('Y-m-d H:i:s'),
          'end'         => Carbon::parse($session->date.' '.$session->time)->addMinutes($session->duration)->format('Y-m-d H:i:s'),
          'topic'       => $session->topic,
          'type'        => 'coaching',
          'coachee'     => $client,
          'id'          => $session->id,
          'url'         => route('agendas.show', $session->id),
          'status'      => $session->status
        ]);
      }

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

      return view('home', compact('total_coach', 'total_coachee', 'total_plans', 'total_sessions', 'today_events'));
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

      $today_events = collect([]);

      $today = Carbon::now()->format('Y-m-d');

      foreach ($agenda_detail->where('date', $today)->whereIn('status', ['scheduled', 'rescheduled', 'finished']) as $session) {
        $agenda = $session->agenda;
        $plan = $agenda->plan;
        $coach = $plan->owner;
        $coach_data = $coach->user->name;
        $today_events->push([
          'title'       => $session->session_name,
          'start'       => Carbon::parse($session->date.' '.$session->time)->format('Y-m-d H:i:s'),
          'end'         => Carbon::parse($session->date.' '.$session->time)->addMinutes($session->duration)->format('Y-m-d H:i:s'),
          'topic'       => $session->topic,
          'type'        => 'coaching',
          'coach'       => $coach_data,
          'id'          => $session->id,
          'url'         => route('agendas.show', $session->id),
          'status'      => $session->status
        ]);
      }

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

      return view('home', compact('total_hours', 'total_coach', 'total_sessions', 'total_ratings', 'client', 'today_events'));
    }elseif (auth()->user()->hasRole('manager')) {

      $total_coach = User::role('coach')->count();
      $total_coachee = User::role('coachee')->count();
      $total_plans = Plan::get()->count();
      $total_sessions = Agenda_detail::get()->count();
      

      $agenda_detail = Agenda_detail::whereIn('status', ['scheduled','rescheduled', 'finished'])->get();

      $today_events = collect([]);

      $today = Carbon::now()->format('Y-m-d');

      foreach ($agenda_detail->where('date', $today) as $session) {
        $client = null;
        $agenda = $session->agenda;
        $plan = $agenda->plan;
        if ($plan->client_id == null) {
          $client = $plan->group_id;
        } else {
          $client = $plan->client->name;
        }
        $today_events->push([
          'title'       => $session->session_name,
          'start'       => Carbon::parse($session->date.' '.$session->time)->format('Y-m-d H:i:s'),
          'end'         => Carbon::parse($session->date.' '.$session->time)->addMinutes($session->duration)->format('Y-m-d H:i:s'),
          'topic'       => $session->topic,
          'type'        => 'coaching',
          'coachee'     => $client,
          'id'          => $session->id,
          'url'         => route('agendas.show', $session->id),
          'status'      => $session->status
        ]);
      }

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

      return view('home', compact('total_coach', 'total_coachee', 'total_plans', 'total_sessions', 'today_events')); 
    
    }elseif (auth()->user()->hasRole('trainer')) {
      $total_topic = Topic::where('trainer_id', auth()->user()->id)->count();
      $topic = Topic::where('trainer_id', auth()->user()->id)->pluck('id');
      $user = Exam_result::whereIn('topic_id', $topic)->pluck('user_id');
      $total_participant = Client::whereIn('user_id', $user)->count();

      $coach = Coach::where('user_id', auth()->user()->id)->first();
      // $coach = collect($coach);
      if (is_null($coach->category_id) && is_null($coach->skill_id) && is_null($coach->skills_description_title) && is_null($coach->skills_description_overview) && is_null($coach->education) && is_null($coach->employment) && is_null($coach->language) && is_null($coach->location)) {
        $empty_profile = true;
      } else {
        $empty_profile = false;
      }
      // return $total_participant;
      return view('home', compact('total_topic', 'total_participant', 'empty_profile'));
    }elseif (auth()->user()->hasRole('adminLMS')) {

      return view('LMS.course.edit');
      }else {
      $total_topic = Topic::count();
      $topic = Topic::all()->pluck('id');
      $user = Exam_result::whereIn('topic_id', $topic)->pluck('user_id');
      $total_participant = Client::whereIn('user_id', $user)->count();

      $coach = Coach::where('user_id', auth()->user()->id)->first();
      $coach = collect($coach);
      if (is_null($coach->category_id) && is_null($coach->skill_id) && is_null($coach->skills_description_title) && is_null($coach->skills_description_overview) && is_null($coach->education) && is_null($coach->employment) && is_null($coach->language) && is_null($coach->location)) {
        $empty_profile = true;
      } else {
        $empty_profile = false;
      }
      return $empty_profile;
      return view('home', compact('total_topic', 'total_participant', 'empty_profile'));
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

  public function show_topics(Request $request)
  {
    if (auth()->user()->hasRole('trainer')) {
      $data = Topic::where('trainer_id', auth()->user()->id)->get();
    } elseif (auth()->user()->hasRole('mentor')) {
      $data = Topic::all();
    }

    if ($request->ajax()) {

      //return data as datatable json
      return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('participant', function ($row) {
          return $total_participant = $row->clients->count();
        })
        ->addColumn('category', function ($row) {
          return $row->category->toArray();
        })
        ->addColumn('sub_topic', function ($row) {
          return $row->sub_topics->count();
        })
        ->addColumn('action', function ($row) {

          //add update button if user have permission
          if (auth()->user()->can('update-topic')) {
            // $edit_btn = '<a href="' . route('topic.edit', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Edit Topic</a>';

            $edit_btn = '<a href="' . route('topic.edit', $row->id) . '" id="editBtn" class="btn-sm btn-primary">Edit</a>';
          } else {
            $edit_btn = null;
          }

          //add detail and whatsapp button if user have permission
          if (auth()->user()->can('detail-topic')) {
            // $detail_topic_btn = '<a href="' . route('topic.show', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Detail Topic</a>';
            // $detail_participant_btn = '<a href="' . route('topic.participant', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Detail Participant</a>';

            $detail_topic_btn = '<a href="' . route('topic.show', $row->id) . '" id="detailBtn" class="btn-sm btn-primary">Detail</a>';
          } else {
            $detail_topic_btn = null;
            // $detail_participant_btn = null;
          }

          //add delete button if user have permission
          if (auth()->user()->can('delete-topic')) {
            // $delete_btn = '<a href="javascript:;" class="dropdown-item deleteTopic" data-id="' . $row->id . '" data-original-title="Delete" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-small-4 mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete</a>';
            $delete_btn = '<a href="javascript:;" class="btn-sm btn-danger deleteTopic" data-id="' . $row->id . '">Delete</a>';
          } else {
            $delete_btn = null;
          }

          //final dropdown button that shows on view
          // $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
          //   <div class="dropdown-menu dropdown-menu-right">' . $edit_btn . $detail_topic_btn . $delete_btn . '</div>';

          // return $actionBtn;

          $actionBtn = $detail_topic_btn . ' ' . $edit_btn . ' ' . $delete_btn;
          return $actionBtn;
        })
        ->rawColumns(['action', 'participant', 'category', 'sub_topic'])
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

  public function load_calendar_data(Request $request){
    if (auth()->user()->hasRole('coach')) {
      $coach = Coach::where('user_id', auth()->user()->id)->first();
      $plans = $coach->plan;
      $agenda = Agenda::whereIn('plan_id', $plans->pluck('id'))->get();
      $agenda_detail = Agenda_detail::whereIn('agenda_id', $agenda->pluck('id'))->whereIn('status', ['scheduled','rescheduled', 'finished'])->get();
    } elseif (auth()->user()->hasRole('coachee')) {
      $client = Client::where('user_id', auth()->user()->id)->first();
      $plan_id = $client->plans->pluck('id');
      $agenda_id = Agenda::whereIn('plan_id', $plan_id)->pluck('id');
      $agenda_detail = Agenda_detail::whereIn('agenda_id', $agenda_id)->get();
    } else {
      $agenda_detail = Agenda_detail::all();
    }

    $data = collect([]);

    foreach ($agenda_detail->whereIn('status', ['scheduled', 'rescheduled', 'finished']) as $session) {
      $user = null;
      $agenda = $session->agenda;
      $plan = $agenda->plan;
      if (auth()->user()->hasAnyRole('coach', 'admin')) {
        if ($plan->client_id == null) {
          $user = $plan->group_id;
        } else {
          $user = $plan->client->name;
        }
      } elseif (auth()->user()->hasRole('coachee')) {
        $coach = $plan->owner;
        $user = $coach->user->name;
      }
      $data->push([
        'title'       => $session->session_name,
        'start'       => Carbon::parse($session->date.' '.$session->time)->format('Y-m-d H:i:s'),
        'end'         => Carbon::parse($session->date.' '.$session->time)->addMinutes($session->duration)->format('Y-m-d H:i:s'),
        'topic'       => $session->topic,
        'type'        => 'coaching',
        'target'      => $user,
        'id'          => $session->id,
        'url'         => route('agendas.show', $session->id),
        'status'      => $session->status
      ]);
    }

    return response()->json($data);
  }

  public function get_date_event(Request $request){
    $date = $request->get('date');

    if (auth()->user()->hasRole('coach')) {
      $coach = Coach::where('user_id', auth()->user()->id)->first();
      $plans = $coach->plan;
      $agenda = Agenda::whereIn('plan_id', $plans->pluck('id'))->get();
      $agenda_detail = Agenda_detail::whereIn('agenda_id', $agenda->pluck('id'))->whereIn('status', ['scheduled','rescheduled', 'finished'])->get();
    } elseif (auth()->user()->hasRole('coachee')) {
      $client = Client::where('user_id', auth()->user()->id)->first();
      $plan_id = $client->plans->pluck('id');
      $agenda_id = Agenda::whereIn('plan_id', $plan_id)->pluck('id');
      $agenda_detail = Agenda_detail::whereIn('agenda_id', $agenda_id)->whereIn('status', ['scheduled','rescheduled', 'finished'])->get();
    } else {
      $agenda_detail = Agenda_detail::whereIn('status', ['scheduled','rescheduled', 'finished'])->get();
    }

    $data = collect([]);

    foreach ($agenda_detail->where('date', $date) as $session) {
      $user = null;
      $agenda = $session->agenda;
      $plan = $agenda->plan;
      if (auth()->user()->hasAnyRole('coach', 'admin')) {
        if ($plan->client_id == null) {
          $user = $plan->group_id;
        } else {
          $user = $plan->client->name;
        }
      } elseif (auth()->user()->hasRole('coachee')) {
        $coach = $plan->owner;
        $user = $coach->user->name;
      }
      $data->push([
        'title'       => $session->session_name,
        'start'       => Carbon::parse($session->date.' '.$session->time)->format('Y-m-d H:i:s'),
        'end'         => Carbon::parse($session->date.' '.$session->time)->addMinutes($session->duration)->format('Y-m-d H:i:s'),
        'topic'       => $session->topic,
        'type'        => 'coaching',
        'target'      => $user,
        'id'          => $session->id,
        'url'         => route('agendas.show', $session->id),
        'status'      => $session->status
      ]);
    }

    return response()->json($data);
  }
}