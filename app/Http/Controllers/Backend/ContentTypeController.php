<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ContentTypeDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\ContentTypeRequest;
use App\Http\Services\ContentTypeService;
use App\Models\ContentType;

class ContentTypeController extends BackendController
{
    public $full_page_ajax  = true;

    public function store(ContentTypeRequest $request, ContentTypeService $contentTypeService)
    {
        $content_type = $contentTypeService->handle($request->validated());
        if (is_string($content_type)) return $this->throwException($content_type);
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.content_type')]));
    }

    public function update(ContentTypeRequest $request, ContentTypeService $contentTypeService, $id)
    {
        $content_type = $contentTypeService->handle($request->validated(), $id);
        if (is_string($content_type)) return $this->throwException($content_type);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.content_type')]));
    }

    public function model() { return new ContentType; }

    public function dataTable() { return new ContentTypeDataTable; }
}
