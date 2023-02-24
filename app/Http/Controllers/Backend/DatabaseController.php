<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckMiddleWare;
use App\Http\Middleware\LockScreenMiddleware;
use App\Http\Requests\DatabaseRequest;
use Illuminate\Support\Facades\DB;

class DatabaseController extends Controller
{
    public function __construct()
    {
        $this->middleware([CheckMiddleWare::class, LockScreenMiddleware::class]);
    }

    public function index()
    {
        $tables = DB::select("SELECT *, ROUND((DATA_LENGTH + INDEX_LENGTH) / 1024) AS Size FROM information_schema.tables WHERE table_schema = SCHEMA()");
        $title = 'Database Tables: '.count($tables);
        return view('backend.database.index', compact('tables', 'title'));
    }

    public function create()
    {
        return view('backend.database.create', [
            'title' => 'إنشاء جدول جديد'
        ]);
    }

    public function store(DatabaseRequest $request)
    {
        $database_config = config('database.connections.mysql');
        $alters = '';
        $query = "CREATE TABLE `{$request->table_name}` (";

        foreach ($request->columns as $index => $column) {
            if ($column['name'] == '') continue;
            $default_type = $column['default_type'] == 'NONE' ? "" : "DEFAULT ".($column['default_type'] == 'USER_DEFINED' ? $column['default_value'] : $column['default_type']);
            $extra = isset($column['extra']) ? "AUTO_INCREMENT" : '';
            $length = $column['length'] ? "({$column['length']})" : '';
            $null = isset($column['null']) ? 'NULL' : 'NOT NULL';
            $comment = $column['comment'] ? "COMMENT '{$column['comment']}' " : '';
            $query .= "\n`{$column['name']}` {$column['type']} $length {$column['attribute']} {$null} $default_type $comment";

            if (($index + 1) < count( $request->columns ) )
                $query .= ",";

            if (isset($column['key']) && $column['key'] !== 'none')
                $alters .= "ALTER TABLE `{$request->table_name}` ADD {$column['key']} KEY (`{$column['name']}`);\n";

            if ($extra)
                $alters .= "ALTER TABLE `{$request->table_name}` MODIFY `{$column['name']}` {$column['type']} $length {$column['attribute']} {$null} $extra $default_type;\n";
        }
        $query .= "\n ) ENGINE={$database_config['engine']} DEFAULT CHARSET={$database_config['charset']} COLLATE={$database_config['collation']};";

        DB::beginTransaction();
            DB::statement($query);
            DB::statement($alters);
        DB::commit();

        return response()->json(['reload' => true], 200);
    }

    public function show($table)
    {
        $row['columns'] = DB::select( "SHOW COLUMNS FROM `$table`" );
        $row['relations'] = getRelationsDetails($table);
        return view('backend.database.show', compact('row', 'table'));
    }
}
