<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;

class UserController extends Controller
{
    //
    public function index(Request $request)
    {
      // $data = User::with('role')->get();
      // return($data);

      if ($request->ajax()) {
        $data = User::with('roles')->get();

        return DataTables::of($data)
          ->addIndexColumn()
          ->addColumn('action', function ($row) {
            $edit_btn = '<a href="javascript:;" id="editRole" class="btn-sm btn-primary" data-id="' . $row->id . '" data-original-title="detail feedback">Update</a>';
            $delete_btn = '<a href="javascript:;" id="deleteRole" class="btn-sm btn-primary" data-id="' . $row->id . '" data-original-title="detail feedback">Delete</a>';
            $actionBtn = $edit_btn.' '.$delete_btn;
            return $actionBtn;
          })
          ->rawColumns(['action'])
          ->make(true);
      }

      return view('users.index');
    }
}
