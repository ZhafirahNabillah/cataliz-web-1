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
use App\Models\User;
use DataTables;

class ClientController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  function __construct()
  {
    $this->middleware('permission:list-user', ['only' => 'index']);
    $this->middleware('permission:create-user', ['only' => ['create', 'store']]);
    $this->middleware('permission:update-user', ['only' => ['edit', 'store']]);
    $this->middleware('permission:detail-user', ['only' => ['show', 'show_agendas_data', 'show_plans_data', 'show_sessions_data']]);
    $this->middleware('permission:delete-user', ['only' => ['destroy']]);
  }

  public function index(Request $request)
  {

    if ($request->ajax()) {
      //get data of table
      if (auth()->user()->hasRole('admin')) {
        $data = Client::with('user')->get();
      } elseif (auth()->user()->hasRole('coach')) {
        $data = Client::with('user')->where('owner_id', Auth::user()->id)->latest()->get();

        //return data as datatable json
        return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {

            //add update button if user have permission
            if (auth()->user()->can('update-user')) {
              $edit_btn = '<a href="javascript:;" class="dropdown-item editClient"  data-id="' . $row->id . '" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4 mr-50"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>Edit</a>';
            } else {
              $edit_btn = null;
            }

            //add detail and whatsapp button if user have permission
            if (auth()->user()->can('detail-user')) {
              $detail_btn = '<a href="' . route('clients.show', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Details</a>';
              $whatsapp_btn = '<a href="https://wa.me/62' . $row->phone . '" class="dropdown-item" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive font-small-4 mr-50"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>Kirim WA</a>';
            } else {
              $detail_btn = null;
              $whatsapp_btn = null;
            }

            //add delete button if user have permission
            if (auth()->user()->can('delete-user')) {
              $delete_btn = '<a href="javascript:;" class="dropdown-item deleteClient" data-id="' . $row->id . '" data-original-title="Delete" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-small-4 mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete</a>';
            } else {
              $delete_btn = null;
            }

            //final dropdown button that shows on view
            $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
            <div class="dropdown-menu dropdown-menu-right">' . $edit_btn . $detail_btn . $whatsapp_btn . $delete_btn . '</div>';

            return $actionBtn;
          })
          ->rawColumns(['action'])
          ->make(true);
      } elseif (auth()->user()->hasRole('coachee')) {

        $data = User::role('coach')->get();

        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $actionBtn = '<a href="javascript:;" class="btn-sm btn-primary detailCoach" data-id = "' . $row->id . '">Detail</a>';
            return $actionBtn;
          })
          ->rawColumns(['action'])
          ->make(true);
      }
    }
    return view('clients.index');
  }

  //method to show coach list
  public function show_coach_list(Request $request)
  {
    if ($request->ajax()) {
      $data = User::role('coach')->get();

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $detail_btn = '<a href="javascript:;" class="btn-sm btn-primary editUser" data-id = "' . $row->id . '">Update</a>';
          $suspend_btn = '<a href="javascript:;" class="btn-sm btn-danger suspendUser" data-id = "' . $row->id . '">Suspend</a>';
          $unsuspend_btn = '<a href="javascript:;" class="btn-sm btn-success unsuspendUser" data-id = "' . $row->id . '">Unsuspend</a>';

          if ($row->status == 1) {
            $actionBtn = $detail_btn . ' ' . $suspend_btn;
          } else {
            $actionBtn = $detail_btn . ' ' . $unsuspend_btn;
          }
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
  }

  //method to show coachee list
  public function show_coachee_list(Request $request)
  {
    if ($request->ajax()) {
      $data = User::role('coachee')->get();

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $detail_btn = '<a href="javascript:;" class="btn-sm btn-primary editUser" data-id = "' . $row->id . '">Update</a>';
          $suspend_btn = '<a href="javascript:;" class="btn-sm btn-danger suspendUser" data-id = "' . $row->id . '">Suspend</a>';
          $unsuspend_btn = '<a href="javascript:;" class="btn-sm btn-success unsuspendUser" data-id = "' . $row->id . '">Unsuspend</a>';

          if ($row->status == 1) {
            $actionBtn = $detail_btn . ' ' . $suspend_btn;
          } else {
            $actionBtn = $detail_btn . ' ' . $unsuspend_btn;
          }
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
  }

  //method to show admin list
  public function show_admin_list(Request $request)
  {
    if ($request->ajax()) {
      $data = User::role('admin')->get();

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $detail_btn = '<a href="javascript:;" class="btn-sm btn-primary editUser" data-id = "' . $row->id . '">Update</a>';
          $suspend_btn = '<a href="javascript:;" class="btn-sm btn-danger suspendUser" data-id = "' . $row->id . '">Suspend</a>';
          $unsuspend_btn = '<a href="javascript:;" class="btn-sm btn-success unsuspendUser" data-id = "' . $row->id . '">Unsuspend</a>';

          if ($row->status == 1) {
            // code...
            $actionBtn = $detail_btn . ' ' . $suspend_btn;
          } else {
            $actionBtn = $detail_btn . ' ' . $unsuspend_btn;
          }
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
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
    Client::updateOrCreate(
      ['id' => $request->Client_id],
      ['name' => $request->name, 'email' => $request->email, 'phone' =>  $request->phone, 'organization' => $request->organization, 'company' => $request->company, 'occupation' => $request->occupation, 'program' => 'Starco', 'owner_id' => Auth::user()->id]
    );

    return response()->json(['success' => 'Customer saved successfully!']);
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Request $request, Client $client)
  {
    $agenda_id = Agenda::where('client_id', $client->id)->pluck('id');
    $agenda_detail_id = Agenda_detail::whereIn('agenda_id', $agenda_id)->pluck('id');
    $coaching_note = Coaching_note::with('agenda_detail')->whereIn('agenda_detail_id', $agenda_detail_id)->get();
    $agenda_detail = Agenda_detail::whereIn('agenda_id', $agenda_id)->where('status', 'finished')->get();

    $total_agenda = Agenda::selectRaw('count(id) as count')
      ->where('owner_id', Auth::user()->id)
      ->where('client_id', $client->id)
      ->first();

    $total_session = Agenda::selectRaw('sum(session) as sum')
      ->where('owner_id', Auth::user()->id)
      ->where('client_id', $client->id)
      ->first();

    $total_event = Agenda_detail::select('agenda_details.id', 'agendas.client_id')
      ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
      ->where('agendas.owner_id', Auth::user()->id)
      ->where('agendas.client_id', $client->id)
      ->where('agenda_details.status', 'scheduled')
      ->count();

    if ($request->ajax()) {
      // upcoming event
      $data = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.time', 'agenda_details.session_name')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('clients', 'clients.id', '=', 'agendas.client_id')
        ->where('clients.id', $client->id)
        ->where('status', 'scheduled')
        ->orderBy('date', 'asc')->orderBy('time', 'asc')
        ->get();
      return DataTables::of($data)
        ->addIndexColumn()
        ->make(true);
    }
    // return $total_event;
    return view('clients.show', compact('client', 'coaching_note', 'agenda_detail', 'total_event', 'total_agenda', 'total_session'));
  }

  public function show_agendas_data(Request $request, Client $client)
  {
    // agenda
    if ($request->ajax()) {

      $data2 = Agenda_detail::select('agenda_details.id', 'clients.name', 'agenda_details.date', 'agenda_details.time', 'agenda_details.duration')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('clients', 'clients.id', '=', 'agendas.client_id')
        ->where('clients.id', $client->id)
        ->where('clients.owner_id', Auth::user()->id)->orderBy('date', 'asc')->orderBy('time', 'asc')
        ->get();
      return DataTables::of($data2)
        ->addIndexColumn()
        ->make(true);
    }
  }

  public function show_sessions_data(Request $request, Client $client)
  {
    if ($request->ajax()) {
      $data = Agenda_detail::select('agenda_details.id', 'agenda_details.time', 'agenda_details.date', 'agenda_details.duration', 'agenda_details.session_name', 'agenda_details.topic', 'agenda_details.created_at')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('clients', 'clients.id', '=', 'agendas.client_id')
        ->where('clients.id', $client->id)->latest()
        ->get();

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $actionBtn = '<a href="' . route('agendas.show', $row->id) . '" class="btn-sm btn-primary">Detail</a>';
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
  }

  public function show_feedbacks_data(Request $request, Client $client)
  {
    if ($request->ajax()) {
      $data = Agenda_detail::select('agenda_details.id', 'users.name', 'agenda_details.session_name', 'agenda_details.topic', 'agenda_details.created_at')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('users', 'agendas.owner_id', '=', 'users.id')
        ->join('clients', 'clients.id', '=', 'agendas.client_id')
        ->where('clients.id', $client->id)->latest()
        ->get();

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $actionBtn = '<a href="javascript:;" id="detailFeedback" class="btn-sm btn-primary" data-id="' . $row->id . '" data-original-title="detail feedback">Detail</a>';
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
  }

  public function show_notes_data(Request $request, Client $client)
  {
    if ($request->ajax()) {
      $data = Agenda_detail::select('coaching_notes.id', 'users.name', 'agenda_details.session_name', 'agenda_details.topic', 'coaching_notes.subject', 'agenda_details.created_at')
        ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
        ->join('users', 'agendas.owner_id', '=', 'users.id')
        ->join('clients', 'clients.id', '=', 'agendas.client_id')
        ->join('coaching_notes', 'coaching_notes.agenda_detail_id', '=', 'agenda_details.id')
        ->where('clients.id', $client->id)->latest()
        ->get();

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $actionBtn = '<a href="javascript:;" id="detailNote" class="btn-sm btn-primary" data-id="' . $row->id . '" data-original-title="detail note">Detail</a>';
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
  }

  public function show_plans_data(Request $request, Client $client)
  {
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

  public function show_detail_feedbacks($id)
  {
    $data = Agenda_detail::select('agenda_details.id', 'users.name', 'agenda_details.session_name', 'agenda_details.topic', 'agenda_details.feedback_from_coach', 'agenda_details.attachment_from_coach', 'agenda_details.created_at')
      ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
      ->join('users', 'agendas.owner_id', '=', 'users.id')
      ->join('clients', 'clients.id', '=', 'agendas.client_id')
      ->where('agenda_details.id', $id)
      ->first();

    return response()->json($data);
  }

  public function show_detail_notes($id)
  {
    $data = Agenda_detail::select('coaching_notes.id', 'users.name', 'agenda_details.session_name', 'agenda_details.topic', 'coaching_notes.subject', 'coaching_notes.attachment', 'coaching_notes.summary', 'agenda_details.created_at')
      ->join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')
      ->join('users', 'agendas.owner_id', '=', 'users.id')
      ->join('clients', 'clients.id', '=', 'agendas.client_id')
      ->join('coaching_notes', 'coaching_notes.agenda_detail_id', '=', 'agenda_details.id')
      ->where('coaching_notes.id', $id)
      ->first();

    return response()->json($data);
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
    return response()->json(['success' => 'Client deleted!']);
  }
}
