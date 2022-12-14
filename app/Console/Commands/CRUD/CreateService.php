<?php

namespace App\Console\Commands\CRUD;

use Illuminate\Console\GeneratorCommand;

class CreateService extends GeneratorCommand
{
/**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:service {model : the model class namespace after Models folder}';
    protected $service;
    protected $model;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To create service class for model';

    protected $type = 'service';

    protected function getStub()
    {
        return  base_path() .DIRECTORY_SEPARATOR. 'stubs'.DIRECTORY_SEPARATOR.'custom'.DIRECTORY_SEPARATOR.'service.stub';
    }

    /**
     * The root location where your new file should
     * be written to.
     */
    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Services';
    }

    public function handle()
    {
        if ($this->checkModelExists()) return;

        $path = $this->getPath($this->service);

        $this->makeDirectory($path);
        $this->files->put($path, $this->getSourceFile());
        $this->info("request class<options=bold> {$this->service}.php </>created successfully!");
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
        if ($this->isReservedName($this->argument('model'))) {
            $this->error('The name "'.$this->argument('model').'" is reserved by PHP.');
            return true;
        }

        $this->service = $this->qualifyClass( $this->argument('model').'Service' );
        $this->model = $this->qualifyModel( $this->argument('model') );

        if (! class_exists($this->model)) {
            $this->error("model class {$this->model}.php not exists!");
            return true;
        }

        if ($this->alreadyExists($this->service)) {
            $this->error("$this->type $this->service already exists!");
            return true;
        }

        $this->model = app($this->model);

        return false;
    }

    private function getSourceFile()
    {
        $name = class_basename($this->service);
        $namespace = substr($this->service, 0, -strlen("\\$name"));

        $vars = [
            '{{ namespace }}' => $namespace,
            '{{ class }}' => $name,
            '{{ modelNamespace }}' => get_class($this->model),
            '{{ model }}' => class_basename($this->model),
        ];

        return $this->getStubContent($vars);
    }

    private function getStubContent($stub_vars = [])
    {
        $content  = file_get_contents($this->getStub());

        foreach ($stub_vars as $name => $value)
        {
            $content = str_replace($name, $value, $content);
        }

        return $content;
    }
}
