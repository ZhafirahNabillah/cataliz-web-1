<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Client;
use App\Models\Coach;
use App\Models\Agenda;
use App\Models\Agenda_detail;
use App\Models\Skill;
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

    return view('clients.index');
  }

  public function show_trainer_list(Request $request) {
    $data = User::role('trainer')->get();

    if ($request->ajax()) {
      return DataTables::of($data)
        ->addIndexColumn()
        ->addColumn('action', function ($row) {
          $detail_btn = '<a href="javascript:;" id="detailTrainer" class="btn-sm btn-primary" data-id="' . $row->id . '" data-original-title="detail feedback">Detail</a>';

          $actionBtn = $detail_btn;
          return $actionBtn;
        })
        ->rawColumns(['action'])
        ->make(true);
    }
  }

  public function edit($id)
  {
    //
    if (auth()->user()->hasRole('admin')) {
      $user = User::find($id);
      $role = $user->getRoleNames()->first();

      if ($role == 'coachee') {
        $client = $user->client;
        $program = $client->program;
      } else {
        $program = null;
      }

      return response()->json([
        'user'    => $user,
        'role'    => $role,
        'program' => $program
      ]);
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

    if (auth()->user()->hasRole('mentor')) {
      $user = User::with('roles')->where('id', $id)->first();
      $role = $user->getRoleNames()->first();

      if ($role == 'trainer') {
        $coach = $user->coach;

        if (is_null($coach->skill_id)) {
          $skills_name = "Skills not yet available";
        } else {
          $skill_id = json_decode($coach->skill_id);
          $skills = Skill::whereIn('id', $skill_id)->get();
          $skills_name = $skills->implode('skill_name', ', ');
        }

        return response()->json([
          'user'    => $user,
          'skills'  => $skills_name
        ]);
      } else {

        return response()->json([
          'user'    => $user
        ]);
      }
    }

    if (auth()->user()->hasRole('coach')) {
      $user = User::with('roles')->where('id', $id)->first();
      $role = $user->getRoleNames()->first();

      if ($role == 'mentor' | $role == 'trainer') {
        $coach = $user->coach;

        if (is_null($coach->skill_id)) {
          $skills_name = "Skills not yet available";
        } else {
          $skill_id = json_decode($coach->skill_id);
          $skills = Skill::whereIn('id', $skill_id)->get();
          $skills_name = $skills->implode('skill_name', ', ');
        }

        return response()->json([
          'user'    => $user,
          'skills'  => $skills_name
        ]);
      }
    }
  }


  public function store(Request $request)
  {

    if ($request->action_type == 'edit-user') {
      $user = User::find($request->user_id);
      $user->syncRoles($request->input('roles'));

      if ($user->getRoleNames()->first() == 'coachee') {
        $client = Client::where('user_id', $user->id)->first();
        $client->program_id = $request->program;
        $client->update();
      }
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
        $client = Client::updateOrCreate(['user_id' => $user->id], ['name' => $user->name, 'email' => $user->email, 'phone' => $user->phone, 'program_id' => $request->program]);
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
