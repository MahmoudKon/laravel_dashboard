<?php

namespace App\Console\Commands;

use App\Models\Role;
use App\Models\Route;
use Illuminate\Console\Command;
use Spatie\Permission\Models\Permission;

class AssignPermissionsToRole extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sync:permissions';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To make assign for permissions with roles';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // Super Admin Sync Permissions
        $this->syncPermissions("Super Admin");


        // $this->syncPermissions("Normal", ['Profile']);
    }

    protected function syncPermissions(string $role_name, array $controllers = [], array $funcs = [], bool $sync = true) :void
    {
        $permissions = []; // Create Empty Array
        $routes = Route::when($controllers, function ($query) use($controllers) {
                        $query->whereIn('controller', $controllers);
                    })->when($funcs, function($query) use($funcs) {
                        $query->whereIn('func', $funcs);
                    })->get();

        $role = Role::where('name', 'LIKE', "%$role_name%")->first(); // Get Role Object
        if ($sync) $role->routes()->sync($routes->pluck('id')); // Make Sync For Role Routes
        else     $role->routes()->attach($routes->pluck('id')); // Make Attach For Role Routes

        foreach ($routes as $route)  // Get All Routes For Each Controller In Array
            array_push($permissions, $route->permissionName()); // Push The Route Permission Name In The Empty Array

        // Make Sync Between Role And All Permissions
        if ($sync)
            $role->permissions()->sync(Permission::whereIn('name', $permissions)->pluck('id')->toArray());
        else
            $role->permissions()->attach(Permission::whereIn('name', $permissions)->pluck('id')->toArray());
    }
}
