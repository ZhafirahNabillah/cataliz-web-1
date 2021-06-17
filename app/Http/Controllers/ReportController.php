<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Report;
use App\Models\Coach;
use App\Models\Plan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            // $client = Client::pluck('name');
            $data = Report::with('client')->where('coach_id', auth()->user()->id)->latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {

                    if (auth()->user()->can('update-report')) {
                        $edit_btn = '<a href="' . route('report.edit', $row->id) . '" class="dropdown-item"  data-id="' . $row->id . '" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit font-small-4 mr-50"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg>Edit</a>';
                    } else {
                        $edit_btn = null;
                    };

                    //add detail and whatsapp button if user have permission
                    if (auth()->user()->can('detail-report')) {
                        $detail_btn = '<a href="' . route('report.show', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Details</a>';
                    } else {
                        $detail_btn = null;
                    };

                    $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
                <div class="dropdown-menu dropdown-menu-right">' . $edit_btn . $detail_btn . '</div>';

                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('reports.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reports.create');
    }

    public function create_group()
    {
        return view('reports.createGroup');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $report = new Report;
        $report->coach_id = auth()->user()->id;
        $report->coachee_id = $request->coachee_id;
        $report->program = $request->program;
        $report->awarness = $request->coachee_awarness;
        $report->mindset = $request->coachee_mindset;
        $report->behaviour = $request->coachee_behaviour;
        $report->engagement = $request->coachee_engagement;
        $report->result = $request->coachee_result;
        $report->note = $request->summary;
        $report->save();

        return redirect('/report')->with('success', 'Report Successfully created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $report = Report::with('client')->where('id', $id)->first();
        $client_name = Client::where('id', $report->client_id)->pluck('name')->first();
        // return $client_name;
        return view('reports.detail', compact('report', 'client_name'));
    }

    public function search_group(Request $request)
    {
        $group_code = [];
        $coach = Coach::where('user_id', auth()->user()->id)->first();
        $code = Plan::where('owner_id', $coach->id)->where('client_id', null)->latest()->get();

        $search = trim($request->q);

        if (empty($search)) {
            $group_code = $code;
        } else {
            $plan_id = $coach->plans->pluck('id');
            $group_code = Plan::whereIn('id', $plan_id)->where('gorup_id', 'LIKE', "%$search%")->get();
        }
       
        return response()->json($group_code);

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
