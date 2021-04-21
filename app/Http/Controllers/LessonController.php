<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\Lesson;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return ('hallo');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('topic.create_lesson');
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
        // ini_set('max_execution_time', 3000);
        // ini_set('memory_limit','256M');

        // dd($request);

        $lesson = new Lesson;
        $lesson->lesson_name = $request->lesson_name;
        $lesson->sub_topic_id = $request->sub_topic_id;

        if ($request->hasFile('video')) {
          // $this->validate($request, [
          //   'video'                 => 'max:2048|mimes:pdf,doc,docx,txt',
          // ], [
          //   'note_attachment.max'   => "Ukuran file feedback tidak boleh melebihi 2Mb!",
          //   'note_attachment.mimes' => "Format file feedback yang didukung adalah .pdf .doc .docx .txt!",
          // ]);
          $filenameWithExt = $request->file('video')->getClientOriginalName();
          $filename = $request->lesson_name;
          $extension = $request->file('video')->getClientOriginalExtension();
          $filenameSave = $filename . '_' . time() . '.' . $extension;
          Storage::disk('s3')->put('lesson_video/'.$request->sub_topic_id.'/'.$filenameSave, fopen($request->file('video'), 'r+'));
          $lesson->video = $filenameSave;
        }

        $lesson->save();

        return redirect('/topic')->with('success', 'New Lesson successfully created!');
        // return response()->json($lesson);
    }

    public function lesson_video_upload(Request $request)
    {
      $filenameWithExt = $request->file('file')->getClientOriginalName();
      // $filename = 'tes';
      // $extension = $request->file('file')->getClientOriginalExtension();
      // $filenameSave = $filename . '_' . time() . '.' . $extension;
      Storage::disk('s3')->put('tes/'.$filenameWithExt, fopen($request->file('file'), 'r+'));
      // $lesson->video = $filenameSave;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Lesson $lesson)
    {
        //
        return response()->json($lesson);
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
