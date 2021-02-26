<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use App\Http\Controllers\MailController;
use App\Models\User;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;


    protected function sendResetLinkEmail(Request $request){

      $this->validateEmail($request);

      $user = User::where('email', $request->email)->first();

      if ($user == null) {
        return back()->with('error', 'Sorry, account with this email address not found!');
      } else {
        $user->reset_code = sha1(time());
        $user->update();

        MailController::SendForgotPasswordMail($user->email, $user->reset_code);
        return back()->with('success', 'Forgot password reset link has been successfully sent to your email address!');
      }
    }
}
