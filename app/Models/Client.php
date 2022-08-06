<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = ['name', 'email', 'image', 'active', 'user_id', 'department_id'];

    public function slug()
    {
        return $this->id;
    }
    
	public function user() { return $this->belongsTo(User::class, 'user_id'); }

	public function department() { return $this->belongsTo(Department::class, 'department_id'); }

    public function scopeFilter($query)
    {
        return $query;
    }

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('orderDesc', function (Builder $builder) {
            $builder->orderBy('id', 'DESC');
        });
    }
}