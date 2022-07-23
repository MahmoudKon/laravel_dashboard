<?php

namespace Database\Seeders;

use App\Console\Commands\AssignPermissionsToRole as CommandsAssignPermissionsToRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AssignPermissionsToRole extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        dispatch(new CommandsAssignPermissionsToRole());
    }
}
