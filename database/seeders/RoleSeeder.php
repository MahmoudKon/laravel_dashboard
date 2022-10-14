<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        truncateTables('roles');

        $roles = [
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'Super Admin'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'Manager'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'Normal'],
        ];

        foreach ($roles as $role) Role::firstOrCreate($role, $role);
    }
}
