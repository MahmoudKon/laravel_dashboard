<?php

namespace App\Imports;

use App\Models\Department;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return User::firstOrCreate([
            'email' => $row['email']
        ], [
            'name'                => $row['name'],
            'email'               => $row['email'],
            'password'            => 123,
            'department_id'       => $this->getDepartmentID($row['department']),
            'annual_credit'       => $row['annual_credit'],
            'finger_print_id'     => $row['finger_print_id'],
            'salary_per_monthly'  => $row['salary'],
            'insurance_deduction' => $row['insurance_deduction']
        ]);
    }

    protected function getDepartmentID($title)
    {
        return Department::where('title', 'LIKE', $title)->first()->id ?? null;
    }
}
