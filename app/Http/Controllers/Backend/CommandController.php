<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Middleware\CheckMiddleWare;
use App\Http\Middleware\LockScreenMiddleware;
use Exception;
use Illuminate\Support\Facades\Artisan;

class CommandController extends Controller
{
    public function __construct()
    {
        $this->middleware([CheckMiddleWare::class, LockScreenMiddleware::class]);
    }

    public function index()
    {
        $commands = $this->getArtisanCommands();
        $count = count($commands);
        return view('backend.commands.index', compact('commands', 'count'));
    }

    private function getArtisanCommands()
    {
        Artisan::call('list');

        // Get the output from the previous command
        $artisan_output = Artisan::output();
        $artisan_output = $this->cleanArtisanOutput($artisan_output);
        $commands = $this->getCommandsFromOutput($artisan_output);

        return $commands;
    }

    private function cleanArtisanOutput($output)
    {

        // Add each new line to an array item and strip out any empty items
        $output = array_filter(explode("\n", $output));

        // Get the current index of: "Available commands:"
        $index = array_search('Available commands:', $output);

        // Remove all commands that precede "Available commands:", and remove that
        // Element itself -1 for offset zero and -1 for the previous index (equals -2)
        $output = array_slice($output, $index - 2, count($output));

        return $output;
    }

    private function getCommandsFromOutput($output)
    {
        $commands = [];

        foreach ($output as $output_line) {
            if (empty(trim(substr($output_line, 0, 2)))) {
                $parts = preg_split('/  +/', trim($output_line));
                $command = (object) ['name' => trim(@$parts[0]), 'description' => trim(@$parts[1])];
                array_push($commands, $command);
            }
        }

        return $commands;
    }

    public function commandInfo(string $command)
    {
        $command_object = Artisan::all()[$command];
        $command_details = [
            'name' => $command,
            'description' => $command_object->getDescription(),
            'arguments' => $command_object->getDefinition()->getArguments(),
            'options' => $command_object->getDefinition()->getOptions()
        ];
        return view('backend.commands.call-command', ['command' => $command_details, 'args' => request()->args]);
    }

    public function call()
    {
        $command = request()->command . ' ' . request()->args;
        try {
            Artisan::call($command);
            $artisan_output = Artisan::output();
        } catch (Exception $e) {
            $artisan_output = $e->getMessage();
        }
        return view('backend.commands.output', ['command' => request()->command, 'artisan_output' => $artisan_output, 'args' => request()->args]);
    }
}
