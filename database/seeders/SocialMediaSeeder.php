<?php

namespace Database\Seeders;

use App\Models\SocialMedia;
use Illuminate\Database\Seeder;

class SocialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rows = [
            [
                'name'  => 'Facebook',
                'icon'  => 'fa-brands fa-facebook',
                'color' => '#3b5998',
                'url' => 'https://www.facebook.com/MahmoudK0n',
            ], [
                'name'  => 'Whatsapp',
                'icon'  => 'fa-brands fa-whatsapp',
                'color' => '#198754',
                'url' => 'https://www.facebook.com/MahmoudK0n',
            ], [
                'name'  => 'Twitter',
                'icon'  => 'fa-brands fa-twitter',
                'color' => '#00ACEE',
                'url' => 'https://www.facebook.com/MahmoudK0n',
            ],
        ];

        foreach ($rows as $row)
            SocialMedia::updateOrCreate(['name' => $row['name']], $row);
    }
}
