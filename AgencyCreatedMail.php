<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AgencyCreatedMail extends Mailable
{

    use Queueable,
        SerializesModels;
    public $user;
    public $agency;
    public function __construct($user, $agency)
    {
        $this->user = $user;
        $this->agency = $agency;
    }
    //build the message.
    public function build()
    {
        return $this->markdown('email-agency-created')->subject('Agency created successfully');
    }
}
