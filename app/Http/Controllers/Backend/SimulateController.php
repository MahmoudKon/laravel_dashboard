<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;

class SimulateController extends Controller
{
    public function index()
    {
        return view('backend.simulate.index', ['title' => trans('menu.simulate'), 'data' => $this->getCommandsList()]);
    }

    protected function getCommandsList()
    {
        return [
            [
                'title'     => 'Public Commands',
                'color'     => 'bg-primary',
                'commandes' => [
                    'SaveRoutesInDatabase' => [
                        'title' => 'Save Routes In Database',
                        'color' => 'btn-dark'
                    ],
                    'AssignPermissionsToRole' => [
                        'title' => 'Assign Permissions To Role',
                        'color' => 'btn-dark'
                    ]
                ]
            ],
        ];
    }

    public function runCommand($command)
    {
        $command = "$command.php";
        foreach (getFilesInDir(app_path('Console\Commands')) as $file_name => $namespace) {
            if (stripos($file_name, $command) !== false) {
                dispatch(app($namespace));
                toast("Command is running in the background!<br> NOTE: please run queue:work", 'success');
                session()->flash('success', "<span class='form-control copy'>php artisan queue:work</span>");
                return back();
            }
        }
        toast('This command not found', 'error');
        return back();
    }

}
