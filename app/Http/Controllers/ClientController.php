<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Agenda_detail;
use App\Models\Coaching_note;
use App\Models\Agenda;
use App\Models\Plan;
use DataTables;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
		/* $data = Client::orderBy('id','DESC')->get();
		return view('clients.index',compact('data')); */

		if ($request->ajax()) {
            $data = Client::where('owner_id',Auth::user()->id)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
								  <div class="dropdown-menu dropdown-menu-right">
								  <a href="javascript:;" class="dropdown-item editClient"  data-id="'.$row->id.'" data-original-title="Edit"><i data-feather="edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-small-4 mr-50"><polyline points="3 6 5 6 21 6"></i> Edit</a>
								  <a href="'. route('clients.show', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Details</a>
								  <a href="https://wa.me/62'. $row->phone .'" class="dropdown-item" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive font-small-4 mr-50"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>Kirim WA</a>
								  <a href="javascript:;" class="dropdown-item deleteClient" data-id="'.$row->id.'" data-original-title="Delete" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-small-4 mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete</a>
								  </div></div>
                  ';
								  ';
								  ';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
		return view('clients.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
		return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      Client::updateOrCreate(['id' => $request->Client_id],
      ['name' => $request->name, 'email' => $request->email, 'phone' =>  $request->phone, 'organization' => $request->organization, 'company' => $request->company, 'occupation' => $request->occupation, 'program' => 'Starco', 'owner_id' => Auth::user()->id]);

      return response()->json(['success'=>'Customer saved successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
		//$client = Client::find($id);
    $agenda_id = Agenda::where('client_id',$client->id)->pluck('id');
    $agenda_detail_id = Agenda_detail::whereIn('agenda_id',$agenda_id)->pluck('id');
    $coaching_note = Coaching_note::with('agenda_detail')->whereIn('agenda_detail_id',$agenda_detail_id)->get();
    $agenda_detail = Agenda_detail::whereIn('agenda_id',$agenda_id)->where('status','finished')->get();
    // return($coaching_note);

		return view('clients.show',compact('client','coaching_note','agenda_detail'));
    }

    public function show_sessions_data(Request $request, Client $client){
      if ($request->ajax()) {
          $data = Agenda_detail::select('agenda_details.id', 'agenda_details.time', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.topic','agenda_details.created_at')
            ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
            ->join('clients', 'clients.id', '=', 'agendas.client_id')
            ->where('clients.id', $client->id)->latest()
            ->get();

          return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
              $actionBtn = '<a href="'. route('agendas.show', $row->id) . '" class="btn-sm btn-primary">Detail</a>';
              return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
      }

    }

    public function show_plans_data(Request $request, Client $client){
      if ($request->ajax()) {
          $data = Plan::with('client')->where('owner_id', Auth::user()->id)->latest()->get();
          return Datatables::of($data)
              ->addIndexColumn()
              ->addColumn('action', function ($row) {
                  $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
                <div class="dropdown-menu dropdown-menu-right">
                <a href="' . route('plans.edit', $row->id) . '" class="dropdown-item editClient"  data-id="' . $row->id . '" data-original-title="Edit"><i data-feather="edit"></i> Edit</a>
                <a href="https://wa.me/62' . $row->client['phone'] . '" class="dropdown-item" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive font-small-4 mr-50"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>Kirim WA</a>
                <a href="javascript:;" class="dropdown-item deletePlan" data-id="' . $row->id . '" data-original-title="Delete" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-small-4 mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete</a>
                </div></div>';
                  return $actionBtn;
              })
              ->rawColumns(['action'])
              ->make(true);
      }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
		$Client = Client::find($id);
        return response()->json($Client);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
		Client::find($id)->delete();
		return response()->json(['success'=>'Client deleted!']);
    }
}
