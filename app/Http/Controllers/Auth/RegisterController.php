<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Models\Coach;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\MailController;

class RegisterController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

  use RegistersUsers;

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = RouteServiceProvider::HOME;

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param  array  $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
  // protected function validator(array $data)
  // {
  //   return Validator::make($data, [
  //     'name' => ['required', 'string', 'max:255'],
  //     'phone' => ['required', 'string', 'max:18', 'min:9'],
  //     'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
  //     'password' => ['required', 'string', 'min:8', 'confirmed']
  //   ]);
  // }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return \App\Models\User
   */

  protected function show_form_register()
  {
    return view('auth.register');
  }

  protected function create(Request $request)
  {
    $this->validate($request, [
      'name'      => 'required',
      'phone'     => 'required|numeric|regex:/^[1-9][0-9]/|digits_between:10,12',
      'email'     => 'required|email|unique:users|regex:/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix',
      'password'  => 'required|confirmed',
      'role'      => 'required',
      'privacy'   => 'required',
    ]);

    $user = User::create([
      'name' => $request->name,
      'phone' => $request->phone,
      'email' => $request->email,
      'password' => Hash::make($request->password),
      'verification_code' => sha1(time()),
    ]);

    if ($request->role == 'coach') {
      Coach::create([
        'user_id' => $user->id,
        'skill' => null
      ]);
      $user->assignRole('coach');
    } elseif ($request->role == 'coachee') {
      Client::create([
        'name' => $user->name,
        'phone' => $user->phone,
        'email' => $user->email,
        'occupation' => null,
        'company' => null,
        'organization' => null,
        'program' => 'Starco',
        'user_id' => $user->id,
      ]);
      $user->assignRole('coachee');
    } elseif ($request->role == 'trainer') {
      Client::create([
        'name' => $user->name,
        'phone' => $user->phone,
        'email' => $user->email,
        'occupation' => null,
        'company' => null,
        'organization' => null,
        'program' => 'Starco',
        'user_id' => $user->id,
      ]);
      $user->assignRole('trainer');
    } elseif ($request->role == 'mentor') {
      Client::create([
        'name' => $user->name,
        'phone' => $user->phone,
        'email' => $user->email,
        'occupation' => null,
        'company' => null,
        'organization' => null,
        'program' => 'Starco',
        'user_id' => $user->id,
      ]);
      $user->assignRole('mentor');
    }

    MailController::SendSignUpMail($user);

    return redirect('login')->with('success', 'Registration is successful, please check your email to verify your account!');
  }

  public function verifyUser()
  {
    $verification_code = \Illuminate\Support\Facades\Request::get('code');
    $user = User::where('verification_code', $verification_code)->first();
    if ($user != null) {
      $user->is_verified = 1;
      $user->verification_code = null;
      $user->save();
      return redirect('login')->with('success', 'Your account has been verified. Please login to continue the journey!');
    } else {
      return abort(404);
    }
  }
}
