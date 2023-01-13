<?php

namespace App\Jobs;

use App\Events\NewEmail;
use App\Mail\SendEmail as MailSendEmail;
use App\Models\Email;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public Email $email, public array $users_id)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->notifyUsers();

        Mail::send(new MailSendEmail($this->email));
    }

    protected function notifyUsers() :void
    {
        foreach ($this->users_id as $user_id)
            broadcast( new NewEmail( $user_id, $this->email ) );
    }
}
