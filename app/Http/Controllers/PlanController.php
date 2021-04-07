<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Models\Client;
use App\Models\Plan;
use App\Models\User;
use App\Models\Coach;
use DataTables;
use PDF;

class PlanController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */

  function __construct()
  {
    $this->middleware('permission:list-plan', ['only' => 'index']);
    $this->middleware('permission:create-plan', ['only' => ['create', 'store', 'ajaxClients']]);
    $this->middleware('permission:update-plan', ['only' => ['edit', 'store']]);
    $this->middleware('permission:detail-plan', ['only' => ['show']]);
    $this->middleware('permission:delete-plan', ['only' => ['destroy']]);
  }

  // method to show plan index page and return datatable of individual plan
  public function index(Request $request)
  {
    if ($request->ajax()) {


      if (auth()->user()->hasRole('admin')) {
        $data = Plan::with('client')->where('group_id', null)->latest()->get();
      } elseif (auth()->user()->hasRole('coach')) {
        $coach = Coach::where('user_id', auth()->user()->id)->first();
        $data = Plan::with('client')->where('owner_id', $coach->id)->where('group_id', null)->latest()->get();
      } elseif (auth()->user()->hasRole('coachee')) {
        // $login_user_id = auth()->user()->id;
        // $client_id = Client::where('user_id', $login_user_id)->pluck('id');
        // $data = Plan::select('plans.id', 'plans.objective', 'plans.date', 'users.name', 'clients.phone')->join('users', 'plans.owner_id', '=', 'users.id')->join('clients', 'plans.client_id', '=', 'clients.id')->where('clients.id', $client_id)->get();

        $client = Client::where('user_id', auth()->user()->id)->first();
        $data = Plan::with('owner')->where('client_id', $client->id)->where('group_id', null)->latest()->get();
      }

      if (auth()->user()->hasRole('coachee')) {
        // code...
        return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('coach_name', function ($row) {
            $user = User::where('id', $row->owner->id)->first();
            return $user->name;
          })
          ->addColumn('objective', function ($row) {
            $objective = strip_tags($row->objective);
            return $objective;
          })
          ->addColumn('action', function ($row) {

            //add update button if user have permission
            if (auth()->user()->can('update-plan')) {
              $edit_btn = '<a href="' . route('plans.edit', $row->id) . '" class="dropdown-item"  data-id="' . $row->id . '" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4 mr-50"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>Edit</a>';
            } else {
              $edit_btn = null;
            };

            //add detail and whatsapp button if user have permission
            if (auth()->user()->can('detail-plan')) {
              $detail_btn = '<a href="' . route('plans.show', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Details</a>';
              // if (auth()->user()->hasRole('coachee')) {
              //   $whatsapp_btn = '<a href="https://wa.me/62' . $row->phone . '" class="dropdown-item" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive font-small-4 mr-50"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>Kirim WA</a>';
              // } else {
              //   $whatsapp_btn = '<a href="https://wa.me/62' . $row->client['phone'] . '" class="dropdown-item" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive font-small-4 mr-50"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>Kirim WA</a>';
              // }
            } else {
              $detail_btn = null;
              // $whatsapp_btn = null;
            };

            //add delete button if user have permission
            if (auth()->user()->can('delete-plan')) {
              $delete_btn = '<a href="javascript:;" class="dropdown-item deletePlan" data-id="' . $row->id . '" data-original-title="Delete" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-small-4 mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete</a></div>';
            } else {
              $delete_btn = null;
            };

            $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
          <div class="dropdown-menu dropdown-menu-right">' . $edit_btn . $detail_btn . $delete_btn . '</div>';

            return $actionBtn;
          })
          ->rawColumns(['action', 'coach_name', 'objective'])
          ->make(true);
      } else {
        // code...
        return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('objective', function ($row) {
            $objective = strip_tags($row->objective);
            return $objective;
          })
          ->addColumn('action', function ($row) {

            //add update button if user have permission
            if (auth()->user()->can('update-plan')) {
              $edit_btn = '<a href="' . route('plans.edit', $row->id) . '" class="dropdown-item"  data-id="' . $row->id . '" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4 mr-50"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>Edit</a>';
            } else {
              $edit_btn = null;
            };

            //add detail and whatsapp button if user have permission
            if (auth()->user()->can('detail-plan')) {
              $detail_btn = '<a href="' . route('plans.show', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Details</a>';
              // if (auth()->user()->hasRole('coachee')) {
              //   $whatsapp_btn = '<a href="https://wa.me/62' . $row->phone . '" class="dropdown-item" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive font-small-4 mr-50"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>Kirim WA</a>';
              // } else {
              //   $whatsapp_btn = '<a href="https://wa.me/62' . $row->client['phone'] . '" class="dropdown-item" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive font-small-4 mr-50"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>Kirim WA</a>';
              // }
            } else {
              $detail_btn = null;
              // $whatsapp_btn = null;
            };

            //add delete button if user have permission
            if (auth()->user()->can('delete-plan')) {
              $delete_btn = '<a href="javascript:;" class="dropdown-item deletePlan" data-id="' . $row->id . '" data-original-title="Delete" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-small-4 mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete</a></div>';
            } else {
              $delete_btn = null;
            };

            $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
          <div class="dropdown-menu dropdown-menu-right">' . $edit_btn . $detail_btn . $delete_btn . '</div>';

            return $actionBtn;
          })
          ->rawColumns(['action', 'objective'])
          ->make(true);
      }
    }
    return view('plans.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */

  //method to show create plan page
  public function create(Request $request)
  {
    // $coach = Coach::where('user_id', auth()->user()->id)->first();
    // $clients = $coach->clients;
    $clients = null;

    if ($request->has('client')) {
      $client_id = $request->get('client');
      $clients[] = Client::find($client_id);
    } elseif ($request->has('group')) {
      $group_id = $request->get('group');
      $plan = Plan::where('group_id', $group_id)->first();
      $clients = $plan->clients;
    }

    return view('plans.create', compact('clients'));
  }

  // public function ajaxClients(Request $request)
  // {
  //   $clients = [];
  //   if ($request->has('q')) {
  //     $search = $request->q;
  //     $clients = Client::select('clients.name', 'clients.id', 'clients.organization', 'clients.company')
  //       ->join('class_has_clients', 'class_has_clients.client_id', '=', 'clients.id')
  //       ->join('class', 'class.id', '=', 'class_has_clients.class_id')
  //       ->where('class.coach_id', Auth::user()->id)
  //       ->where('name', 'LIKE', "%$search%")
  //       ->get();
  //   } else {
  //     $clients = Client::select('clients.name', 'clients.id', 'clients.organization', 'clients.company')
  //       ->orderby('clients.name', 'asc')
  //       ->join('class_has_clients', 'class_has_clients.client_id', '=', 'clients.id')
  //       ->join('class', 'class.id', '=', 'class_has_clients.class_id')
  //       ->where('class.coach_id', Auth::user()->id)
  //       ->get();
  //   }
  //
  //   return response()->json($clients);
  // }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  //method to store plan on database from create plan page and edit plan page
  public function store(Request $request)
  {
    // return $request;
    // return response()->json($request);

    // if ($request->filled('client')) {
    //   $count = count(collect($request)->get('client'));
    //   // return response()->json($count);
    // } else {
    //   $count = 0;
    //   // return response()->json($count);
    // }
    //

    $validator = Validator::make($request->all(), [
      'client'  => 'required',
      'date' => 'required',
      'objective' => 'required',
      'success_indicator' => 'required',
      'development_areas' => 'required',
      'support' => 'required',
      'group_code' => 'sometimes|required|min:5|max:10',
    ]);


    if ($validator->fails()) {
      return response()->json($validator->errors(), 422);
    }

    $count = 0;

    foreach ($request->input('client') as $client) {
      $count = $count + 1;
    }

    // $objective = strip_tags($request->objective);
    // $success_indicator = strip_tags($request->success_indicator);
    // $development_areas = strip_tags($request->development_areas);
    // $support = strip_tags($request->support);

    $coach = Coach::where('user_id', auth()->user()->id)->first();

    if ($count == 1) {

      $plan = Plan::updateOrCreate(['id' => $request->id], [
        'date' => $request->date,
        'objective' => $request->objective,
        'success_indicator' =>  $request->success_indicator,
        'development_areas' => $request->development_areas,
        'support' => $request->support,
        'owner_id' => $coach->id,
        'client_id' => $request->client[0],
        'group_id' => null
      ]);
    } else {
      // if ($request->group_id == null) {
      //   $rid = rand(00000, 99999);
      //   while (Plan::where('group_id', $rid)->exists()) {
      //     $rid = rand(00000, 99999);
      //   }
      // } else {
      //   $rid = $request->group_id;
      // }

      // return $rid;

      $plan = Plan::updateOrCreate(['id' => $request->id], [
        'date' => $request->date,
        'objective' => $request->objective,
        'success_indicator' =>  $request->success_indicator,
        'development_areas' => $request->development_areas,
        'support' => $request->support,
        'owner_id' => $coach->id,
        'group_id' => $request->group_code,
        'client_id' => null
      ]);
    }
    $plan->clients()->sync($request->input('client'));

    // return $count;

    // $plan = Plan::updateOrCreate(['id' => $request->id], [
    //   'date' => $request->date,
    //   'objective' => $objective,
    //   'success_indicator' =>  $success_indicator, 'development_areas' => $development_areas,
    //   'support' => $support,
    //   'owner_id' => Auth::user()->id,
    //   'client_id' => $plan_type
    // ]);
    if ($plan->wasRecentlyCreated) {
      $request->session()->flash('success', 'The plan has been added successfully!');
    } else {
      $request->session()->flash('success', 'The plan has been updated successfully!');
    }
    return response()->json(['success' => true]);
    // return redirect('/plans')->with('success', 'The plan has been added successfully!!');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  //method to show detail plan page
  public function show(Plan $plan)
  {
    if (auth()->user()->hasRole('coachee')) {
      $coach = $plan->owner;
      $coach_detail = $coach->user;
      return view('plans.detail', compact('plan', 'coach_detail'));
    } else {
      return view('plans.detail', compact('plan'));
    }
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  //method to show edit plan page
  public function edit(Plan $plan)
  {
    $coach = Coach::where('user_id', auth()->user()->id)->first();
    $all_clients = $coach->clients;
    $clients = $plan->clients->pluck('id');

    // return $clients;

    return view('plans.edit', compact('plan', 'all_clients', 'clients'));
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */

  //method to delete plan
  public function destroy($id)
  {
    $plan = Plan::find($id);
    $plan->clients()->detach();
    $plan->delete();

    // Plan::find($id)->clients()->detach();

    return response()->json(['success' => 'Plan deleted!']);
  }

  //method to export plan on detail plan page
  public function plan_detail_to_pdf($id)
  {
    $plan = Plan::find($id);
    $coach = User::find($plan->owner_id);
    $coachee = Client::find($plan->client_id);

    $pdf = PDF::loadview('pdf_template.plans_detail_pdf', compact('plan', 'coach', 'coachee'));
    $pdf->setPaper('A4', 'portrait');
    $pdf->setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true]);
    return $pdf->stream();
    // return $pdf->download('plan_detail_' . $plan->id . '.pdf');
  }

  //method to show plan group list on plan index page (plan tab)
  public function show_group_list(Request $request)
  {
    if (auth()->user()->hasRole('admin')) {
      $data = Plan::where('client_id', null)->latest()->get();
    } elseif (auth()->user()->hasRole('coach')) {
      $coach = Coach::where('user_id', auth()->user()->id)->first();
      $data = Plan::where('owner_id', $coach->id)->where('client_id', null)->latest()->get();
    } elseif (auth()->user()->hasRole('coachee')) {
      $client = Client::where('user_id', auth()->user()->id)->first();
      $data = $client->plans->where('client_id', null);
    }

    if ($request->ajax()) {

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('objective', function ($row) {
          $objective = strip_tags($row->objective);
          return $objective;
        })
        ->addColumn('action', function ($row) {

          //add update button if user have permission
          if (auth()->user()->can('update-plan')) {
            $edit_btn = '<a href="' . route('plans.edit', $row->id) . '" class="dropdown-item"  data-id="' . $row->id . '" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4 mr-50"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>Edit</a>';
          } else {
            $edit_btn = null;
          };

          //add detail and whatsapp button if user have permission
          if (auth()->user()->can('detail-plan')) {
            $detail_btn = '<a href="' . route('plans.show', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Details</a>';
          } else {
            $detail_btn = null;
          };

          //add delete button if user have permission
          if (auth()->user()->can('delete-plan')) {
            $delete_btn = '<a href="javascript:;" class="dropdown-item deletePlan" data-id="' . $row->id . '" data-original-title="Delete" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-small-4 mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete</a></div>';
          } else {
            $delete_btn = null;
          };

          $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
        <div class="dropdown-menu dropdown-menu-right">' . $edit_btn . $detail_btn . $delete_btn . '</div>';

          return $actionBtn;
        })
        ->rawColumns(['action', 'objective'])
        ->make(true);
    }
  }

  // method ajax for livesearch client on plan create
  public function ajaxInsertUsers(Request $request)
  {
    $clients = [];
    $coach = Coach::where('user_id', auth()->user()->id)->first();

    $search = trim($request->q);

    if (empty($search)) {
      $clients = $coach->clients;
    } else {
      $client_id = $coach->clients->pluck('id');
      $clients = Client::whereIn('id', $client_id)->where('name', 'LIKE', "%$search%")->get();
    }
    // if ($request->has('term')) {
    //   $search = $request->term;
    //   $clients_id = $coach->clients->pluck('id');
    //   $clients_detail = Client::whereIn('id', $clients_id)->get();
    // } else {
    //   // $clients = Client::orderby('id', 'asc')->get()
    //   //   ->where('owner_id', Auth::user()->id);
    // }

    return response()->json($clients);
  }
}
