<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PermissionDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\PermissionRequest;
use App\Http\Services\PermissionService;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionController extends BackendController
{
    public $full_page_ajax = true;

    public function __construct(PermissionDataTable $dataTable, Permission $permission)
    {
        parent::__construct($dataTable, $permission);
    }

    public function store(PermissionRequest $request, PermissionService $PermissionService)
    {
        $permission = $PermissionService->handle($request->validated());
        if (is_string($permission)) return $this->throwException($permission);
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.permission')]));
    }

    public function update(PermissionRequest $request, PermissionService $PermissionService, $id)
    {
        $permission = $PermissionService->handle($request->validated(), $id);
        if (is_string($permission)) return $this->throwException($permission);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.permission')]));
    }

    public function append()
    {
        return [
            'roles' => Role::pluck('name', 'id')
        ];
    }
}
