<?php

namespace App\Models;

use App\Builders\UserBuilder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;
use Faker\Factory;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    const CODE_LENGTH = 6;

    protected $guard_name = 'web,api';

    protected $with = ['department'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'code',
        'name',
        'email',
        'password',
        'image',
        'department_id',
        'email_verified_at',
        'remember_token',
        'mobile_token',
        'logged_in'
    ];

    /**
     * The relations to eager load on every query.
     *
     * @var array
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class)->select('id', 'title', 'manager_id');
    }

    public function socialAccounts()
    {
        return $this->morphMany(SocialAccount::class, 'sociable');
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Hash::make($value),
        );
    }

    protected function image(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => $value && Storage::disk('public')->exists( 'uploads/users/' . $value ) ? 'storage/uploads/users/' . $value : null,
        );
    }

    public function newEloquentBuilder($query)
    {
        return new UserBuilder($query);
    }

    public function hasPermission($permission)
    {
        return in_array($permission, $this->permissions()->pluck('name')->toArray())
                ? true
                : false;
    }

    public function getPermissions($pluck_column = 'id')
    {
        return $this->permissions()->pluck($pluck_column)->toArray();
    }

    public function slug()
    {
        return "<a href='".routeHelper('users.edit', $this)."'>$this->name</a>";
    }

    public static function generateCode()
    {
        do {
            $code = (Factory::create())->randomNumber(self::CODE_LENGTH, true);
        } while ( self::query()->where('code', $code)->exists() );
        return $code;
    }
}
