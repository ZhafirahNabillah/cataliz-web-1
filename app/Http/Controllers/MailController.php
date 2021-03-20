<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendResetPasswordMail;
use App\Mail\SendForgotPasswordMail;
use App\Mail\SendSessionScheduledMail;
use App\Mail\SendSessionRescheduledMail;
use App\Mail\SendSignUpMail;
use Carbon\Carbon;

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

    public static function SendSignUpMail($email, $verification_code){
      $data = [
        'verification_code' => $verification_code
      ];

      Mail::to($email)->send(new SendSignUpMail($data));
    }

    public static function SendSessionScheduledMail($agenda_detail, $clients, $coach){
      $data_for_coach = [
        'receiver_name' => $coach->name,
        'coach_name' => $coach->name,
        'clients' => $clients,
        'session_name' => $agenda_detail->session_name,
        'topic' => $agenda_detail->topic,
        'media' => $agenda_detail->media,
        'date' => Carbon::parse($agenda_detail->date)->format('l jS \\of F Y'),
        'time' => Carbon::parse($agenda_detail->time)->format('H:i'),
        'duration' => $agenda_detail->duration
      ];

      Mail::to($coach->email)->send(new SendSessionScheduledMail($data_for_coach));

      foreach ($clients as $client) {
        $data_for_coachee = [
          'receiver_name' => $client->name,
          'coach_name' => $coach->name,
          'client_name' => $client->name,
          'session_name' => $agenda_detail->session_name,
          'topic' => $agenda_detail->topic,
          'media' => $agenda_detail->media,
          'date' => Carbon::parse($agenda_detail->date)->format('l jS \\of F Y'),
          'time' => Carbon::parse($agenda_detail->time)->format('H:i'),
          'duration' => $agenda_detail->duration
        ];

        Mail::to($client->email)->send(new SendSessionScheduledMail($data_for_coachee));
      }

    }

    public static function SendSessionRescheduledMail($old_agenda_detail, $agenda_detail, $clients, $coach){
      $data_for_coach = [
        'receiver_name' => $coach->name,
        'coach_name' => $coach->name,
        'clients' => $clients,
        'session_name' => $agenda_detail->session_name,
        'media' => $agenda_detail->media,
        'topic' => $agenda_detail->topic,
        'date' => Carbon::parse($agenda_detail->date)->format('l jS \\of F Y'),
        'time' => Carbon::parse($agenda_detail->time)->format('H:i'),
        'old_date' => Carbon::parse($old_agenda_detail->date)->format('l jS \\of F Y'),
        'old_time' => Carbon::parse($old_agenda_detail->time)->format('H:i'),
        'duration' => $agenda_detail->duration
      ];

      Mail::to($coach->email)->send(new SendSessionRescheduledMail($data_for_coach));

      foreach ($clients as $client) {
        $data_for_coachee = [
          'receiver_name' => $client->name,
          'coach_name' => $coach->name,
          'client_name' => $client->name,
          'session_name' => $agenda_detail->session_name,
          'media' => $agenda_detail->media,
          'topic' => $agenda_detail->topic,
          'date' => Carbon::parse($agenda_detail->date)->format('l jS \\of F Y'),
          'time' => Carbon::parse($agenda_detail->time)->format('H:i'),
          'old_date' => Carbon::parse($old_agenda_detail->date)->format('l jS \\of F Y'),
          'old_time' => Carbon::parse($old_agenda_detail->time)->format('H:i'),
          'duration' => $agenda_detail->duration
        ];

        Mail::to($client->email)->send(new SendSessionRescheduledMail($data_for_coachee));
      }

    }
}
