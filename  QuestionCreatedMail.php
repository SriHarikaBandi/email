<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class QuestionCreatedMail extends Mailable
{

    use Queueable,
        SerializesModels;
    public $question;
    public $feature;
    public $isUpdated;

    public function __construct($question, $feature, $isUpdated)
    {
        $this->question = $question;
        $this->feature = $feature;
        $this->isUpdated = $isUpdated;
    }
    //build the message.
    public function build()
    {
        if($this->isUpdated == 0)
        {
            return $this->markdown('email-question-created')->subject('Welcome to' .config('app.name'));
        }
        else
        {
        return $this->markdown('email-question-created')->subject('Welcome to' .config('app.name'));
        }
    }

}
