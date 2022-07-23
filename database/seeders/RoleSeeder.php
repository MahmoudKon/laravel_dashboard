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
        $roles = [
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'Super Admin'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'RBT'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'Subscriptions'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'Digital Media'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'Social Media'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'Multimedia'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'Development'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'IT'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'Legal'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'CEO Assistant'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'Content'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'Quality'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'RBT Upload'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'Reports'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'Finance'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'Ceo'],
            ['guard_name' => PERMISSION_GUARDS, 'name' => 'Acount'],
        ];

        foreach ($roles as $role) Role::firstOrCreate($role, $role);
    }
}
