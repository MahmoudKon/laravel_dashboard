<?php

namespace App\Console\Commands\CRUD;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateRequest extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:request {model : the model class namespace after Models folder}';
    protected $model;
    protected $table;
    protected $validations = '';
    protected $translations = '';
    protected $content;
    protected $request;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create request file from table migration';

    protected $type = 'request';

    protected function getStub()
    {
        return  base_path() . DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.'custom'.DIRECTORY_SEPARATOR.'request.stub';
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\Http\Requests';
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        if ($this->checkModelExists()) return;

        $this->getColumns();
        $this->createContent();
        $this->createFile();
        $this->info("model class<options=bold> {$this->request}.php </>created successfully!");
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

        $this->request = $this->qualifyClass( $this->argument('model').'Request' );
        $this->model = $this->qualifyModel( $this->argument('model') );

        if (! $this->alreadyExists($this->model)) {
            $this->error("model class {$this->model}.php not exists!");
            return true;
        }

        if ($this->alreadyExists($this->request)) {
            $this->error("request $this->request already exists!");
            return true;
        }

        $this->model = app($this->model);
        $this->table = $this->model->getTable();
        return false;
    }

    protected function getColumns()
    {
        $rows = [];
        $fk_columns = getRelationsDetails($this->table);
        foreach (DB::select('SHOW FULL COLUMNS FROM '.$this->table) as $column) {
            if (! in_array($column->Field, $this->model->getFillable())) continue;

            $trans = "trans('inputs.{$column->Field}')";
            $fk_column = false;

            if (isset($fk_columns[$column->Field])) {
                $fk_column = $fk_columns[$column->Field];
                $trans = "trans('menu.{$fk_column->fk_table}')";
            }

            if (stripos($column->Comment, 'translations') !== false) {
                foreach (config('languages') as $key => $lang) {
                    $this->validations  .= "'$column->Field.{$lang}' => '". $this->getValidation($column, $fk_column) ."',\n\t\t\t";
                    $this->translations .= "'$column->Field.{$lang}' => $trans,\n\t\t\t";
                }
            } else {
                $this->validations  .= "'$column->Field' => '". $this->getValidation($column, $fk_column) ."',\n\t\t\t";
                $this->translations .= "'$column->Field' => $trans,\n\t\t\t";
            }

        }

        foreach ($rows as $key => $value) {
            $this->validations .= "'$key' => $value',\n\t\t\t";
        }
    }

    protected function getValidation($column, $fk_column)
    {
        $validate = [];

        if (stripos($column->Null, "Yes") !== false || stripos($column->Type, "tinyint") !== false) array_push($validate, 'nullable');
        elseif ( checkColumnIsFile($column->Comment) ) array_push($validate, 'required_without:id');
        else array_push($validate, 'required');

        if(stripos($column->Type, "tinyint") !== false)
            array_push($validate, 'boolean');

        else if(stripos($column->Type, "int") !== false || stripos($column->Type, "decimal") !== false)
            array_push($validate, 'numeric');

        else if (stripos($column->Type, "timestamp") !== false || stripos($column->Type, "date") !== false)
            array_push($validate, 'date');

        else {
            $this->getFileValidation($column, $validate);
        }

        if ($fk_column)
            array_push($validate, "exists:$fk_column->fk_table,$fk_column->fk_column");

        if (stripos($column->Key, "UNI") !== false) // is unique
            array_push($validate, "unique:{$this->table},$column->Field,'.request()->".Str::singular($this->table)."" .".'" );

        return implode('|', $validate);
    }

    protected function getFileValidation($column, &$validate)
    {
        if (stripos($column->Comment, 'image') !== false)
            array_push($validate, 'image|mimes:png,jpg,jpeg');

        else if (stripos($column->Comment, 'audio') !== false)
            array_push($validate, 'file|mimes:mp3');

        else if (stripos($column->Comment, 'video') !== false)
            array_push($validate, 'file|mimes:mp4');

        else if (stripos($column->Comment, 'file') !== false)
            array_push($validate, 'file|mimes:pdf,docx,xsl');
        else
            array_push($validate, 'string');
    }

    protected function createFile()
    {
        Artisan::call("make:request {$this->argument('model')}Request");
        $file = getClassFile($this->request);
        File::put($file, trim($this->content));
    }

    protected function createContent()
    {
        $content = file_get_contents(base_path('stubs/custom/request.stub'));
        $name = class_basename($this->request);

        $this->content = str_replace([
            '{{ namespace }}',
            '{{ class }}',
            'return false',
            '{{ validation }}',
            '{{ translation }}'
        ],[
            substr($this->request, 0, -strlen("\\$name")),
            $name,
            'return true',
            $this->validations,
            $this->translations,
        ], $content);
    }
}
