<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Facades\Hash;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    protected $guard_name = 'web,api';

    protected $with = ['department'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'image',
        'department_id',
        'email_verified_at',
        'remember_token',
        'mobile_token',
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
        return $this->belongsTo(Department::class)->select('id', 'title', 'manager_id', 'manager_of_manager_id');
    }

    public function socialAccounts()
    {
        return $this->hasMany(SocialAccount::class);
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
            get: fn ($value) => $value && file_exists('uploads/users/' . $value) ? "uploads/users/$value" : null,
        );
    }

    public function scopeWithRole($query, $role)
    {
        return $query->whereHas('roles', function($query) use($role) {
            return $query->where('name', 'LIKE', "%$role%");
        });
    }

    public function scopeHasManager($query)
    {
        return $query->when(! isSuperAdmin(), function($query) {
            $query->whereHas('department', function($query) {
                $query->where('manager_id', auth()->id());
            });
        });
    }

    public function scopeExceptAuth($query)
    {
        return $query->where('id', '!=', auth()->id());
    }

    public function scopeFilter($query)
    {
        return $query->when(request('department'), function ($query) {
                        return $query->where('department_id', request('department'));
                    })->when(request()->name, function ($query) {
                        return $query->where('name', 'LIKE', "%".request()->name."%");
                    })->when(request()->email, function ($query) {
                        return $query->where('email', 'LIKE', "%".request()->email."%");
                    });
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
}
