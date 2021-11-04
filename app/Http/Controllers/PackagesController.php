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
                $detail_btn = '<a href="'.route('packages.show', $row->id).'" id="detailPackage" class="btn-sm btn-warning">Detail</a>';
  
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
        Package::updateOrCreate(
            ['id' => $request->input('package_id')],
            ['package_name' => $request->input('package')],
            ['program_id' => $request->input('programId')]
          );
  
          return response()->json(['success' => 'Program saved successfully!']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Package $package, Request $request)
    {
        $data = Package::all();
  
        return view('LMS.packages.detail', compact('package'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $package = Package::find($id);
        return response()->json($package);
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
        $package = Package::find($id);
        $package->delete();

        return response()->json(['success' => 'Package deleted!']);
    }
}
