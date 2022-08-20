<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

/**
 * getTableModel
 *
 *  Convert database table name to model class name
 *  users => User
 *
 * @param  string $table
 * @return string
 */
function getTableModel(string $table) :string
{
    return Str::studly( Str::singular($table) );
}

function getRelationName(string $table) :string
{
    return Str::lcfirst( Str::studly( Str::singular($table) ) );
}


function checkClassExists(string $path, string $specific_name) :bool
{
    if (stripos('.php', $specific_name) === false) $specific_name .= '.php';
    $path = str_replace(['App', '\\'], ['app', DIRECTORY_SEPARATOR], $path);

    foreach (getFilesInDir(base_path($path)) as $name => $namespace) {
        if ($name == $specific_name)  return $namespace;
    }

    return false;
}

function createAppends($table)
{
    $appends = "";
    foreach (getRelatedTables($table) as $data) {
        $appends .= "\n\t\t\t'{$data['table']}' => \App\Models\\".ucfirst($data['model'])."::pluck('{$data['related_column']}', 'id'),";
    }
    return $appends;
}

function getRelatedTables($table)
{
    $related_columns = [];
    foreach (getTableDetails($table)['relations'] as $table => $columns) {
        foreach ($columns['columns'] as $column) {
            if (stripos($column->Type, 'varchar') === false) continue;
            array_push($related_columns, [
                'table' => $table,
                'related_column' => $column->Field,
                'model' => getTableModel($table)
            ]);
            break;
        }
    }
    return $related_columns;
}

function getTableDetails(string $table, bool $with_relations = true)
{
    $data = ['columns' => [], 'relations' => []];

    foreach (DB::select("SHOW FULL COLUMNS FROM $table") as $value) {
        if (in_array($value->Field, ['id', 'created_at', 'updated_at']))
            continue;

        array_push($data['columns'], $value);
        if ($value->Key == 'MUL' && $with_relations) {
            $related_table = Str::plural(str_replace('_id', '', $value->Field));
            $data['relations'][$related_table] = getTableDetails($related_table, false);
        }
    }

    return $data;
}

function getFirstStringColumn($columns)
{
    foreach ($columns as $column) {
        if (stripos($column->Type, 'varchar') !== false)
            return $column->Field;
    }

    return $columns[0]->Field;
}
