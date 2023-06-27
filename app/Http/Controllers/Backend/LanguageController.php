<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\LanguageDataTable;
use App\Http\Controllers\BackendController;
use App\Models\Language;
use App\Http\Services\LanguageService;
use App\Http\Requests\LanguageRequest;
use Exception;

class LanguageController extends BackendController
{
    public bool $use_form_ajax = true;

    public function store(LanguageRequest $request, LanguageService $LanguageService)
    {
        $row = $LanguageService->handle($request->validated());
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.language')]));
    }

    public function update(LanguageRequest $request, LanguageService $LanguageService, $id)
    {
        $row = $LanguageService->handle($request->validated(), $id);
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.language')]));
    }

    public function model() :\Illuminate\Database\Eloquent\Model { return new Language; }

    public function dataTable() :\Yajra\DataTables\Services\DataTable { return new LanguageDataTable; }

    public function append(): array
    {
        return [
            'icons' => LanguageService::getFlags(),
        ];
    }
}
