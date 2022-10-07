<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckMiddleWare;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApiController extends BasicApiController
{
    public function __construct(public $resource, public $model)
    {
        $this->middleware([CheckMiddleWare::class]);
    }

    public function index()
    {
        $rows = $this->getQuery()->paginate(request()->limit ?? 10)->appends(request()->all());
        return  $this->resource::collection($rows)->additional(['success' => true, 'message' => "List ".(new $this->model)->getTable()]);
    }

    public function show($id)
    {
        $row = $this->model::find($id);
        if (! $row) return $this->sendError(trans('flash.something is wrong'));
        $this->doSomethingInShow($row);
        return [$this->getModelName() => new $this->resource($row)];
    }

    public function destroy($id)
    {
        $row = $this->getQuery()->find($id);
        if (!$row) return $this->sendError(trans('flash.something is wrong'));
        $row->delete();
        return $this->sendResponse(trans('flash.row deleted', ['model' => trans('menu.'.$this->getModelName())]));
    }

    public function multidelete(Request $request)
    {
        try {
            $ids = is_array($request['id']) ? $request['id'] : explode(',', $request['id']);
            $rows = $this->model::whereIn('id', $ids)->get();
            DB::beginTransaction();
            foreach ($rows as $row)
                $row->delete();
            DB::commit();
            return $this->sendResponse(trans('flash.rows deleted', ['count' => $rows->count(), 'model' => trans('menu.'.$this->getModelName(true))]));
        } catch (Exception $e) {
            return $this->sendError($e->getMessage(), [], 500);
        }
    }

    public function toggleVisible($id)
    {
        $row = $this->model::find($id);
        if (!$row) return $this->sendError(trans('flash.something is wrong'));
        $row->update(['visible' => ! $row->visible]);
        return response()->json(['success' => true, 'message' => trans('flash.change status'), 'icon' => 'success'], 200);
        return $this->sendResponse(trans('flash.change status', ['model' => trans('menu.'.$this->getModelName())]), [ $this->getModelName() => new $this->resource($row) ]);
    }

    protected function getModelName(bool $plural = false) :string
    {
        $model_name = preg_replace('/([^A-Z])([A-Z])/', "$1_$2", class_basename($this->model));
        $model = strtolower( $model_name );
        return $plural ? Str::plural($model) : $model;
    }

    public function getQuery() :object
    {
        return $this->model::filter();
    }

    public function doSomethingInShow($row): void {}
}
