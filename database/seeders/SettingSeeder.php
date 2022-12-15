<?php

namespace Database\Seeders;

use App\Models\ContentType;
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
                'content_type_id' => ContentType::where('name', 'LIKE', '%Image%')->first()->id,
                'active' => true,
                'autoload' => true,
            ], [
                'key' => 'site_name',
                'value' => env('APP_NAME', 'Laravel'),
                'content_type_id' => ContentType::where('name', 'LIKE', '%Normal Text%')->first()->id,
                'active' => true,
                'autoload' => true,
            ], [
                'key' => 'success_audio',
                'value' => 'samples/audios/success.mp3',
                'content_type_id' => ContentType::where('name', 'LIKE', '%Audio%')->first()->id,
                'active' => true,
                'autoload' => true,
            ], [
                'key' => 'warrning_audio',
                'value' => 'samples/audios/warrning.mp3',
                'content_type_id' => ContentType::where('name', 'LIKE', '%Audio%')->first()->id,
                'active' => true,
                'autoload' => true,
            ], [
                'key' => 'notification_audio',
                'value' => 'samples/audios/notification.mp3',
                'content_type_id' => ContentType::where('name', 'LIKE', '%Audio%')->first()->id,
                'active' => true,
                'autoload' => true,
            ], [
                'key' => 'default_lang',
                'value' => 'ar',
                'content_type_id' => ContentType::where('name', 'LIKE', '%Languages%')->first()->id,
                'active' => true,
                'autoload' => true,
            ], [
                'key' => 'route_prefix',
                'value' => 'dashboard',
                'content_type_id' => ContentType::where('name', 'LIKE', '%Normal Text%')->first()->id,
                'active' => true,
                'autoload' => true,
            ]
        ];

        foreach ($rows as $row) {
            Setting::updateOrCreate(['key' => $row['key']], $row);
        }
    }
}
