<?php

namespace App\Http\Services;

use App\Models\Department;
use Exception;

class DepartmentService
{
    public function handle($request, $id = null)
    {
        try {
            return Department::updateOrCreate(['id' => $id],$request);
        } catch (Exception $e) {
            return $e;
        }
    }
}
