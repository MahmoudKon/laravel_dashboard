<?php

namespace App\Http\Controllers\Frontend;

use App\Helpers\Puzzle;
use App\Http\Controllers\Controller;

class SudokuController extends Controller
{
    protected array $init_array;

    public function __construct()
    {
        if (request()->has('sudoku')) {
            foreach (request()->sudoku as $row => $columns) {
                foreach ($columns as $column => $value) {
                    $this->init_array[$row][$column] = $value ?? 0;
                }
            }
        }
    }

    public function index()
    {
        return view('frontend.sudoku.index');
    }

    public function solve()
    {
        set_time_limit(0);
        $start = microtime(true);
        $puzzle = new Puzzle(3, $this->init_array);
        $puzzle->solve();
        $solution = $puzzle->getSolution();

        return [
            'result' => $solution,
            'time'   => number_format( microtime(true) - $start, 3)
        ];
    }

    public function generate()
    {
        $puzzle = new Puzzle();
        $puzzle->generatePuzzle();
        return $puzzle->getPuzzle();
    }
}
