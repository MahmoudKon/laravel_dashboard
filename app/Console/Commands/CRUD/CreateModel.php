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
    protected $class;
    protected $fillable = '';
    protected $related_columns = array();
    protected $relations = '';
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
        $this->createFillable();
        $this->createRelations();
        $this->createModel();
        $this->createFile();

        $this->info("model class<options=bold> {$this->model}.php </>created successfully!");
    }

    protected function createFillable()
    {
        $columns = Schema::getColumnListing($this->argument('table'));
        if (in_array('created_at', $columns)) $this->timestamps = '';
        foreach ($columns as $column) {
            if (in_array($column, ['id', 'created_at', 'updated_at'])) continue;
            if (stripos($column, '_id') !== false) array_push($this->related_columns, $column);
            $this->fillable .= "'$column', ";
        }
        $this->fillable = rtrim($this->fillable, ', ');
    }

    protected function createRelations()
    {
        foreach ($this->related_columns as $column) {
            $relation = str_replace('_id', '', $column);
            $relation_class = ucfirst( $relation );
            $class_namespace = getFilesInDir(app_path('Models'), $relation_class);
            $this->relations .= "\n\tpublic function $relation() { \n\t\treturn \$this->belongsTo(\\{$class_namespace}::class)->withDefault(['id' => null]); \n\t}\n";
        }
    }

    protected function createModel()
    {
        $this->model = getFilesInDir(app_path('Models'), $this->argument('model'));

        if (! $this->model) {
            Artisan::call("make:model {$this->argument('model')}");
            $this->model = $this->argument('model');
        }
    }

    protected function createFile()
    {
        $file = "app\models\\".str_replace('/', '\\', $this->model).".php";
        File::put($file, trim($this->createContent()));
    }

    protected function createContent()
    {
        $content = file_get_contents(base_path('stubs/custom/model.stub'));
        $name = last( explode('/', $this->model) );
        $namespace = substr_replace($this->model, '', -strlen($name));

        $content = str_replace([
            '{{ namespace }}',
            '{{ class }}',
            '{{ table }}',
            '{{ fillable }}',
            '{{ relations }}',
            '{{ timestamps }}',
        ],[
            '\\'.trim( str_replace('/', '\\', $namespace) , '\\'),
            $name,
            $this->argument('table'),
            $this->fillable,
            $this->relations,
            $this->timestamps,
        ], $content);

        return $content;
    }
}
