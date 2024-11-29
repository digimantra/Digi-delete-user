<?php

namespace Digi\AccountDeletion\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OtpMail extends Mailable
{
    use Queueable, SerializesModels;

    public $otp;

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function build()
    {
        return $this->subject('Your OTP for Account Deletion')
                    ->view('digi_deleteUser::emails.otp_email'); // Use the namespace you defined for the view
    }
}
