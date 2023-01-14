<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\DepartmentDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\DepartmentRequest;
use App\Http\Services\DepartmentService;
use App\Models\Department;
use App\Models\User;
use Exception;

class DepartmentController extends BackendController
{
    public bool $use_form_ajax   = true;
    public bool $use_button_ajax = true;

    public function store(DepartmentRequest $request, DepartmentService $DepartmentService)
    {
        $row = $DepartmentService->handle($request->validated());
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.department')]));
    }

    public function update(DepartmentRequest $request, DepartmentService $DepartmentService, $id)
    {
        $row = $DepartmentService->handle($request->validated(), $id);
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.department')]));
    }

    public function model() :\Illuminate\Database\Eloquent\Model { return new Department; }

    public function dataTable() :\Yajra\DataTables\Services\DataTable { return new DepartmentDataTable; }

    public function append() :array
    {
        return [
            'users' => User::pluck('name', 'id')
        ];
    }
}
