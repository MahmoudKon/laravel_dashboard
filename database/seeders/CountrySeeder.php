<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        truncateTables('countries');

        $countries = [
            ['name' => ['en' => 'Egypt', 'ar' => 'مصر']],
            ['name' => ['en' => 'KSA', 'ar' => 'السعودية']],
            ['name' => ['en' => 'Kuwait', 'ar' => 'الكويت']],
            ['name' => ['en' => 'Palestine', 'ar' => 'فلسطين']],
        ];

        foreach ($countries as $country)
            Country::firstOrCreate(['name->en' => $country['name']['en']], $country);
    }
}
