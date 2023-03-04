<?php

namespace Database\Seeders;

use App\Constants\SettingType;
use App\Models\InputType;
use Illuminate\Database\Seeder;

class InputTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        truncateTables('input_types');

        $types = [
            ['name' => SettingType::ADVANCED_TEXT],
            ['name' => SettingType::NORMAL_TEXT],
            ['name' => SettingType::IMAGE],
            ['name' => SettingType::AUDIO],
            ['name' => SettingType::VIDEO],
            ['name' => SettingType::EXTERNAL_LINK],
            ['name' => SettingType::SELECT],
            ['name' => SettingType::TIME],
            ['name' => SettingType::WEEKEND_DAYS],
            ['name' => SettingType::FILE],
            ['name' => SettingType::DATE],
            ['name' => SettingType::LANGUAGES],
        ];

        foreach ($types as $type) InputType::firstOrCreate(['name' => $type['name']], $type);
    }
}
