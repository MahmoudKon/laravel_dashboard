<?php

namespace App\Http\Middleware;

use App\Models\Menu;
use App\Models\Route;
use Closure;
use Illuminate\Http\Request;

class CheckMiddleWare
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // Get instance on user model
        $auth_user = auth()->user();

        // To check auth user is has specific roles, this roles can access to this page without conditions.
        if (!auth()->check() || isSuperAdmin()) return $next($request);

        // get the route object
        $route = request()->route();

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
        $action = $route->getAction();

        //  Check if the route is in the menu table
        $menu = Menu::where('route', str_replace(getRoutePrefex(), '', $action['as']))->first();
        // If the route is in the menu table and it visible is false, then redirect to error page
        if ($menu && ! $menu->visible) abort(503, 'This page is closed because it is under maintenance!');

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

        // get the route from database
        // en/dashboard/users
        $route = Route::where([
            // 'uri'        => $uri, // dashboard/users
            'method'     => $method, // get,batch
            'controller' => $controller, // UserController
            'func'       => $function // index
        ])->first();

        // if current route not exists in database, return 404 page not found
        if (!$route) {
            if ($request->ajax()) return response()->json(['message' => 'This route not saved in database!', 'title' => 'ROLES'], 403);
            abort(400, 'This route not found in database!');
        }

        if ($auth_user->hasPermissionTo($route->permissionName())) return $next($request);

        // here the user not have permissions to access this page
        if ($request->ajax())
            return response()->json(['message' => 'You do not have permission to access this page!', 'title' => 'ROLES'], 403);
        abort(403, 'You do not have permission to access this page!');
    }
}
