<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendResetPasswordMail extends Mailable
{
    use Queueable, SerializesModels;
    public $token;
    public $client_url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($token, $mail)
    {
        $this->token = $token;
        $this->mail = $mail;
        $this->client_url = env('CLIENT_URL');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Email.forgotPassword')
        ->subject('Restaurar contraseña')
        ->with([
            'token' => $this->token,
            'mail' => $this->mail,
            'client_url' => $this->client_url
        ]);
    }
}