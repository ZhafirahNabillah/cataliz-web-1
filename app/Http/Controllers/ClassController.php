<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Class_model;
use App\Models\Client;
use App\Models\Class_has_client;
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
        $client = Client::all();
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
        $this->validate($request, [
            'class_name'  => 'required',
            'livesearch' => 'required'
        ]);

        Permission::updateOrCreate(
            ['id' => $request->input('permission_id')],
            ['class_name' => $request->input('class_name')],
            ['coach_name' => $request->input('livesearch')],
            ['status' => 'Pending']
        );

        return response()->json(['success' => 'Class saved successfully!']);
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
        $class = Class_model::with('coach')->where('id',$id)->first();
        $coachee_id = Class_has_client::where('class_id',$class->id)->pluck('client_id');

        if ($request->ajax()) {

            $data = Client::whereIn('id',$coachee_id)->get();

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
}
