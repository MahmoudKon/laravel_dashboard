<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;

class Route extends Model
{
    use HasFactory;

    protected $fillable = [
        'controller',
        'func',
        'method',
        'middleware',
        'namespace',
        'uri',
        'route',
        'prefix',
        'where',
    ];

    public function roles()
    {
        return $this->BelongsToMany(Role::class, 'role_route', 'route_id', 'role_id')->withPivot('role_id');
    }

    public function hasRole($role_id)
    {
        return $this->roles()->where('role_id', $role_id)->count() ? true : false;
    }

    public function permissionName()
    {
        $model = str_replace('Controller', '', $this->controller); // User
        $model = Str::plural( strtolower($model) ); // users
        return "$model-$this->func"; // users-index
    }

    public function method()
    {
        $methods = explode(',', $this->method);
        return strtolower($methods[0]);
    }
}
