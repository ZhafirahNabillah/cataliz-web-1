<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Jobs\SendResetPasswordMailJob;
use App\Jobs\SendForgotPasswordMailJob;
use App\Jobs\SendSignUpMailJob;
use App\Jobs\SendRemoveClassMailJob;
use App\Jobs\SendAddClassMailJob;
use App\Jobs\SendSessionScheduledMailJob;
use App\Jobs\SendSessionRescheduledMailJob;
use Carbon\Carbon;

class MailController extends Controller
{
    //
    public static function SendResetPasswordMail($name, $email, $reset_code){
      $data = [
          'name' => $name,
          'reset_code' => $reset_code,
          'email' => $email
      ];

      // Mail::to($email)->send(new SendResetPasswordMail($data));
      SendResetPasswordMailJob::dispatch($data);
    }

    public static function SendForgotPasswordMail($email, $reset_code){
      $data = [
        'reset_code' => $reset_code,
        'email' => $email
      ];

      // Mail::to($email)->send(new SendForgotPasswordMail($data));
      SendForgotPasswordMailJob::dispatch($data);
    }

    public static function SendSignUpMail($user){
      $data = [
        'verification_code' => $user->verification_code,
        'receiver_name' => $user->name,
        'email' => $user->email
      ];

      // Mail::to($user->email)->send(new SendSignUpMail($data));
      SendSignUpMailJob::dispatch($data);
    }

    public static function SendSessionScheduledMail($agenda_detail, $clients, $coach){
      $data_for_coach = [
        'receiver_email' => $coach->email,
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

      SendSessionScheduledMailJob::dispatch($data_for_coach);

      foreach ($clients as $client) {
        $data_for_coachee = [
          'receiver_email' => $client->email,
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

        SendSessionScheduledMailJob::dispatch($data_for_coachee);
      }

    }

    public static function SendSessionRescheduledMail($old_agenda_detail, $agenda_detail, $clients, $coach){
      $data_for_coach = [
        'receiver_email' => $coach->email,
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

      SendSessionRescheduledMailJob::dispatch($data_for_coach);

      foreach ($clients as $client) {
        $data_for_coachee = [
          'receiver_email' => $client->email,
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

        SendSessionRescheduledMailJob::dispatch($data_for_coachee);
      }

    }

    public static function SendAddClassMail($clients, $coach_detail){
      foreach ($clients as $client) {
        // code...
        $data = [
          'client_name'     => $client->name,
          'client_email'    => $client->email,
          'client_company'  => $client->company,
          'coach_name'      => $coach_detail->name,
          'coach_email'     => $coach_detail->email,
          'admin_name'      => auth()->user()->name,
          'admin_email'     => auth()->user()->email
        ];

        SendAddClassMailJob::dispatch($data);
      }

      return response('email sent');

      // Mail::to(auth()->user()->email)->send(new SendRemoveClassMailToCoach($data));
    }

    public static function SendRemoveClassMail($client, $coach_detail){
      $data = [
        'client_name'     => $client->name,
        'client_email'    => $client->email,
        'client_company'  => $client->company,
        'coach_name'      => $coach_detail->name,
        'coach_email'     => $coach_detail->email,
        'admin_name'      => auth()->user()->name,
        'admin_email'     => auth()->user()->email
      ];

      SendRemoveClassMailJob::dispatch($data);

      return response($data);

      // Mail::to(auth()->user()->email)->send(new SendRemoveClassMailToCoach($data));
    }
}
