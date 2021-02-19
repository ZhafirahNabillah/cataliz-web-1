<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Agenda_detail;
use App\Models\Plan;
use App\Models\Client;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
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
            $client = Client::where('owner_id', Auth::user()->id)->count();
            $hours = Agenda::selectRaw('sum(agenda_details.duration)/60 as sum')
                ->join('agenda_details', 'agenda_id', '=', 'agendas.id')
                ->where([
                    ['agendas.owner_id', Auth::user()->id],
                    ['status', 'finished'],
                ])->first();
            $session = Agenda::selectRaw('sum(session) as sum')->where('owner_id', Auth::user()->id)->first();

            // list upcoming
            if ($request->ajax()) {

                $data = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.time', 'agenda_details.session_name')
                    ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
                    ->join('clients', 'clients.id', '=', 'agendas.client_id')
                    ->where('status', 'scheduled')
                    ->where('clients.owner_id', Auth::user()->id)
                    ->orderBy('date', 'asc')->orderBy('time', 'asc')
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }

            return view('home', compact('client', 'hours', 'session'));
        } elseif (auth()->user()->hasRole('admin')) {

            $total_coach = User::role('coach')->count();
            $total_coachee = User::role('coachee')->count();
            $total_plans = Plan::get()->count();
            $total_sessions = Agenda_detail::get()->count();

            if ($request->ajax()) {
                //list all sessions
                $data = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.status')
                    ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
                    ->join('clients', 'clients.id', '=', 'agendas.client_id')
                    ->orderBy('agenda_details.date', 'asc')
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }

            return view('home', compact('total_coach', 'total_coachee', 'total_plans', 'total_sessions'));
        } elseif (auth()->user()->hasRole('coachee')) {

            $hours = Agenda::selectRaw('sum(agenda_details.duration)/60 as sum')
                ->join('agenda_details', 'agenda_id', '=', 'agendas.id')
                ->join('clients', 'clients.id', '=', 'agendas.client_id')
                ->where([
                    ['clients.user_id', Auth::user()->id],
                    ['status', 'finished'],
                ])->first();
            $total_coach = User::role('coach')->count();
            $session = Agenda::selectRaw('sum(session) as sum')
                ->join('clients', 'clients.id', '=', 'agendas.client_id')
                ->where('clients.user_id', Auth::user()->id)->first();

            $data = Client::select('clients.id', 'users.name', 'users.phone', 'users.email', 'clients.company', 'clients.occupation', 'clients.organization')
                ->join('users', 'users.id', '=', 'clients.user_id')
                ->where('clients.user_id', Auth::user()->id)
                ->first();
            return view('home', compact('hours', 'total_coach', 'session', 'data'));
        }
    }

    public function show_agendas_data(Request $request, Client $client)
    {
        if (auth()->user()->hasRole('coach')) {

            // agenda
            if ($request->ajax()) {

                $data2 = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.time', 'agenda_details.duration')
                    ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
                    ->join('clients', 'clients.id', '=', 'agendas.client_id')
                    ->where('clients.owner_id', Auth::user()->id)->orderBy('date', 'asc')->orderBy('time', 'asc')
                    ->get();
                return DataTables::of($data2)
                    ->addIndexColumn()
                    ->make(true);
            }
        } elseif (auth()->user()->hasRole('coachee')) {
            // agenda
            if ($request->ajax()) {

                $data = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.time', 'agenda_details.duration')
                    ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
                    ->join('clients', 'clients.id', '=', 'agendas.client_id')
                    ->where('clients.user_id', Auth::user()->id)->orderBy('date', 'asc')->orderBy('time', 'asc')
                    ->get();
                return DataTables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }
        }
    }

    public function show_upcoming_data(Request $request, Client $client)
    {
        if ($request->ajax()) {

            $data = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.time', 'agenda_details.session_name')
                ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
                ->join('clients', 'clients.id', '=', 'agendas.client_id')
                ->where('status', 'scheduled')
                ->where('clients.user_id', Auth::user()->id)
                ->orderBy('date', 'asc')->orderBy('time', 'asc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function store_data(Request $request, $id)
    {
        $client = Client::find($id);
        $user = User::find($client->user_id);

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
