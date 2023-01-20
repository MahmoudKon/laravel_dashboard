<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\LanguageDataTable;
use App\Http\Controllers\BackendController;
use App\Models\Language;
use App\Http\Services\LanguageService;
use App\Http\Requests\LanguageRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;

class LanguageController extends BackendController
{
    public bool $use_form_ajax = true;

    public function store(LanguageRequest $request, LanguageService $LanguageService)
    {
        $row = $LanguageService->handle($request->validated());
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.language')]));
    }

    public function update(LanguageRequest $request, LanguageService $LanguageService, $id)
    {
        $row = $LanguageService->handle($request->validated(), $id);
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.language')]));
    }
    
    public function show($id)
    {
        $row = $this->query($id);
        if (request()->ajax()) {
            $file = request()->get('file') ?? ( LanguageService::getFiles($row->short_name)[0]['name'] ?? null );
            $rows = $file ? LanguageService::getTrans($file, $row->short_name) : null;
            return view('backend.languages.trans.index', compact('row', 'rows', 'file'));
        }
        $files = LanguageService::getFiles($row->short_name);
        $languages = Language::select('id', 'icon', 'native')->active()->get();
        return view('backend.languages.show', compact('row', 'files', 'languages'));
    }

    public function transCreate($id)
    {
        $row = $this->query($id);
        $trans = ['file' => request()->get('file', 'auth')];
        return view('backend.languages.trans.form', compact('row', 'trans'));
    }

    public function transStore(Request $request, $id)
    {
        $row = $this->query($id);
        $file = request()->get('file', 'auth');
        LanguageService::transStore($file, $row->short_name, $request);
        return response()->json(['message' => trans('flash.row updated', ['model' => trans('menu.language')])], 200);
    }

    public function transEdit($id, $key)
    {
        $row = $this->query($id);
        $file = request()->get('file', 'auth');
        $trans = ['file' => $file, 'key' => $key, 'val' => Lang::get("$file.$key", locale: $row->short_name)];
        return view('backend.languages.trans.form', compact('row', 'trans'));
    }

    public function transUpdate($id, $key)
    {
        $row = $this->query($id);
        $file = request()->get('file', 'auth');

        LanguageService::transUpdate($file, $row->short_name, $key);
        return response()->json(['message' => trans('flash.row updated', ['model' => trans('menu.language')])], 200);
    }

    public function model() :\Illuminate\Database\Eloquent\Model { return new Language; }

    public function dataTable() :\Yajra\DataTables\Services\DataTable { return new LanguageDataTable; }

    public function append(): array
    {
        return [
            'icons' => LanguageService::getFlags(),
        ];
    }
}
