<?php

namespace App\Imports;

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
            'name'              => $row['name'],
            'email'             => $row['email'],
            'password'          => 123,
            'email_verified_at' => now(),
        ]);
    }
}
