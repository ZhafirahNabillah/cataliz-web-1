<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Program;
use App\Models\Batch;
use DataTables;

class ProgramController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
          $data = Program::all();

          return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
              $edit_btn = '<a href="javascript:;" id="editProgram" class="btn-sm btn-primary" data-id="' . $row->id . '" >Update</a>';
              $delete_btn = '<a href="javascript:;" id="deleteProgram" class="btn-sm btn-danger" data-id="' . $row->id . '" >Delete</a>';
              $detail_btn = '<a href="'.route('program.show', $row->id).'" id="detailProgram" class="btn-sm btn-warning">Detail</a>';

              $actionBtn = $edit_btn . ' ' . $delete_btn . ' ' . $detail_btn;
              return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('program.index');
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
        Program::updateOrCreate(
          ['id' => $request->input('program_id')],
          ['program_name' => $request->input('program')]
        );

        return response()->json(['success' => 'Program saved successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Program $program, Request $request)
    {
        //
        if ($request->ajax()) {
          $data = Batch::where('program_id', $program->id)->get();

          return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
              $update_btn = '<a href="javascript:;" id="updateBatchBtn" class="btn-sm btn-primary" data-id="' . $row->id . '" >Update</a>';
              $delete_btn = '<a href="javascript:;" id="deleteBatchBtn" class="btn-sm btn-danger" data-id="' . $row->id . '" >Delete</a>';

              $actionBtn = $update_btn . ' ' . $delete_btn;
              return $actionBtn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('program.detail', compact('program'));
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
        $program = Program::find($id);
        return response()->json($program);
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
        $program = Program::find($id);
        $program->delete();

        return response()->json(['success' => 'Program deleted!']);
    }

    public function get_batch($id){
      $program = Program::find($id);
      $batches = Batch::where('program_id', $program->id)->get();
      return response()->json($batches);
    }
}
