<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SocialMediaDataTable;
use App\Http\Controllers\BackendController;
use App\Models\SocialMedia;
use App\Http\Services\SocialMediaService;
use App\Http\Requests\SocialMediaRequest;
use Exception;

class SocialMediaController extends BackendController
{
    public bool $use_form_ajax   = true;
    public bool $use_button_ajax = true;

    public function store(SocialMediaRequest $request, SocialMediaService $SocialMediaService)
    {
        $row = $SocialMediaService->handle($request->validated());
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.social_media')]));
    }

    public function update(SocialMediaRequest $request, SocialMediaService $SocialMediaService, $id)
    {
        $row = $SocialMediaService->handle($request->validated(), $id);
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.social_media')]));
    }

    public function model() :\Illuminate\Database\Eloquent\Model { return new SocialMedia; }

    public function dataTable() :\Yajra\DataTables\Services\DataTable { return new SocialMediaDataTable; }
}
