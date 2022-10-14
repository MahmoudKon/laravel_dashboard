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
    protected $signature = 'crud:request {model} {table}';

    protected $validations = '';
    protected $request;

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
        $this->createRequest();
        $this->getColumns();
        $this->createFile();
        $this->info("model class<options=bold> {$this->request}.php </>created successfully!");
    }

    protected function getColumns()
    {
        $rows = [];

        foreach (DB::select('SHOW FULL COLUMNS FROM '.$this->argument('table')) as $column) {
            if (in_array($column->Field, ['id', 'created_at', 'updated_at'])) continue;
            $rows[$column->Field] = $this->getValidation($column);
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

        else {
            $this->getFileValidation($column, $validate);
        }

        if (stripos($column->Field, "_id") !== false) {
            $related_table = Str::plural( str_replace('_id', '', $column->Field) );
            array_push($validate, "exists:$related_table,id");
        }

        if (stripos($column->Key, "UNI") !== false) // is unique
            array_push($validate, "unique:{$this->argument('table')},$column->Field,'.request()->".Str::singular($this->argument("table"))."" . ".'" );

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

    protected function createRequest()
    {
        $this->request = getFilesInDir(app_path('Http/Requests'), "{$this->argument('model')}Request");

        if ( ! $this->request) {
            Artisan::call("make:request {$this->argument('model')}Request");
            $this->request = "{$this->argument('model')}Request";
        }
    }

    protected function createFile()
    {
        $file = "app\Http\Requests\\".str_replace('/', '\\', $this->request).".php";
        File::put($file, trim($this->createContent()));
    }

    protected function createContent()
    {
        $content = file_get_contents(base_path('stubs/custom/request.stub'));
        $content = str_replace([
            '{{ namespace }}',
            '{{ class }}',
            'return false',
            '//'
        ],[
            explode('/', $this->request)[0],
            last( explode('/', $this->request) ),
            'return true',
            $this->validations,
        ], $content);

        return $content;
    }
}
