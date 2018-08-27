<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class nova_senha extends Mailable
{
    use Queueable, SerializesModels;


    public $senha, $nome;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($senha, $nome)
    {
        $this->senha = $senha;
        $this->nome = $nome;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('email.nova_senha');

    }
}
