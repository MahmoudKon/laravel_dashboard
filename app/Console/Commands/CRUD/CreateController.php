<?php

namespace App\Console\Commands\CRUD;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;

class CreateController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature  = 'crud:controller {table}';
    protected $controller;
    protected $model;
    protected $path;
    protected $sub_dir = '';
    protected $namespace  = "App\Http\Controllers";

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
        $this->askForSubDir();
        $this->checkClassExistsOrCreate();
        $this->createFile();
    }

    /**
     * askForSubDir
     *
     *  ask to create file in sub dir or nain controllers dir
     *  and set variables
     *
     * @return void
     */
    protected function askForSubDir()
    {
        $this->model        = getTableModel( $this->argument('table') );
        $this->controller   = $this->model.'Controller';
        $this->path         = str_replace(['App', '\\'], ['app', DIRECTORY_SEPARATOR], $this->namespace);

        // $this->sub_dir = $this->ask('The path is app/Http/Controllers/ you want to create sub folder ?  name =', '');
        $this->sub_dir = "Backend";
        if ($this->sub_dir) {
            $this->sub_dir = ucfirst($this->sub_dir);
            $this->namespace .= "\\$this->sub_dir";
            $this->controller = ucfirst($this->sub_dir).'/'.$this->controller;
        }
    }

    protected function checkClassExistsOrCreate()
    {
        if (! checkClassExists($this->path, $this->controller) ) {
            Artisan::call("make:controller {$this->controller}");
        }
    }

    protected function createFile()
    {
        $file = $this->path . DIRECTORY_SEPARATOR . $this->controller . '.php';
        File::put($file, $this->createContent());
    }

    protected function createContent()
    {
        $content = file_get_contents(base_path('stubs/custom/controller.stub'));

        $content = str_replace([
            '{{ rootNamespace }}',
            '{{ namespacedModel }}',
            '{{ namespace }}',
            '{{ class }}',
            '{{ model }}',
            '{{ appends }}'
        ],[
            'App\\',
            "App\Models\\{$this->model}",
            $this->namespace,
            $this->model.'Controller',
            $this->model,
            createAppends($this->argument('table'))
        ], $content);

        return $content;
    }
}
