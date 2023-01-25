<?php

namespace App\Console\Commands;

use App\Jobs\AssignPermissionsToRole;
use App\Models\Route;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class SaveRoutesInDatabase extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:routes';

    protected $namespaces = 'App\Http\Controllers\Backend';

    protected $exceptControllers = ['LoginController', 'LogoutController', 'RegisterController', 'ForgotPasswordController', 'ProfileController'];

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get all routes in project and store it in table with creating permissions for each route';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        foreach (\Illuminate\Support\Facades\Route::getRoutes()->getRoutes() as $route) {
            $action = $route->getAction();
            $controller_class = $route->getController();

            if ( stripos( get_class( $controller_class ), $this->namespaces ) === false || in_array( class_basename( $controller_class ), $this->exceptControllers ) )
                continue;

            /**
             * route details EX:
             * $action = [
             *      'uri' => 'en/dashboard/users',
             *      'controller' => 'App\Http\Controllers\Backend\UserController@index',
             *      'as'         => 'dashboard.users.index',
             *      'namespace'  => 'App\Http\Controllers\Backend',
             *      'prefix      => '/en/dashboard',
             *  ];
             *
             *  */

            // controller namespace with his function
            [$controller, $function] = explode('@', $action['controller']);

            // the only namespace
            $namespace = $action['namespace'];

            // get the only controller name
            $controller = trim(str_replace($namespace, '', $controller), '\\'); // App\Http\Controllers\Backend\UserController => UserController

            // get route methods in string
            $method = implode(',', $route->methods); // ['GET', 'BATCH'] => 'GET,BATCH'

            // get route prefix
            $prefix = $action['prefix']; // ex: /en/dashboard

            // get url without prefix
            $uri = str_replace($prefix, getRoutePrefex(), $route->uri); // remove prefex from  en/dashboard/users => dashboard/users

            $route_name = $action['as'] ?? "";
            $middleware = implode(',', $action['middleware']);
            $where = implode(',', $action['where']);


            $route = Route::firstOrCreate([
                'controller' => $controller,
                'func'       => $function,
                'method'     => $method,
                // 'uri'        => $uri,
            ], [
                'controller' => $controller,
                'func'       => $function,
                'method'     => $method,
                'middleware' => $middleware,
                'namespace'  => $namespace,
                'uri'        => $uri,
                'route'      => $route_name,
                'prefix'     => $prefix,
                'where'      => $where
            ]);

            Permission::updateOrCreate(['name' => $route->permissionName(), 'guard_name' => PERMISSION_GUARDS]);
        }

        dispatch(new AssignPermissionsToRole());
    }
}
