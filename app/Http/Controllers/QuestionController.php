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
                'question-' . $question_id      => 'required',
                'answer-' . $question_id        => 'required',
                'true-answer-' . $question_id   => 'required',
                'point-' . $question_id         => 'required'
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
        return view('exercise.detailQuestion', compact('topic', 'question', 'ans_array', 'choice_itr'));
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
        return redirect()->route('exercise.show', ['exercise' => $question->exam_id])->with('success', 'Question has been edited successfully');
    }

    public function add_new_question($id)
    {
        // $id = Exam::find($id)->pluck('id');
        return view('exercise.createQuestionInOneTopic', compact('id'));
    }
    public function store_new_question(Request $request, $id)
    {
        // $exam = Exam::where('id', $id)->pluck('id');
        $topic_id = Question::where('exam_id', $id)->pluck('topic_id');
        $question = new Question;
        foreach ($topic_id as $tpc_id) {
            $question->topic_id = $tpc_id;
        }
        $question->question = $request->input('question-' . 1);
        $question->answers = implode(',', $request->input('answer-' . 1));
        $question->true_answer = $request->input('true-answer-' . 1);
        $question->weight = $request->input('point-' . 1);
        $question->exam_id = $id;
        $question->save();
        return redirect()->route('exercise.show', ['exercise' => $question->exam_id])->with('success', 'Question has been added successfully');
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
