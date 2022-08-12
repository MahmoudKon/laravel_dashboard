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
    protected $signature = 'crud:routes {table}';
    protected $controller;

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
        $model        = getTableModel($this->argument('table'));
        $this->controller = "{$model}Controller";
        $model_pram   = Str::singular($this->argument('table'));
        $namespace    = "App".DIRECTORY_SEPARATOR."Http".DIRECTORY_SEPARATOR."Controllers".DIRECTORY_SEPARATOR."Backend";
        $middleware   = "web,localeSessionRedirect,localizationRedirect,localeViewPath,auth";
        $ROUTE_PREFIX = URL_PREFIX."/";
        $prefix       = "/".URL_PREFIX;

        $routes = [
            [
                'route'  => "{$this->argument('table')}.index",
                'uri'    => $ROUTE_PREFIX."{$this->argument('table')}",
                'method' => 'GET,HEAD',
                'func'   => 'index'
            ], [
                'route'  => "{$this->argument('table')}.create",
                'uri'    => $ROUTE_PREFIX."{$this->argument('table')}", // dashboard/users
                'method' => 'GET,HEAD',
                'func'   => 'create'
            ], [
                'route'  => "{$this->argument('table')}.store",
                'uri'    => $ROUTE_PREFIX."{$this->argument('table')}",
                'method' => 'POST',
                'func'   => 'store'
            ], [
                'route'  => "{$this->argument('table')}.show",
                'uri'    => $ROUTE_PREFIX."{$this->argument('table')}/{$model_pram}",
                'method' => 'GET,HEAD',
                'func'   => 'show'
            ], [
                'route'  => "{$this->argument('table')}.edit",
                'uri'    => $ROUTE_PREFIX."{$this->argument('table')}/{$model_pram}/edit",
                'method' => 'GET,HEAD',
                'func'   => 'edit'
            ], [
                'route'  => "{$this->argument('table')}.update",
                'uri'    => $ROUTE_PREFIX."{$this->argument('table')}/{$model_pram}",
                'method' => 'PUT,PATCH',
                'func'   => 'update'
            ], [
                'route'  => "{$this->argument('table')}.destroy",
                'uri'    => $ROUTE_PREFIX."{$this->argument('table')}/{$model_pram}",
                'method' => 'DELETE',
                'func'   => 'destroy'
            ], [
                'route'  => "{$this->argument('table')}.multidelete",
                'uri'    => $ROUTE_PREFIX."{$this->argument('table')}/multidelete",
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
        $append_routes = "\nRoute::resource('{$this->argument('table')}', '{$this->controller}'); \nRoute::post('{$this->argument('table')}/multidelete', '{$this->controller}@multidelete')->name('{$this->argument('table')}.multidelete'); \n";
        File::append(base_path('routes/backend.php'), $append_routes);

        echo "Routes inserted in database successfully!\n";
    }

    protected function createMenu()
    {
        $menu_name  = ucwords( str_replace('_', ' ', $this->argument('table')) );

        Menu::firstOrCreate([
            'name->en' => $menu_name,
            'route'    => $this->argument('table').'.index',
            'parent_id'=> null
        ], [
            'name' => ['en' => $menu_name, 'ar' => $menu_name],
            'route' => $this->argument('table').'.index',
            'icon' => "fa fa-gears",
            'parent_id' => null
        ]);

        Cache::forget('list_menus');
        echo "Menu inserted in database successfully!\n";
    }
}
