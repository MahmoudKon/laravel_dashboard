<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CountryDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\CountryRequest;
use App\Http\Services\CountryService;
use App\Models\Country;

class CountryController extends BackendController
{
    public $full_page_ajax = true;

    public function __construct(CountryDataTable $dataTable, Country $country)
    {
        parent::__construct($dataTable, $country);
    }

    public function store(CountryRequest $request, CountryService $countryService)
    {
        $country = $countryService->handle($request->validated());
        if (is_string($country)) return $this->throwException($country);
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.country')]));
    }

    public function update(CountryRequest $request, CountryService $countryService, $id)
    {
        $country = $countryService->handle($request->validated(), $id);
        if (is_string($country)) return $this->throwException($country);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.country')]));
    }
}
