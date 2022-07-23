<?php

namespace App\Traits;

use Exception;
use Illuminate\Support\Str;

trait BackendControllerHelper
{
    /**
     * index_view
     * the main index page for larg data.
     * @var string
     */
    public $index_view  = "backend.includes.pages.index-page";

    /**
     * create_view
     * the form create in in full page
     * @var string
     */
    public $create_view = "backend.includes.pages.form-page";

    /**
     * update_view
     * the form update in in full page
     * @var string
     */
    public $update_view = "backend.includes.pages.form-page";

    /**
     * show_view
     * the cover/show page in in full page
     * @var string
     */
    public $show_view   = "backend.includes.pages.show-page";

    /**
     * full_page_ajax
     *  to make the create/update in modal in the same index page, with add small create form near table list, without refresh page.
     * @var bool
     */
    public $full_page_ajax  = false;

    /**
     * use_form_ajax
     * to make create/update form use ajax when make submit, then refresh the page.
     * @var bool
     */
    public $use_form_ajax   = false;

    /**
     * use_button_ajax
     * use to make create/edit buttons get the form in modal.
     * NOTE if form blade has code js and this property is true, then must remove the push or section if used to use script tag direct
     * @var bool
     */
    public $use_button_ajax = false;

    /**
     * append
     * To append data for form page like [users data for select tag]
     *
     * @return array
     */
    public function append()
    {
        return [];
    }

    /**
     * query
     * to customize get instance of model like [get relations]
     *
     * @param  int $id
     * @return object|null
     */
    public function query($id) :object|null
    {
        return $this->model::find($id);
    }

    /**
     *  getModelName
     *  to get the model name from model object
     * @param  bool $lower_case
     * @param  bool $plural
     * @return string
     */
    public function getModelName(bool $lower_case = false, bool $plural = false) :string
    {
        $model_name = class_basename($this->model);
        $model_name = preg_replace('/([^A-Z])([A-Z])/', "$1 $2", $model_name);
        $model_name = $lower_case ? Str::lower($model_name) : $model_name;
        $model_name = $plural ? Str::plural($model_name) : $model_name;
        return $model_name;
    }

    /**
     * modelCount
     * check if the current model has scope filter, then get the count rows per this scope.
     * @return int
     */
    public function modelCount() :int
    {
        return method_exists($this->model, 'scopeFilter')
                ? $this->model::filter()->count()
                : $this->model::count();
    }

    /**
     * redirect
     * handler return type
     * 1) use single page for crud [modal for create and update] not use redirect, just display flash message after any action.
     * 2) use ajax for any form to just make validation and insert data, here will return redirect to another page [index]
     *          will return the url and use js make redirect.
     * 3) use normal for after submit the controller will make redirect.
     *
     * @return object
     */
    public function redirect($message = null, $redirect = null) :object
    {
        toast($message, 'success');
        $message = $message ?? $this->getModelName()." Created Successfully!";
        $goto = $redirect ?? routeHelper(str_replace(' ', '_', $this->getModelName(true, true)).'.index');

        if ($this->full_page_ajax || ($this->use_form_ajax && $this->use_button_ajax))
            if ($redirect) {
                return response()->json(['redirect' => $goto]);
            } else
                return response()->json(['message' => $message, 'icon' => 'success', 'count' => $this->modelCount()]);
        else {
            if ($this->use_form_ajax)
                return response()->json(['redirect' => $goto]);
            else {
                return redirect($goto);
            }
        }
    }

    /**
     * throwException
     * handler return type
     * 1) handel error reterned
     *
     * @return object
     */
    public function throwException($error_message) :object
    {
        if ($this->full_page_ajax || ($this->use_form_ajax && $this->use_button_ajax))
                return response()->json($error_message, 500);
        else {
            if ($this->use_form_ajax && ! in_array("GET", request()->route()->methods()))
                return response()->json($error_message, 500);
            else {
                toast($error_message, 'error');
                return back();
            }
        }
    }
}
