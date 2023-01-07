<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Foundation\Auth\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class Client extends User
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = ['username', 'email', 'password', 'phone', 'image'];

    protected function image(): Attribute
	{
		return Attribute::make(
            get: fn ($value) => $value && Storage::disk('public')->exists( 'uploads/clients/' . $value ) ? 'storage/uploads/clients/' . $value : null,
		);
	}

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }

    public function slug()
    {
        return $this->username;
    }

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
