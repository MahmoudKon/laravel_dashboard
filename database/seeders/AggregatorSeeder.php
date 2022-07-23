<?php

namespace Database\Seeders;

use App\Models\Aggregator;
use Illuminate\Database\Seeder;

class AggregatorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            ['title' => 'Arpu' ,      'ratio' => "0.00"],
            ['title' => 'DIGI ZONE',  'ratio' => '0.40'],
            ['title' => 'IVAS' ,      'ratio' => "0.00"],
            ['title' => 'ON Mobil',   'ratio' => "0.00"],
            ['title' => 'IDEX' ,      'ratio' => "0.00"],
        ];

        foreach ($rows as $row) Aggregator::firstOrCreate(['title' => $row['title']], $row);
    }
}
