<?php

namespace App\Console\Commands\CRUD;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CreateDatatable extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:datatable {model : the model class namespace after Models folder}';
    protected $datatable;
    protected $model;
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
        return  base_path() . DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.'custom'.DIRECTORY_SEPARATOR.'datatable.stub';
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
        if($this->checkModelExists()) return;
        $path = $this->getPath($this->datatable);

        $this->addTranslations();
        $this->makeDirectory($path);
        $this->files->put($path, $this->getSourceFile());
        $this->info("request class<options=bold> {$this->datatable}.php </>created successfully!");
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

        $this->datatable = $this->qualifyClass( $this->argument('model').'DataTable' );
        $this->model = $this->qualifyModel( $this->argument('model') );

        if (! $this->alreadyExists($this->model)) {
            $this->error("model class {$this->model}.php not exists!");
            return true;
        }

        if ($this->alreadyExists($this->datatable)) {
            $this->error("$this->type $this->datatable already exists!");
            return true;
        }
        $this->model = app($this->model);
        $this->table = $this->model->getTable();
        return false;
    }

    private function getSourceFile()
    {
        $name = class_basename($this->datatable);
        $namespace = substr($this->datatable, 0, -strlen("\\$name"));

        $vars = [
            '{{ namespace }}' => $namespace,
            '{{ class }}' => $name,
            '{{ modelNamespace }}' => get_class($this->model),
            '{{ modelName }}' => class_basename($this->model),
            '{{ table }}' => $this->table,
            '{{ withRelations }}' => $this->getRelatedTables(),
            '{{ columns }}' => $this->getTableColumns()
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

    protected function getRelatedTables()
    {
        $relations = '';
        foreach (getRelationsDetails($this->table) as $column)
            $relations .= "'".getRelationName($column->column_name)."', ";

        return $relations !== '' ? "->with([". trim($relations, ', ') ."])" : '';
    }

    protected function getTableColumns()
    {
        $fk_columns = getRelationsDetails($this->table);
        $rows = '';
        foreach ($this->model->getFillable() as $column) {
            $translate = "inputs.$column";
            $name = $column;

            if( isset( $fk_columns[$column] ) ) {
                $related_table = $fk_columns[$column]->fk_table;
                $translate = "menu.$related_table";
                $name = getRelationName($column) . '.' . getFirstStringColumn( DB::select("SHOW FULL COLUMNS FROM $related_table") );
            }

            $rows .= "\n\t\t\tColumn::make('$name')->title(trans('$translate')),";
        }

        return $rows;
    }

    protected function addTranslations()
    {
        foreach (config('languages') as $key => $lang) {
            $file = base_path("lang/$lang/inputs.php");
            if (!file_exists($file)) continue;
            $contents = file($file);
            $size = count($contents);
            $contents[$size -1] = $this->setTrans($file).$contents[$size-1];
            file_put_contents($file, $contents);
        }
    }

    protected function setTrans($file)
    {
        $content = file_get_contents($file);
        $trans = "\n\n\t// ". Str::upper($this->table);
        foreach($this->model->getFillable() as $column) {
            if (stripos($column, '_id') !== false) continue;
            if (stripos( $content, "'$column'") !== false) continue;
            $trans .= "\n\t'$column' => '". ucwords( str_replace('_', ' ', $column) ) ."',";
        }
        $trans .= "\n";

        return $trans;
    }
}
