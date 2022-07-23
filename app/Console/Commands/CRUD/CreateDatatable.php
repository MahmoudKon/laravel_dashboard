<?php

namespace App\Console\Commands\CRUD;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateDatatable extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:datatable {table}';
    protected $datatable = array();
    protected $model_class;
    protected $columns = array();

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To create service class for model';

    protected $type = 'datatable';

    protected function getStub()
    {
        return  base_path() . '/stubs/datatable.custom.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\DataTables';
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->isReservedName($this->argument('table'))) {
            $this->error('The name "'.$this->argument('table').'" is reserved by PHP.');
            return false;
        }

        self::getColumns();

        $class_name = getTableModel( $this->argument('table') );
        $this->datatable['name'] = "{$class_name}DataTable";
        $this->datatable['namespace'] = $this->qualifyClass( $this->datatable['name'] );
        $this->model_class = $this->qualifyModel($class_name);

        $path = $this->getPath($this->datatable['namespace']);

        if ($this->alreadyExists($this->datatable['name'])) {
            $this->error($this->type.' already exists!');
            return false;
        }

        $this->makeDirectory($path);
        $this->files->put($path, $this->getSourceFile());
        $this->info("request class<options=bold> {$this->datatable['name']}.php </>created successfully!");
    }

    private function getSourceFile()
    {
        $vars = [
            '{{ namespace }}' => str_replace("\\{$this->datatable['name']}", '', $this->datatable['namespace']),
            '{{ class }}' => $this->datatable['name'],
            '{{ modelNamespace }}' => $this->model_class,
            '{{ modelName }}' => last(explode('\\', $this->model_class)),
            '{{ table }}' => $this->argument('table'),
            '{{ singularTable }}' => Str::singular($this->argument('table')),
            '{{ withRelations }}' => self::getRelatedTables(),
            '{{ columns }}' => self::getTableColumns()
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

    protected function getColumns()
    {
        foreach (Schema::getColumnListing($this->argument('table')) as $column) {
            if (!in_array($column, ['created_at', 'updated_at', 'id']))
                array_push($this->columns, $column);
        }
    }

    protected function getRelatedTables()
    {
        $relations = '';
        foreach ($this->columns as $column) {
            if (stripos($column, '_id') !== false && $column !== "id")
                $relations .= "'".str_replace('_id', '', $column)."', ";
        }

        return $relations !== ''
                ? "->with([". trim($relations, ', ') ."])"
                : '';
    }

    protected function getTableColumns()
    {
        $rows = '';
        foreach ($this->columns as $column) {
            $translate = stripos($column, "_id") !== false
                        ? "menu.".str_replace("_id", '', $column)
                        : "inputs.$column";
            $rows .= "\n\t\t\tColumn::make('$column')->title(trans('$translate')),";
        }

        return $rows;
    }
}
