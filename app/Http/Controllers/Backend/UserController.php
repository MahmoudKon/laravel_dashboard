<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\UserDataTable;
use App\Exports\UsersExport;
use App\Http\Controllers\BackendController;
use App\Http\Requests\ImportExcelRequest;
use App\Http\Requests\UserRequest;
use App\Http\Services\UserService;
use App\Imports\UsersImport;
use App\Models\Department;
use App\Models\User;
use Exception;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Role;

class UserController extends BackendController
{
    public bool $use_form_ajax   = true;
    public bool $use_button_ajax = true;

    public function store(UserRequest $request, UserService $UserService)
    {
        $row = $UserService->handle($request->validated());
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.user')]), routeHelper($this->getTableName().'.show', $row));
    }

    public function update(UserRequest $request, UserService $UserService, $id)
    {
        $row = $UserService->handle($request->validated(), $id);
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.user')]), routeHelper($this->getTableName().'.show', $row));
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import()
    {
        return view($this->form_general, [
            'route' => routeHelper(getModel().'.excel.import'),
            'title' => 'Import Users Excel File',
            'form_name' => 'import'
        ]);
    }

    public function saveImport(ImportExcelRequest $request)
    {
        Excel::import(new UsersImport, $request->file);
        return response()->json(['message' => "Data Saved Successfully!", 'icon' => 'success']);
    }

    public function forceLogout()
    {
        $this->model()->filter()->update(['logged_in' => false]);
        return response()->json(['message' => trans('flash.user logged out')]);
    }

    public function model() :\Illuminate\Database\Eloquent\Model { return new User; }

    public function dataTable() :\Yajra\DataTables\Services\DataTable { return new UserDataTable; }

    public function append() :array
    {
        return [
            'departments' => Department::filter()->pluck('title', 'id'),
            'roles' => Role::whereNotIn('name', SUPERADMIN_ROLES)->pluck('name', 'id')
        ];
    }

    public function query($id) :object|null
    {
        return $this->model()->hasManager()->find($id);
    }
}
