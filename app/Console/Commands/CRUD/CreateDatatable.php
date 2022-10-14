<?php

namespace App\Console\Commands\CRUD;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Str;

class CreateDatatable extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:datatable {model}';
    protected $datatable;
    protected $model_class;
    protected $table;
    protected $table_details = array();

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To create service class for model';

    protected $type = 'datatable';

    protected function getStub()
    {
        return  base_path() . '/stubs/custom/datatable.stub';
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
        $this->datatable   = $this->qualifyClass( $this->argument('model').'Datatable' );
        $this->model_class = $this->qualifyModel($this->argument('model'));
        $this->table       = app($this->model_class)->getTable();
        $path              = $this->getPath($this->datatable);

        if ($this->alreadyExists($this->datatable)) {
            $this->error("$this->type $this->datatable already exists!");
            return false;
        }

        $this->addTranslations();
        $this->getColumns();
        $this->makeDirectory($path);
        $this->files->put($path, $this->getSourceFile());
        $this->info("request class<options=bold> {$this->datatable}.php </>created successfully!");
    }

    private function getSourceFile()
    {
        $name = last( explode('\\', $this->datatable) );
        $namespace = str_replace([$name, '/'], ['', '\\'], $this->datatable);
        $vars = [
            '{{ namespace }}' => rtrim($namespace, '\\'),
            '{{ class }}' => $name,
            '{{ modelNamespace }}' => $this->model_class,
            '{{ modelName }}' => last(explode('\\', $this->model_class)),
            '{{ table }}' => $this->table,
            '{{ withRelations }}' => $this->getRelatedTables(),
            '{{ columns }}' => $this->getTableColumns()
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
        $this->table_details = getTableDetails($this->table);
    }

    protected function getRelatedTables()
    {
        $relations = '';

        foreach ($this->table_details['relations'] as $table => $columns) {
            $relations .= "'".getRelationName($table)."', ";
        }

        return $relations !== ''
                ? "->with([". trim($relations, ', ') ."])"
                : '';
    }

    protected function getTableColumns()
    {
        $rows = '';
        foreach ($this->table_details['columns'] as $column) {
            $translate = "inputs.$this->table.$column->Field";
            $name = $column->Field;

            if (stripos($column->Field, "_id") !== false) {
                $related_table = Str::plural(str_replace("_id", '', $column->Field));
                $translate = "menu.$related_table";
                $name = getRelationName($related_table) . '.' . getFirstStringColumn( $this->table_details['relations'][$related_table]['columns']);
            }
            $rows .= "\n\t\t\tColumn::make('$name')->title(trans('$translate')),";
        }

        return $rows;
    }

    protected function addTranslations()
    {
        $trans = "\n\t'".app($this->model_class)->getTable()."' => [";

        foreach(app($this->model_class)->getFillable() as $column) {
            if (stripos($column, '_id') !== false) continue;
            $trans .= "\n\t\t'$column' => '". ucwords( str_replace('_', ' ', $column) ) ."',";
        }
        $trans .= "\n\t],\n";

        foreach (config('languages') as $key => $lang) {
            $file = base_path("lang/$lang/inputs.php");
            if (!file_exists($file)) continue;
            $contents = file($file);
            $size = count($contents);
            $contents[$size -1] = $trans.$contents[$size-1];
            file_put_contents($file, $contents);
        }
    }
}
