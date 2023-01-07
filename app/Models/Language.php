<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    use HasFactory;

    protected $table = 'languages';

    protected $fillable = ['name', 'native', 'short_name', 'active', 'icon'];

	public $timestamps = false;

    public function scopeActive($query)
    {
        return $query->where('active', true);
    }

    public function slug()
    {
        return "<i class='$this->icon'></i> $this->native";
    }
}
