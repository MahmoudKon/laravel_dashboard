<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\AggregatorDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\AggregatorRequest;
use App\Http\Services\AggregatorService;
use App\Models\Aggregator;

class AggregatorController extends BackendController
{
    public $full_page_ajax = true;

    public function __construct(AggregatorDataTable $dataTable, Aggregator $aggregator)
    {
        parent::__construct($dataTable, $aggregator);
    }

    public function store(AggregatorRequest $request, AggregatorService $AggregatorService)
    {
        $aggregator = $AggregatorService->handle($request->validated());
        if (is_string($aggregator)) return $this->throwException($aggregator);
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.aggregator')]));
    }

    public function update(AggregatorRequest $request, AggregatorService $AggregatorService, $id)
    {
        $aggregator = $AggregatorService->handle($request->validated(), $id);
        if (is_string($aggregator)) return $this->throwException($aggregator);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.aggregator')]));
    }
}
