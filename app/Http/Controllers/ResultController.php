<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam_result;
use App\Models\User;
use DataTables;

class ResultController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    //
    $exam_results = Exam_result::all();

    if ($request->ajax()) {
      //return data as datatable json
      return Datatables::of($exam_results)
        ->addIndexColumn()
        ->addColumn('topic', function ($row) {
          return $row->topic->toArray();
        })
        ->addColumn('user', function ($row) {
          $user = $row->user;

          return $user->client->toArray();
        })
        ->addColumn('action', function ($row) {

          //add detail and whatsapp button if user have permission
          if (auth()->user()->can('detail-result')) {
            $detail_btn = '<a href="' . route('result.show', $row->id) . '" id="detailBtn" class="btn-sm btn-primary">Detail</a>';
          } else {
            $detail_btn = null;
          }

          return $detail_btn;
        })
        ->rawColumns(['topic', 'user', 'action'])
        ->make(true);
    }

    return view('result.index');
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
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($id)
  {
    //
    $exam_result = Exam_result::find($id);
    $topic = $exam_result->topic;
    $user = $exam_result->user;
    $client = $user->client;
    $answers = $exam_result->answers;
    if (auth()->user()->hasRole('trainer')) {
      $feedback = $exam_result->training_feedbacks()->where('from', 'trainer')->where('to', 'trainee')->first();
      $report = $exam_result->training_feedbacks()->where('from', 'trainer')->where('to', 'coach')->first();
    } elseif (auth()->user()->hasRole('mentor')) {
      $feedback = $exam_result->training_feedbacks()->where('from', 'mentor')->where('to', 'mentee')->first();
      $report = $exam_result->training_feedbacks()->where('from', 'mentor')->where('to', 'coach')->first();
    }

    return view('result.detailPoint', compact('topic', 'client', 'exam_result', 'answers', 'feedback', 'report'));
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
