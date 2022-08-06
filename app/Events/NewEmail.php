<?php

namespace App\Events;

use App\Models\Email;
use App\Models\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewEmail implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */

    protected $email_id;

    public function __construct(public Email $email)
    {
        $this->email_id = $this->email->id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new Channel("new-email.$this->email_id");
    }

    // public function join(User $user, Email $email)
    // {
    //     return true;
    //     $emails = "$email->to,$email->cc,$email->do";
    //     $emails = array_filter( array_unique( explode(',', $emails) ) );
    //     return in_array($user->email, $emails);
    // }
}
