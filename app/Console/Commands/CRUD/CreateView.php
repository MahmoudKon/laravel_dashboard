<?php

namespace App\Console\Commands\CRUD;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateView extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:view {view : the view path after view folder} {model : the model class namespace after Models folder}';
    protected $columns = array();
    protected $relations = array();
    protected $model;
    protected $table;
    protected $inputs;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new blade template.';

    protected $type = 'view';

    protected function getStub()
    {
        return  base_path() .DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.'custom'.DIRECTORY_SEPARATOR.'form.stub';
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        if ($this->checkModelExists()) return;

        $this->getColumns();

        $path = $this->view();

        if (File::exists($path)) {
            echo "File {$path} already exists! \n";
            return;
        }

        $this->createDir($path);

        File::put($path, $this->appendText());

        $this->line('<bg=green;fg=white;options=bold>View</> Created Successfully!');
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
            echo 'The name "'.$this->argument('model').'" is reserved by PHP.'."\n";
            return true;
        }

        $this->model = $this->qualifyModel( $this->argument('model') );

        if (! $this->alreadyExists($this->model)) {
            echo "model class {$this->model}.php not exists! \n";
            return true;
        }

        $this->model = app($this->model);
        $this->table = $this->model->getTable();
        return false;
    }

    /**
     * Get the view full path.
     *
     * @param string $view
     *
     * to replace . to / => [backend.clients.form => backend/clients/form]
     *
     * @return string
     */
    public function view()
    {
        $view = convertCamelCaseTo($this->argument('view'));
        $view =  'resources/views/'.$view;
        $view = str_replace(['/', '\\'], ['/'], $view);
        return $view;
    }

    /**
     * Create view directory if not exists.
     *
     * @param $path
     */
    public function createDir($path)
    {
        $dir = dirname($path);

        if (!file_exists($dir))
        {
            mkdir($dir, 0777, true);
        }
    }

    public function appendText() :string
    {
        return str_replace('{{-- HTML Code --}}', $this->createFormContent(), file_get_contents($this->getStub()));
    }

    protected function getColumns() :void
    {
        foreach (DB::select('SHOW FULL COLUMNS FROM '.$this->table) as $column) {
            if (in_array($column->Field, ['id', 'created_at', 'updated_at'])) continue;
            array_push($this->columns, $column);
        }
    }

    protected function createFormContent() :string
    {
        $inputs = '';
        foreach ($this->columns as $column) {
            $inputs .= $this->html($column)."\n\n";
        }
        return $inputs;
    }

    protected function getInputType($column) :string
    {
        if (stripos($column->Type, 'tinyint') !== false)
            return 'checkbox';

        if (stripos($column->Comment, 'translations') !== false)
            return 'trans';

        if (stripos($column->Field, '_id') !== false)
            return 'select';

        if (stripos($column->Type, 'date') !== false)
            return 'date';

        if (stripos($column->Type, 'text') !== false)
            return 'textarea';

        if (stripos($column->Comment, 'file') !== false)
            return 'file';

        if (stripos($column->Comment, 'image') !== false)
            return 'image';

        if (stripos($column->Comment, 'audio') !== false)
            return 'audio';

        if (stripos($column->Comment, 'video') !== false)
            return 'video';

        return "input";
    }

    protected function html($column) :string
    {
        $related_table = stripos($column->Field, '_id') !== false ? Str::plural( str_replace('_id', '', $column->Field) ) : '';
        $type = $this->getInputType($column);
        $content = file_get_contents(base_path("stubs/custom/html.$type.stub"));
        return str_replace([
            '{{ table }}',
            '{{ trans_column }}',
            '{{ column }}',
            '{{ upper_column }}',
            '{{ required }}',
            '{{ type }}',
            '{{ related }}'
        ], [
            $related_table,
            $column->Field,
            $column->Field,
            ucfirst($column->Field),
            stripos($column->Null, 'NO') !== false ? 'required' : '',
            stripos($column->Type, 'varchar') !== false || stripos($column->Type, 'text') !== false
                    ? 'text'
                    : (stripos($column->Type, 'date') !== false || stripos($column->Type, 'timestamp') !== false ? 'date' : 'number'),
            $type == 'select' ? Str::plural( str_replace('_id', '', $column->Field)) : ''
        ], $content);
    }
}
