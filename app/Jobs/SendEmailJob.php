<?php

namespace App\Jobs;

use App\Mail\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $recipient;
    public $subject;
    public $data;
    public $view;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    
    public function __construct($recipient, $data, $subject, $view)
    {
        $this->recipient = $recipient;
        $this->subject = $subject;
        $this->data = $data;
        $this->view = $view;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $email = new SendMail($this->data, $this->subject, $this->view);
        Mail::to($this->recipient)->send($email);
    }
    
}
