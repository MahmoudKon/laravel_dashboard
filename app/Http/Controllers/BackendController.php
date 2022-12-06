<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckMiddleWare;
use App\Http\Middleware\LockScreenMiddleware;
use App\Traits\BackendControllerHelper;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class BackendController extends Controller
{
    use BackendControllerHelper;

    public function __construct()
    {
        $this->middleware([CheckMiddleWare::class, LockScreenMiddleware::class]);

        if ($this->full_page_ajax) {
            $this->use_form_ajax   = true;
            $this->use_button_ajax = true;
            $this->index_view  = "backend.includes.pages.crud-index-page";
        }

        session(['use_button_ajax' => $this->use_button_ajax, 'view_sub_path' => $this->view_sub_path]);
        if ($this->use_button_ajax) {
            $this->create_view = "backend.includes.forms.form-create";
            $this->update_view = "backend.includes.forms.form-update";
        }
        View::share('use_form_ajax', $this->use_form_ajax);
        View::share('use_button_ajax', $this->use_button_ajax);
    }

    public function index()
    {
        try {
            if (request()->ajax())
                return $this->dataTable()->render('backend.includes.tables.table');

            return view($this->index_view, ['count' => $this->modelCount()]);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function create()
    {
        try {
            if (! request()->ajax() && $this->use_form_ajax)
                $this->create_view = "backend.includes.pages.form-page";

            return view($this->create_view, $this->append());
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function show($id)
    {
        $row = $this->query($id);
        if (! $row) return $this->throwException(trans('flash.something is wrong'));

        return view($this->show_view, compact('row'));
    }

    public function edit($id)
    {
        try {
            $row = $this->query($id);
            if (! $row) return $this->throwException(trans('flash.something is wrong'));

            if (! request()->ajax() && $this->use_form_ajax)
                $this->update_view = "backend.includes.pages.form-page";

            return view($this->update_view, $this->append(), compact('row'));
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function destroy($id)
    {
        try {
            $row = $this->query($id);
            if (! $row) return $this->throwException(trans('flash.something is wrong'));
            $row->delete();
            return response()->json(['message' => trans('flash.row deleted', ['model' => trans('menu.'.$this->getTableName(singular: true))]), 'icon' => 'success', 'count' => $this->modelCount()]);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function multidelete(Request $request)
    {
        try {
            $rows = $this->model()->whereIn('id', (array)$request['id'])->get();
            DB::beginTransaction();
                foreach ($rows as $row)
                    $row->delete();
            DB::commit();
            return response()->json(['message' => trans('flash.rows deleted', ['model' => trans('menu.'.$this->getTableName()), 'count' => $rows->count()]), 'icon' => 'success', 'count' => $this->modelCount()]);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function search()
    {
        try {
            $title = trans('title.search in table', ['table' => trans('menu.'.$this->getTableName())]);
            return response()->json( view('backend.includes.forms.form-search', $this->searchData(), compact('title'))->render() );
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function columnToggle(int $id, $column)
    {
        $row = $this->query($id);
        if (! $row) return $this->throwException(trans('flash.something is wrong'));

        $row->update([$column => !$row->$column]);
        return response()->json(['stop' => true, 'message' => trans('flash.row updated', ['model' => trans('menu.'.$this->getTableName(singular: true))])]);
    }
}
