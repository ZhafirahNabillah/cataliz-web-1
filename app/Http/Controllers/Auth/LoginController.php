<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
  /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

  use AuthenticatesUsers;

  /**
   * Where to redirect users after login.
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
    $this->middleware('guest')->except('logout');
  }

  protected function authenticated(Request $request)
  {

    if (Auth::attempt(['email' => $request->email, 'password' => $request->password, 'suspend_status' => 1, 'is_verified' => 1])) {
      return redirect()->intended('dashboard');
    } else if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'suspend_status' => 0, 'is_verified' => 1])){
      Auth::logout();
      return redirect('login')->with('error', 'Your account has been suspended!');
    } else if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'suspend_status' => 1, 'is_verified' => 0])){
      Auth::logout();
      return redirect('login')->with('error', 'Please verify your account before proceed!');
    } else if(Auth::attempt(['email' => $request->email, 'password' => $request->password, 'suspend_status' => 0, 'is_verified' => 0])){
      Auth::logout();
      return redirect('login')->with('error', 'Your account has been suspended and not verified!');
    }
  }

  public function logout(Request $request)
  {
    Auth::logout();
    return redirect('/login');
  }
}
