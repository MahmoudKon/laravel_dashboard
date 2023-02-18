<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        truncateTables('departments');

        $departments = [
            ['title' => 'superadmin',    'email' => 'super_admin@ivas.com1', ],
            ['title' => 'Development',   'email' => 'super_admin@ivas.com6', ],
            ['title' => 'IT',            'email' => 'super_admin@ivas.com7', ],
            ['title' => 'Finance',       'email' => 'super_admin@ivas.com13',],
            ['title' => 'HR',            'email' => 'super_admin@ivas.com14',],
        ];

        foreach ($departments as $department)
            Department::firstOrCreate(['title' => $department['title']], $department);
    }
}
