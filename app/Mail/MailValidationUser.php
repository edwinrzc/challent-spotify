<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailValidationUser extends Mailable
{
    
    use Queueable, SerializesModels;

    public $link;

    public $vars;
    

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($vars)
    {
        
        $frontend_url = env('URL_FRONT', 'http://localhost:8000');
        $this->link =  "{$frontend_url}/usuario/validar-cuenta?code=" . $vars['validation_token'];
        $this->subject(__('Validación de cuenta'));
        $this->vars = $vars;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.users.validar_cuenta');
    }
}