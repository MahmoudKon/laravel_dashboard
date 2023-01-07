<?php

namespace App\Observers;

use App\Models\Client;
use App\Traits\UploadFile;

class ClientObserver
{
    use UploadFile;

    /**
     * Handle the Client "updated" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function updated(Client $client)
    {
        if ($client->isDirty('image')) {
            $this->remove($client->getOriginal('image'));
        }
    }

    /**
     * Handle the Client "deleted" event.
     *
     * @param  \App\Models\Client  $client
     * @return void
     */
    public function deleted(Client $client)
    {
        $this->remove($client->image);
    }
}
