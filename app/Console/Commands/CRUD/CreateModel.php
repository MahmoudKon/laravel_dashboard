<?php

namespace App\Console\Commands\CRUD;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateModel extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:model {table}';

    protected $model = array();
    protected $fillable = '';
    protected $related_columns = array();
    protected $relations = '';

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
        self::createFillable();
        self::createRelations();
        self::createModel();
        self::createFile();

        $this->info("model class<options=bold> {$this->model['name']}.php </>created successfully!");
    }

    protected function createFillable()
    {
        foreach (Schema::getColumnListing($this->argument('table')) as $column) {
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
            $this->relations .= "\n\tpublic function $relation() { return \$this->belongsTo({$relation_class}::class, '$column'); }\n";
        }
    }

    protected function createModel()
    {
        $model_name = Str::studly(Str::singular($this->argument('table')));
        $this->model['name']  = $model_name;
        foreach (getFilesInDir(app_path('Models')) as $name => $class) {
            if (stripos($name, $model_name) !== false) {
                $this->model['path'] = str_replace('\\', '/', $class);
                break;
            }
        }

        if (! isset($this->model['path']) ) {
            $this->model['path'] = "App/Models/{$this->model['name']}";
            Artisan::call("make:model {$this->model['path']}");
        }
    }

    protected function createFile()
    {
        $file = str_replace('App', 'app', $this->model['path']).".php";
        File::put($file, trim(self::createContent()));
    }

    protected function createContent()
    {
        $content = file_get_contents(base_path('stubs/model.custom.stub'));

        $content = str_replace([
            '{{ namespace }}',
            '{{ class }}',
            '{{ table }}',
            '{{ fillable }}',
            '{{ relations }}'
        ],[
            str_replace(['/', "\\{$this->model['name']}"], ['\\', ''], $this->model['path']),
            $this->model['name'],
            $this->argument('table'),
            $this->fillable,
            $this->relations
        ], $content);

        return $content;
    }
}
