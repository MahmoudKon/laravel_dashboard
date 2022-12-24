<?php

namespace App\Http\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionService
{
    public function handle($request, $id = null)
    {
        try {
            DB::beginTransaction();
                $permission = Permission::updateOrCreate(['id' => $id], $request + ['guard_name' => PERMISSION_GUARDS]);

                if (isset($request['roles']) && ! empty($request['roles'][0]))
                    $permission->syncRoles($request['roles']);
            DB::commit();

            return $permission;
        } catch (Exception $e) {
            return $e;
        }
    }
}
