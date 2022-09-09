<?php

namespace Database\Seeders;

use App\Constants\SettingType;
use App\Models\ContentType;
use Illuminate\Database\Seeder;

class ContentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        truncateTables('content_types');

        $types = [
            ['visible_to_content' => true,  'name' => SettingType::ADVANCED_TEXT],
            ['visible_to_content' => true,  'name' => SettingType::NORMAL_TEXT],
            ['visible_to_content' => true,  'name' => SettingType::IMAGE],
            ['visible_to_content' => true,  'name' => SettingType::AUDIO],
            ['visible_to_content' => true,  'name' => SettingType::VIDEO],
            ['visible_to_content' => true,  'name' => SettingType::EXTERNAL_LINK],
            ['visible_to_content' => false, 'name' => SettingType::SELECT],
            ['visible_to_content' => false, 'name' => SettingType::TIME],
            ['visible_to_content' => false, 'name' => SettingType::WEEKEND_DAYS],
            ['visible_to_content' => false, 'name' => SettingType::FILE],
            ['visible_to_content' => false, 'name' => SettingType::DATE],
            ['visible_to_content' => false, 'name' => SettingType::LANGUAGES],
        ];

        foreach ($types as $type) ContentType::firstOrCreate(['name' => $type['name']], $type);
    }
}
