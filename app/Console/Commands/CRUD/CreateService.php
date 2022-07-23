<?php

namespace App\Console\Commands\CRUD;

use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputArgument;

class CreateService extends GeneratorCommand
{
/**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:service {table}';
    protected $service_class = array();
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
        return  base_path() . '/stubs/service.stub';
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
        if ($this->isReservedName($this->argument('table'))) {
            $this->error('The name "'.$this->argument('table').'" is reserved by PHP.');
            return false;
        }

        $class_name = getTableModel( $this->argument('table') );
        $this->service_class['name'] = "{$class_name}Service";
        $this->service_class['namespace'] = $this->qualifyClass( $this->service_class['name'] );
        $this->model_class = $this->qualifyModel($class_name);

        $path = $this->getPath($this->service_class['namespace']);

        if ($this->alreadyExists($this->service_class['name'])) {
            $this->error($this->type.' already exists!');
            return false;
        }

        $this->makeDirectory($path);
        $this->files->put($path, $this->getSourceFile());
        $this->info("request class<options=bold> {$this->service_class['name']}.php </>created successfully!");
    }

    private function getSourceFile()
    {
        $vars = [
            '{{ namespace }}' => str_replace("\\{$this->service_class['name']}", '', $this->service_class['namespace']),
            '{{ class }}' => $this->service_class['name'],
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
