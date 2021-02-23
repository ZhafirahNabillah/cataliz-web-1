<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendResetPasswordMail;

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
}
