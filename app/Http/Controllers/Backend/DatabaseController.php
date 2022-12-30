<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckMiddleWare;
use App\Http\Middleware\LockScreenMiddleware;
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

    public function show($table)
    {
        $row['columns'] = DB::select( "SHOW COLUMNS FROM `$table`" );
        $row['relations'] = getRelationsDetails($table);
        return view('backend.database.show', compact('row', 'table'));
    }
}
