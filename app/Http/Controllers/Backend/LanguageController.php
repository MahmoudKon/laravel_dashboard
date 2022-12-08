<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\LanguageDataTable;
use App\Http\Controllers\BackendController;
use App\Models\Language;
use App\Http\Services\LanguageService;
use App\Http\Requests\LanguageRequest;

class LanguageController extends BackendController
{
    public $use_form_ajax   = true;
    public $view_sub_path   = '.';

    public function store(LanguageRequest $request, LanguageService $LanguageService)
    {
        $row = $LanguageService->handle($request->validated());
        if (is_string($row)) return $this->throwException($row);
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.language')]));
    }

    public function update(LanguageRequest $request, LanguageService $LanguageService, $id)
    {
        $row = $LanguageService->handle($request->validated(), $id);
        if (is_string($row)) return $this->throwException($row);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.language')]));
    }

    public function model() { return new Language; }

    public function dataTable() { return new LanguageDataTable; }

    public function append(): array
    {
        $files = getFilesInDir(base_path('public\app-assets\backend\fonts\flag-icon-css\flags\1x1'));
        $icons = [];
        foreach ($files as $name => $path) {
            $name = 'flag-icon flag-icon-'.explode('.', $name)[0];
            $icons[$name] = $path;
        }
        return [
            'icons' => $icons
        ];
    }
}
