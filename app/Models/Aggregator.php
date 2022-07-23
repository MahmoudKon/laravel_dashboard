<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aggregator extends Model
{
    use HasFactory;

    protected $fillable = [ 'title', 'ratio' ];
}
