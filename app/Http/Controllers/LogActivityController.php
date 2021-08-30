<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Models\LogActivity;
use App\Models\Plan;
use DataTables;
use Spatie\Activitylog\Models\Activity;
use Carbon\Carbon;
use Auth;

class LogActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
        $this->middleware('permission:activity-log', ['only' => 'index']);
        $this->middleware('permission:activity-log', ['only' => ['create', 'store']]);
        $this->middleware('permission:activity-log', ['only' => 'show']);
    }

    public function index(Request $request)
    {
        $user = Auth::user();
        $id = $user->id;
        if ($request->ajax()) {
            if (auth()->user()->hasRole('admin')) {
                $data = Activity::with('causer')
                    ->whereNotNull('causer_id')
                    ->orderby('id', 'desc')
                    ->get();
            } else {
                $data = Activity::with('causer')
                    ->where('causer_id', '=', $id)
                    ->whereNotNull('causer_id')
                    ->orderby('id', 'desc')
                    ->get();
            }
            return Datatables::of($data)
                ->editColumn('created_at', function ($data) {
                    return $data->created_at ? with(new Carbon($data->created_at))->format('D, d-m-Y H:i:s') : '';
                })
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="javascript:void(0)" class="edit btn btn-primary btn-sm">View</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('log_activity.index');
        //return response()->json($data);
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
