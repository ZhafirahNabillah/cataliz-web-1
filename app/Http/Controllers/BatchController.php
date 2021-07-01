<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Batch;

class BatchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // $batch = new Batch;
        // $batch->program_id = $request->program_id;
        // $batch->batch_number = $request->batch_number;
        // $batch->start_date = $request->start_date;
        // $batch->end_date = $request->end_date;
        // $batch->save();

        $batch = Batch::updateOrCreate(
          ['id' => $request->batch_id],
          [
            'program_id' => $request->program_id,
            'batch_number' => $request->batch_number,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'status'  => 1
        ]
        );

        return response()->json([
          'success' => 'Batch successfully created!'
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
        $batch = Batch::find($id);
        return response()->json($batch);
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
    public function destroy(Batch $batch)
    {
        $batch->delete();

        return response()->json([
          'success' => 'Batch successfully deleted!'
        ]);
    }

    public function max()
    {
      $max_batch = Batch::get()->max('batch_number');
      return response()->json($max_batch);
    }

    public function close_batch(Request $request)
    {
      $batch = Batch::find($request->id);
      $batch->status = 0;
      $batch->update();

      return response()->json(['success' => 'User has been suspended!']);
    }

    public function open_batch(Request $request)
    {
      $batch = Batch::find($request->id);
      $batch->status = 1;
      $batch->update();

      return response()->json(['success' => 'User has been activated!']);
    }
}
