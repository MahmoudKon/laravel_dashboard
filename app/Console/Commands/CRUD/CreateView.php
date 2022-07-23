<?php

namespace App\Console\Commands\CRUD;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class CreateView extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'crud:view {table}';
    protected $columns = array();
    protected $inputs;

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new blade template.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        self::getColumns();

        $path = self::viewPath();

        self::createDir($path);

        if (File::exists($path))
        {
            $this->error("File {$path} already exists!");
            return;
        }

        File::put($path, self::appendText());

        $this->line('<bg=green;fg=white;options=bold>View</> Created Successfully!');
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
    public function viewPath()
    {
        return "resources/views/backend/{$this->argument('table')}/form.blade.php";
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
        $form_content = file_get_contents(base_path("stubs/form.stub"));
        return str_replace('{{-- HTML Code --}}', self::createFormContent(), $form_content);
    }

    protected function getColumns() :void
    {
        foreach (DB::select('describe '.$this->argument('table')) as $column) {
            if (in_array($column->Field, ['id', 'created_at', 'updated_at'])) continue;
            array_push($this->columns, $column);
        }
    }

    protected function createFormContent() :string
    {
        $inputs = '';
        foreach ($this->columns as $column) {
            $inputs .= self::html($column)."\n\n";
        }
        return $inputs;
    }

    protected function getInputType($column) :string
    {
        if (stripos($column->Type, 'tinyint') !== false)
            return 'checkbox';

        if (stripos($column->Field, '_id') !== false)
            return 'select';

        return "input";
    }

    protected function html($column) :string
    {
        $related_table = stripos($column->Field, '_id') !== false ? Str::plural( str_replace('_id', '', $column->Field) ) : '';
        $type = self::getInputType($column);
        $content = file_get_contents(base_path("stubs/html.$type.stub"));
        return str_replace([
            '{{ table }}',
            '{{ column }}',
            '{{ required }}',
            '{{ type }}',
            '{{ related }}'
        ], [
            $related_table,
            $column->Field,
            stripos($column->Null, 'NO') !== false ? 'required' : '',
            stripos($column->Type, 'varchar') !== false || stripos($column->Type, 'text') !== false
                    ? 'text'
                    : (stripos($column->Type, 'date') !== false || stripos($column->Type, 'timestamp') !== false ? 'date' : 'number'),
            $type == 'select' ? Str::plural( str_replace('_id', '', $column->Field)) : ''
        ], $content);
    }
}
