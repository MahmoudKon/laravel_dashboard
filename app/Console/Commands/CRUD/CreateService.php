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
    protected $signature = 'crud:service {model}';
    protected $service_class;
    protected $model_class;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To create service class for model';

    protected $type = 'service';

    protected function getStub()
    {
        return  base_path() . '/stubs/custom/service.stub';
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
        if ($this->isReservedName($this->argument('model'))) {
            $this->error('The name "'.$this->argument('table').'" is reserved by PHP.');
            return false;
        }

        $this->service_class = $this->qualifyClass( $this->argument('model').'Service' );
        $this->model_class = $this->qualifyModel( $this->argument('model') );

        $path = $this->getPath($this->service_class);

        if ($this->alreadyExists($this->service_class)) {
            $this->error("$this->type $this->service_class already exists!");
            return false;
        }

        $this->makeDirectory($path);
        $this->files->put($path, $this->getSourceFile());
        $this->info("request class<options=bold> {$this->service_class}.php </>created successfully!");
    }

    private function getSourceFile()
    {
        $class = last( explode('\\', $this->service_class) );
        $namespace = str_replace($class, '', $this->service_class);

        $vars = [
            '{{ namespace }}' => rtrim($namespace, '\\'),
            '{{ class }}' => $class,
            '{{ modelNamespace }}' => $this->model_class,
            '{{ model }}' => last(explode('\\', $this->model_class)),
        ];

        return $this->getStubContent($this->getStub(), $vars);
    }

    private function getStubContent($stub, $stub_vars = [])
    {
        $content  = file_get_contents($stub);

        foreach ($stub_vars as $name => $value)
        {
            $content = str_replace($name, $value, $content);
        }

        return $content;
    }
}
