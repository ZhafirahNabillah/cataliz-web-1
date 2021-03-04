<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use PHPUnit\TextUI\XmlConfiguration\Constant;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::LOGOUT;

    public function show_reset_form()
    {
        $reset_code = \Illuminate\Support\Facades\Request::get('code');
        $user = User::where('reset_code', $reset_code)->first();
        if ($user != null) {
            return view('auth.passwords.reset', compact('user'));
        } else {
            return abort(404);
        }
    }

    public function reset_password(Request $request)
    {
        $user = User::where('reset_code', $request->reset_code)->first();

        if ($request->password == $request->password_confirmation) {

            $user->password = Hash::make($request->password);
            $user->reset_code = null;
            $user->update();

            return redirect('login')->with('success', 'Password changed successfully. Please login!');
        } else {
            return back()->with('error', 'Password tidak sama!');
        }
    }
}
