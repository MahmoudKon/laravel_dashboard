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

    public function getTemplate($use_route = false)
    {
        $route = $use_route ? route('auth.provider', $this->name) : 'javascript::void(0)';
        return "<a href='$route' class='btn btn-sm login-provider' data-toggle='tooltip' title='$this->display_name' style='background-color: $this->color !important; color: #fff; border-color: $this->color; font-weight: bold'>
                    <i class='$this->icon' style='padding: 0 5px;'></i></i> $this->display_name
                </a>";
    }
}
