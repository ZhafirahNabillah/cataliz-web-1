<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\JsonResponse;
use App\Models\Lesson;
use Pion\Laravel\ChunkUpload\Exceptions\UploadFailedException;
use Pion\Laravel\ChunkUpload\Exceptions\UploadMissingFileException;
use Pion\Laravel\ChunkUpload\Handler\AbstractHandler;
use Pion\Laravel\ChunkUpload\Handler\HandlerFactory;
use Pion\Laravel\ChunkUpload\Receiver\FileReceiver;

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

        dd($request);

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
      // dd($request);

      $filenameWithExt = $request->file->getClientOriginalName();
      $request->file->move(public_path('/upload'), $filenameWithExt);
      // $filename = 'tes';
      // $extension = $request->file('file')->getClientOriginalExtension();
      // $filenameSave = $filename . '_' . time() . '.' . $extension;
      // Storage::disk('s3')->put('tes/'.$filenameWithExt, fopen($request->file('file'), 'r+'));
      // $lesson->video = $filenameSave;
    }

    public function lesson_chunk_upload(Request $request)
    {
        // create the file receiver
        $receiver = new FileReceiver("file", $request, HandlerFactory::classFromRequest($request));

        // check if the upload is success, throw exception or return response you need
        if ($receiver->isUploaded() === false) {
            throw new UploadMissingFileException();
        }

        // receive the file
        $save = $receiver->receive();

        // check if the upload has finished (in chunk mode it will send smaller files)
        if ($save->isFinished()) {
            // save the file and return any response you need, current example uses `move` function. If you are
            // not using move, you need to manually delete the file by unlink($save->getFile()->getPathname())
            return $this->saveFileToS3($save->getFile());
        }

        // we are in chunk mode, lets send the current progress
        /** @var AbstractHandler $handler */
        $handler = $save->handler();

        return response()->json([
            "done" => $handler->getPercentageDone(),
            'status' => true
        ]);
    }

    protected function saveFileToS3($file)
    {
        $fileName = $this->createFilename($file);

        $disk = Storage::disk('s3');
        // It's better to use streaming Streaming (laravel 5.4+)
        // $disk->put('lesson_video/'.$fileName, $file);
        $disk->putFileAs('/lessons', $file, $fileName);

        // for older laravel
        // $disk->put($fileName, file_get_contents($file), 'public');
        $mime = str_replace('/', '-', $file->getMimeType());

        // We need to delete the file when uploaded to s3
        unlink($file->getPathname());

        return response()->json([
            'path' => $disk->url($fileName),
            'name' => $fileName,
            'mime_type' =>$mime
        ]);
    }

    protected function createFilename(UploadedFile $file)
    {
        $extension = $file->getClientOriginalExtension();
        $filename = str_replace(".".$extension, "", $file->getClientOriginalName()); // Filename without extension

        // Add timestamp hash to name of the file
        $filename .= "_" . md5(time()) . "." . $extension;

        return $filename;
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
