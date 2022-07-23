<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Operator;
use Illuminate\Database\Seeder;

class OperatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $egypt_id = Country::where('name->en', 'Egypt')->first()->id ?? null;
        $ksa_id = Country::where('name->en', 'KSA')->first()->id ?? null;
        $kuwait_id = Country::where('name->en', 'Kuwait')->first()->id ?? null;

        $operators = [
            [
                'name' => ['en' => 'We', 'ar' => 'وي'],
                'country_id' => $egypt_id
            ], [
                'name' => ['en' => 'Orange', 'ar' => 'اورانج'],
                'country_id' => $egypt_id
            ], [
                'name' => ['en' => 'Etisalat', 'ar' => 'اتصالات'],
                'country_id' => $egypt_id
            ],[
                'name' => ['en' => 'Vodafone', 'ar' => 'فودافون'],
                'country_id' => $egypt_id
            ], [
                'name' => ['en' => 'Ooredoo', 'ar' => 'اوريدو'],
                'country_id' => $kuwait_id
            ], [
                'name' => ['en' => 'Zain', 'ar' => 'زين'],
                'country_id' => $kuwait_id
            ], [
                'name' => ['en' => 'Zain', 'ar' => 'زين'],
                'country_id' => $ksa_id
            ], [
                'name' => ['en' => 'STC', 'ar' => 'إس تي سي'],
                'country_id' => $ksa_id
            ],
        ];

        foreach ($operators as $operator)
            Operator::firstOrCreate([
                    'name->en' => $operator['name']['en'],
                    'country_id' => $operator['country_id']
                ], $operator);
    }
}
