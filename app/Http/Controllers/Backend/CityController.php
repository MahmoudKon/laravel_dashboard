<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CityDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\CityRequest;
use App\Http\Services\CityService;
use App\Models\City;
use App\Models\Governorate;
use Exception;

class CityController extends BackendController
{
    public bool $use_form_ajax   = true;
    public bool $use_button_ajax = true;

    public function store(CityRequest $request, CityService $CityService)
    {
        $row = $CityService->handle($request->validated());
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.city')]), routeHelper('governorates.cities.index', $request->governorate_id));
    }

    public function update(CityRequest $request, CityService $CityService, $id)
    {
        $row = $CityService->handle($request->validated(), $id);
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.city')]));
    }

    public function model() :\Illuminate\Database\Eloquent\Model { return new City; }

    public function dataTable() :\Yajra\DataTables\Services\DataTable { return new CityDataTable; }

    public function append(): array
    {
        return [
            'governorates' => Governorate::filter()->pluck('name', 'id')
        ];
    }
}
