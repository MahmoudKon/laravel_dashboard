<?php

namespace App\Http\Controllers\Backend;

use App\Constants\ContentType as ConstantContentType;
use App\DataTables\ContentDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\ContentRequest;
use App\Http\Services\ContentService;
use App\Models\Category;
use App\Models\Content;
use App\Models\ContentType;
use Illuminate\Http\Request;

class ContentController extends BackendController
{
    public $use_form_ajax = true;

    public function __construct(ContentDataTable $dataTable, Content $content)
    {
        parent::__construct($dataTable, $content, true);
    }

    public function store(ContentRequest $request, ContentService $contentService)
    {
        $content = $contentService->handle($request->validated());
        if (is_string($content)) return $this->throwException($content);
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.content')]));
    }

    public function update(ContentRequest $request, ContentService $contentService, $id)
    {
        $content = $contentService->handle($request->validated(), $id);
        if (is_string($content)) return $this->throwException($content);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.content')]));
    }

    public function getTypeInput(Request $request)
    {
        $view_path = ConstantContentType::viewHandler($request->content_type_id);
        $row = $this->model::whereId($request->content_id)->first();
        return $view_path ? view($view_path, compact('row')) : '';
    }

    public function append()
    {
        return [
            'types' => ContentType::where('visible_to_content', true)->pluck('name', 'id'),
            'categories' => Category::when(request()->category, function($query) {
                return $query->where('id', request()->category);
            })->pluck('name', 'id')
        ];
    }

    public function query($id) :object|null
    {
        return $this->model::with(['contentType', 'category'])->findOrFail($id);
    }
}
