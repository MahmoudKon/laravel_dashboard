<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ContentTypeDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\ContentTypeRequest;
use App\Http\Services\ContentTypeService;
use App\Models\ContentType;
use Exception;

class ContentTypeController extends BackendController
{
    public bool $full_page_ajax  = true;

    public function store(ContentTypeRequest $request, ContentTypeService $contentTypeService)
    {
        $row = $contentTypeService->handle($request->validated());
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.content_type')]));
    }

    public function update(ContentTypeRequest $request, ContentTypeService $contentTypeService, $id)
    {
        $row = $contentTypeService->handle($request->validated(), $id);
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.content_type')]));
    }

    public function model() :\Illuminate\Database\Eloquent\Model { return new ContentType; }

    public function dataTable() :\Yajra\DataTables\Services\DataTable { return new ContentTypeDataTable; }
}
