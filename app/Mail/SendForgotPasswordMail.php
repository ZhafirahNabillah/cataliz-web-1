<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendForgotPasswordMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->email_data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
     public function build()
     {
         return $this->subject("Cataliz.id - Forgot Password Reset Link")->view('email_template.forgot_password_mail', ['email_data' => $this->email_data])->from('no-reply@cataliz.id');
     }
}
