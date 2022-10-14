<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckMiddleWare;
use App\Http\Middleware\LockScreenMiddleware;
use App\Traits\BackendControllerHelper;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Yajra\DataTables\Services\DataTable;

class BackendController extends Controller
{
    use BackendControllerHelper;

    public function __construct(public DataTable $dataTable, public Model $model)
    {
        $this->middleware([CheckMiddleWare::class, LockScreenMiddleware::class]);

        if ($this->full_page_ajax) {
            $this->use_form_ajax   = true;
            $this->use_button_ajax = true;
            $this->index_view  = "backend.includes.pages.crud-index-page";
        }

        session(['use_button_ajax' => $this->use_button_ajax]);
        if ($this->use_button_ajax) {
            $this->create_view = "backend.includes.forms.form-create";
            $this->update_view = "backend.includes.forms.form-update";
        }
        View::share('model_view_path', $this->model::VIEW ?? '');
        View::share('use_form_ajax', $this->use_form_ajax);
        View::share('use_button_ajax', $this->use_button_ajax);
    }

    public function index()
    {
        try {
            if (request()->ajax())
                return $this->dataTable->render('backend.includes.tables.table');

            return view($this->index_view, ['count' => $this->modelCount()]);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function create()
    {
        try {
            if ($this->doSomethingInCreate()) {
                $this->full_page_ajax = $this->use_button_ajax = false;
                $this->use_form_ajax = true;
                return $this->redirect();
            }

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

        if ($this->doSomethingInShow($row)) {
            $this->full_page_ajax = $this->use_button_ajax = false;
            $this->use_form_ajax = true;
            return $this->redirect();
        }

        return view($this->show_view, compact('row'));
    }

    public function edit($id)
    {
        try {
            $row = $this->query($id);
            if (! $row) return $this->throwException(trans('flash.something is wrong'));

            if ($this->doSomethingInEdit($row)) {
                $this->full_page_ajax = $this->use_button_ajax = false;
                $this->use_form_ajax = true;
                return $this->redirect();
            }

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

            $this->doSomethingAfterDelete();
            return response()->json(['message' => trans('flash.row deleted', ['model' => trans('menu.'.$this->getTableName())]), 'icon' => 'success', 'count' => $this->modelCount()]);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function multidelete(Request $request)
    {
        try {
            $rows = $this->model::whereIn('id', (array)$request['id'])->get();
            DB::beginTransaction();
                foreach ($rows as $row)
                    $row->delete();

                $this->doSomethingAfterDelete();
            DB::commit();
            return response()->json(['message' => trans('flash.rows deleted', ['model' => trans('menu.'.$this->getTableName(true)), 'count' => $rows->count()]), 'icon' => 'success', 'count' => $this->modelCount()]);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function search()
    {
        try {
            $title = "Search In ".$this->getTableName(true)." Table";
            return response()->json( view('backend.includes.forms.form-search', $this->append(), compact('title'))->render() );
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function columnToggle(int $id, $column)
    {
        $row = $this->query($id);
        if (! $row) return $this->throwException(trans('flash.something is wrong'));

        $row->update([$column => !$row->$column]);
        return response()->json(['stop' => true, 'message' => trans('flash.row updated', ['model' => trans('menu.'.$this->getTableName())])]);
    }
}
