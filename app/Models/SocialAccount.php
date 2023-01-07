<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $fillable = ['user_id', 'provider_name', 'provider_id'];

    public function user(){
        return $this->morphTo(User::class, 'sociable');
    }
}
