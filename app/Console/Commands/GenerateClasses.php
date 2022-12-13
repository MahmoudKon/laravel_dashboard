<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

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
    protected $signature = 'make:crud {table : the table name from database} {--namespace= : the namespace of all classes and view}'; // EX => php artisan make:crud clients
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
            $this->error("model class app/Models/{$this->model}.php already exists!");
        } else {
            Artisan::call("crud:model {$this->model} {$this->table}");
            $this->info("model class<options=bold> app/Models/{$this->model}.php </>created successfully!");
        }

        if (file_exists("app/Http/Requests/{$this->model}Request.php")) {
            $this->error("request class app/Http/Requests/{$this->model}Request.php already exists!");
        } else {
            Artisan::call("crud:request {$this->model}");
            $this->info("request class<options=bold> app/Http/Requests/{$this->model}Request.php </>created successfully!");
        }

        if (file_exists("app/Http/Services/{$this->model}Service.php")) {
            $this->error("service class app/Http/Services/{$this->model}Service already exists!");
        } else {
            Artisan::call("crud:service {$this->model}");
            $this->info("service class<options=bold> app/Http/Services/{$this->model}Service.php </>created successfully!");
        }

        if (file_exists("app/DataTables/{$this->model}DataTable.php")) {
            $this->error("datatable class app/DataTables/{$this->model}Datatable already exists!");
        } else {
            Artisan::call("crud:datatable {$this->model}");
            $this->info("datatable class<options=bold> app/DataTables/{$this->model}Datatable.php </>created successfully!");
        }

        if (file_exists("app/Http/Controllers/Backend/{$this->model}Controller.php")) {
            $this->error("controller class app/Http/Controllers/Backend/{$this->model}Controller already exists!");
        } else {
            Artisan::call("crud:controller {$this->model}");
            $this->info("controller class<options=bold> app/Http/Controllers/Backend/{$this->model}Controller.php </>created successfully!");
        }

        $view_path = "backend/".($this->option('namespace') ? $this->option('namespace').'/' : '')."{$this->argument('table')}/form.blade.php";
        if (file_exists(resource_path("views/$view_path"))) {
            $this->error("view blade {$view_path} already exists!");
        } else {
            Artisan::call("crud:view {$view_path} {$this->model}");
            $this->info("View blade<options=bold> {$view_path} </>created successfully!");
        }

        Artisan::call("crud:routes {$this->model}");
        $this->info("<options=bold>All classes genrated successfully!</>");
    }

    protected function init()
    {
        $this->table = $this->argument('table');
        $this->model = getTableModel($this->table);
        if ($this->option('namespace')) $this->model = $this->option('namespace').'/'.$this->model;
    }
}
