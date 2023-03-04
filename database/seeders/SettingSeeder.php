<?php

namespace Database\Seeders;

use App\Models\InputType;
use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        truncateTables('settings');

        $rows = [
            [
                'key' => 'logo',
                'value' => 'samples/images/logo.png',
                'input_type_id' => InputType::where('name', 'LIKE', '%Image%')->first()->id,
                'active' => true,
                'autoload' => true,
            ], [
                'key' => 'site_name',
                'value' => env('APP_NAME', 'Laravel'),
                'input_type_id' => InputType::where('name', 'LIKE', '%Normal Text%')->first()->id,
                'active' => true,
                'autoload' => true,
            ], [
                'key' => 'success_audio',
                'value' => 'samples/audios/success.mp3',
                'input_type_id' => InputType::where('name', 'LIKE', '%Audio%')->first()->id,
                'active' => true,
                'autoload' => true,
            ], [
                'key' => 'warrning_audio',
                'value' => 'samples/audios/warrning.mp3',
                'input_type_id' => InputType::where('name', 'LIKE', '%Audio%')->first()->id,
                'active' => true,
                'autoload' => true,
            ], [
                'key' => 'notification_audio',
                'value' => 'samples/audios/notification.mp3',
                'input_type_id' => InputType::where('name', 'LIKE', '%Audio%')->first()->id,
                'active' => true,
                'autoload' => true,
            ], [
                'key' => 'default_lang',
                'value' => 'ar',
                'input_type_id' => InputType::where('name', 'LIKE', '%Languages%')->first()->id,
                'active' => true,
                'autoload' => true,
            ], [
                'key' => 'route_prefix',
                'value' => 'dashboard',
                'input_type_id' => InputType::where('name', 'LIKE', '%Normal Text%')->first()->id,
                'active' => true,
                'autoload' => true,
            ]
        ];

        foreach ($rows as $row) {
            Setting::updateOrCreate(['key' => $row['key']], $row);
        }
    }
}
