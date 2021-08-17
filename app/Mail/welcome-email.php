<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class verification_email extends Mailable
{
    use Queueable, SerializesModels;
    public $data;
    public $code;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data,$code)
    {
        $this->data = $data;
        $this->code = $code;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('admin.users.emails.email_verification');
    }
}
