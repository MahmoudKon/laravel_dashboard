<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Traits\UploadFile;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    use UploadFile;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            ['name' => ['en' => 'Quran', 'ar' => 'القرآن']],
            ['name' => ['en' => 'Prayer', 'ar' => 'دعاء']],
            ['name' => ['en' => 'Explanation', 'ar' => 'تفسير']],
            ['name' => ['en' => 'Chant', 'ar' => 'اناشيد']],
        ];

        $images = $this->GetApiImage('animals');
        foreach ($categories as $index => $category)
            Category::firstOrCreate(
                ['name->en' => $category['name']['en']],
                $category + ['image' => $this->uploadApiImage($images[$index]['src']['medium'], 'categories')]
            );
    }
}
