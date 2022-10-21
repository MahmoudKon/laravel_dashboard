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
    protected $signature  = 'crud:controller {model}';
    protected $controller;
    protected $model;
    protected $path = 'app/Http/Controllers/Backend/';
    protected $sub_dir = '';
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
        $file = $this->path . $this->controller . '.php';
        File::put($file, $this->createContent());
    }

    protected function createContent()
    {
        $content = file_get_contents(base_path('stubs/custom/controller.stub'));
        $model_name = class_basename($this->model);
        $sub_folder = trim( str_replace([$model_name, '/'], ['', '\\'], $this->argument('model')), '\\');
        $namespace = $this->namespace.$sub_folder;
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
            trim($namespace, '\\'),
            str_replace('/', '\\', $this->argument('model')),
            $model_name,
            "{$model_name}Controller",
            Str::singular($table),
            createAppends($table),
            convertCamelCaseTo(str_replace('\\', '.', $sub_folder)).'.'
        ], $content);

        return $content;
    }
}
