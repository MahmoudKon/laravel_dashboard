<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\GovernorateDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\GovernorateRequest;
use App\Http\Services\GovernorateService;
use App\Models\Governorate;
use Illuminate\Http\Request;

class GovernorateController extends BackendController
{
    public $use_form_ajax   = true;
    public $use_button_ajax = true;

    public function __construct(GovernorateDataTable $dataTable, Governorate $governorate)
    {
        parent::__construct($dataTable, $governorate);
    }

    public function store(GovernorateRequest $request, GovernorateService $GovernorateService)
    {
        $row = $GovernorateService->handle($request->validated());
        if (is_string($row)) return $this->throwException($row);
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.governorate')]));
    }

    public function update(GovernorateRequest $request, GovernorateService $GovernorateService, $id)
    {
        $row = $GovernorateService->handle($request->validated(), $id);
        if (is_string($row)) return $this->throwException($row);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.governorate')]));
    }
}
