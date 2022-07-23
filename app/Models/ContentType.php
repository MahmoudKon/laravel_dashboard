<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentType extends Model
{
    use HasFactory;

    protected $table = 'content_types';

    protected $fillable = ['name', 'visible_to_content'];

    public $timestamps = false;
}
