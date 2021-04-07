<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documentation;
use Illuminate\Support\Facades\Storage;

class DocumentationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('docs.create');
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
        $documentation = new Documentation;
        $documentation->title = 'tes';
        $documentation->description = $request->description;
        $documentation->save();

        return redirect('/docs');
        // return $request->description;
    }

    public function image_upload(Request $request)
    {
        $fileName = $request->file('file')->getClientOriginalName();
        if (Storage::disk('s3')->exists('uploads/' . $fileName)) {
            Storage::disk('s3')->delete('uploads/' . $fileName);
        }
        Storage::disk('s3')->put('uploads/' . $fileName, file_get_contents($request->file('file')));
        $path = Storage::disk('s3')->url('uploads/' . $fileName);
        return response()->json(['location' => $path]);
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
        $documentation = Documentation::find($id);

        return view('docs.show', compact('documentation'));
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
