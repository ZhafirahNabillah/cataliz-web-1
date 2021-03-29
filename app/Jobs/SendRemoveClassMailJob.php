<?php

namespace App\Jobs;

use Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\SendRemoveClassMailToCoach;
use App\Mail\SendRemoveClassMailToCoachee;
use App\Mail\SendRemoveClassMailToAdmin;

class SendRemoveClassMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        //
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Mail::to($this->data['coach_email'])->send(new SendRemoveClassMailToCoach($this->data));
        Mail::to($this->data['client_email'])->send(new SendRemoveClassMailToCoachee($this->data));
        Mail::to($this->data['admin_email'])->send(new SendRemoveClassMailToAdmin($this->data));
    }
}
