<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CategoryCreatedMail extends Mailable
{

    use Queueable,
        SerializesModels;
    public $user;
    public $category;
    public $isUpdated;

    public function __construct($user, $category, $isUpdated)
    {
        $this->user = $user;
        $this->category = $category;
        $this->isUpdated = $isUpdated;
    }
    //build the message.
    public function build()
    {
        if($this->isUpdated == 0)
        {
            return $this->markdown('email-category-created')->subject('Welcome to' .config('app.name'));
        }
        else{
            return $this->markdown('email-category-created')->subject('Welcome to' .config('app.name'));  
        }
    }
}
