<?php

namespace App\Console\Commands\CRUD;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

class CreateController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature  = 'crud:controller {model : the model class namespace after Models folder}';
    protected $controller;
    protected $model;
    protected $path = 'app/Http/Controllers/Backend/';
    protected $namespace  = "App\Http\Controllers\Backend\\";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command to create a controller from database table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->checkModelExists()) return ;

        $this->createFile();

        $this->info("controller class<options=bold> {$this->path}{$this->controller}.php </>created successfully!");
    }

    /**
     * checkModelExists
     *
     *  This method to check is model is alleady exists
     *
     * @return bool
     */
    protected function checkModelExists() :bool
    {
        $this->controller = $this->argument('model').'Controller';
        $this->model      = "App\Models\\".str_replace('/', '\\', $this->argument('model'));

        if (! class_exists($this->model)) {
            $this->error("model class {$this->model}.php not exists!");
            return true;
        }

        if (getFilesInDir(app_path('Http/Controllers/Backend'), $this->controller)) {
            $this->error("controller class app/Http/Controllers/Backend/{$this->controller}.php already exists!");
            return true;
        }

        Artisan::call("make:controller Backend/{$this->controller}");
        $this->model = app($this->model);
        return false;
    }

    protected function createFile()
    {
        $file = getClassFile($this->namespace . $this->controller);
        File::put($file, $this->createContent());
    }

    protected function createContent()
    {
        $content = file_get_contents(base_path('stubs'.DIRECTORY_SEPARATOR.'custom'.DIRECTORY_SEPARATOR.'controller.stub'));
        $model_name = class_basename($this->model);
        $model = str_replace('/', '\\', $this->argument('model'));
        $sub_folder = substr($model, 0, -strlen("\\$model_name"));
        $view_sub_path = str_replace('\\', '.', convertCamelCaseTo($sub_folder)).'.';
        $namespace = trim($this->namespace.$sub_folder, '\\');
        $table = $this->model->getTable();

        $content = str_replace([
            '{{ namespace }}',
            '{{ model }}',
            '{{ model_name }}',
            '{{ class }}',
            '{{ single_table }}',
            '{{ appends }}',
            '{{ view_sub_path }}'
        ],[
            $namespace,
            $model,
            $model_name,
            "{$model_name}Controller",
            Str::singular($table),
            createAppends($table),
            $view_sub_path == '.' ? '' : $view_sub_path
        ], $content);

        return $content;
    }
}
