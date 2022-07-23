<?php

namespace App\Console\Commands;

use App\Models\Menu;
use App\Models\Route;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class GenerateClasses extends Command
{
    /**
     * Created By: Mahmoud
     * - Laravel Custom Command Console Color [ LINK ]  https://postsrc.com/code-snippets/laravel-custom-command-console-color
     *
    **/


    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:crud {table} {routes?}'; // EX => php artisan generate:classes Client routes
    protected $model;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command to generate model, migration, controller, request file and datatable class';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->model = Str::studly(Str::singular($this->argument('table')));

        if (file_exists("app/Http/Requests/{$this->model}Request.php")) {
            $this->error("request class {$this->model}Request already exists!");
        } else {
            Artisan::call("crud:request {$this->argument('table')}");
            $this->info("request class<options=bold> {$this->model}Request.php </>created successfully!");
        }

        if (file_exists("app/Models/{$this->model}.php")) {
            $this->error("model class {$this->model} already exists!");
        } else {
            Artisan::call("crud:model {$this->argument('table')}");
            $this->info("model class<options=bold> {$this->model}.php </>created successfully!");
        }

        if (file_exists("app/Http/Controllers/Backend/{$this->model}Controller.php")) {
            $this->error("controller class {$this->model}Controller already exists!");
        } else {
            Artisan::call("crud:controller {$this->argument('table')}");
            $this->info("controller class<options=bold> {$this->model}Controller.php </>created successfully!");
        }

        if (file_exists("app/Http/Services/{$this->model}Service.php")) {
            $this->error("service class {$this->model}Service already exists!");
        } else {
            Artisan::call("crud:service {$this->argument('table')}");
            $this->info("service class<options=bold> {$this->model}Service.php </>created successfully!");
        }

        if (file_exists("app/DataTables/{$this->model}DataTable.php")) {
            $this->error("datatable class {$this->model}Datatable already exists!");
        } else {
            Artisan::call("crud:datatable {$this->argument('table')}");
            $this->info("datatable class<options=bold> {$this->model}Datatable.php </>created successfully!");
        }

        $view_path = "backend/{$this->argument('table')}/form";
        if (file_exists(resource_path("views/$view_path.blade.php"))) {
            $this->error("view blade {$view_path} already exists!");
        } else {
            Artisan::call("crud:view {$this->argument('table')}");
            $this->info("View blade<options=bold> {$view_path}.blade.php </>created successfully!");
        }

        $this->createRoutes();

        $this->info("<options=bold>All classes genrated successfully!</>");
    }

    protected function createRoutes()
    {
        if (! $this->argument('routes')) return true;

        $controller   = "{$this->model}Controller";
        $model_pram   = Str::singular($this->argument('table'));
        $namespace    = "app".DIRECTORY_SEPARATOR."Http".DIRECTORY_SEPARATOR."Controllers".DIRECTORY_SEPARATOR."Backend";
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
                'controller' => $controller,
                'func'       => $route['func'],
                'method'     => $route['method'],
                'uri'        => $route['uri'],
            ], [
                'controller' => $controller,
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

        $this->appendRoutes();

        $this->createMenu();
    }

    protected function appendRoutes()
    {
        $controller = "{$this->model}Controller";
        $append_routes = "\nRoute::resource('{$this->argument('table')}', '{$controller}'); \nRoute::post('{$this->argument('table')}/multidelete', '{$controller}@multidelete')->name('{$this->argument('table')}.multidelete'); \n";
        File::append(base_path('routes/backend.php'), $append_routes);

        $this->info('<options=bold>Routes </>inserted in database successfully!');
    }

    protected function createMenu()
    {
        $menu_name  = ucwords( str_replace('_', ' ', $this->argument('table')) );

        $parent = Menu::firstOrCreate([
            'name->en' => $menu_name,
            'route'    => '#',
            'parent_id'=> null
        ], [
            'name' => ['en' => $menu_name, 'ar' => $menu_name],
            'route' => '#',
            'icon' => "fa fa-gears",
            'parent_id' => null
        ]);

        Menu::firstOrCreate([
            'name->en' => $menu_name,
            'route'    => "{$this->argument('table')}.index",
            'parent_id'=> $parent->id
        ], [
            'name' => ['en' => "List $menu_name", 'ar' => "List $menu_name"],
            'route' => "{$this->argument('table')}.index",
            'icon' => "fa fa-list",
            'parent_id' => $parent->id
        ]);

        Menu::firstOrCreate([
            'name->en' => $menu_name,
            'route'    => "{$this->argument('table')}.create",
            'parent_id'=> $parent->id
        ], [
            'name' => ['en' => "Create $menu_name", 'ar' => "Create $menu_name"],
            'route' => "{$this->argument('table')}.create",
            'icon' => "fa fa-plus",
            'parent_id' => $parent->id
        ]);
        $this->info('<options=bold>Menu </>inserted in database successfully!');
    }
}
