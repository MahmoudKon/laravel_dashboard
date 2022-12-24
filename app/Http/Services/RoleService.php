<?php

namespace App\Http\Services;

use Exception;
use Spatie\Permission\Models\Role;

class RoleService
{
    public function handle($request, $id = null)
    {
        try {
            return Role::updateOrCreate(['id' => $id],$request + ['guard_name' => PERMISSION_GUARDS]);
        } catch (Exception $e) {
            return $e;
        }
    }
}
