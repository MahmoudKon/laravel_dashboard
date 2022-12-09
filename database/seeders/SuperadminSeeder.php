<?php

namespace Database\Seeders;

use App\Models\Department;
use App\Models\User;
use App\Traits\UploadFile;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class SuperadminSeeder extends Seeder
{
    use UploadFile;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = $this->GetApiImage('people', 1);

        $data = [
            'code'                  => 111111,
            'name'                  => 'super_admin',
            'email'                 => 'super_admin@app.com',
            'password'              => 123,
            'department_id'         => Department::first()->id,
            'email_verified_at'     => now(),
            'remember_token'        => Str::random(10),
            'image'                 => $this->uploadApiImage($images[0]['src']['medium'], 'users')
        ];

        $user = User::firstOrCreate(['email' => $data['email']], $data);
        Department::get()->each(function($row) use($user) {
            $row->update(['manager_id' => $user->id]);
        });
        $user->assignRole('Super Admin');
    }
}
