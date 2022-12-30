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
    return Str::lcfirst( Str::studly( Str::singular( getRelationMethodName($table) ) ) );
}

/**
 * checkColumnIsFile
 *
 * @param  string $column
 * @return bool
 */
function checkColumnIsFile(string $column) :bool
{
    return in_array($column, ['audio', 'video', 'file', 'image']);
}

function checkClassExists(string $path, string $specific_name) :bool|string
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

    foreach (getRelationsDetails($table) as $column) {
        $model = getFilesInDir(base_path('app/Models'), getTableModel($column->fk_table));
        if (! $model) continue;
        $model = trim($model, '\\');
        $model_Class = app($model);

        $fk_column_name = $model_Class->getFillable()[0] ?? getFirstStringColumn( getTableColumns( $column->fk_table ) );
        $appends .= "\n\t\t\t'{$column->fk_table}' => \\{$model}::pluck('{$fk_column_name}', 'id'),";
    }
    return $appends;
}

function getTableColumns($table)
{
    return DB::select("SHOW FULL COLUMNS FROM $table");
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
            $related_table = getSpecificRelation($table, $value->Field);
            if (! $related_table) continue;
            $data['relations'][$related_table->fk_table] = getTableDetails($related_table->fk_table, false);

        }
    }
    return $data;
}

/**
 * getFirstStringColumn
 *
 *  get first column his type is string from table
 *  EX => [id, date, name, email]  return name
 *
 * @param  array $columns
 * @return string
 */
function getFirstStringColumn(array $columns) :string
{
    foreach ($columns as $column) {
        if (stripos($column->Type, 'varchar') !== false)
            return $column->Field;
    }

    return $columns[0]->Field;
}

/**
 * getRelationsDetails
 *
 *  This query to get all fk columns with table name
 *
 * @param  string $table
 * @return array
 */
function getRelationsDetails($table) :array
{
    $data = DB::select("SELECT `column_name` AS column_name, `referenced_table_name` AS fk_table, `referenced_column_name`  AS fk_column
                            FROM `information_schema`.`KEY_COLUMN_USAGE` WHERE `constraint_schema` = SCHEMA()
                            AND `table_name` = '$table' AND `referenced_column_name` IS NOT NULL"
                    );
    return array_combine(collect($data)->pluck('column_name')->toArray(), $data);
}


/**
 * getRelationsDetails
 *
 *  This query to get specific fk column details
 *
 * @param  string $table
 * @param  string $column
 * @return ?object
 */
function getSpecificRelation($table, string $column) :?object
{
    $relations = getRelationsDetails($table);
    return $relations[$column] ?? null;
}

/**
 * getRelationMethodName
 *  this function to change fk column to relation method name
 *  EX => user_id => user   |   manger_of_manager_id  => managerOfManager
 * @param  string $column
 * @return string
 */
function getRelationMethodName(string $column) :string
{
    $column = str_replace('_id', '', $column);
    return Str::camel($column);
}

/**
 * getClassNamespace
 *  this function to get name of class and his part of namespace
 * @param  string $class    // Backend/User        ||  User
 * @return array            // [User, \Backend]    ||  [User , '']
 */
function getClassNamespace(string $class) :array
{
    $name = last( explode('/', $class) );
    $namespace = trim( str_replace("$name", '', $class) , '/');
    if ($namespace) $namespace = "\\$namespace";

    return [$name, $namespace];
}

/**
 * getClassFile
 *  this function to get file path of class
 * @param  string $namespace
 * @return string
 */
function getClassFile(string $namespace) :string
{
    $namespace = str_replace('/', '\\', $namespace);
    if (class_exists($namespace)) {
        $reflector = new ReflectionClass( $namespace );
        return $reflector->getFileName();
    }
    return '';
}
