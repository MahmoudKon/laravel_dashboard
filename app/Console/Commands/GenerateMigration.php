<?php

namespace App\Console\Commands;

use Illuminate\Console\GeneratorCommand;
use Illuminate\Support\Facades\File;

class GenerateMigration extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:migration {tables?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To generate the migration file from database | This command not finished yet';

    protected $type = 'migration';

    protected function getStub()
    {
        return  base_path() . DIRECTORY_SEPARATOR.'stubs'.DIRECTORY_SEPARATOR.'custom'.DIRECTORY_SEPARATOR."$this->type.stub";
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $tables = $this->argument('tables')
                    ? array_unique( explode(',', $this->argument('tables')) )
                    : null;

        foreach ($tables as $table) {
            $this->createTableMigration($table);
        }
    }

    protected function createTableMigration($table)
    {
        $columns = getTableColumns($table);
        $details = '';
        foreach ($columns as $column) {
            if ($column->Extra == 'auto_increment' && $column->Extra == 'PRI') {
                $details .= "\t\t\t\$table->unsignedBigInteger('$column->Field', true);\n";
                continue;
            }

            if ($column->Key === 'MUL') {
                $details .= $this->getRelation($table, $column);
                continue;
            }

            $details .= $this->handleColumnType($column);

            if ($column->Extra == 'auto_increment') {
                $details .= "->autoIncrement()";
            }

            if (stripos($column->Type, 'unsigned') !== false)
                $details .= "->unsigned()";

            if ($column->Null !== 'NO')
                $details .= "->nullable()";

            if ($column->Key === 'UNI')
                $details .= "->unique()";

            if ($column->Default)
                $details .= "->default('$column->Default')";

            if ($column->Collation)
                $details .= "->collation('$column->Collation')";

            if ($column->Comment)
                $details .= "->comment('$column->Comment')";

            $details .= ";\n";
        }

        $this->createFile($table, $details);
    }

    protected function createFile($table, $details)
    {
        $content  = file_get_contents($this->getStub());
        $content = str_replace(['{{ table }}', '{{ colomns }}'], [$table, $details], $content);
        $path = database_path('migrations/'.date('Y_m_d_his')."_create_{$table}_table.php");
        File::put($path, $content);
    }

    protected function getRelation($table, $column)
    {
        foreach (getRelationsDetails($table) as $column_name => $relation) {
            if ($column_name !== $column->Field) continue;
            return "\t\t\$table->foreignId('$column_name')->constrained('$relation->fk_table')->cascadeOnDelete()->cascadeOnUpdate();\n";
        }
        return '';
    }

    protected function handleColumnType($column)
    {
        $text = "\t\t\t\$table->";

        if( stripos($column->Type, 'timestamp') !== false ) {
            $text .= "timestamp('$column->Field')";
        } else if ( stripos($column->Type, 'date') !== false ) {
            $text .= "date('$column->Field')";
        } else if ( stripos($column->Type, 'varchar') !== false ) {
            $text .= "string('$column->Field', ". (int)filter_var($column->Type, FILTER_SANITIZE_NUMBER_INT) .")";
        } else if ( stripos($column->Type, 'text') !== false ) {
            $text .= "text('$column->Field')";
        } else if ( stripos($column->Type, 'bigint') !== false ) {
            $text .= "bigInteger('$column->Field')";
        } else if ( stripos($column->Type, 'tinyint') !== false ) {
            $text .= "boolean('$column->Field')";
        } else if ( stripos($column->Type, 'int') !== false ) {
            $text .= "integer('$column->Field')";
        } 

        return $text;
    }
}
