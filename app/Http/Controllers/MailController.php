<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendResetPasswordMail;
use App\Mail\SendForgotPasswordMail;
use App\Mail\SendSessionScheduledMail;
use App\Mail\SendSessionRescheduledMail;

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

    public static function SendSessionScheduledMail($agenda_detail, $client, $coach){
      $data = [
        'coach_name' => $coach->name,
        'client_name' => $client->name,
        'session_name' => $agenda_detail->session_name,
        'topic' => $agenda_detail->topic,
        'date' => $agenda_detail->date,
        'time' => $agenda_detail->time,
        'duration' => $agenda_detail->duration
      ];

      Mail::to($client->email)->send(new SendSessionScheduledMail($data));
      Mail::to($coach->email)->send(new SendSessionScheduledMail($data));
    }

    public static function SendSessionRescheduledMail($agenda_detail, $client, $coach){
      $data = [
        'coach_name' => $coach->name,
        'client_name' => $client->name,
        'session_name' => $agenda_detail->session_name,
        'topic' => $agenda_detail->topic,
        'date' => $agenda_detail->date,
        'time' => $agenda_detail->time,
        'duration' => $agenda_detail->duration
      ];

      Mail::to($client->email)->send(new SendSessionRescheduledMail($data));
      Mail::to($coach->email)->send(new SendSessionRescheduledMail($data));
    }
}
