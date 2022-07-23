<?php

namespace App\Console\Commands\CRUD;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateRequest extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:request {table}';

    protected $validations = '';
    protected $request = array();

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'create request file from table migration';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        self::createRequest();
        self::getColumns();
        self::createFile();
        $this->info("model class<options=bold> {$this->request['name']}.php </>created successfully!");
    }

    protected function getColumns()
    {
        $rows = [];
        foreach (DB::select('describe '.$this->argument('table')) as $column) {
            if (in_array($column->Field, ['id', 'created_at', 'updated_at'])) continue;
            $rows[$column->Field] = self::getValidation($column);
        }

        foreach ($rows as $key => $value) {
            $this->validations .= "'$key' => '$value',\n\t\t\t";
        }
    }

    protected function getValidation($column)
    {
        $validate = [];

        if (stripos($column->Null, "Yes") !== false || stripos($column->Type, "tinyint") !== false) array_push($validate, 'nullable');
        else array_push($validate, 'required');

        if(stripos($column->Type, "tinyint") !== false)
            array_push($validate, 'boolean');

        else if(stripos($column->Type, "int") !== false || stripos($column->Type, "decimal") !== false)
            array_push($validate, 'numeric');

        else if (stripos($column->Type, "timestamp") !== false || stripos($column->Type, "date") !== false)
            array_push($validate, 'date');
        else
            array_push($validate, 'string');

        if (stripos($column->Field, "_id") !== false) {
            $related_table = Str::plural( str_replace('_id', '', $column->Field) );
            array_push($validate, "exists:$related_table,id");
        }

        if (stripos($column->Key, "UNI") !== false)
            array_push($validate, "unique:{$this->argument('table')},$column->Field");

        return implode('|', $validate);
    }

    protected function createRequest()
    {
        $model_name = Str::studly(Str::singular($this->argument('table'))).'Request';
        $this->request['name'] = $model_name;
        foreach (getFilesInDir(app_path('Http/Requests')) as $name => $class) {
            if (stripos($name, $model_name) !== false) {
                $this->request['namespace'] = str_replace('\\', '/', $class);
                break;
            }
        }

        if ( !isset($this->request['namespace']) ) {
            $this->request['namespace'] = "App/Http/Requests/$model_name";
            Artisan::call("make:request $model_name");
        }
    }

    protected function createFile()
    {
        $file = str_replace('App', 'app', $this->request['namespace']).".php";
        File::put($file, trim(self::createContent()));
    }

    protected function createContent()
    {
        $content = file_get_contents(base_path('stubs/request.stub'));
        $content = str_replace([
            '{{ namespace }}',
            '{{ class }}',
            'return false',
            '//'
        ],[
            str_replace(['/', "\\{$this->request['name']}"], ['\\', ''], $this->request['namespace']),
            $this->request['name'],
            'return true',
            $this->validations,
        ], $content);

        return $content;
    }
}
