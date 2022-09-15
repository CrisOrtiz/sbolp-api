<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendEmailValidationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $user_id;
    public $client_url;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user_id, $mail)
    {
        $this->mail = $mail;
        $this->user_id = $user_id;
        $this->client_url = env('CLIENT_URL');
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('Email.emailValidation')
        ->subject('Verificación de correo.')
        ->with([
            'mail' => $this->mail,
            'id' => $this->user_id,
            'client_url' => $this->client_url
        ]);
    }
}