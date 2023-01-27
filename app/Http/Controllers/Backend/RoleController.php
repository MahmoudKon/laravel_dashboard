<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\RoleDataTable;
use App\Http\Controllers\BackendController;
use App\Http\Requests\RoleRequest;
use App\Http\Services\RoleService;
use App\Models\Role;
use App\Models\Route;
use Exception;
use Illuminate\Http\Request;

class RoleController extends BackendController
{
    public bool $full_page_ajax = true;

    public function store(RoleRequest $request, RoleService $RoleService)
    {
        $row = $RoleService->handle($request->validated());
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row created', ['model' => trans('menu.role')]));
    }

    public function update(RoleRequest $request, RoleService $RoleService, $id)
    {
        $row = $RoleService->handle($request->validated(), $id);
        if ($row instanceof Exception ) throw new Exception( $row );
        return $this->redirect(trans('flash.row updated', ['model' => trans('menu.role')]));
    }

    public function cloneRoutes(Role $role)
    {
        $title = "Clone Routes From $role->name";
        $roles = Role::where('id', '<>', $role->id)->pluck('name', 'id');
        $route = routeHelper('roles.save.clone.routes', $role);
        $form_name = 'clone_routes';
        return view($this->form_general, compact('title', 'roles', 'route', 'form_name'));
    }

    public function saveCloneRoutes(Request $request, $role_id)
    {
        $request->validate(['role_id' => 'required|exists:roles,id']);
        $role = Role::findOrFail($request->role_id);
        $routes = Route::whereHas('roles', function($query) use($role_id) {
                        $query->where('role_id', $role_id);
                    })->pluck('id')->toArray();
        $role->routes()->sync($routes);
        return $this->redirect(trans('flash.cloned successfully', ['model' => trans('menu.permissions')]), stop: true);
    }

    public function model() :\Illuminate\Database\Eloquent\Model { return new Role; }

    public function dataTable() :\Yajra\DataTables\Services\DataTable { return new RoleDataTable; }
}
