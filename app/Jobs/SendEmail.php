<?php

namespace App\Jobs;

use App\Events\NewEmail;
use App\Mail\SendEmail as MailSendEmail;
use App\Models\Attachment;
use App\Models\Email;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(public $data)
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
        DB::beginTransaction();
            $email = Email::create($this->data);

            if (isset($this->data['attachments']))
                $this->insertAttachments($email, $this->data['attachments']);

            $users_id = $this->getUsers($email);
            $this->notifyUsers($email, $users_id);

            Mail::send(new MailSendEmail($email));
        DB::commit();
    }

    protected function insertAttachments($email, $attachments = null)
    {
        if (! $attachments) return;

        foreach ($attachments as $attachment) {
            $info = [
                'name' => $attachment->getClientOriginalName(),
                'extension' => $attachment->extension(),
                'size' => $attachment->getSize(),
                'mime' => $attachment->getMimeType(),
            ];
            $email->attachments()->create(['attachment' => (new Attachment)->upload($attachment), 'info' => $info]);
        }
    }

    protected function getUsers(&$email) :array
    {
        $users_id = User::select('id')->whereIn('email', explode(',', $email->to))->when($email->cc, function($query) use ($email) {
            $query->orWhereIn('email', explode(',', $email->cc));
        })->pluck('id')->toArray();

        $email->recipients()->sync($users_id);
        $email->recipients()->attach([$email->notifier_id => ['is_sender' => true, 'seen' => true, 'seen_time' => now()]]);
        $email->load('notifier');

        return $users_id;
    }

    protected function notifyUsers($email, $users_id) :void
    {
        foreach ($users_id as $user_id) {
            broadcast( new NewEmail( $user_id, $email ) );
        }
    }
}
