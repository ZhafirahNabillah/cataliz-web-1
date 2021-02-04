<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Agenda_detail;
use App\Models\Client;
use DataTables;

class AgendaController extends Controller
{
  /**
  * Display a listing of the resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function index(Request $request)
  {
    //
    //
    if ($request->ajax()) {
        $data = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.status')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('clients', 'clients.id', '=', 'agendas.client_id')
        ->where('clients.owner_id', Auth::user()->id)
        ->get();
      return DataTables::of($data)
      ->addIndexColumn()
      ->addColumn('action', function ($row) {
        $actionBtn = '<div class="d-inline-flex">
        <a class="pr-1 dropdown-toggle hide-arrow text-primary"    data-toggle="dropdown"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
        <div class="dropdown-menu dropdown-menu-right">
        <a href="' . route('agendas.edit', $row->id) . '" class="dropdown-item editClient"  data-id="' . $row->id . '" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4 mr-50"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>Edit</a>
        <a href="https://wa.me/62' . $row->phone . '" class="dropdown-item" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive font-small-4 mr-50"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>Kirim WA</a>
        <a href="javascript:;" class="dropdown-item deleteAgenda" data-id="' . $row->id . '" data-original-title="Delete" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-small-4 mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete</a>
        </div>
        </div>';
        return $actionBtn;
      })
      ->rawColumns(['action'])
      ->make(true);
    }

    return view('agendas.index');
  }

  /**
  * Show the form for creating a new resource.
  *
  * @return \Illuminate\Http\Response
  */
  public function create()
  {
    return view('agendas.create');
  }

  /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
  public function store(Request $request)
  {
    //

    // return($request);
    // $agenda = Agenda::updateOrCreate(['id' => $request->id], ['client_id' => $request->client_id, 'session' => $request->session, 'type_session' => $request->type_session, 'date' =>  $request->date, 'duration' => $request->duration, 'status' => $request->status, 'owner_id' => Auth::user()->id]);
    //
    // if ($agenda->wasChanged()) {
    //   $agenda->status = 'scheduled';
    //   $agenda->update();
    // }
    //
    // if ($agenda->wasRecentlyCreated) {
    //   $agenda->status = 'unschedule';
    //   $agenda->update();
    // }

    $agenda = new Agenda;
    $agenda->client_id = $request->client_id;
    $agenda->session = $request->session;
    $agenda->type_session = $request->session;
    $agenda->owner_id = Auth::user()->id;
    $agenda->save();

    for ($i=1; $i <= $agenda->session ; $i++) {
      $agenda_detail = new Agenda_detail;
      $agenda_detail->agenda_id = $agenda->id;
      $agenda_detail->status = 'unschedule';
      $agenda_detail->session_name = 'Sesi '.$i;
      $agenda_detail->save();
    }

    return redirect('/agendas')->with('success', 'Data berhasil disimpan!');
  }

  /**
  * Display the specified resource.
  *
  * @param  int  $id
  * @return \Illuminate\Http\Response
  */
  public function show($id)
  {
    //
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
    $agenda_detail = Agenda_detail::where('id',$id)->first();
    $agenda = Agenda::where('id',$agenda_detail->agenda_id)->first();
    $client = Client::where('id',$agenda->client_id)->first();
    return view('agendas.edit',compact('agenda','client','agenda_detail'));
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
    $agenda_detail = Agenda_detail::where('id',$id)->first();
    $agenda_detail->topic = $request->topic;
    if ($agenda_detail->date != $request->date) {
      $agenda_detail->status = 'rescheduled';
    } else if($agenda_detail->status == null) {
      $agenda_detail->status = 'scheduled';
    };
    $agenda_detail->date = $request->date;
    $agenda_detail->time = $request->time;
    $agenda_detail->media = $request->media;
    $agenda_detail->media_url = $request->media_url;
    $agenda_detail->duration = $request->duration;
    $agenda_detail->update();

    return redirect('/agendas')->with('success','Data berhasil diupdate!');
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
    Agenda::find($id)->delete();
    return response()->json(['success' => 'Agenda deleted!']);
  }
}
