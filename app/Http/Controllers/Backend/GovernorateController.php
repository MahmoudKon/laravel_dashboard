<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\GovernorateDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\GovernorateRequest;
use App\Http\Services\GovernorateService;
use App\Models\Governorate;
use Exception;

class GovernorateController extends BackendController
{
    public $use_form_ajax   = true;
    public $use_button_ajax = true;

    public function store(GovernorateRequest $request, GovernorateService $GovernorateService)
    {
        $row = $GovernorateService->handle($request->validated());
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.governorate')]));
    }

    public function update(GovernorateRequest $request, GovernorateService $GovernorateService, $id)
    {
        $row = $GovernorateService->handle($request->validated(), $id);
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.governorate')]));
    }

    public function model() { return new Governorate; }

    public function dataTable() { return new GovernorateDataTable; }
}
