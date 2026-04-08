<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class LoginVerificationCodeMail extends Mailable
{
    use Queueable, SerializesModels;

    public string $name;
    public string $code;

    public function __construct(string $name, string $code)
    {
        $this->name = $name;
        $this->code = $code;
    }

    public function build()
    {
        return $this->subject('Your SaveUp login verification code')
            ->view('emails.login-code');
    }
}