<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\RouteDataTable;
use App\Http\Controllers\BackendController;
use App\Jobs\AssignPermissionsToRole;
use App\Jobs\SaveRoutesInDatabase;
use App\Models\Route;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class RouteController extends BackendController
{
    public function __construct(RouteDataTable $dataTable, Route $route)
    {
        parent::__construct($dataTable, $route);
    }

    public function edit($id)
    {
        try {
            $row = Route::findOrFail($id);
            $roles = Role::pluck('name', 'id');
            $title = "Assign Roles";
            return view('backend.includes.forms.form-update', compact('roles', 'row', 'title'));
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            DB::beginTransaction();
                $route = Route::findOrFail($id);
                $route->roles()->sync($request->roles);
            DB::commit();
            return response()->json(['message' => "New roles has been assigned to this route '$route->uri'!", 'icon' => 'success', 'count' => Route::count()]);

            return view('backend.includes.forms.form-update', compact('roles', 'row'));
        } catch (Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }

    public function assign(Request $request)
    {
        if ($request->ajax()) {
            $routes = Route::select('id', 'func', 'method', 'uri', 'route')->with('roles')->where('controller', $request->controller)->get();
            $roles = Role::select('name', 'id')->whereNotIn('name', SUPERADMIN_ROLES)->get();
            return view('backend.routes.list-route-roles', compact('routes', 'roles'));
        }

        $controllers = Route::select('controller')->pluck('controller', 'controller');
        return view('backend.routes.assign-roles', compact('controllers'));
    }

    public function assignRoles(Request $request)
    {
        foreach (Route::with('roles')->where('controller', $request->controller)->get() as $route) {
            foreach ($route->roles as $role) {
                $method = $this->getModelFromController($request->controller)."-$route->func";
                $role->revokePermissionTo($method);
            }
            $route->roles()->detach();
        }

        if ($request->roles != null) {
            foreach ($request->roles as $route_id => $roles_id) {
                $route = Route::findOrFail($route_id);
                $route->roles()->sync($roles_id);
                $this->createPermission($request->controller, $route->func, $roles_id);
            }
        }

        toast('Assigned Roles Successfully!', 'success');
        return back()->withInput(['controller']);
    }

    protected function createPermission($controller, $func, $roles_id = [])
    {
        $permission_name = $this->getModelFromController($controller)."-$func";
        $permission = Permission::updateOrCreate(['name' => $permission_name, 'guard_name' => PERMISSION_GUARDS], ['name' => $permission_name]);
        if (!empty($roles_id))
            $permission->syncRoles($roles_id);
    }

    protected function getModelFromController($controller)
    {
        $model = str_replace('Controller', '', $controller);
        return Str::plural( strtolower($model) );
    }

    public function download()
    {
        $text = "<?php \n\nuse Illuminate\Support\Facades\Route; \n\n";
        $middlewares = Route::get()->groupBy(['middleware', 'controller']);

        foreach ($middlewares as $middleware => $controllers) {
            $text .= "Route::group(['middleware' => [";

            foreach (explode(',', $middleware) as $index => $item) {
                $text .= "'{$item}'";
                $text .= count(explode(',', $middleware)) == ($index + 1) ? "" : ", ";
            }
            $text .= "] ], function () {\n\n";

            foreach ($controllers as $controller => $routes) {
                $text .= "\tRoute::controller('{$routes[0]->namespace}\\{$controller}')->group(function () {\n";
                foreach ($routes as $route) {
                    $text .= "\t\tRoute::{$route->method()}('{$route->uri}','{$route->func}')->name('{$route->route}');\n";
                }
                $text .= "\t});\n\n";
            }
            $text .= "});\n\n";
        }

        $myfile = fopen("routes.php", "w");
        fwrite($myfile, $text);
        fclose($myfile);
        if ($myfile) {
            header("Content-disposition: attachment; filename=routes.php");
            header('Content-type: application/php');
            readfile("routes.php");
        }
    }


    public function syncRoutes()
    {
        truncateTables('routes');
        dispatch(new SaveRoutesInDatabase());
        toast("Routes will be synchronized with the database in the background!<br> NOTE: please run queue:work", 'success');
        session(['success' => "<span class='form-control copy'>php artisan queue:work</span>"]);
        return back();
    }

    public function syncPermissions()
    {
        dispatch(new AssignPermissionsToRole());
        toast("Assign permissions will be synchronized with the database in the background!<br> NOTE: please run queue:work", 'success');
        session(['success' => "<span class='form-control copy'>php artisan queue:work</span>"]);
        return back();
    }
}
