<?php

namespace App\Console\Commands\CRUD;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;

class CreateModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:model {model} {table}';

    protected $model;
    protected $fillable = '';
    protected $relations = '';
    protected $content = '';
    protected $timestamps = "\n\tpublic \$timestamps = false;\n";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command to create a model from database table with relations';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if($this->checkModelExists()) return;

        $this->createFillable();
        $this->createRelations();
        $this->createContent();
        $this->createFile();

        $this->info("model class<options=bold> app/Models/{$this->model}.php </>created successfully!");
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
        $this->model = $this->argument('model');
        if (getFilesInDir(app_path('Models'), $this->model)) {
            $this->error("model class app/Models/{$this->model}.php already exists!");
            return true;
        }
        return false;
    }

    /**
     * createFillable
     *
     * This method to create fillable columns in model class
     *
     * @return void
     */
    protected function createFillable() :void
    {
        $columns = Schema::getColumnListing($this->argument('table'));
        if (in_array('created_at', $columns)) $this->timestamps = '';
        foreach ($columns as $column) {
            if (in_array($column, ['id', 'created_at', 'updated_at'])) continue;
            $this->fillable .= "'$column', ";
        }
        $this->fillable = rtrim($this->fillable, ', ');
    }

    /**
     * createRelations
     *
     * This method to generate relations methods
     *
     * @return void
     */
    protected function createRelations() :void
    {
        foreach (getRelationsDetails($this->argument('table')) as $column) {
            $relation_name = getRelationMethodName($column->column_name);
            $class_namespace = getFilesInDir(app_path('Models'), getTableModel($column->fk_table));
            $this->relations .= "\n\tpublic function $relation_name() \n\t{ \n\t\treturn \$this->belongsTo(\\{$class_namespace}::class, '{$column->column_name}', '{$column->fk_column}')->withDefault(['{$column->fk_column}' => 'null']); \n\t}\n";
        }
    }

    /**
     * createContent
     *
     * this method to make replase data in stub file
     *
     * @return void
     */
    protected function createContent() :void
    {
        $content = file_get_contents(base_path('stubs/custom/model.stub'));
        [$name, $namespace] = getClassNamespace($this->model);

        $this->content = str_replace([
            '{{ namespace }}',
            '{{ class }}',
            '{{ table }}',
            '{{ fillable }}',
            '{{ relations }}',
            '{{ timestamps }}',
        ],[
            $namespace,
            $name,
            $this->argument('table'),
            $this->fillable,
            $this->relations,
            $this->timestamps,
        ], $content);
    }

    /**
     * createFile
     *
     * This method to get model file and put file content
     *
     * @return void
     */
    protected function createFile() :void
    {
        Artisan::call("make:model {$this->model}");
        $file = "app\Models\\".str_replace('/', '\\', $this->model).".php";
        File::put($file, trim($this->content));
    }
}
