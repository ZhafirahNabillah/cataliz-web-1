<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Graduate;
use App\Models\Client;
use DataTables;

class GraduateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('alumni.index');
    }

    public function load_graduates_data(Request $request) {
      $data = Graduate::all();

      if ($request->ajax()) {
        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('user_data', function ($row) {
            $user = $row->user;
            $client = $user->client->toArray();

            return $client;
          })->addColumn('program', function ($row) {
            $user = $row->user;
            $client = $user->client;
            $program = $client->program;

            if (is_null($program)) {
              return 'Not Registered to Any program';
            } else {
              return $program->program_name;
            }
          })->addColumn('action', function ($row) {
            $remove_btn = '<a href="javascript:;" id="removeGraduateBtn" class="btn-sm btn-danger" data-id="' . $row->id . '" data-original-title="Remove Graduate">Remove</a>';

            $actionBtn = $remove_btn;
            return $actionBtn;
          })
          ->rawColumns(['action', 'user_data'])
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
        $validator = Validator::make($request->all(), [
          'name'        => 'required'
        ]);

        if ($validator->fails()) {
          return response()->json($validator->errors(), 422);
        }

        $client = Client::find($request->name);
        $user = $client->user;

        $graduate = new Graduate;
        $graduate->user_id = $user->id;
        // $graduate->graduate_as = $request->graduate_as;
        $graduate->save();

        return response()->json([
          'success' => 'Graduate saved successfully!'
        ]);
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
    public function destroy(Graduate $graduate)
    {
        $graduate->delete();
        return response()->json([
          'success' => 'Graduate deleted successfully!'
        ]);
    }

    public function load_clients_data(Request $request)
    {
        $coachee = [];

        if ($request->has('q')) {
            $search = $request->q;
            $coachee = Client::where('name', 'LIKE', "%$search%")->get();
        } else {
            $coachee = Client::get();
        }
        return response()->json($coachee);
    }
}
