<?php

namespace App\Http\Controllers;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Plan;
use DataTables;

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

  public function index(Request $request)
  {
    if ($request->ajax()) {


      if (auth()->user()->hasRole('admin')) {
        $data = Plan::with('client')->get();
      } elseif (auth()->user()->hasRole('coach')) {
        $data = Plan::with('client')->where('owner_id', Auth::user()->id)->latest()->get();
      } elseif (auth()->user()->hasRole('coachee')) {
        $login_user_id = auth()->user()->id;
        $client_id = Client::where('user_id', $login_user_id)->pluck('id');
        $data = Plan::select('plans.objective', 'plans.date', 'users.name')->join('users', 'plans.owner_id', '=', 'users.id')->join('clients', 'plans.client_id', '=', 'clients.id')->where('clients.id', $client_id)->get();
      }

      return Datatables::of($data)
        ->addIndexColumn()
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
            $whatsapp_btn = '<a href="https://wa.me/62' . $row->client['phone'] . '" class="dropdown-item" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-archive font-small-4 mr-50"><polyline points="21 8 21 21 3 21 3 8"></polyline><rect x="1" y="3" width="22" height="5"></rect><line x1="10" y1="12" x2="14" y2="12"></line></svg>Kirim WA</a>';
          } else {
            $detail_btn = null;
            $whatsapp_btn = null;
          };

          //add delete button if user have permission
          if (auth()->user()->can('delete-plan')) {
            $delete_btn = '<a href="javascript:;" class="dropdown-item deletePlan" data-id="' . $row->id . '" data-original-title="Delete" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 font-small-4 mr-50"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>Delete</a></div>';
          } else {
            $delete_btn = null;
          };

          $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
                  <div class="dropdown-menu dropdown-menu-right">' . $edit_btn . $detail_btn . $whatsapp_btn . $delete_btn . '</div>';

          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
    return view('plans.index');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    return view('plans.create');
  }

  public function ajaxClients(Request $request)
  {
    $clients = [];
    if ($request->has('q')) {
      $search = $request->q;
      $clients = Client::select('clients.name', 'clients.id', 'clients.organization')
        ->join('class_has_clients', 'class_has_clients.client_id', '=', 'clients.id')
        ->join('class', 'class.id', '=', 'class_has_clients.class_id')
        ->where('class.status', 'Sedang Berjalan')
        ->where('class.coach_id', Auth::user()->id)
        ->where('name', 'LIKE', "%$search%")
        ->get();
    } else {
      $clients = Client::select('clients.name', 'clients.id', 'clients.organization')
        ->orderby('clients.name', 'asc')
        ->join('class_has_clients', 'class_has_clients.client_id', '=', 'clients.id')
        ->join('class', 'class.id', '=', 'class_has_clients.class_id')
        ->where('class.status', 'Sedang Berjalan')
        ->where('class.coach_id', Auth::user()->id)
        ->get();
    }
    /* $search = $request->search;

      if($search == ''){
         $clients = Client::orderby('name','asc')->select('id','name')->get();
      }else{
         $clients = Client::orderby('name','asc')->select('id','name')->where('name', 'like', '%' .$search . '%')->limit(5)->get();
      }

      $response = array();
      foreach($clients as $client){
         $response[] = array(
              "id"=>$client->id,
              "text"=>$client->name
         );
      } */
    return response()->json($clients);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $this->validate($request, [
      'client_id' => 'required',
      'date' => 'required',
      'objective' => 'required',
      'success_indicator' => 'required',
      'development_areas' => 'required',
      'support' => 'required',
    ]);

    $objective = strip_tags($request->objective);
    $success_indicator = strip_tags($request->success_indicator);
    $development_areas = strip_tags($request->development_areas);
    $support = strip_tags($request->support);

    Plan::updateOrCreate(['id' => $request->id], [
      'client_id' => $request->client_id,
      'date' => $request->date,
      'objective' => $objective,
      'success_indicator' =>  $success_indicator, 'development_areas' => $development_areas,
      'support' => $support,
      'owner_id' => Auth::user()->id
    ]);
    return redirect('/plans')->with('success', 'Data berhasil disimpan!');
  }

  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show(Plan $plan)
  {
    $client = Client::where('id', $plan->client_id)->first();
    // return $client;
    return view('plans.detail', compact('plan', 'client'));
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function edit(Plan $plan)
  {
    $client = Client::where('id', $plan->client_id)->first();
    return view('plans.edit', compact('plan', 'client'));
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
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    Plan::find($id)->delete();
    return response()->json(['success' => 'Plan deleted!']);
  }
}
