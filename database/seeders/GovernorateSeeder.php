<?php

namespace Database\Seeders;

use App\Models\Governorate;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GovernorateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        truncateTables('governorates');

        $governorates = [
            ['name' => ['en' => 'Cairo'          , 'ar' => 'القاهرة']],
            ['name' => ['en' => 'Giza'           , 'ar' => 'الجيزة']],
            ['name' => ['en' => 'Alexandria'     , 'ar' => 'الأسكندرية']],
            ['name' => ['en' => 'Dakahlia'       , 'ar' => 'الدقهلية']],
            ['name' => ['en' => 'Red Sea'        , 'ar' => 'البحر الأحمر']],
            ['name' => ['en' => 'Beheira'        , 'ar' => 'البحيرة']],
            ['name' => ['en' => 'Fayoum'         , 'ar' => 'الفيوم']],
            ['name' => ['en' => 'Gharbiya'       , 'ar' => 'الغربية']],
            ['name' => ['en' => 'Ismailia'       , 'ar' => 'الإسماعلية']],
            ['name' => ['en' => 'Menofia'        , 'ar' => 'المنوفية']],
            ['name' => ['en' => 'Minya'          , 'ar' => 'المنيا']],
            ['name' => ['en' => 'Qaliubiya'      , 'ar' => 'القليوبية']],
            ['name' => ['en' => 'New Valley'     , 'ar' => 'الوادي الجديد']],
            ['name' => ['en' => 'Suez'           , 'ar' => 'السويس']],
            ['name' => ['en' => 'Aswan'          , 'ar' => 'اسوان']],
            ['name' => ['en' => 'Assiut'         , 'ar' => 'اسيوط']],
            ['name' => ['en' => 'Beni Suef'      , 'ar' => 'بني سويف']],
            ['name' => ['en' => 'Port Said'      , 'ar' => 'بورسعيد']],
            ['name' => ['en' => 'Damietta'       , 'ar' => 'دمياط']],
            ['name' => ['en' => 'Sharkia'        , 'ar' => 'الشرقية']],
            ['name' => ['en' => 'South Sinai'    , 'ar' => 'جنوب سيناء']],
            ['name' => ['en' => 'Kafr Al sheikh' , 'ar' => 'كفر الشيخ']],
            ['name' => ['en' => 'Matrouh'        , 'ar' => 'مطروح']],
            ['name' => ['en' => 'Luxor'          , 'ar' => 'الأقصر']],
            ['name' => ['en' => 'Qena'           , 'ar' => 'قنا']],
            ['name' => ['en' => 'North Sinai'    , 'ar' => 'شمال سيناء']],
            ['name' => ['en' => 'Sohag'          , 'ar' => 'سوهاج']],
        ];

        foreach ($governorates as $governorate) Governorate::updateOrCreate(['name->ar' => $governorate['name']['ar']], $governorate);
    }
}
