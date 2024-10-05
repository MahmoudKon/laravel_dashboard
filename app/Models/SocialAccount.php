<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class SocialAccount extends Model
{
    protected $fillable = ['user_id', 'provider_name', 'provider_id'];

    public function user(): MorphTo
    {
        return $this->morphTo(User::class, 'sociable');
    }
}
