<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = ['name', 'phone', 'active', 'bio', 'department_id', 'user_id'];

    public function slug()
    {
        return $this->id;
    }
    
	public function department() { return $this->belongsTo(Department::class, 'department_id'); }

	public function user() { return $this->belongsTo(User::class, 'user_id'); }

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