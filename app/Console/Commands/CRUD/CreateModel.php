<?php

namespace App\Console\Commands\CRUD;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CreateModel extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:model {model : the model class namespace after Models folder} {table : the table name from database}';
    protected $model;
    protected $table;
    protected $namespaces = '';
    protected $timestamps = "\n\tpublic \$timestamps = false;\n";
    protected $methods = '';
    protected $traits = "";
    protected $translatable = '';


    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To create Model class';

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

        return false;
    }

    private function getSourceFile()
    {
        $name = class_basename($this->model);
        $namespace = substr($this->model, 0, -strlen("\\$name"));

        $vars = [
            '{{ namespace }}' => $namespace,
            '{{ relations }}' => $this->relations(),
            '{{ class }}' => $name,
            '{{ table }}' => $this->table,
            '{{ fillable }}' => $this->fillable(),
            '{{ namespaces }}' => $this->namespaces,
            '{{ timestamps }}' => $this->timestamps,
            '{{ traits }}' => $this->traits,
            '{{ methods }}' => $this->methods,
            '{{ translatable }}' => $this->translatable ? "protected \$translatable = [".trim($this->translatable, ',').'];' : '',
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
            $this->namespaces .= "use ". trim($class_namespace, '\\') .";\n";
            $relations .= "\n\tpublic function ".getRelationName($column->column_name)."() \n\t{";
            $relations .= "\n\t\treturn \$this->belongsTo({$model_name}::class, '{$column->column_name}', '{$column->fk_column}')->withDefault(['{$column->fk_column}' => null]);";
            $relations .= "\n\t}\n";
        }
        return $relations;
    }

    protected function fillable()
    {
        $fillables = '';
        $columns = DB::select('SHOW FULL COLUMNS FROM '.$this->argument('table'));

        foreach ($columns as $column) {
            if (in_array($column->Field, ['created_at', 'updated_at'])) $this->timestamps = '';
            if (in_array($column->Field, ['id', 'created_at', 'updated_at'])) continue;

            $fillables .= "'$column->Field', ";

            if ($column->Comment == 'translations') {

                if (stripos($this->namespaces, "use Spatie\Translatable\HasTranslations;") === false) {
                    $this->namespaces .= "use Spatie\Translatable\HasTranslations;\n";
                    $this->traits .= ', HasTranslations';
                    $this->translatable .= "'$column->Field',";
                    $this->methods .= "\n\tpublic function asJson(\$value)\n\t{";
                    $this->methods .= "\n\t\treturn json_encode(\$value, JSON_UNESCAPED_UNICODE);";
                    $this->methods .= "\n\t}\n";
                }

                $this->methods .= "\n\tprotected function $column->Field(): Attribute\n\t{";
                $this->methods .= "\n\t\treturn Attribute::make(";
                $this->methods .= "\n\t\t\tget: fn (\$value) => \$this->get". ucfirst($column->Field) ."(),";
                $this->methods .= "\n\t\t);";
                $this->methods .= "\n\t}\n";

                $this->methods .= "\n\tpublic function get".ucfirst($column->Field)."(\$lang = null)\n\t{";
                $this->methods .= "\n\t\t\$lang = \$lang ?? app()->getLocale();";
                $this->methods .= "\n\t\treturn \$this->getTranslations('$column->Field')[\$lang] ?? '';";
                $this->methods .= "\n\t}\n";

            } elseif ( checkColumnIsFile($column->Comment) ) {
                $storage_namespace = "Illuminate\Support\Facades\Storage";
                if ( stripos($this->namespaces, $storage_namespace) === false )
                    $this->namespaces .= "use $storage_namespace;\n";

                $this->methods .= "\n\tprotected function $column->Field(): Attribute\n\t{";
                $this->methods .= "\n\t\treturn Attribute::make(";
                $this->methods .= "\n\t\t\tget: fn (\$value) => \$value && Storage::disk('public')->exists( 'uploads/$this->table/' . \$value ) ? 'storage/uploads/$this->table/' . \$value : null,";
                $this->methods .= "\n\t\t);";
                $this->methods .= "\n\t}\n";
            }
        }

        return rtrim($fillables, ', ');

    }
}
