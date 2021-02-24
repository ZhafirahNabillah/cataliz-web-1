<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agenda_detail;
use App\Models\Client;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;
use App\Http\Controllers\MailController;

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
      if (auth()->user()->hasRole('admin')) {
        $user = User::with('roles')->where('id',$id)->first();

        return response()->json($user);
      }
      if (auth()->user()->hasRole('coachee')) {
        $user = User::with('roles')->where('id',$id)->first();
        $total_coaching = Agenda_detail::join('agendas', 'agendas.id', '=', 'agenda_details.agenda_id')->where('agendas.owner_id','=',$id)->count();
        $total_client = Client::where('owner_id',$id)->count();

        return response()->json(array('total_coaching' => $total_coaching, 'total_client' => $total_client, 'user' => $user));
      }

      // return response()->json($user);
    }

    public function store(Request $request){
        $this->validate($request, [
            'name'      => 'required',
            'email'     => 'required|email',
            'phone'     => 'required',
            'roles'     => 'required',
        ]);

        $user = User::updateOrCreate(['id' => $request->user_id],['name' => $request->name, 'email'=> $request->email, 'phone' => $request->phone, 'password' => Hash::make('default123'), 'reset_code' => sha1(time())]);
        $user->syncRoles($request->input('roles'));

        if ($user->hasRole('coachee')) {
          $client = Client::updateOrCreate(['user_id' => $user->id],['name' => $user->name, 'email' => $user->name, 'phone' => $user->phone, 'program' => 'Starco']);
        }

        MailController::SendResetPasswordMail($user->name, $user->email, $user->reset_code);

        return response()->json(['success' => 'Customer saved successfully!']);
    }

    public function suspend_user(Request $request){
      $user = User::find($request->id);
      $user->status = 0;
      $user->update();

      return response()->json(['success' => 'User has been suspended!']);
    }

    public function unsuspend_user(Request $request){
      $user = User::find($request->id);
      $user->status = 1;
      $user->update();

      return response()->json(['success' => 'User has been activated!']);
    }
}
