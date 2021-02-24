<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Client;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

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
  protected function validator(array $data)
  {
    return Validator::make($data, [
      'name' => ['required', 'string', 'max:255'],
      'phone' => ['required', 'string', 'max:18', 'min:9'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
      'password' => ['required', 'string', 'min:8', 'confirmed'],
    ]);
  }

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
      'phone'     => 'required',
      'email'     => 'required',
      'password'  => 'required',
      'role'      => 'required',
    ]);

    $user = User::create([
      'name' => $request->name,
      'phone' => $request->phone,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    if ($request->role == 'coach') {
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
    }

    return redirect('login')->with('success', 'Registrasi berhasil, silahkan login!');
  }
}
