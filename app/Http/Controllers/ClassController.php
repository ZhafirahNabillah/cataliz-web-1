<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Class_model;
use App\Models\Client;
use App\Models\Class_has_client;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DataTables;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
        $this->middleware('permission:list-class', ['only' => 'index']);
        $this->middleware('permission:create-class', ['only' => ['create', 'store']]);
        $this->middleware('permission:detail-class', ['only' => 'show']);
    }



    public function index(Request $request)
    {
        if ($request->ajax()) {

            $data = Class_model::with('coach')->get();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    $detail_btn = '<a href="' . route('class.show', $row->id) . '" class="btn-sm btn-primary">Detail</a>';

                    return $detail_btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('class.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $client_final = Class_has_client::pluck('client_id');
        // return $client_final;
        $client = Client::whereNotIn('id', $client_final)->get();
        // return $client;
        return view('class.create', compact('client'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request->cl;

        $this->validate($request, [
            'class_name'  => 'required',
            'coach_id' => 'required'
        ]);

        $class = new Class_model;
        $class->class_name = $request->class_name;
        $class->coach_id = $request->coach_id;
        $class->status = 'Pending';
        $class->save();

        $count = $request->cl;

        foreach ($count as $ct) {
            $coachee = new Class_has_client;
            $coachee->class_id = $class->id;
            $coachee->client_id = $ct;
            $coachee->save();
        }

        return redirect('/class');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        //
        $class = Class_model::with('coach')->where('id', $id)->first();
        $coachee_id = Class_has_client::where('class_id', $class->id)->pluck('client_id');

        if ($request->ajax()) {

            $data = Client::whereIn('id', $coachee_id)->get();

            return DataTables::of($data)
                ->addIndexColumn()
                ->make(true);
        }

        return view('class.detail', compact('class'));
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
    }

    public function ajaxClass(Request $request)
    {
        $coach = [];
        if ($request->has('q')) {
            $search = $request->q;
            $coach = User::role('coach')->get()
                ->where('name', 'LIKE', "%$search%")
                ->get();
        } else {
            $coach = User::orderby('name', 'asc')
                ->role('coach')
                ->get();
        }
        return response()->json($coach);
    }

    public function ubah_status(Request $request, $id)
    {
        $class = Class_model::where('id', $id)->first();
        $class->status = $request->status;
        $class->notes = $request->notes;
        $class->update();

        return redirect('/class');
    }
}
