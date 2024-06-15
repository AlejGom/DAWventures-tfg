<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RecoverMail extends Mailable
{
    use Queueable, SerializesModels;

    public $subject;
    public $messageContent1;
    public $messageContent2;
    public $messageContent3;
    public $code;

    public function __construct($subject, $messageContent1, $messageContent2, $messageContent3, $code)
    {
        $this->subject         = $subject;
        $this->messageContent  = $messageContent1;
        $this->messageContent2 = $messageContent2;
        $this->messageContent3 = $messageContent3;
        $this->code = $code;
    }

    public function build()
    {
        return $this->view('emails.recoverMail')->subject($this->subject)->with([
            'messageContent1' => $this->messageContent1,
            'messageContent2' => $this->messageContent2,
            'messageContent3' => $this->messageContent3,
            'code'            => $this->code
        ]);
    }
}

