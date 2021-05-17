<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Answer;
use App\Models\Question;
use App\Models\Exam_result;
use Carbon\Carbon;
use DataTables;

class ExerciseController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index(Request $request)
  {
    if (auth()->user()->hasRole('trainer')) {
      $data = Topic::where('trainer_id', auth()->user()->id)->get();

      if ($request->ajax()) {

        //return data as datatable json
        return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('total_questions', function ($row) {
            $total_questions = $row->question->count();
            return $total_questions;
          })
          ->addColumn('action', function ($row) {

            //add detail and whatsapp button if user have permission
            if (auth()->user()->can('detail-exercise')) {
              $detail_btn = '<a href="' . route('exercise.show', $row->id) . '" class="btn-sm btn-primary">Detail</a>';
            } else {
              $detail_btn = null;
              // $detail_participant_btn = null;
            }

            //final button that shows on view
            $actionBtn = $detail_btn;

            return $actionBtn;
          })
          ->rawColumns(['action'])
          ->make(true);
      }
    } elseif (auth()->user()->hasRole('mentor')) {
      $data = Exam_result::all();
      // return $data;
      if ($request->ajax()) {

        //return data as datatable json
        return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('user', function ($row) {
            $user = $row->user;
            $client = $user->client->toArray();
            return $client;
          })
          ->addColumn('category', function ($row) {
            $topic = $row->topic;
            $category = $topic->category->toArray();
            return $category;
          })
          ->addColumn('total_questions', function ($row) {
            $topic = $row->topic;
            $total_questions = $topic->question->count();
            return $total_questions;
          })
          ->addColumn('action', function ($row) {

            //add detail and whatsapp button if user have permission
            if (auth()->user()->can('detail-exercise')) {
              $detail_exercise_btn = '<a href="' . route('exercise.show', $row->topic_id) . '" id="detailBtn" class="btn-sm btn-primary">Detail</a>';
              // $detail_participant_btn = '<a href="' . route('topic.participant', $row->id) . '" class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-file-text font-small-4 mr-50"><path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path><polyline points="14 2 14 8 20 8"></polyline><line x1="16" y1="13" x2="8" y2="13"></line><line x1="16" y1="17" x2="8" y2="17"></line><polyline points="10 9 9 9 8 9"></polyline></svg>Detail Participant</a>';
            } else {
              $detail_exercise_btn = null;
              // $detail_participant_btn = null;
            }

            //final dropdown button that shows on view
            // $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
            //   <div class="dropdown-menu dropdown-menu-right">' . $detail_exercise_btn . '</div>';

            return $detail_exercise_btn;
          })
          ->rawColumns(['user', 'category', 'total_questions', 'action'])
          ->make(true);
      }
    } elseif (auth()->user()->hasRole('coach')) {

      $data = Topic::all();

      if ($request->ajax()) {

        //return data as datatable json
        return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('total_questions', function ($row) {
            $total_questions = $row->question->count();
            return $total_questions;
          })
          ->addColumn('category', function ($row) {
            $category = $row->category->category;
            return $category;
          })
          ->addColumn('action', function ($row) {

            //add detail and whatsapp button if user have permission
            if (auth()->user()->can('detail-exercise')) {
              $detail_exercise_btn = '<a href="' . route('exercise.show', $row->id) . '" class="btn-sm btn-primary">Detail</a>';
            } else {
              $detail_exercise_btn = null;
            }

            //final dropdown button that shows on view
            // $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
            //   <div class="dropdown-menu dropdown-menu-right">' . $detail_exercise_btn . '</div>';

            return $detail_exercise_btn;
          })
          ->rawColumns(['action', 'total_questions', 'category'])
          ->make(true);
      }
    } elseif (auth()->user()->hasRole('coachee')) {

      $client = auth()->user()->client;
      $data = $client->topics;

      if ($request->ajax()) {

        //return data as datatable json
        return Datatables::of($data)
          ->addIndexColumn()
          ->addColumn('total_questions', function ($row) {
            $total_questions = $row->question->count();
            return $total_questions;
          })
          ->addColumn('category', function ($row) {
            $category = $row->category->category;
            return $category;
          })
          ->addColumn('action', function ($row) {

            //add detail and whatsapp button if user have permission
            $start_exam_btn = '<a href="' . route('exercise.start', $row->id) . '" class="btn-sm btn-primary">Start</a>';

            //final dropdown button that shows on view
            // $actionBtn = '<div class="d-inline-flex"><a class="pr-1 dropdown-toggle hide-arrow text-primary" data-toggle="dropdown" ><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical font-small-4"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg></a>
            //   <div class="dropdown-menu dropdown-menu-right">' . $detail_exercise_btn . '</div>';

            return $start_exam_btn;
          })
          ->rawColumns(['action', 'total_questions', 'category'])
          ->make(true);
      }
    }

    return view('exercise.index');
  }

  public function start_exam(Topic $topic)
  {
    $questions = $topic->question;
    $total_questions = $questions->count();
    $choice_itr = 1;
    $exam = Exam_result::updateOrCreate([
      'topic_id'      => $topic->id,
      'user_id'       => auth()->user()->id,
    ],[
      'attempt_start' => Carbon::now()->format('Y-m-d H:i:s')
    ]);

    $answers = collect();

    foreach ($questions as $question) {
      $answer = Answer::updateOrCreate([
        'exam_id'           => $exam->id,
        'question_id'       => $question->id
      ],[

      ]);

      $answers->push($answer);
    }

    // return $answers;

    return view('exercise.start', compact('topic', 'questions', 'total_questions', 'choice_itr', 'exam', 'answers'));
  }

  public function save_answer(Request $request){
    $answer = Answer::updateOrCreate([
      'id'                => $request->answer_id
    ],[
      'answer'            => $request->answer
    ]);

    return response()->json([
      'answer' => $answer
    ]);
  }

  public function submit_all(Exam_result $exam_result){
    $answers = $exam_result->answers;

    foreach ($answers as $answer) {
      $question = Question::where('id', $answer->question_id)->first();

      if ($answer->answer == $question->true_answer) {
        $answer->is_correct_answer = 1;
      } else {
        $answer->is_correct_answer = 0;
      }

      $answer->save();
      // return $answer;
    }

    $total_answers = $answers->count();
    $correct_answers = $answers->where('is_correct_answer', 1)->count();
    $grade = $correct_answers / $total_answers * 100 ;

    $exam_result->grade = $grade;
    $exam_result->save();

    return redirect()->route('exercise.index')->with('success', 'Your exam has successfully submited, see your exam result on result section!');
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('exercise.create');
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
  public function show(Request $request, $id)
  {

    $topic = Topic::find($id);

    if ($request->ajax()) {
      $data = Question::where('topic_id', $topic->id)->get();

      //return data as datatable json
      return Datatables::of($data)
        ->addIndexColumn()
        ->addColumn('question', function ($row) {
          return $question = strip_tags($row->question);
        })
        ->addColumn('action', function ($row) {

          //add update button if user have permission
          if (auth()->user()->can('update-question')) {
            $edit_btn = '<a href="' . route('question.edit', $row->id) . '" class="btn-sm btn-primary">Edit</a>';
          } else {
            $edit_btn = null;
          }

          //add detail button if user have permission
          if (auth()->user()->can('detail-question')) {
            $detail_btn = '<a href="' . route('question.show', $row->id) . '" class="btn-sm btn-primary">Detail</a>';
          } else {
            $detail_btn = null;
          }

          //final dropdown button that shows on view
          $actionBtn = $detail_btn . ' ' . $edit_btn;
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    return view('exercise.detail', compact('topic'));
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
