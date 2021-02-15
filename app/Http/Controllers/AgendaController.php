<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agenda;
use App\Models\Agenda_detail;
use App\Models\Coaching_note;
use App\Models\Client;
use App\Models\Plan;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;

class AgendaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  function __construct()
  {
    $this->middleware('permission:list-agenda',['only' => 'index']);
    $this->middleware('permission:create-agenda', ['only' => ['create','store']]);
    $this->middleware('permission:update-agenda', ['only' => ['edit','update','ajaxPlans']]);
    $this->middleware('permission:detail-agenda', ['only' => ['show','agenda_detail_update','feedback_download','note_download']]);
    $this->middleware('permission:delete-agenda', ['only' => ['destroy']]);
  }



  public function index(Request $request)
  {

    if ($request->ajax()) {
      //get data of table
      $data = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.status', 'agenda_details.created_at')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('clients', 'clients.id', '=', 'agendas.client_id')
        ->where('clients.owner_id', Auth::user()->id)->latest()
        ->get();

      //return data as datatable json
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {

          //add update button if user have permission
          if (auth()->user()->can('update-agenda')) {
            $edit_btn = '<a href="' . route('agendas.edit', $row->id) . '" class="dropdown-item"  data-id="' . $row->id . '" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4 mr-50"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>Edit</a>';
          } else {
            $edit_btn = null;
          };

          //add detail and whatsapp button if user have permission
          if (auth()->user()->can('detail-agenda')) {
            $detail_btn = '<a href="' . route('agendas.show', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Details</a>';
            $whatsapp_btn = '<a href="https://wa.me/62' . $row->phone . '" class="dropdown-item" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive font-small-4 mr-50"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>Kirim WA</a>';
          } else {
            $detail_btn = null;
            $whatsapp_btn = null;
          };

          //add delete button if user have permission
          if (auth()->user()->can('delete-agenda')) {
            $delete_btn = '<a href="javascript:;" class="dropdown-item deleteAgenda" data-id="' . $row->id . '" data-original-title="Delete" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-small-4 mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete</a></div>';
          } else {
            $delete_btn = null;
          };

          //final dropdown button that shows on view
          $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
          <div class="dropdown-menu dropdown-menu-right">'. $edit_btn . $detail_btn . $whatsapp_btn . $delete_btn .'</div>';
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
    $this->validate($request, [
      'client_id'     => 'required',
      'session'       => 'required',
      'type_session'  => 'required',
      'plan_id'       => 'required',
    ], [
      'client_id.required'            => "Silahkan pilih client anda terlebih dahulu!",
      'session.required'              => "Silahkan pilih banyaknya sesi terlebih dahulu!",
      'type_session.required'         => "Silahkan pilih tipe sesi terlebih dahulu!",
      'plan_id.required'              => "Silahkan pilih plan anda terlebih dahulu!",
    ]);

    $agenda = new Agenda;
    $agenda->client_id = $request->client_id;
    $agenda->session = $request->session;
    $agenda->type_session = $request->session;
    $agenda->owner_id = Auth::user()->id;
    $agenda->plan_id = $request->plan_id;
    $agenda->save();

    for ($i = 1; $i <= $agenda->session; $i++) {
      $agenda_detail = new Agenda_detail;
      $agenda_detail->agenda_id = $agenda->id;
      $agenda_detail->status = 'unschedule';
      $agenda_detail->session_name = 'Sesi ' . $i;
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
    $agenda_detail = Agenda_detail::where('id', $id)->first();
    $agenda = Agenda::with('client')->where('id', $agenda_detail->agenda_id)->first();
    $coaching_note = Coaching_note::where('agenda_detail_id', $id)->first();

    return view('agendas.detail', compact('agenda_detail', 'agenda', 'coaching_note'));
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
    $agenda_detail = Agenda_detail::where('id', $id)->first();
    $agenda = Agenda::where('id', $agenda_detail->agenda_id)->first();
    $client = Client::where('id', $agenda->client_id)->first();
    $plan = Plan::where('id', $agenda->plan_id)->first();

    return view('agendas.edit', compact('agenda', 'client', 'agenda_detail', 'plan'));
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
    $this->validate($request, [
      'topic'         => 'required',
      'date'          => 'required',
      'time'          => 'required',
      'duration'      => 'required',
    ], [
      'topic.required'            => "Silahkan isi topic sesi terlebih dahulu!",
      'date.required'             => "Silahkan isi tanggal sesi terlebih dahulu!",
      'time.required'             => "Silahkan isi waktu sesi terlebih dahulu!",
      'duration.required'         => "Silahkan isi durasi sesi terlebih dahulu!",
    ]);

    $agenda_detail = Agenda_detail::where('id', $id)->first();
    $agenda_detail->topic = $request->topic;

    if ($agenda_detail->status == 'unschedule' && $agenda_detail->date == null) {
      $agenda_detail->status = 'scheduled';
    };

    if ($agenda_detail->status == 'scheduled' && $agenda_detail->date != null && ($request->date != $agenda_detail->date || $request->time != $agenda_detail->time)) {
      $agenda_detail->status = 'rescheduled';
    };

    $agenda_detail->date = $request->date;
    $agenda_detail->time = $request->time;
    $agenda_detail->media = $request->media;
    $agenda_detail->media_url = $request->media_url;
    $agenda_detail->duration = $request->duration;
    $agenda_detail->update();

    return redirect('/agendas')->with('success', 'Data berhasil diupdate!');
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
    Agenda_detail::find($id)->delete();
    return response()->json(['success' => 'Agenda deleted!']);
  }

  public function agenda_detail_update(Request $request, $id)
  {
    // dd($request);

    $this->validate($request, [
      'subject'       => 'required',
      'summary'       => 'required',
    ], [
      'subject.required'       => "Silahkan isi subject note anda terlebih dahulu!",
      'summary.required'       => "Silahkan isi summary note anda terlebih dahulu!",
    ]);

    $agenda_detail = Agenda_detail::where('id', $id)->first();

    if ($request->has('feedback')) {
      $agenda_detail->feedback = $request->feedback;
      $agenda_detail->status = 'finished';
    }

    if ($request->hasFile('feedback_attachment')) {
      $filenameWithExt = $request->file('feedback_attachment')->getClientOriginalName();
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      $extension = $request->file('feedback_attachment')->getClientOriginalExtension();
      $filenameSave = $filename . '_' . time() . '.' . $extension;
      $path = $request->file('feedback_attachment')->storeAs('public/attachment', $filenameSave);
      $agenda_detail->attachment = $filenameSave;
      $agenda_detail->status = 'finished';
    }
    $agenda_detail->update();

    $coaching_note = Coaching_note::updateOrCreate(['agenda_detail_id' => $request->id], ['subject' => $request->subject, 'summary' => $request->summary, 'owner_id' => Auth::user()->id]);

    if ($request->hasFile('note_attachment')) {
      $filenameWithExt = $request->file('note_attachment')->getClientOriginalName();
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      $extension = $request->file('note_attachment')->getClientOriginalExtension();
      $filenameSave = $filename . '_' . time() . '.' . $extension;
      $path = $request->file('note_attachment')->storeAs('public/attachment', $filenameSave);
      $coaching_note->attachment = $filenameSave;
      $coaching_note->update();
    }


    return redirect('/agendas')->with('success', 'Feedback dan notes berhasil disimpan!');
  }

  public function feedback_download($id)
  {
    $agenda_detail = Agenda_detail::where('id', $id)->first();
    return response()->download(storage_path('app/public/attachment/' . $agenda_detail->attachment));
  }

  public function note_download($id)
  {
    $coaching_note = Coaching_note::where('id', $id)->first();
    return response()->download(storage_path('app/public/attachment/' . $coaching_note->attachment));
  }

  public function ajaxPlans(Request $request)
  {
    $plans = [];
    if ($request->has('q')) {
      $search = $request->q;
      $plans = Plan::where('owner_id', Auth::user()->id)
        ->where('objective', 'LIKE', "%$search%")
        ->get();
    } else {
      $plans = Plan::orderby('objective', 'asc')
        ->where('owner_id', Auth::user()->id)
        ->get();
    }
    return response()->json($plans);
  }
}
