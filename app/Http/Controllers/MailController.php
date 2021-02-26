<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendResetPasswordMail;
use App\Mail\SendForgotPasswordMail;

class MailController extends Controller
{
    //
    public static function SendResetPasswordMail($name, $email, $reset_code){
      $data = [
          'name' => $name,
          'reset_code' => $reset_code
      ];

      Mail::to($email)->send(new SendResetPasswordMail($data));
    }

    public static function SendForgotPasswordMail($email, $reset_code){
      $data = [
        'reset_code' => $reset_code
      ];

      Mail::to($email)->send(new SendForgotPasswordMail($data));
    }
}
