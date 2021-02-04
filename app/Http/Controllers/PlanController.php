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
    public function index(Request $request)
    {
        //
        //$data = Plan::with('client')->where('owner_id', Auth::user()->id)->orderBy('id','DESC')->get();
        //dd($data);
        //return view('clients.index',compact('data'));
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
            $clients = Client::where('owner_id', Auth::user()->id)
                ->where('name', 'LIKE', "%$search%")
                ->get();
        } else {
            $clients = Client::orderby('name', 'asc')
                ->where('owner_id', Auth::user()->id)
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
            // 'client_id' => 'required',
            // 'organization' => 'required',
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
            'client_id' => $request->livesearch,
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
