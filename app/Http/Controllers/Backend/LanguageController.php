<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\LanguageDataTable;
use App\Http\Controllers\BackendController;
use App\Models\Language;
use App\Http\Services\LanguageService;
use App\Http\Requests\LanguageRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Lang;

class LanguageController extends BackendController
{
    public $use_form_ajax   = true;

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

    public function files($id)
    {
        $row = $this->query($id);
        if (! file_exists( lang_path( $row->short_name ) )) {
            $this->use_button_ajax = true;
            $this->throwException( throw new Exception("This lang $row->short_name Not has translation files") );
        }


        $files = [];
        foreach (File::allFiles( lang_path( $row->short_name ) ) as $index => $file) {
            $file_name = str_replace('.php', '', $file->getRelativePathname());
            $files[$index] = [
                'name' => $file_name,
                'count' => count( Lang::get( $file_name ) ),
                'size' => $file->getSize(),
            ];
        }

        return view('backend.languages.files', compact('row', 'files'));
    }

    public function trans($id, $file)
    {
        $row = $this->query($id);
        $trans = Lang::get( $file );
        return view('backend.languages.trans', compact('row', 'trans', 'file'));
    }

    public function model() { return new Language; }

    public function dataTable() { return new LanguageDataTable; }

    public function append(): array
    {
        return [
            'icons' => LanguageService::getFlags(),
        ];
    }
}
