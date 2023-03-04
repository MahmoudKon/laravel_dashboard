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
        truncateTables(['role_has_permissions', 'role_route']);

        // Super Admin Sync Permissions
        $this->syncPermissions("Super Admin");

        // Admin Sync Permissions
        $this->syncPermissions("Admin", ['ProfileController', 'UserController', 'AnnouncementController', 'CityController', 'ClientController']);

        // User Sync Permissions
        $this->syncPermissions("User", ['ProfileController', 'UserController', 'CityController', 'ClientController'], ['index', 'show', 'search']);
        $this->syncPermissions("User", ['AnnouncementController'], except_funcs:['multidelete', 'destroy']);

        echo "\nSynced...\n";
    }

    protected function syncPermissions(string $role_name, array $controllers = [], array $funcs = [], array $except_funcs = []) :void
    {
        $permissions = []; // Create Empty Array
        $routes = Route::when($controllers, function ($query) use($controllers) {
                        $query->whereIn('controller', $controllers);
                    })->when(count($funcs), function($query) use($funcs) {
                        $query->whereIn('func', $funcs);
                    })->when(count($except_funcs), function($query) use($except_funcs) {
                        $query->whereNotIn('func', $except_funcs);
                    })->get();

        $role = Role::where('name', 'LIKE', "$role_name")->first(); // Get Role Object
        $role->routes()->attach($routes->pluck('id'));

        foreach ($routes as $route)  // Get All Routes For Each Controller In Array
            array_push($permissions, $route->permissionName()); // Push The Route Permission Name In The Empty Array

        // Make Sync Between Role And All Permissions
        $permissions_id = Permission::whereIn('name', $permissions)->pluck('id')->toArray();
        $permissions_id = array_merge($permissions_id, $role->permissions()->pluck('id')->toArray());
        $role->permissions()->sync($permissions_id);
    }
}
