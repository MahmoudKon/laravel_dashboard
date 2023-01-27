<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use Yajra\DataTables\Services\DataTable;

trait BackendControllerHelper
{
    /**
     * view_sub_path
     * the sub dir path after 'backend' folder.
     * @var string
     */
    public string $view_sub_path = '';

    /**
     * index_view
     * the main index page for larg data.
     * @var string
     */
    public string $index_view  = "backend.includes.pages.index-page";

    /**
     * create_view
     * the form create in in full page
     * @var string
     */
    public string $create_view = "backend.includes.pages.form-page";

    /**
     * update_view
     * the form update in in full page
     * @var string
     */
    public string $update_view = "backend.includes.pages.form-page";

    /**
     * show_view
     * the cover/show page in in full page
     * @var string
     */
    public string $show_view = "backend.includes.pages.show-page";

    /**
     * form_general
     * the Generate form modal
     * @var string
     */
    public $form_general = "backend.includes.pages.general-form";

    /**
     * full_page_ajax
     *  to make the create/update in modal in the same index page, with add small create form near table list, without refresh page.
     * @var bool
     */
    public bool $full_page_ajax  = false;

    /**
     * use_form_ajax
     * to make create/update form use ajax when make submit, then refresh the page.
     * @var bool
     */
    public bool $use_form_ajax   = false;

    /**
     * use_button_ajax
     * use to make create/edit buttons get the form in modal.
     * NOTE if form blade has code js and this property is true, then must remove the push or section if used to use script tag direct
     * @var bool
     */
    public bool $use_button_ajax = false;

    /**
     * model
     * To set the model
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model() :?Model
    {
        return null;
    }

    /**
     * dataTable
     * To set the dataTable
     *
     * @return \Yajra\DataTables\Services\DataTable|null
     */
    public function dataTable() :?DataTable
    {
        return null;
    }

    /**
     * append
     * To append data for form page like [users data for select tag]
     *
     * @return array
     */
    public function append() :array
    {
        return [];
}

    /**
     * searchData
     * To append data for form search like [users data for select tag]
     *
     * @return array
     */
    public function searchData() :array
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
    public function query($id) : ?object
    {
        return $this->model()::find($id);
    }

    /**
     *  getTableName
     *  to get the table name from model object
     * @param  bool $singular
     * @return string
     */
    public function getTableName(bool $singular = false) :string
    {
        return $singular ? Str::singular($this->model()->getTable()) : $this->model()->getTable();
    }

    /**
     * modelCount
     * check if the current model has scope filter, then get the count rows per this scope.
     * @return int
     */
    public function modelCount() :int
    {
        return method_exists($this->model(), 'scopeFilter')
                ? $this->model()->filter()->count()
                : $this->model()->count();
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
    public function redirect($message = null, $redirect = null, $stop = false) :object
    {
        $message = $message ?? trans('flash.row created', ['model' => trans('menu.'.$this->getTableName(singular: true))]);
        $goto = $redirect ?? routeHelper($this->getTableName().'.index');

        if ($this->full_page_ajax || ($this->use_form_ajax && $this->use_button_ajax))
                if ($redirect) {
                    toast($message, 'success');
                    return response()->json(['redirect' => $goto]);
                } else if($stop)
                    return response()->json(['stop' => $stop, 'message' => $message, 'icon' => 'success']);
                else
                    return response()->json(['message' => $message, 'icon' => 'success', 'count' => $this->modelCount()]);
        else {
                toast($message, 'success');
                if ($this->use_form_ajax)
                    return response()->json(['redirect' => $goto]);
                else
                    return redirect($goto);
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

    /**
     * init
     *  to init vars and sessions
     * @return void
     */
    public function init()
    {
        if ($this->full_page_ajax) {
            $this->use_form_ajax = $this->use_button_ajax = true;
            $this->index_view  = "backend.includes.pages.crud-index-page";
        }

        if ($this->use_button_ajax) {
            $this->create_view = "backend.includes.forms.form-create";
            $this->update_view = "backend.includes.forms.form-update";
            $this->form_general = "backend.includes.forms.form-general";
        }
        
        $this->shareProperties();
    }

    protected function shareProperties()
    {
        View::share('use_form_ajax', $this->use_form_ajax);
        View::share('use_button_ajax', $this->use_button_ajax);

        Cache::forget('use_button_ajax');
        Cache::forget('view_sub_path');
        Cache::add('use_button_ajax', $this->use_button_ajax);
        Cache::add('view_sub_path', $this->view_sub_path);
    }
}
