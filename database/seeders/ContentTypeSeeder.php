<?php

namespace Database\Seeders;

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
        $types = [
            ['visible_to_content' => true,  'name' => 'Advanced Text'],
            ['visible_to_content' => true,  'name' => 'Normal Text'],
            ['visible_to_content' => true,  'name' => 'Image'],
            ['visible_to_content' => true,  'name' => 'Audio'],
            ['visible_to_content' => true,  'name' => 'Video'],
            ['visible_to_content' => true,  'name' => 'external video link'],
            ['visible_to_content' => false, 'name' => 'selector'],
            ['visible_to_content' => false, 'name' => 'Time'],
            ['visible_to_content' => false, 'name' => 'Week Days'],
            ['visible_to_content' => false, 'name' => 'File'],
            ['visible_to_content' => false, 'name' => 'Languages'],
        ];

        foreach ($types as $type) ContentType::firstOrCreate(['name' => $type['name']], $type);
    }
}
