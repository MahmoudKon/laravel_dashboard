<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\PermissionDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\PermissionRequest;
use App\Http\Services\PermissionService;
use Spatie\Permission\Models\Permission;
use Exception;

class PermissionController extends BackendController
{
    public $full_page_ajax   = true;

    public function store(PermissionRequest $request, PermissionService $PermissionService)
    {
        $row = $PermissionService->handle($request->validated());
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.permission')]));
    }

    public function update(PermissionRequest $request, PermissionService $PermissionService, $id)
    {
        $row = $PermissionService->handle($request->validated(), $id);
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.permission')]));
    }

    public function model() { return new Permission; }

    public function dataTable() { return new PermissionDataTable; }
}
