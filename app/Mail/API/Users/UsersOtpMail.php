<?php

namespace App\Mail\API\Users;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UsersOtpMail extends Mailable
{
    use Queueable, SerializesModels;
    public $subject;
    public $data;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($subject, $data)
    {
        $this->subject = $subject;
        $this->data = $data;
        // Here, data array contains otp and it's type
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->subject)->view('api.users.mails.users_otp_mail');
    }
}
