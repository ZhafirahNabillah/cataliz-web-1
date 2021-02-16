<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use DataTables;

class PermissionController extends Controller
{
    //
    public function index(Request $request)
    {
      if ($request->ajax()) {
        $data = Permission::all();

        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $edit_btn = '<a href="javascript:;" id="editPermission" class="btn-sm btn-primary" data-id="' . $row->id . '" data-original-title="detail feedback">Update</a>';
            $delete_btn = '<a href="javascript:;" id="deletePermission" class="btn-sm btn-primary" data-id="' . $row->id . '" data-original-title="detail feedback">Delete</a>';
            $actionBtn = $edit_btn.' '.$delete_btn;
            return $actionBtn;
          })
          ->rawColumns(['action'])
          ->make(true);
      }

      return view('permissions.index');
    }
}
