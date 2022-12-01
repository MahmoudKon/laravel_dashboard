<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\DepartmentDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\DepartmentRequest;
use App\Http\Services\DepartmentService;
use App\Models\Department;
use App\Models\User;

class DepartmentController extends BackendController
{
    public $use_form_ajax   = true;
    public $use_button_ajax = true;

    public function store(DepartmentRequest $request, DepartmentService $DepartmentService)
    {
        $department = $DepartmentService->handle($request->validated());
        if (is_string($department)) return $this->throwException($department);
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.department')]));
    }

    public function update(DepartmentRequest $request, DepartmentService $DepartmentService, $id)
    {
        $department = $DepartmentService->handle($request->validated(), $id);
        if (is_string($department)) return $this->throwException($department);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.department')]));
    }

    public function model()
    {
        return new Department;
    }

    public function dataTable()
    {
        return new DepartmentDataTable;
    }

    public function append() :array
    {
        return [
            'users' => User::pluck('name', 'id')
        ];
    }
}
