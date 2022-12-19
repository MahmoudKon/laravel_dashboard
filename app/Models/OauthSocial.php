<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OauthSocial extends Model
{
    use HasFactory;

    protected $table = 'oauth_socials';

    protected $fillable = ['display_name', 'name', 'icon', 'color', 'active'];

    public function slug()
    {
        return $this->display_name;
    }

    public function scopeActive(Builder $query)
    {
        return $query->whereActive(true);
    }
}
