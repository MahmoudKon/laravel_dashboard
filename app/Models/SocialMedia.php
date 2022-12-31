<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SocialMedia extends Model
{
    use HasFactory;

    protected $table = 'social_medias';

    protected $fillable = ['name', 'url', 'icon', 'color', 'is_visible'];

    public function slug()
    {
        return $this->name;
    }

    public function scopeIsVisible($query)
    {
        return $query->where('is_visible', true);
    }

    public function getTemplate()
    {
        return "<a class='btn btn-sm' target='_blank' href='$this->url' data-toggle='tooltip' title='$this->name'
                    style='background-color: $this->color !important; color: #fff; border-color: $this->color; font-weight: bold'>
                    <i class='$this->icon' style='padding: 0 5px'></i>
                    $this->name
                </a>";
    }
}
