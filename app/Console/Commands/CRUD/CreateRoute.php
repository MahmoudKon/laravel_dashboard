<?php

namespace App\Console\Commands\CRUD;

use App\Models\Menu;
use App\Models\Route;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class CreateRoute extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:routes {model : the model class namespace after Models folder}';
    protected $controller;
    protected $route_controller_namespace;
    protected $table;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create routes for specific table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->createRoutes();

        $this->appendRoutes();

        $this->createMenu();
    }

    protected function createRoutes()
    {
        $model        = str_replace('/', '\\', $this->argument('model'));
        $this->route_controller_namespace = $model.'Controller';
        $model        = app( "App\Models\\".$model);
        $this->table  = $model->getTable();
        $this->controller = class_basename($model)."Controller";
        $model_pram   = Str::singular( Str::lower(class_basename($model)) );
        $namespace    = "App\\Http\\Controllers\\Backend";
        $middleware   = "web,localeSessionRedirect,localizationRedirect,localeViewPath,auth";
        $ROUTE_PREFIX = getRoutePrefex()."/";
        $prefix       = "/".getRoutePrefex();

        $routes = [
            [
                'route'  => "{$this->table}.index",
                'uri'    => $ROUTE_PREFIX."{$this->table}",
                'method' => 'GET,HEAD',
                'func'   => 'index'
            ], [
                'route'  => "{$this->table}.create",
                'uri'    => $ROUTE_PREFIX."{$this->table}", // dashboard/users
                'method' => 'GET,HEAD',
                'func'   => 'create'
            ], [
                'route'  => "{$this->table}.store",
                'uri'    => $ROUTE_PREFIX."{$this->table}",
                'method' => 'POST',
                'func'   => 'store'
            ], [
                'route'  => "{$this->table}.show",
                'uri'    => $ROUTE_PREFIX."{$this->table}/{$model_pram}",
                'method' => 'GET,HEAD',
                'func'   => 'show'
            ], [
                'route'  => "{$this->table}.edit",
                'uri'    => $ROUTE_PREFIX."{$this->table}/{$model_pram}/edit",
                'method' => 'GET,HEAD',
                'func'   => 'edit'
            ], [
                'route'  => "{$this->table}.update",
                'uri'    => $ROUTE_PREFIX."{$this->table}/{$model_pram}",
                'method' => 'PUT,PATCH',
                'func'   => 'update'
            ], [
                'route'  => "{$this->table}.destroy",
                'uri'    => $ROUTE_PREFIX."{$this->table}/{$model_pram}",
                'method' => 'DELETE',
                'func'   => 'destroy'
            ], [
                'route'  => "{$this->table}.multidelete",
                'uri'    => $ROUTE_PREFIX."{$this->table}/multidelete",
                'method' => 'POST',
                'func'   => 'multidelete'
            ],
        ];

        foreach ($routes as $route) {
            $row = Route::firstOrCreate([
                'controller' => $this->controller,
                'func'       => $route['func'],
                'method'     => $route['method'],
                'uri'        => $route['uri'],
            ], [
                'controller' => $this->controller,
                'func'       => $route['func'],
                'method'     => $route['method'],
                'middleware' => $middleware,
                'namespace'  => $namespace,
                'uri'        => $route['uri'],
                'route'      => $route['route'],
                'prefix'     => rtrim($prefix, '/'),
            ]);

            Permission::firstOrCreate(['name' => $row->permissionName(), 'guard_name' => PERMISSION_GUARDS]);
        }
    }

    protected function appendRoutes()
    {
        $append_routes = "\nRoute::resource('{$this->table}', '{$this->route_controller_namespace}'); \nRoute::post('{$this->table}/multidelete', '{$this->route_controller_namespace}@multidelete')->name('{$this->table}.multidelete'); \n";

        if (stripos(file_get_contents(base_path('routes/backend.php')), $append_routes) === false) {
            File::append(base_path('routes'.DIRECTORY_SEPARATOR.'backend.php'), $append_routes);
            echo "Routes inserted in database successfully!\n";
        } else {
            echo "Routes already exists!\n";
        }
    }

    protected function createMenu()
    {
        $menu_name  = ucwords( str_replace('_', ' ', $this->table) );

        Menu::firstOrCreate([
            'name->en' => $menu_name,
            'route'    => $this->table.'.index',
            'parent_id'=> null
        ], [
            'name' => ['en' => $menu_name, 'ar' => $menu_name],
            'route' => $this->table.'.index',
            'icon' => "fa fa-gears",
            'parent_id' => null
        ]);

        Cache::forget('list_menus');
        echo "Menu inserted in database successfully!\n";
    }
}
