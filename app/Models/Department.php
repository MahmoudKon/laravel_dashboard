<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['title', 'email', 'manager_id'];

    public function manager()
    {
        return $this->belongsTo(User::class, 'manager_id')->select('id', 'name')->withDefault(['id' => null, 'name' => '']);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function slug()
    {
        return $this->title;
    }

    public function scopeFilter($query)
    {
        return $query->when(request('department'), function($query) {
                    $query->where('id', request('department'));
                });
    }
}
