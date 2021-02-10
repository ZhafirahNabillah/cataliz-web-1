<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Agenda_detail;
use App\Models\Client;
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
        // Atas
        $client = Client::where('owner_id', Auth::user()->id)->count();
        $hours = Agenda::groupBy('agendas.id')
            ->selectRaw('sum(agenda_details.duration)/60 as sum')
            ->join('agenda_details', 'agenda_id', '=', 'agendas.id')
            ->where([
                ['agendas.owner_id', Auth::user()->id],
                ['status', 'finished'],
            ])->first();
        $session = Agenda::selectRaw('sum(session) as sum')->where('owner_id', Auth::user()->id)->first();

        // Bawah
        if ($request->ajax()) {
            //agenda
            $data = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.time', 'agenda_details.session_name')
                ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
                ->join('clients', 'clients.id', '=', 'agendas.client_id')
                ->where('status', 'scheduled')
                ->orderBy('date', 'asc')->orderBy('time', 'asc')
                ->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        // return $hours;
        return view('home', compact('client', 'hours', 'session'));
    }

    public function show_agendas_data(Request $request, Client $client)
    {
        // upcoming
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
    }
}
