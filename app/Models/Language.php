<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\File;

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

    public function checkDir()
    {
        return File::isDirectory( lang_path( $this->short_name ) );
    }

    public function slug()
    {
        return "<i class='$this->icon'></i> $this->native";
    }
}
