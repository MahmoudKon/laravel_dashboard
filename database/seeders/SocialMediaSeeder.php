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
                'icon'  => 'fa-brands fa-facebook-f',
                'color' => '#3b5998',
                'url'   => 'https://www.facebook.com/MahmoudK0n',
            ], [
                'name'  => 'Whatsapp',
                'icon'  => 'fa-brands fa-whatsapp',
                'color' => '#198754',
                'url'   => 'https://wa.me/01156455369',
            ], [
                'name'  => 'LinkedIn',
                'icon'  => 'fa-brands fa-linkedin-in',
                'color' => '#007ba7',
                'url'   => 'https://www.linkedin.com/in/mahmoud-mohammed-00b74418a/',
            ],  [
                'name'  => 'Github',
                'icon'  => 'fa-brands fa-github',
                'color' => '#444444',
                'url'   => 'https://github.com/MahmoudKon',
            ],
        ];

        foreach ($rows as $row)
            SocialMedia::updateOrCreate(['name' => $row['name']], $row);
    }
}
