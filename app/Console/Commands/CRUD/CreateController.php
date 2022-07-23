<?php

namespace App\Console\Commands\CRUD;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class CreateController extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:controller {table}';
    protected $controller = array();

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command to create a controller from database table';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        self::createController();
        self::createFile();

        $this->info("controller class<options=bold> {$this->controller['name']}.php </>created successfully!");
    }

    protected function createController()
    {
        $this->controller['model'] = Str::studly(Str::singular($this->argument('table')));
        $controller_name = $this->controller['model'].'Controller';
        $this->controller['name']  = $controller_name;
        foreach (getFilesInDir(app_path('Http/Controllers/Backend')) as $name => $class) {
            if (stripos($name, $controller_name) !== false) {
                $this->controller['namespace'] = str_replace('\\', '/', $class);
                break;
            }
        }

        if (! isset($this->controller['namespace']) ) {
            $this->controller['namespace'] = "App/Http/Controllers/Backend/{$this->controller['name']}";
            Artisan::call("make:controller {$this->controller['namespace']}");
        }
    }

    protected function createFile()
    {
        $file = str_replace('App', 'app', $this->controller['namespace']).".php";
        File::put($file, trim(self::createContent()));
    }

    protected function createContent()
    {
        $content = file_get_contents(base_path('stubs/controller.custom.stub'));

        $content = str_replace([
            '{{ rootNamespace }}',
            '{{ namespacedModel }}',
            '{{ namespace }}',
            '{{ class }}',
            '{{ model }}',
            '{{ appends }}'
        ],[
            'App\\',
            'App\Models\\'.$this->controller['model'],
            str_replace(['/', '\\'.$this->controller['name']], ['\\', ''], $this->controller['namespace']),
            $this->controller['name'],
            $this->controller['model'],
            self::createAppends()
        ], $content);

        return $content;
    }

    protected function createAppends()
    {
        $appends = "";
        foreach (self::getRelatedTables() as $data) {
            $appends .= "\n\t\t\t'{$data['table']}' => \App\Models\\".ucfirst($data['model'])."::pluck('{$data['related_column']}', 'id'),";
        }
        return $appends;
    }

    protected function getRelatedTables()
    {
        $related_columns = [];
        foreach (Schema::getColumnListing($this->argument('table')) as $column) {
            if (stripos($column, '_id') !== false && $column !== "id") {
                $table = Str::plural( str_replace('_id', '', $column) );
                foreach (Schema::getColumnListing($table) as $related_column) {
                    if (in_array($related_column, ['created_at', 'updated_at', 'id'])) continue;

                    array_push($related_columns, [
                        'table' => $table,
                        'related_column' => $related_column,
                        'model' => ucfirst( str_replace('_id', '', $column) )
                    ]);
                    break;
                }

            }
        }

        return $related_columns;
    }
}
