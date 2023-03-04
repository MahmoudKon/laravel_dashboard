<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\InputTypeDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\InputTypeRequest;
use App\Http\Services\InputTypeService;
use App\Models\InputType;
use Exception;

class InputTypeController extends BackendController
{
    public bool $full_page_ajax  = true;

    public function store(InputTypeRequest $request, InputTypeService $service)
    {
        $row = $service->handle($request->validated());
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.content_type')]));
    }

    public function update(InputTypeRequest $request, InputTypeService $service, $id)
    {
        $row = $service->handle($request->validated(), $id);
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.content_type')]));
    }

    public function model() :\Illuminate\Database\Eloquent\Model { return new InputType(); }

    public function dataTable() :\Yajra\DataTables\Services\DataTable { return new InputTypeDataTable; }
}
