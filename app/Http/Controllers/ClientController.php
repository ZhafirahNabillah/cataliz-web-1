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
use App\Models\Coach;
use App\Models\Feedback;
use App\Models\Class_model;
use App\Models\Class_has_client;
use DataTables;
use PDF;

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

        $coach = Coach::where('user_id', auth()->user()->id)->first();
        $data = $coach->clients;

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

            if (auth()->user()->can('create-plan')) {
              $create_plan_btn = '<a href="' . url('/plans/create?client=' . $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Create Plan</a>';
            } else {
              $create_plan_btn = null;
            }

            if (auth()->user()->can('create-agenda')) {
              $create_agenda_btn = '<a href="' . url('/agendas/create?client=' . $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Create Agenda</a>';
            } else {
              $create_agenda_btn = null;
            }

            //final dropdown button that shows on view
            $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
            <div class="dropdown-menu dropdown-menu-right">' . $edit_btn . $detail_btn . $delete_btn . $create_plan_btn . $create_agenda_btn . '</div>';

            return $actionBtn;
          })->addColumn('phone', function ($row) {
            $phone = substr($row->phone, 0, -5) . 'xxxxx';

            return $phone;
          })->addColumn('email', function ($row) {
            $email = str_pad(substr($row->email, -11), strlen($row->email), 'x', STR_PAD_LEFT);

            return $email;
          })
          ->rawColumns(['action', 'phone', 'email'])
          ->make(true);
      } elseif (auth()->user()->hasRole('coachee')) {

        $data = User::role('coach')->get();

        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $actionBtn = '<a href="javascript:;" class="btn-sm btn-primary detailCoach" data-id = "' . $row->id . '">Detail</a>';
            return $actionBtn;
          })->addColumn('phone', function ($row) {
            $phone = '+62' . substr($row->phone, 0, -5) . 'xxxxx';

            return $phone;
          })->addColumn('email', function ($row) {
            $email = str_pad(substr($row->email, -11), strlen($row->email), 'x', STR_PAD_LEFT);

            return $email;
          })
          ->rawColumns(['action', 'phone', 'email'])
          ->make(true);
      }
    }
    return view('clients.index');
  }

  public function show_group_list(Request $request)
  {
    $coach = Coach::where('user_id', auth()->user()->id)->first();
    $data = $coach->plan->where('client_id', null)->groupBy('group_id');

    // return $data;

    if ($request->ajax()) {
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('participant', function ($row) {
          return $row->first()->clients->count();
        })
        ->addColumn('group_code', function ($row) {
          return $row->first()->group_id;
        })
        ->addColumn('action', function ($row) {

          if (auth()->user()->can('create-plan')) {
            $create_plan_btn = '<a href="' . url('/plans/create?group=' . $row->first()->group_id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Create Plan</a>';
          } else {
            $create_plan_btn = null;
          }

          if (auth()->user()->can('create-agenda')) {
            $create_agenda_btn = '<a href="' . url('/agendas/create?group=' . $row->first()->group_id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Create Agenda</a>';
          } else {
            $create_agenda_btn = null;
          }

          $detail_btn = '<a href="' . route('group.show', $row->first()->group_id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Details</a>';

          //final dropdown button that shows on view
          $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
          <div class="dropdown-menu dropdown-menu-right">' . $detail_btn . $create_plan_btn . $create_agenda_btn . '</div>';

          return $actionBtn;
        })
        ->rawColumns(['action', 'pacticipant', 'group_code'])
        ->make(true);
    }
  }

  public function show_group_detail(Request $request, $id)
  {
    // $coach = Coach::where('user_id', auth()->user()->id)->first();
    $plan = Plan::where('group_id', $id)->first();
    $user = User::where('id', $plan->owner->user_id)->first();

    $data = $plan->clients;

    if ($request->ajax()) {
      // code...
      return DataTables::of($data)
        ->addIndexColumn()
        // ->addColumn('participant', function($row) {
        //   return $row->clients->count();
        // })
        ->addColumn('action', function ($row) {
          $actionBtn = '<a href="' . route('group.show', $row->id) . '" class="btn-sm btn-primary">Detail</a>';
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    return view('clients.detail_group', compact('plan', 'user'));
  }

  //method to show coach list
  public function show_coach_list(Request $request)
  {
    if ($request->ajax()) {
      // $data = User::role('coach')->select('users.*')->selectRaw('avg(agenda_details.rating_from_coachee) as average')
      //   ->leftJoin('agendas', function ($join) {
      //     $join->on('agendas.owner_id', '=', 'users.id');
      //   })
      //   ->leftJoin('agenda_details', function ($join) {
      //     $join->on('agenda_details.agenda_id', '=', 'agendas.id');
      //   })
      //   ->groupBy('users.id', 'users.name', 'users.phone', 'users.email', 'users.email_verified_at', 'users.password', 'users.profil_picture', 'users.background_picture', 'users.remember_token', 'users.created_at', 'users.updated_at', 'users.suspend_status', 'users.reset_code','users.verification_code','users.is_verified', 'agendas.id', 'agendas.client_id', 'agendas.plan_id', 'agendas.session', 'agendas.type_session', 'agendas.owner_id', 'agendas.created_at', 'agendas.updated_at')
      //   // // ->whereNull('agenda_details.agenda_id')
      //   ->get();

      $data = User::role('coach')->get();

      return DataTables::of($data)
        ->addIndexColumn()
        // ->addColumn('rating', function ($row) {

        //   // if ($row->average != null) {
        //   //   $rating = $row->average . '/5';
        //   // } else {
        //   //   $rating = $row->average;
        //   // }
        //   $coach = Coach::where('user_id', $row->id)->first();
        //   $plans = $coach->plan->pluck('id');
        //   $agenda = Agenda::whereIn('plan_id', $plans)->pluck('id');
        //   // $agenda_id = Agenda::where('owner_id', $row->id)->pluck('id');
        //   // $rating = Agenda_detail::whereIn('agenda_id', $agenda)->pluck('rating_from_coachee')->avg();

        //   // if ($rating) {
        //   //   $rating = $rating.'/5';
        //   // }

        //   // return $rating;
        // })
        ->addColumn('action', function ($row) {
          $detail_btn = '<div style="line-height: 35px;"><a href="javascript:;" class="btn-sm btn-primary editUser" data-id = "' . $row->id . '">Update</a></div></div>';
          $suspend_btn = '<div style="line-height: 35px;"><a href="javascript:;" class="btn-sm btn-danger suspendUser" data-id = "' . $row->id . '">Suspend</a></div>';
          $unsuspend_btn = '<div style="line-height: 35px;"><a href="javascript:;" class="btn-sm btn-success unsuspendUser" data-id = "' . $row->id . '">Unsuspend</a></div>';

          if ($row->suspend_status == 1) {
            $actionBtn = $detail_btn . ' ' . $suspend_btn;
          } else {
            $actionBtn = $detail_btn . ' ' . $unsuspend_btn;
          }
          return $actionBtn;
        })
        ->rawColumns(['action'])
        // ->rawColumns(['rating'])
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
          $detail_btn = '<div style="line-height: 35px;"><a href="javascript:;" class="btn-sm btn-primary editUser" data-id = "' . $row->id . '">Update</a></div>';
          $suspend_btn = '<div style="line-height: 35px;"><a href="javascript:;" class="btn-sm btn-danger suspendUser" data-id = "' . $row->id . '">Suspend</a></div>';
          $unsuspend_btn = '<div style="line-height: 35px;"><a href="javascript:;" class="btn-sm btn-success unsuspendUser" data-id = "' . $row->id . '">Unsuspend</a></div>';

          if ($row->suspend_status == 1) {
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
          $detail_btn = '<div style="line-height: 35px;"><a href="javascript:;" class="btn-sm btn-primary editUser" data-id = "' . $row->id . '">Update</a></div>';
          $suspend_btn = '<div style="line-height: 35px;"><a href="javascript:;" class="btn-sm btn-danger suspendUser" data-id = "' . $row->id . '">Suspend</a></div>';
          $unsuspend_btn = '<div style="line-height: 35px;"><a href="javascript:;" class="btn-sm btn-success unsuspendUser" data-id = "' . $row->id . '">Unsuspend</a></div>';

          if ($row->suspend_status == 1) {
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

  //method to show trainer list
  public function show_trainer_list(Request $request)
  {
    if ($request->ajax()) {
      $data = User::role('trainer')->get();

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $detail_btn = '<a href="javascript:;" class="btn-sm btn-primary editUser" data-id = "' . $row->id . '">Update</a>';
          $suspend_btn = '<a href="javascript:;" class="btn-sm btn-danger suspendUser" data-id = "' . $row->id . '">Suspend</a>';
          $unsuspend_btn = '<a href="javascript:;" class="btn-sm btn-success unsuspendUser" data-id = "' . $row->id . '">Unsuspend</a>';

          if ($row->suspend_status == 1) {
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

  //method to show mentor list
  public function show_mentor_list(Request $request)
  {
    if ($request->ajax()) {
      $data = User::role('mentor')->get();

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $detail_btn = '<a href="javascript:;" class="btn-sm btn-primary editUser" data-id = "' . $row->id . '">Update</a>';
          $suspend_btn = '<a href="javascript:;" class="btn-sm btn-danger suspendUser" data-id = "' . $row->id . '">Suspend</a>';
          $unsuspend_btn = '<a href="javascript:;" class="btn-sm btn-success unsuspendUser" data-id = "' . $row->id . '">Unsuspend</a>';

          if ($row->suspend_status == 1) {
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
    $coach = Coach::where('user_id', auth()->user()->id)->first();
    $plans = $client->plans->where('owner_id', $coach->id);

    $agendas = Agenda::whereIn('plan_id', $plans->pluck('id'))->get();
    $agenda_detail = Agenda_detail::whereIn('agenda_id', $agendas->pluck('id'))->get();

    $coaching_note = Coaching_note::whereIn('agenda_detail_id', $agenda_detail->pluck('id'))->get();

    $total_event = $agenda_detail->where('status', 'scheduled')->count();
    $total_agenda = $agendas->count();
    $total_session = $agenda_detail->count();

    return view('clients.show', compact('client', 'coaching_note', 'agenda_detail', 'total_event', 'total_agenda', 'total_session'));
  }

  public function show_upcoming_list(Request $request, Client $client)
  {
    $coach = Coach::where('user_id', auth()->user()->id)->first();
    $plans = $client->plans->where('owner_id', $coach->id);

    $agendas = Agenda::whereIn('plan_id', $plans->pluck('id'))->get();
    $agenda_detail = Agenda_detail::whereIn('agenda_id', $agendas->pluck('id'))->orderByRaw('-date DESC')->get();

    $data = $agenda_detail->where('status', 'scheduled');

    if ($request->ajax()) {
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('type', function ($row) {
          $agenda = $row->agenda;
          $plan = $agenda->plan;

          if ($plan->client_id) {
            $type = 'indiviual';
          } elseif ($plan->group_id) {
            $type = 'group';
          }

          return $type;
        })
        ->rawColumns(['type'])
        ->make(true);
    }
  }


  // role: coach, list agendas on client detail
  public function show_agendas_list(Request $request, Client $client)
  {
    $coach = Coach::where('user_id', auth()->user()->id)->first();
    $plans = $client->plans->where('owner_id', $coach->id);

    $agendas = Agenda::whereIn('plan_id', $plans->pluck('id'))->get();
    $agenda_detail = Agenda_detail::whereIn('agenda_id', $agendas->pluck('id'))->orderByRaw('-date DESC')->get();

    $data = $agenda_detail;

    if ($request->ajax()) {
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('type', function ($row) {
          $agenda = $row->agenda;
          $plan = $agenda->plan;

          if ($plan->client_id) {
            $type = 'indiviual';
          } elseif ($plan->group_id) {
            $type = 'group';
          }

          return $type;
        })
        ->rawColumns(['type'])
        ->make(true);
    }
  }

  // role: coach, list sessions on client detail
  public function show_sessions_list(Request $request, Client $client)
  {
    $coach = Coach::where('user_id', auth()->user()->id)->first();
    $plans = $client->plans->where('owner_id', $coach->id);

    $agendas = Agenda::whereIn('plan_id', $plans->pluck('id'))->get();
    $agenda_detail = Agenda_detail::whereIn('agenda_id', $agendas->pluck('id'))->orderByRaw('-date DESC')->get();

    $data = $agenda_detail;

    if ($request->ajax()) {
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('type', function ($row) {
          $agenda = $row->agenda;
          $plan = $agenda->plan;

          if ($plan->client_id) {
            $type = 'indiviual';
          } elseif ($plan->group_id) {
            $type = 'group';
          }

          return $type;
        })
        ->addColumn('action', function ($row) {
          $actionBtn = '<a href="' . route('agendas.show', $row->id) . '" class="btn-sm btn-primary">Detail</a>';
          return $actionBtn;
        })
        ->rawColumns(['type', 'action'])
        ->make(true);
    }
  }

  public function show_plans_list(Request $request, Client $client)
  {
    $coach = Coach::where('user_id', auth()->user()->id)->first();
    $plans = $client->plans->where('owner_id', $coach->id);

    $data = $plans;

    if ($request->ajax()) {
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $actionBtn = '<a href="' . route('plans.show', $row->id) . '" class="btn-sm btn-primary">Detail</a>';
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
  }

  // role: coach, list feedbacks on client detail
  public function show_feedbacks_list(Request $request, Client $client)
  {
    if ($request->ajax()) {
      $plan = $client->plans;
      $agenda = Agenda::whereIn('plan_id', $plan->pluck('id'))->get();
      $agenda_detail = Agenda_detail::whereIn('agenda_id', $agenda->pluck('id'))->get();

      $feedbacks = Feedback::whereIn('agenda_detail_id', $agenda_detail->pluck('id'))->Where(function ($query) {
        $query->where('feedback', '!=', null)
          ->orWhere('attachment', '!=', null);
      })->get();
      $feedbacks = $feedbacks->where('from', 'coach');

      $data = $feedbacks;

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('coach', function ($row) {
          $agenda_detail = $row->agenda_detail;
          $agenda = $agenda_detail->agenda;
          $plan = $agenda->plan;
          $coach = $plan->owner;
          $coach_detail = $coach->user->toArray();
          return $coach_detail;
        })
        ->addColumn('agenda_detail', function ($row) {
          $agenda_detail = $row->agenda_detail->toArray();
          return $agenda_detail;
        })
        ->addColumn('action', function ($row) {
          $actionBtn = '<a href="javascript:;" id="detailFeedback" class="btn-sm btn-primary" data-id="' . $row->id . '" data-original-title="detail feedback">Detail</a>';
          return $actionBtn;
        })
        ->rawColumns(['action', 'coach_detail', 'agenda_detail'])
        ->make(true);
    }
  }

  // role: coach, list notes on client detail
  public function show_notes_list(Request $request, Client $client)
  {
    $coach = Coach::where('user_id', auth()->user()->id)->first();
    $plans = $client->plans->where('owner_id', $coach->id);

    $agendas = Agenda::whereIn('plan_id', $plans->pluck('id'))->get();
    $agenda_detail = Agenda_detail::whereIn('agenda_id', $agendas->pluck('id'))->orderByRaw('-date DESC')->get();

    $data = Coaching_note::with('agenda_detail')->whereIn('agenda_detail_id', $agenda_detail->pluck('id'))->get();

    if ($request->ajax()) {
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $actionBtn = '<a href="javascript:;" id="detailNote" class="btn-sm btn-primary" data-id="' . $row->id . '" data-original-title="detail session">Detail</a>';
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
  }

  // role: coach, detail feedback on client detail
  public function show_detail_feedbacks($id)
  {
    $feedback = Feedback::find($id);
    $agenda_detail = $feedback->agenda_detail;
    $agenda = $agenda_detail->agenda;
    $plan = $agenda->plan;
    $coach = $plan->owner;
    $coach_detail = $coach->user;

    $data = [
      'session' => $agenda_detail,
      'coach' => $coach_detail,
      'feedback' => $feedback
    ];

    return response()->json($data);
  }

  // role: coach, detail notes on client detail
  public function show_detail_notes($id)
  {
    $coaching_note = Coaching_note::find($id);
    $agenda_detail = $coaching_note->agenda_detail;
    $agenda = $agenda_detail->agenda;
    $plan = $agenda->plan;
    $coach = $plan->owner;
    $coach_detail = $coach->user;

    $data = [
      'session' => $agenda_detail,
      'coach' => $coach_detail,
      'coaching_note' => $coaching_note
    ];

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

  // download pdf list coach
  public function coach_pdf_download()
  {
    $coachs = User::role('coach')->get();

    $pdf = PDF::loadview('pdf_template.coach_list_pdf', compact('coachs'));
    return $pdf->download('coach_list.pdf');
  }

  // download pdf list coachee
  public function coachee_pdf_download()
  {
    $coachee = User::role('coachee')->get();

    $pdf = PDF::loadview('pdf_template.coachee_list_pdf', compact('coachee'));
    return $pdf->download('coachee_list.pdf');
  }

  public function get_client_data($id)
  {
    $client = Client::find($id);
    return response()->json($client);
  }
}
