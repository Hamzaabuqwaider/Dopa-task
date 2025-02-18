<?php

namespace App\Jobs;

use App\Mail\sendGeneratedLinkMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

class SendGeneratedLinkMailJob implements ShouldQueue
{
    use Queueable;

    protected $signed_url;
    protected $email;

    public function __construct($signed_url, $email)
    {
        $this->signed_url = $signed_url;
        $this->email = $email;
    }

    public function handle(): void
    {
        Mail::to($this->email)->send(new sendGeneratedLinkMail($this->signed_url));
    }
}
