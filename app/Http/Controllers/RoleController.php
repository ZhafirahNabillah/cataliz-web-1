<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;

class RoleController extends Controller
{
  //

  public function index(Request $request)
  {
    // $role = Role::find(1);
    // $permissions = $role->permissions;

    if ($request->ajax()) {
      $data = Role::all();

      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $edit_btn = '<a href="javascript:;" id="editRole" class="btn-sm btn-primary" data-id="' . $row->id . '" data-original-title="detail feedback">Update</a>';
          $delete_btn = '<a href="javascript:;" id="deleteRole" class="btn-sm btn-danger" data-id="' . $row->id . '" data-original-title="detail feedback">Delete</a>';
          $actionBtn = $edit_btn . ' ' . $delete_btn;
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    $permissions = Permission::all();
    return view('roles.index', compact('permissions'));
  }

  public function edit($id)
  {
    //
    $role_with_permissions = Role::with('permissions')->where('id', $id)->get();

    return response()->json($role_with_permissions);
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required',
      'permission' => 'required',
    ]);

    $role = Role::updateOrCreate(
      ['id' => $request->input('role_id')],
      ['name' => $request->input('name')]
    );

    $role->syncPermissions($request->input('permission'));

    return response()->json(['success' => 'Customer saved successfully!']);
  }


  public function destroy($id)
  {
    $role = Role::find($id);
    $role->syncPermissions();
    $role->delete();

    return response()->json(['success' => 'Client deleted!']);
  }
}
