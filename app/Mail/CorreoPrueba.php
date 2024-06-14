<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CorreoPrueba extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $messageContent;

    public function __construct($subject, $messageContent)
    {
        $this->subject = $subject;
        $this->messageContent = $messageContent;
    }

    public function build()
    {
        return $this->view('emails.prueba')
                    ->subject($this->subject)
                    ->with(['messageContent' => $this->messageContent]);
    }
}

