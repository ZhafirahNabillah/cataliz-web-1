<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;
use DataTables;

class PackagesController extends Controller
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
            $data = Package::all();
  
            return DataTables::of($data)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                if (auth()->user()->hasRole('adminLMS')) {
                $edit_btn = '<a href="javascript:;" id="editPackage" class="btn-sm btn-primary" data-id="' . $row->id . '" >Update</a>';
                $delete_btn = '<a href="javascript:;" id="deletePackage" class="btn-sm btn-danger" data-id="' . $row->id . '" >Delete</a>';
                $detail_btn = '<a href="'.route('program.show', $row->id).'" id="detailPackage" class="btn-sm btn-warning">Detail</a>';
  
                $actionBtn = $edit_btn . ' ' . $delete_btn . ' ' . $detail_btn;
                return $actionBtn;
              } 
              })
              ->rawColumns(['action'])
              ->make(true);
          }
  
        return view('LMS.packages.index');
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
        return redirect('LMS/');
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
        $package = Package::find($id);
        $package->delete();

        return response()->json(['success' => 'Package deleted!']);
    }
}
