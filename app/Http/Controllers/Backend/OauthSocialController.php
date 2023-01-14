<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\OauthSocialDataTable;
use App\Http\Controllers\BackendController;
use App\Models\OauthSocial;
use App\Http\Services\OauthSocialService;
use App\Http\Requests\OauthSocialRequest;
use Exception;

class OauthSocialController extends BackendController
{
    public bool $use_form_ajax   = true;
    public bool $use_button_ajax = true;

    public function store(OauthSocialRequest $request, OauthSocialService $OauthSocialService)
    {
        $row = $OauthSocialService->handle($request->validated());
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.oauth_social')]));
    }

    public function update(OauthSocialRequest $request, OauthSocialService $OauthSocialService, $id)
    {
        $row = $OauthSocialService->handle($request->validated(), $id);
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.oauth_social')]));
    }

    public function model() :\Illuminate\Database\Eloquent\Model { return new OauthSocial; }

    public function dataTable() :\Yajra\DataTables\Services\DataTable { return new OauthSocialDataTable; }
}
