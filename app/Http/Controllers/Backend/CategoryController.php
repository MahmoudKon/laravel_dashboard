<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CategoryDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\CategoryRequest;
use App\Http\Services\CategoryService;
use App\Models\Category;

class CategoryController extends BackendController
{
    public $use_form_ajax   = true;
    public $use_button_ajax = true;

    public function __construct(CategoryDataTable $dataTable, Category $category)
    {
        parent::__construct($dataTable, $category);
    }

    public function store(CategoryRequest $request, CategoryService $categoryService)
    {
        $category = $categoryService->handle($request->validated());
        if (is_string($category)) return $this->throwException($category);
        $redirect = $request->parent_id ? routeHelper("categories.subs.index", $request->parent_id) : null;
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.category')]), $redirect);
    }

    public function update(CategoryRequest $request, CategoryService $categoryService, $id)
    {
        $category = $categoryService->handle($request->validated(), $id);
        if (is_string($category)) return $this->throwException($category);
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.category')]));
    }

    public function append()
    {
        return [
            'categories' => Category::select('name', 'id')
            ->when(request()->category && stripos(request()->route()->action['as'], 'create') !== false, function($query) {
                return $query->where('id', request()->category);
            })->when(request()->category && stripos(request()->route()->action['as'], 'edit') !== false, function($query) {
                return $query->where('id', '!=', request()->category)->where(function($query) {
                    return $query->where('parent_id', '!=', request()->category)->orWhereNull('parent_id');
                });
            })->get()
        ];
    }
}
