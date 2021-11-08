<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Program_lms;
use DataTables;
use Alert;

class ProgramLmsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Program_lms::all();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btnEdit = '<a href="javascript:;" id="editCategory" class="btn btn-primary btn-sm">Edit</a>';
                    $btnDelete = '<a href="javascript:void(0)" class="btn btn-danger btn-sm">Delete</a>';
                    $btnAction = $btnEdit . ' ' . $btnDelete;
                    return $btnAction;
                })

                ->rawColumns(['action'])
                ->make(true);
        }
        return view('LMS.category_program.index');
    }

    public function indexCoach()
    {
        return view('LMS.program.ourProgramLMS');
    }
    public function detailProgram()
    {
        return view('LMS.program.detail_program');
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
        $this->validate($request, [
            'program_name' => 'required',

        ]);

        $input = $request->all();
        $programLmsData = Program_lms::create($input);

        Alert::success('Your program, has been successfully created!');
        return redirect('programLms/index');
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
        $data = Program_lms::find($id);
        return view('LMS.edit', compact('data'));
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
        $this->validate($request, [
            'program_name' => 'required',

        ]);

        Booking::where('id', $id)->update([
            'program_name' => $request->program_name,
        ]);
        return redirect('LMS/edit');
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
