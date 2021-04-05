<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Coach;
use App\Models\Agenda;
use App\Models\Agenda_detail;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DataTables;
use App\Http\Controllers\MailController;
use Illuminate\Support\Facades\Validator;

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
      $user = User::with('roles')->where('id', $id)->first();

      return response()->json($user);
    }
    if (auth()->user()->hasRole('coachee')) {
      $user = User::with('roles')->where('id', $id)->first();
      $coach = $user->coach;
      $plans_id = $coach->plan->pluck('id');
      $agendas_id = Agenda::whereIn('plan_id', $plans_id)->pluck('id');
      $total_coaching = Agenda_detail::whereIn('agenda_id', $agendas_id)->count();
      $total_client = $coach->clients->count();

      $user->phone = '+62' . substr($user->phone, 0, -5) . 'xxxxx';
      $user->email = str_pad(substr($user->email, -11), strlen($user->email), 'x', STR_PAD_LEFT);

      return response()->json(array('total_coaching' => $total_coaching, 'total_client' => $total_client, 'user' => $user));
    }

    // return response()->json($user);
  }


  public function store(Request $request)
  {

    if ($request->action_type == 'edit-user') {
      $user = User::find($request->user_id);
      $user->syncRoles($request->input('roles'));
    } elseif ($request->action_type == 'create-user') {
      $validator = Validator::make($request->all(), [
        'name'  => 'required',
        'phone' => 'required|numeric|regex:/^[1-9][0-9]/|digits_between:10,12',
        'email' => 'required|email|unique:users|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
        'roles' => 'required',
      ]);

      if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
      }
      
      $user = User::updateOrCreate(['id' => $request->user_id], ['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'password' => Hash::make('default123'), 'reset_code' => sha1(time())]);
      $user->syncRoles($request->input('roles'));

      if ($user->hasRole('coachee')) {
        $client = Client::updateOrCreate(['user_id' => $user->id], ['name' => $user->name, 'email' => $user->email, 'phone' => $user->phone, 'program' => 'Starco']);
      } elseif ($user->hasRole('coach')) {
        $coach = Coach::updateOrCreate(['user_id' => $user->id]);
      }

      MailController::SendResetPasswordMail($user->name, $user->email, $user->reset_code);
    }

    return response()->json(['success' => 'Customer saved successfully!']);
  }

  public function suspend_user(Request $request)
  {
    $user = User::find($request->id);
    $user->suspend_status = 0;
    $user->update();

    return response()->json(['success' => 'User has been suspended!']);
  }

  public function unsuspend_user(Request $request)
  {
    $user = User::find($request->id);
    $user->suspend_status = 1;
    $user->update();

    return response()->json(['success' => 'User has been activated!']);
  }
}
