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
use Exception;

class SettingController extends BackendController
{
    public bool $use_form_ajax  = true;

    public function store(SettingRequest $request, SettingService $SettingService)
    {
        $row = $SettingService->handle($request->validated());
        if ($row instanceof Exception ) throw new Exception( $row );
        $redirect = '/'.getRoutePrefex().'/settings';
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.setting')]), $redirect);
    }

    public function update(SettingRequest $request, SettingService $SettingService, $id)
    {
        $row = $SettingService->handle($request->validated(), $id);
        if ($row instanceof Exception ) throw new Exception( $row );
        $redirect = '/'.getRoutePrefex().'/settings';
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.setting')]), $redirect);
    }

    public function getTypeInput(Request $request)
    {
        $view_path = SettingType::viewHandler($request->content_type_id);
        $row = $this->model()->whereId($request->content_id)->first();
        $value = $row && $row->content_type_id == $request->content_type_id ? $row->value : null;
        return $view_path ? view($view_path, compact('value'), ['name' => 'value', 'value' => $value]) : '';
    }

    public function model() :\Illuminate\Database\Eloquent\Model { return new Setting; }

    public function dataTable() :\Yajra\DataTables\Services\DataTable { return new SettingDataTable; }

    public function append() :array
    {
        return [
            'types' => ContentType::pluck('name', 'id')
        ];
    }
}
