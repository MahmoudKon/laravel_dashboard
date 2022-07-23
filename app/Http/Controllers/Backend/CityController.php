<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CityDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\CityRequest;
use App\Http\Services\CityService;
use App\Models\City;
use App\Models\Governorate;
use Illuminate\Http\Request;

class CityController extends BackendController
{
    public $use_form_ajax   = true;
    public $use_button_ajax = true;

    public function __construct(CityDataTable $dataTable, City $city)
    {
        parent::__construct($dataTable, $city);
    }

    public function store(CityRequest $request, CityService $CityService)
    {
        $row = $CityService->handle($request->validated());
        if (is_string($row)) return $this->throwException($row);
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.city')]));
    }

    public function update(CityRequest $request, CityService $CityService, $id)
    {
        $row = $CityService->handle($request->validated(), $id);
        if (is_string($row)) return $this->throwException($row);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.city')]));
    }

    public function append(): array
    {
        return [
            'governorates' => Governorate::when(request()->governorate, function($query) {
                                    $query->where('id', request()->governorate);
                                })->pluck('name', 'id')
        ];
    }
}
