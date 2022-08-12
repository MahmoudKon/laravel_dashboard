<?php

namespace Database\Seeders;

use App\Console\Commands\SaveRoutesInDatabase;
use Illuminate\Database\Seeder;

class RouteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        truncateTables('routes');

        dispatch(new SaveRoutesInDatabase());
    }
}
