<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\RoleRequest;
use App\Http\Services\RoleService;
use App\Models\Role;
use Exception;

class RoleController extends BackendController
{
    public bool $full_page_ajax = true;

    public function store(RoleRequest $request, RoleService $RoleService)
    {
        $row = $RoleService->handle($request->validated());
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.role')]));
    }

    public function update(RoleRequest $request, RoleService $RoleService, $id)
    {
        $row = $RoleService->handle($request->validated(), $id);
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.role')]));
    }

    public function model() :\Illuminate\Database\Eloquent\Model { return new Role; }

    public function dataTable() :\Yajra\DataTables\Services\DataTable { return new RoleDataTable; }
}
