<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\LogActivity;
use App\Models\Plan;
use DataTables;

class LogActivityController extends Controller
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
        $data=Plan::all();
        if ($request->ajax()) {
            return Datatables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
    
              $detail_btn = '<a href="' . route('class.show', $row->id) . '" class="btn-sm btn-primary">Detail</a>';
    
              return $detail_btn;
            })
            ->addColumn('Total Client', function ($row) {
              $coach = Coach::where('id', $row->id)->first();
    
              return $coach->clients->count();
            })
            ->rawColumns(['action', 'Total Client'])
            ->make(true);
        }
        return view('log_activity.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
}
