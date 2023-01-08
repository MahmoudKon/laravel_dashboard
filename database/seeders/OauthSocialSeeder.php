<?php

namespace Database\Seeders;

use App\Models\OauthSocial;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OauthSocialSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        truncateTables('oauth_socials');

        $socials = [
            [
                'display_name'  => 'Github',
                'name'          => 'github',
                'icon'          => 'fa-brands fa-github',
                'color'         => '#444444'
            ], [
                'display_name'  => 'Google',
                'name'          => 'google',
                'icon'          => 'fa-brands fa-google',
                'color'         => '#dd4b39'
            ], [
                'display_name'  => 'Gitlab',
                'name'          => 'gitlab',
                'icon'          => 'fa-brands fa-gitlab',
                'color'         => '#FF7E39'
            ], [
                'display_name'  => 'Facebook',
                'name'          => 'facebook',
                'icon'          => 'fa-brands fa-facebook-f',
                'color'         => '#3b5998'
            ],
        ];

        foreach ($socials as $social) OauthSocial::firstOrCreate($social, $social);
    }
}
