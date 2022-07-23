<?php

namespace App\Models;

use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    public function routes()
    {
        return $this->belongsToMany(Route::class, 'role_route', 'role_id', 'route_id');
    }

    public function slug()
    {
        return $this->name;
    }
}
