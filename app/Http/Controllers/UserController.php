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
            $edit_btn = '<a href="javascript:;" id="editUser" class="btn-sm btn-primary" data-id="' . $row->id . '" data-original-title="detail feedback">Update</a>';
            // $delete_btn = '<a href="javascript:;" id="deleteUser" class="btn-sm btn-primary" data-id="' . $row->id . '" data-original-title="detail feedback">Delete</a>';
            $actionBtn = $edit_btn;
            return $actionBtn;
          })
          ->rawColumns(['action'])
          ->make(true);
      }

      return view('users.index');
    }

    public function edit($id)
    {
      //
      $user = User::with('roles')->where('id',$id)->first();
      return response()->json($user);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name'  => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'role'  => 'required',
        ]);

        $user = User::where('id',$request->input('user_id'))->first();
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->syncRoles($request->input('role'));
        $user->save();

        return response()->json(['success' => 'Customer saved successfully!']);
    }
}
