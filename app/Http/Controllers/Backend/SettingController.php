<?php

namespace App\Http\Controllers\Backend;

use App\Constants\SettingType;
use App\DataTables\SettingDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\SettingRequest;
use App\Http\Services\SettingService;
use App\Models\ContentType;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends BackendController
{
    public $use_form_ajax  = true;

    public function store(SettingRequest $request, SettingService $SettingService)
    {
        $setting = $SettingService->handle($request->validated());
        if (is_string($setting)) return $this->throwException($setting);
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.setting')]));
    }

    public function update(SettingRequest $request, SettingService $SettingService, $id)
    {
        $setting = $SettingService->handle($request->validated(), $id);
        if (is_string($setting)) return $this->throwException($setting);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.setting')]));
    }

    public function getTypeInput(Request $request)
    {
        $view_path = SettingType::viewHandler($request->content_type_id);
        $row = $this->model::whereId($request->content_id)->first();
        $value = $row && $row->content_type_id == $request->content_type_id ? $row->value : null;
        return $view_path ? view($view_path, compact('value'), ['name' => 'value', 'value' => $value]) : '';
    }

    public function model()
    {
        return new Setting;
    }

    public function dataTable()
    {
        return new SettingDataTable;
    }

    public function append() :array
    {
        return [
            'types' => ContentType::pluck('name', 'id')
        ];
    }
}
