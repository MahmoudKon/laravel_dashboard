<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\OperatorDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\OperatorRequest;
use App\Http\Services\OperatorService;
use App\Models\Country;
use App\Models\Operator;

class OperatorController extends BackendController
{
    public $full_page_ajax = true;

    public function __construct(OperatorDataTable $dataTable, Operator $operator)
    {
        parent::__construct($dataTable, $operator);
    }

    public function store(OperatorRequest $request, OperatorService $operatorService)
    {
        $operator = $operatorService->handle($request->validated());
        if (is_string($operator)) return $this->throwException($operator);
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.operator')]));
    }

    public function update(OperatorRequest $request, OperatorService $operatorService, $id)
    {
        $operator = $operatorService->handle($request->validated(), $id);
        if (is_string($operator)) return $this->throwException($operator);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.operator')]));
    }

    public function append()
    {
        return [
            'countries' => Country::when(request()->country, function($query) {
                $query->where('id', request()->country);
            })->pluck('name', 'id'),
        ];
    }
}
