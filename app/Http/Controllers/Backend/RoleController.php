<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\RoleRequest;
use App\Http\Services\RoleService;
use App\Models\Role as ModelsRole;
use Spatie\Permission\Models\Role;

class RoleController extends BackendController
{
    public $full_page_ajax = true;

    public function __construct(RoleDataTable $dataTable, Role $role)
    {
        parent::__construct($dataTable, $role);
    }

    public function store(RoleRequest $request, RoleService $RoleService)
    {
        $role = $RoleService->handle($request->validated());
        if (is_string($role)) return $this->throwException($role);
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.role')]));
    }

    public function update(RoleRequest $request, RoleService $RoleService, $id)
    {
        $role = $RoleService->handle($request->validated(), $id);
        if (is_string($role)) return $this->throwException($role);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.role')]));
    }
}
