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
            ['title' => 'RBT',           'email' => 'super_admin@ivas.com2', ],
            ['title' => 'Subscriptions', 'email' => 'super_admin@ivas.com3', ],
            ['title' => 'Social Media',  'email' => 'super_admin@ivas.com4', ],
            ['title' => 'Multimedia',    'email' => 'super_admin@ivas.com5', ],
            ['title' => 'Development',   'email' => 'super_admin@ivas.com6', ],
            ['title' => 'IT',            'email' => 'super_admin@ivas.com7', ],
            ['title' => 'Legal',         'email' => 'super_admin@ivas.com8', ],
            ['title' => 'CEO Assistant', 'email' => 'super_admin@ivas.com9', ],
            ['title' => 'Quality',       'email' => 'super_admin@ivas.com10',],
            ['title' => 'RBT Upload',    'email' => 'super_admin@ivas.com11',],
            ['title' => 'Reports',       'email' => 'super_admin@ivas.com12',],
            ['title' => 'Finance',       'email' => 'super_admin@ivas.com13',],
            ['title' => 'HR',            'email' => 'super_admin@ivas.com14',],
            ['title' => 'Content',       'email' => 'super_admin@ivas.com15',],
        ];

        foreach ($departments as $department)
            Department::firstOrCreate(['title' => $department['title']], $department);
    }
}
