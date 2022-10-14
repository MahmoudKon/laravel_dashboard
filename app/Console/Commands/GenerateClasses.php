<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;

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
    protected $signature = 'make:crud {table} {--namespace=}'; // EX => php artisan make:crud clients
    protected $table;
    protected $model;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command to generate model, controller, request file, service and datatable class';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->init();

        if (file_exists("app/Models/{$this->model}.php")) {
            $this->error("model class app/Models/{$this->model} already exists!");
        } else {
            Artisan::call("crud:model {$this->model} {$this->table}");
            $this->info("model class<options=bold> {$this->model}.php </>created successfully!");
        }

        if (file_exists("app/Http/Requests/{$this->model}Request.php")) {
            $this->error("request class {$this->model}Request already exists!");
        } else {
            Artisan::call("crud:request {$this->model} {$this->argument('table')}");
            $this->info("request class<options=bold> {$this->model}Request.php </>created successfully!");
        }

        Artisan::call("crud:service {$this->model}");
        if (file_exists("app/Http/Services/{$this->model}Service.php")) {
            $this->error("service class {$this->model}Service already exists!");
        } else {
            Artisan::call("crud:service {$this->model}");
            $this->info("service class<options=bold> {$this->model}Service.php </>created successfully!");
        }

        if (file_exists("app/DataTables/{$this->model}DataTable.php")) {
            $this->error("datatable class {$this->model}Datatable already exists!");
        } else {
            Artisan::call("crud:datatable {$this->model}");
            $this->info("datatable class<options=bold> {$this->model}Datatable.php </>created successfully!");
        }

        if (file_exists("app/Http/Controllers/Backend/{$this->model}Controller.php")) {
            $this->error("controller class {$this->model}Controller already exists!");
        } else {
            Artisan::call("crud:controller {$this->model}");
            $this->info("controller class<options=bold> {$this->model}Controller.php </>created successfully!");
        }

        $view_path = "backend/".($this->option('namespace') ? $this->option('namespace').'/' : '')."{$this->argument('table')}/form.blade.php";
        if (file_exists(resource_path("views/$view_path"))) {
            $this->error("view blade {$view_path} already exists!");
        } else {
            Artisan::call("crud:view {$view_path} {$this->argument('table')}");
            $this->info("View blade<options=bold> {$view_path} </>created successfully!");
        }

        Artisan::call("crud:routes {$this->argument('table')}");
        $this->info("<options=bold>All classes genrated successfully!</>");
    }

    protected function init()
    {
        $this->table = $this->argument('table');
        if ($this->option('namespace')) $this->model = $this->option('namespace').'/'.getTableModel($this->table);
    }
}
