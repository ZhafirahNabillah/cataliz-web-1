<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Question;
use App\Models\Exam;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
        $exam = new Exam;
        $exam->topic_id = $request->topic_id;
        $exam->type = $request->type;
        $exam->duration = $request->duration;
        $exam->owner_id = auth()->user()->id;
        $exam->save();

        foreach ($request->all_questions_id as $question_id) {

            $validator = Validator::make($request->all(), [
              'question-'.$question_id      => 'required',
              'answer-'.$question_id        => 'required',
              'true-answer-'.$question_id   => 'required',
              'point-'.$question_id         => 'required'
            ]);

            if ($validator->fails()) {
              return back()
              ->withErrors($validator)
              ->withInput();
            }

            $question = new Question;
            $question->topic_id = $request->topic_id;
            $question->exam_id = $exam->id;
            $question->question = $request->input('question-' . $question_id);
            $question->answers = implode(',', $request->input('answer-' . $question_id));
            $question->true_answer = $request->input('true-answer-' . $question_id);
            $question->weight = $request->input('point-' . $question_id);
            $question->save();
        }

        return redirect('/exercise')->with('success', 'Exercise has been created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $question = Question::find($id);
        $answer = $question->answers;
        $topic = $question->topic;
        $ans_array = explode(',', $answer);
        // $ans = shuffle($ans_array);
        $choice_itr = 'A';
        // return $ans_array;
        return view('exercise.detailQuestion', compact('topic','question', 'ans_array', 'choice_itr'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $question = Question::find($id);
        $answers = explode(',', $question->answers);

        return view('exercise.editQuestion', compact('question', 'answers'));
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
        // return $request;
        $question = Question::find($id);
        $question->question = $request->question;
        $question->answers = implode(",", $request->input('answers'));
        $question->true_answer = $request->true_answer;
        $question->weight = $request->point;
        $question->update();
        return redirect()->route('exercise.show', ['exercise' => $question->topic_id])->with('success', 'question has been edited successfully');
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
