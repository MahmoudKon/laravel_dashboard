<?php

namespace App\Console\Commands\CRUD;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Schema;

class CreateModel extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:model {model} {table}';
    protected $model;
    protected $table;
    protected $namespaces = '';
    protected $timestamps = "\n\tpublic \$timestamps = false;\n";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To create service class for model';

    protected $type = 'model';

    protected function getStub()
    {
        return  base_path() . DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.'custom'.DIRECTORY_SEPARATOR.'model.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Models';
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if($this->checkModelExists()) return;
        $path = $this->getPath( $this->model );
        $this->makeDirectory($path);

        $this->files->put($path, $this->getSourceFile());
        $this->info("model class<options=bold> {$this->model}.php </>created successfully!");
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

        $this->model = $this->qualifyClass( $this->argument('model'));
        $this->table = $this->argument('table');

        if (! Schema::hasTable($this->table)) {
            $this->error("model class {$this->table} not exists!");
            return true;
        }

        if ($this->alreadyExists($this->table)) {
            $this->error("$this->type $this->datatable already exists!");
            return true;
        }

        return false;
    }

    private function getSourceFile()
    {
        $name = class_basename($this->model);
        $namespace = str_replace("\\$name", '', $this->model);

        $vars = [
            '{{ namespace }}' => $namespace,
            '{{ relations }}' => $this->relations(),
            '{{ namespaces }}' => $this->namespaces,
            '{{ class }}' => $name,
            '{{ table }}' => $this->table,
            '{{ fillable }}' => $this->fillable(),
            '{{ timestamps }}' => $this->timestamps,
        ];

        return $this->getStubContent($vars);
    }

    private function getStubContent($stub_vars = [])
    {
        $content  = file_get_contents($this->getStub());

        foreach ($stub_vars as $name => $value)
            $content = str_replace($name, $value, $content);

        return $content;
    }

    protected function relations()
    {
        $relations = '';
        foreach (getRelationsDetails($this->table) as $column) {
            $model_name = getTableModel($column->fk_table);
            $class_namespace = getFilesInDir(app_path('Models'), $model_name);
            $this->namespaces .= "use {$class_namespace};\n";
            $relations .= "\n\tpublic function {$column->fk_table}() \n\t{";
            $relations .= "\n\t\treturn \$this->belongsTo({$model_name}::class, '{$column->column_name}', '{$column->fk_column}')->withDefault(['{$column->fk_column}' => null]);";
            $relations .= "\n\t}\n";
        }
        return $relations;
    }

    protected function fillable()
    {
        $fillables = '';
        $columns = Schema::getColumnListing($this->argument('table'));
        if (in_array('created_at', $columns)) $this->timestamps = '';
        foreach ($columns as $column) {
            if (in_array($column, ['id', 'created_at', 'updated_at'])) continue;
            $fillables .= "'$column', ";
        }

        return rtrim($fillables, ', ');
    }
}
