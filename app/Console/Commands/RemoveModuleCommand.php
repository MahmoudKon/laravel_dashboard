<?php

namespace App\Console\Commands;

use App\Models\Menu;
use App\Models\Route;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;

class RemoveModuleCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'remove:crud {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command to remove all generated files from crud command';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $model = getTableModel($this->argument('name'));

        $this->removeViewDir($model);

        foreach ($this->deletedFiles($model) as $path => $name) {
            $this->removeFileInDir( $path, $name);
        }

        $this->removeMenu();
        $this->removeRoute("{$model}Controller");

        $this->info("All files removed");
    }

    protected function removeViewDir(string $model): void
    {
        $view_sub_path = '';
        $contoller = getFilesInDir( app_path('Http'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'Backend'), "{$model}Controller");

        if ( $contoller ) {
            $contoller = app($contoller);
            $view_sub_path = str_replace('.', DIRECTORY_SEPARATOR ,$contoller->view_sub_path);
        }

        $path = resource_path('views'.DIRECTORY_SEPARATOR.'backend'.DIRECTORY_SEPARATOR.$view_sub_path.$this->argument('name'));
        if ( File::isDirectory( $path ) ) {
            File::deleteDirectory( $path );
            $this->message( $path );
        }
    }

    protected function deletedFiles(string $model): array
    {
        return [
            app_path('Models') => $model ,
            app_path('Imports') => "{$model}Import",
            app_path('Exports') => "{$model}Export",
            app_path('Observers') => "{$model}Observer",
            app_path('DataTables') => "{$model}DataTable",
            app_path('Http'.DIRECTORY_SEPARATOR.'Requests') => "{$model}Request",
            app_path('Http'.DIRECTORY_SEPARATOR.'Services') => "{$model}Service",
            app_path('Http'.DIRECTORY_SEPARATOR.'Controllers'.DIRECTORY_SEPARATOR.'Backend') => "{$model}Controller",
        ];
    }

    protected function removeFileInDir(string $dir, string $target): void
    {
        if (File::isDirectory($dir)) {
            foreach (File::allFiles($dir) as $file) {
                if ($file->getFilename() == "$target.".$file->getExtension()) {
                    $path = $file->getRealPath();
                    if (file_exists( $path )) {
                        unlink( $path );
                        $this->message($path);
                    }
                }
            }
        }
    }

    protected function removeMenu()
    {
        $check = Menu::where('route', 'like', '%'.$this->argument('name').'.%')->delete();
        if ($check) {
            Cache::forget('active_languages');
            $this->message("Menu");
        }
    }

    protected function removeRoute($controller): void
    {
        Route::where('controller', $controller)->delete();

        $contents = explode(PHP_EOL, file_get_contents(base_path('routes/backend.php')));
        $out      = [];

        foreach ($contents as $line) {
            if(stripos($line, $controller) !== false) continue;
            $out[] = $line;
        }

        $out[] = '';

        file_put_contents(base_path('routes'.DIRECTORY_SEPARATOR.'backend.php'), implode(PHP_EOL, $out));
        $this->message("Routes");
    }

    protected function message($path)
    {
        $this->info("$path --- Removed");
    }
}
