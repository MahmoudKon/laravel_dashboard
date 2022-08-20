<?php

namespace App\Mail;

use App\Models\PasswordPinCode;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ForgetPassword extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public PasswordPinCode $password_pin_code)
    {
        //
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->password_pin_code->email)
                    ->subject('Reset Password Notification')
                    ->from(setting('site_email', env('MAIL_FROM_ADDRESS')), setting('site_name', env('MAIL_FROM_NAME')))
                    ->view('emails.forget-password', ['row' => $this->password_pin_code]);
    }
}
