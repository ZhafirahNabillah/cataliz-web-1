<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role as ModelsRole;
use Spatie\Permission\Models\Permission;

class ManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.dashboard');
    }

    public function manajemen_user()
    {
        return view('admin.user_management');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create_permissions(Request $request)
    {
        //     $this->validate($request, [
        //         'name' => 'required|string|unique:permissions'
        //     ]);
        // ​
        //     $permission = Permission::firstOrCreate([
        //         'name' => $request->name
        //     ]);
        //     return redirect()->back();

        // $permission1 = Permission::create(['name' => 'create agendas'])
        // $permission1 = Permission::create(['name' => 'create plans'])
        // $permission1 = Permission::create(['name' => 'create clients'])
    }

    public function ajaxAdmin(Request $request)
    {
        $admins = [];
        if ($request->has('q')) {
            $search = $request->q;
            $admins = ModelsRole::where('name', 'LIKE', "%$search%")
                ->get();
        } else {
            $admins = ModelsRole::orderby('id', 'asc')->get();
        }
        return response()->json($admins);
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
