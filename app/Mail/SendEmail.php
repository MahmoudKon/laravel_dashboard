<?php

namespace App\Mail;

use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(public Email $email)
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
        $to = $this->email->to ? explode(',', $this->email->to) : '';
        $cc = $this->email->cc ? explode(',', $this->email->cc) : '';
        return $this->subject($this->email->subject)
                            ->to($to)
                            ->cc($cc)
                            ->attachMany($this->email->attachments->pluck('attachment'))
                            ->view('emails.send-email', ['body' => $this->email->body]);
    }
}
