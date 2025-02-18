<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class sendGeneratedLinkMail extends Mailable
{
    use Queueable, SerializesModels;

    public $signed_url;

    public function __construct($signed_url)
    {
        $this->signed_url = $signed_url;
    }

    public function build()
    {
        return $this->subject('Your One-Time Access Link')
            ->view('emails.generatedLinkMail')
            ->with(['signedUrl' => $this->signed_url]);
    }
}
