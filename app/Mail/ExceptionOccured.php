<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ExceptionOccured extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * __construct
     * Create a new message instance.
     *
     * @param  array $content
     * @return void
     */
    public function __construct(public array $content)
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
        return $this->to('mahmoud.mohammed050684@gmail.com')
                    ->subject('Have a new exception')
                    ->from(env('APP_EMAIL'), env('APP_NAME', setting('site_name', 'Laravel')))
                    ->view('emails.exception', ['content' => $this->content]);
    }
}
