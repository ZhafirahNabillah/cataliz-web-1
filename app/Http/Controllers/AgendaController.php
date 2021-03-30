<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DataTables;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Models\Permission;
use App\Http\Controllers\MailController;
use App\Models\Agenda;
use App\Models\Agenda_detail;
use App\Models\Coaching_note;
use App\Models\Client;
use App\Models\Plan;
use App\Models\User;
use App\Models\Coach;
use App\Models\Feedback;

class AgendaController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  function __construct()
  {
    $this->middleware('permission:list-agenda', ['only' => 'index']);
    $this->middleware('permission:create-agenda', ['only' => ['create', 'store']]);
    $this->middleware('permission:update-agenda', ['only' => ['edit', 'update', 'ajaxPlans']]);
    $this->middleware('permission:detail-agenda', ['only' => ['show', 'agenda_detail_update', 'feedback_download', 'note_download']]);
    $this->middleware('permission:delete-agenda', ['only' => ['destroy']]);
  }


  //method to show agenda index page and get summary data of agenda (top of the page)
  public function index(Request $request)
  {

    if (auth()->user()->hasRole('admin')) {

      $total_unscheduled_sessions = Agenda_detail::where('status', 'unschedule')->get()->count();
      $total_scheduled_sessions = Agenda_detail::where('status', 'scheduled')->get()->count();
      $total_rescheduled_sessions = Agenda_detail::where('status', 'rescheduled')->get()->count();
      $total_finished_sessions = Agenda_detail::where('status', 'finished')->get()->count();
      $total_canceled_sessions = Agenda_detail::where('status', 'canceled')->get()->count();
    } elseif (auth()->user()->hasRole('coach')) {
      $coach = Coach::where('user_id', auth()->user()->id)->first();
      $plans = $coach->plan->pluck('id');

      $agendas = Agenda::whereIn('plan_id', $plans)->pluck('id');
      $sessions = Agenda_detail::whereIn('agenda_id', $agendas)->get();

      $total_unscheduled_sessions = $sessions->where('status', 'unschedule')->count();
      $total_scheduled_sessions = $sessions->where('status', 'scheduled')->count();
      $total_rescheduled_sessions = $sessions->where('status', 'rescheduled')->count();
      $total_finished_sessions = $sessions->where('status', 'finished')->count();
      $total_canceled_sessions = $sessions->where('status', 'canceled')->count();
    } elseif (auth()->user()->hasRole('coachee')) {
      $client = Client::where('user_id', auth()->user()->id)->first();

      $plans = $client->plans->pluck('id');
      $agendas = Agenda::whereIn('plan_id', $plans)->pluck('id');
      $sessions = Agenda_detail::whereIn('agenda_id', $agendas)->get();

      $total_unscheduled_sessions = $sessions->where('status', 'unschedule')->count();
      $total_scheduled_sessions = $sessions->where('status', 'scheduled')->count();
      $total_rescheduled_sessions = $sessions->where('status', 'rescheduled')->count();
      $total_finished_sessions = $sessions->where('status', 'finished')->count();
      $total_canceled_sessions = $sessions->where('status', 'canceled')->count();
    }

    return view('agendas.index', compact('total_unscheduled_sessions', 'total_scheduled_sessions', 'total_rescheduled_sessions', 'total_canceled_sessions', 'total_finished_sessions'));
  }

  //method to show list individuals session on agenda index page
  public function show_individual_sessions(Request $request)
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

      //return data as datatable json
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('status_colored', function ($row) {
          if ($row->status == 'unschedule') {
            $unschedule_status = '<span class="badge badge-pill badge-secondary" style="
            background-color: #F1AF33;">unschedule</span>';
            return $unschedule_status;
          } elseif ($row->status == 'scheduled') {
            $scheduled_status = '<span class="badge badge-pill badge-warning" style="
            background-color: #CADB05;">scheduled</span>';
            return $scheduled_status;
          } elseif ($row->status == 'rescheduled') {
            $rescheduled_status = '<span class="badge badge-pill badge-primary">rescheduled</span>';
            return $rescheduled_status;
          } elseif ($row->status == 'finished') {
            $finished_status = '<span class="badge badge-pill badge-success">finished</span>';
            return $finished_status;
          } elseif ($row->status == 'canceled') {
            $canceled_status = '<span class="badge badge-pill badge-danger">canceled</span>';
            return $canceled_status;
          }
        })
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
          <div class="dropdown-menu dropdown-menu-right">' . $edit_btn . $detail_btn . $delete_btn . '</div>';
          return $actionBtn;
        })
        ->rawColumns(['action', 'status_colored'])
        ->make(true);
    }
  }

  //method to show list group sessions on agenda index page
  public function show_group_sessions(Request $request)
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
        // ->where('plans.owner_id', $client->id)->latest()
        ->get();
    }

    if ($request->ajax()) {

      //return data as datatable json
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('status_colored', function ($row) {
          if ($row->status == 'unschedule') {
            $unschedule_status = '<span class="badge badge-pill badge-secondary" style="
            background-color: #F1AF33;">unschedule</span>';
            return $unschedule_status;
          } elseif ($row->status == 'scheduled') {
            $scheduled_status = '<span class="badge badge-pill badge-warning" style="
            background-color: #CADB05;">scheduled</span>';
            return $scheduled_status;
          } elseif ($row->status == 'rescheduled') {
            $rescheduled_status = '<span class="badge badge-pill badge-primary">rescheduled</span>';
            return $rescheduled_status;
          } elseif ($row->status == 'finished') {
            $finished_status = '<span class="badge badge-pill badge-success">finished</span>';
            return $finished_status;
          } elseif ($row->status == 'canceled') {
            $canceled_status = '<span class="badge badge-pill badge-danger">canceled</span>';
            return $canceled_status;
          }
        })
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
          <div class="dropdown-menu dropdown-menu-right">' . $edit_btn . $detail_btn . $delete_btn . '</div>';
          return $actionBtn;
        })
        ->rawColumns(['action', 'status_colored'])
        ->make(true);
    }
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */

  // method to show create agenda page
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

  //method to store new agenda also create initials agenda detail and feedback
  public function store(Request $request)
  {
    // $user_id = Plan::select('client_plan.client_id')
    //   ->rightJoin('client_plan', 'plan_id', '=', 'plans.id')
    //   ->where('plans.id', $request->plan_id)
    //   ->get();

    $this->validate($request, [
      'session'       => 'required',
      'type_session'  => 'required',
      'plan_id'       => 'required',
    ], [
      'session.required'              => "Silahkan pilih banyaknya sesi terlebih dahulu!",
      'type_session.required'         => "Silahkan pilih tipe sesi terlebih dahulu!",
      'plan_id.required'              => "Silahkan pilih plan anda terlebih dahulu!",
    ]);

    $agenda = new Agenda;
    $agenda->session = $request->session;
    $agenda->type_session = $request->session;
    $agenda->plan_id = $request->plan_id;
    $agenda->save();

    $plan = $agenda->plan;
    $coach = $plan->owner;
    $clients = $plan->clients;

    for ($i = 1; $i <= $agenda->session; $i++) {
      $agenda_detail = new Agenda_detail;
      $agenda_detail->agenda_id = $agenda->id;
      $agenda_detail->status = 'unschedule';
      $agenda_detail->session_name = 'Session ' . $i;
      $agenda_detail->save();

      $feedback_from_coach = new Feedback;
      $feedback_from_coach->agenda_detail_id = $agenda_detail->id;
      $feedback_from_coach->user_id = $coach->user_id;
      $feedback_from_coach->from = 'coach';
      $feedback_from_coach->save();

      foreach ($clients as $client) {
        $feedback_from_coachee = new Feedback;
        $feedback_from_coachee->agenda_detail_id = $agenda_detail->id;
        $feedback_from_coachee->user_id = $client->user_id;
        $feedback_from_coachee->from = 'coachee';
        $feedback_from_coachee->save();
      }
    }

    return redirect('/agendas')->with('success', 'Agenda successfully created!');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  //method to show detail agenda also feedback and coaching note if already filled
  public function show($id)
  {
    $agenda_detail = Agenda_detail::find($id);
    $agenda = $agenda_detail->agenda;
    $plan = $agenda->plan;

    $feedbacks = $agenda_detail->feedbacks;

    if (auth()->user()->hasRole('coachee')) {
      $feedback = $feedbacks->where('from', 'coachee')->where('user_id', auth()->user()->id)->first();
      // return $feedback;
    } elseif (auth()->user()->hasRole('coach')) {
      $feedback = $feedbacks->where('from', 'coach')->where('user_id', auth()->user()->id)->first();
      // return $feedback;
    } else {
      $feedbacks = Feedback::where('agenda_detail_id', $id)->get();
      $feedback_from_coach = $feedbacks->where('from', 'coach')->first();
      $feedback_from_coachee = $feedbacks->where('from', 'coachee');
    }

    $coaching_note = Coaching_note::where('agenda_detail_id', $id)->first();

    if (auth()->user()->hasRole('admin')) {
      return view('agendas.detail', compact('agenda_detail', 'agenda', 'coaching_note', 'plan', 'feedback_from_coach', 'feedback_from_coachee'));
    } else {
      return view('agendas.detail', compact('agenda_detail', 'agenda', 'coaching_note', 'plan', 'feedback'));
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  //method to show edit agenda page
  public function edit($id)
  {
    //
    $agenda_detail = Agenda_detail::where('id', $id)->first();
    $agenda = Agenda::where('id', $agenda_detail->agenda_id)->first();
    // $client = Client::where('id', $agenda->client_id)->first();
    // $plan = Plan::where('id', $agenda->plan_id)->first();
    $plan = $agenda->plan;
    $clients = $plan->clients;


    return view('agendas.edit', compact('agenda', 'clients', 'agenda_detail', 'plan'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  //method to update agenda detail/session on agenda edit page and send the email for scheduled and rescheduled session
  public function update(Request $request, $id)
  {
    //
    $this->validate($request, [
      'topic'         => 'required',
      'date'          => 'required',
      'time'          => 'required',
      'media'         => 'required',
      'duration'      => 'required',
    ]);

    $agenda_detail = Agenda_detail::with('agenda')->where('id', $id)->first();
    $old_agenda_detail = Agenda_detail::with('agenda')->where('id', $id)->first();

    $agenda = $agenda_detail->agenda;
    $plan = $agenda->plan;
    $clients = $plan->clients;
    $coach_detail = Coach::find($plan->owner_id)->user;
    $was_scheduled = false;
    $was_rescheduled = false;

    //check if status unschedule and the date is filled
    if ($agenda_detail->status == 'unschedule' && $agenda_detail->date == null) {
      $agenda_detail->status = 'scheduled';
      $was_scheduled = true;
    //check if status schedule or rescheduled and the date and time was changed
    } elseif (($agenda_detail->status == 'scheduled' || $agenda_detail->status == 'rescheduled') && ($request->date != $agenda_detail->date || $request->time != $agenda_detail->time)) {
      $agenda_detail->status = 'rescheduled';
      $was_rescheduled = true;
    }

    $agenda_detail->topic = $request->topic;
    $agenda_detail->date = $request->date;
    $agenda_detail->time = $request->time;
    $agenda_detail->media = $request->media;

    //checking the media
    if ($agenda_detail->media == 'Whatsapp') {
      $agenda_detail->media_url = null;
    } else {
      $agenda_detail->media_url = $request->media_url;
    }

    $agenda_detail->duration = $request->duration;
    $agenda_detail->update();

    //checking if status was changed to send the email
    if ($was_scheduled) {
      MailController::SendSessionScheduledMail($agenda_detail, $clients, $coach_detail);
    } elseif ($was_rescheduled) {
      MailController::SendSessionRescheduledMail($old_agenda_detail, $agenda_detail, $clients, $coach_detail);
    }

    return redirect('/agendas')->with('success', 'Sessions Successfully updated!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  // method to delete agenda on agenda index page
  public function destroy($id)
  {
    //
    Agenda_detail::find($id)->delete();
    return response()->json(['success' => 'Agenda deleted!']);
  }

  // method to add feedback from coachee on detail agenda page
  public function add_feedback_from_coachee(Request $request, $id)
  {

    // return $request;
    // return $client;
    $agenda_detail = Agenda_detail::find($id);
    $feedback = Feedback::where('agenda_detail_id', $agenda_detail->id)->where('user_id', auth()->user()->id)->where('from', 'coachee')->first();
    // return $feedback;

    //check if feedback input was filled
    if ($request->filled('feedback')) {
      //add feeback form coachee to database session
      $feedback->feedback = $request->feedback;
    }

    //check if feedback attachment was filled
    if ($request->hasFile('feedback_attachment')) {
      //add feedback attachment form coachee to database session
      $this->validate($request, [
        'feedback_attachment'       => 'max:2048|mimes:pdf,doc,docx,txt',
      ], [
        'feedback_attachment.max'   => "Ukuran file feedback tidak boleh melebihi 2Mb!",
        'feedback_attachment.mimes' => "Format file feedback yang didukung adalah .pdf .doc .docx .txt!",
      ]);
      $filenameWithExt = $request->file('feedback_attachment')->getClientOriginalName();
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      $extension = $request->file('feedback_attachment')->getClientOriginalExtension();
      $filenameSave = $filename . '_' . time() . '.' . $extension;
      Storage::disk('s3')->put('attachment/' . $filenameSave, file_get_contents($request->file('feedback_attachment')));
      // $path = $request->file('feedback_attachment')->storeAs('public/attachment', $filenameSave);
      $feedback->attachment = $filenameSave;
    }

    //check if rating from coachee was filled
    if ($request->filled('coach_rating')) {
      //add rating from coachee to database session
      $feedback->rating = $request->coach_rating;
    }

    $agenda_detail->status = 'finished';
    $agenda_detail->update();
    $feedback->update();

    return redirect('/agendas')->with('success', 'Feedback saved successfully!');
  }

  //method to update feedback and coaching note on agenda detail page
  public function agenda_detail_update(Request $request, $id)
  {
    // return $request;

    $agenda_detail = Agenda_detail::find($id);
    if (auth()->user()->hasRole('coach')) {
      $feedback = $agenda_detail->feedbacks->where('from', 'coach')->where('user_id', auth()->user()->id)->first();
    } elseif (auth()->user()->hasRole('coachee')) {
      $feedback = $agenda_detail->feedbacks->where('from', 'coachee')->where('user_id', auth()->user()->id)->first();
    }
    // return $feedback;

    if ($request->filled('feedback')) {
      $feedback->feedback = $request->feedback;
      $agenda_detail->status = 'finished';
    }

    if ($request->hasFile('feedback_attachment')) {
      $this->validate($request, [
        'feedback_attachment'       => 'max:2048|mimes:pdf,doc,docx,txt',
      ], [
        'feedback_attachment.max'   => "Ukuran file feedback tidak boleh melebihi 2Mb!",
        'feedback_attachment.mimes' => "Format file feedback yang didukung adalah .pdf .doc .docx .txt!",
      ]);
      $filenameWithExt = $request->file('feedback_attachment')->getClientOriginalName();
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      $extension = $request->file('feedback_attachment')->getClientOriginalExtension();
      $filenameSave = $filename . '_' . time() . '.' . $extension;
      Storage::disk('s3')->put('attachment/' . $filenameSave, file_get_contents($request->file('feedback_attachment')));
      $feedback->attachment = $filenameSave;
      $agenda_detail->status = 'finished';
    }

    $feedback->update();
    $agenda_detail->update();

    if ($request->filled('subject') || $request->filled('summary')) {

      $this->validate($request, [
        'subject'       => 'required',
        'summary'       => 'required',
      ], [
        'subject.required'       => "Silahkan isi subject note anda terlebih dahulu!",
        'summary.required'       => "Silahkan isi summary note anda terlebih dahulu!",
      ]);

      $coaching_note = Coaching_note::updateOrCreate(
        ['agenda_detail_id' => $request->id],
        ['subject' => $request->subject, 'summary' => $request->summary, 'owner_id' => Auth::user()->id]
      );
    }

    if ($request->hasFile('note_attachment')) {
      $this->validate($request, [
        'note_attachment'       => 'max:2048|mimes:pdf,doc,docx,txt',
      ], [
        'note_attachment.max'   => "Ukuran file feedback tidak boleh melebihi 2Mb!",
        'note_attachment.mimes' => "Format file feedback yang didukung adalah .pdf .doc .docx .txt!",
      ]);
      $filenameWithExt = $request->file('note_attachment')->getClientOriginalName();
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
      $extension = $request->file('note_attachment')->getClientOriginalExtension();
      $filenameSave = $filename . '_' . time() . '.' . $extension;
      Storage::disk('s3')->put('attachment/' . $filenameSave, file_get_contents($request->file('note_attachment')));
      $coaching_note->attachment = $filenameSave;
      $coaching_note->update();
    }

    return redirect('/agendas')->with('success', 'Feedback and notes saved successfully!');
  }

  //method to download feedback
  public function feedback_download($id)
  {
    $feedback = Feedback::where('id', $id)->first();
    return Storage::disk('s3')->download('attachment/' . $feedback->attachment);
  }

  //method to download agenda
  public function note_download($id)
  {
    $coaching_note = Coaching_note::where('id', $id)->first();
    return Storage::disk('s3')->download('attachment/' . $coaching_note->attachment);
  }

  //method ajax to seach the plan on agenda create page
  public function ajaxPlans(Request $request)
  {
    $plans = [];
    $coach = Coach::where('user_id', auth()->user()->id)->first();
    if ($request->has('q')) {
      $search = $request->q;
      $plans = $coach->plan->where('objective', 'LIKE', "%$search%");
    } else {
      $plans = $coach->plan;
    }
    return response()->json($plans);
  }
}
