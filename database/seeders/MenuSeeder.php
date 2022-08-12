<?php

namespace Database\Seeders;

use App\Models\Menu;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        truncateTables('menus');

        $menus = [
            1 => [
                'name' => ["en" => "Dashboard", "ar" => "لوحة التحكم"],
                'route' => "/",
                'icon' => "fa fa-tachometer",
                'parent_id' => null
            ],
            2 => [
                'name' => ["en" => "Configurations", "ar" => "التكوينات"],
                'route' => null,
                'icon' => "fa fa-gears",
                'parent_id' => null
            ],
            3 => [
                'name' => ["en" => "Settings", "ar" => "الإعدادات"],
                'route' => "settings.index",
                'icon' => "fa fa-gear",
                'parent_id' => 2
            ],
            4 => [
                'name' => ["en" => "Menus", "ar" => "القوائم"],
                'route' => "menus.index",
                'icon' => "fa fa-bars",
                'parent_id' => 2
            ],
            5 => [
                'name' => ["en" => "Image Tools", "ar" => "أدوات الصور"],
                'route' => null,
                'icon' => "fa fa-image",
                'parent_id' => 2
            ],
            6 => [
                'name' => ["en" => "Routes", "ar" => "المسارات"],
                'route' => null,
                'icon' => "fa fa-anchor",
                'parent_id' => null
            ],
            7 => [
                'name' => ["en" => "List Routes", "ar" => "عرض المسارات"],
                'route' => "routes.index",
                'icon' => "fa fa-list",
                'parent_id' => 6
            ],
            8 => [
                'name' => ["en" => "Assign Roles", "ar" => "تمكين صلاحيات"],
                'route' => "routes.assign",
                'icon' => "fa fa-link",
                'parent_id' => 6
            ],
            9 => [
                'name' => ["en" => "Roles", "ar" => "الأدوار"],
                'route' => "roles.index",
                'icon' => "fa fa-check",
                'parent_id' => null
            ],
            10 => [
                'name' => ["en" => "Permissions", "ar" => "الأذونات"],
                'route' => "permissions.index",
                'icon' => "fa fa-shield",
                'parent_id' => null
            ],
            11 => [
                'name' => ["en" => "Users", "ar" => "المستخدمين"],
                'route' => null,
                'icon' => "fa fa-users",
                'parent_id' => null
            ],
            12 => [
                'name' => ["en" => "List Users", "ar" => "عرض المستخدمين"],
                'route' => "users.index",
                'icon' => "fa fa-list",
                'parent_id' => 11
            ],
            13 => [
                'name' => ["en" => "Create Users", "ar" => "إنشاء مستخدم"],
                'route' => "users.create",
                'icon' => "fa fa-plus",
                'parent_id' => 11
            ],
            14 => [
                'name' => ["en" => "Departments", "ar" => "الأقسام"],
                'route' => null,
                'icon' => "fa fa-home",
                'parent_id' => null
            ],
            15 => [
                'name' => ["en" => "list Departments", "ar" => "عرض الأقسام"],
                'route' => "departments.index",
                'icon' => "fa fa-list",
                'parent_id' => 14
            ],
            16 => [
                'name' => ["en" => "Create Departments", "ar" => "إنشاء قسم"],
                'route' => "departments.create",
                'icon' => "fa fa-plus",
                'parent_id' => 14
            ],
            17 => [
                'name' => ["en" => "Categories", "ar" => "التصنيفات"],
                'route' => "categories.index",
                'icon' => "fa fa-list",
                'parent_id' => null
            ],
            18 => [
                'name' => ["en" => "Countries", "ar" => "البلدان"],
                'route' => "countries.index",
                'icon' => "fa fa-globe",
                'parent_id' => null
            ],
            19 => [
                'name' => ["en" => "Operators", "ar" => "المشغلين"],
                'route' => "operators.index",
                'icon' => "fa fa-phone",
                'parent_id' => null
            ],
            20 => [
                'name' => ["en" => "Aggregators", "ar" =>"المجمعين"],
                'route' => "aggregators.index",
                'icon' => "fa fa-certificate",
                'parent_id' => null
            ],
            21 => [
                'name' => ["en" => "Contents", "ar" => "المحتوي"],
                'route' => null,
                'icon' => "fa fa-building-user",
                'parent_id' => null
            ],
            22 => [
                'name' => ["en" => "Content Types", "ar" =>"أنواع المحتوي"],
                'route' => "content_types.index",
                'icon' => "fa fa-folder",
                'parent_id' => 2
            ],
            23 => [
                'name' => ["en" => "List Contents", "ar" => "عرض المحتوي"],
                'route' => "contents.index",
                'icon' => "fa fa-list",
                'parent_id' => 21
            ],
            24 => [
                'name' => ["en" => "Create Content", "ar" => "إنشاء محتوي"],
                'route' => "contents.create",
                'icon' => "fa fa-plus",
                'parent_id' => 21
            ],
            25 => [
                'name' => ["en" => "Posts", "ar" => "المنشورات"],
                'route' => null,
                'icon' => "fa fa-share",
                'parent_id' => null
            ],
            26 => [
                'name' => ["en" => "List Posts", "ar" => "عرض المنشورات"],
                'route' => "posts.index",
                'icon' => "fa fa-list",
                'parent_id' => 25
            ],
            27 => [
                'name' => ["en" => "Create Post", "ar" => "إنشاء منشور"],
                'route' => "posts.create",
                'icon' => "fa fa-plus",
                'parent_id' => 25
            ],
            28 => [
                'name' => ["en" => "File Manager", "ar" => "مدير الملفات"],
                'route' => "file.manager",
                'icon' => "fa fa-folder",
                'parent_id' => 2
            ],
            29 => [
                'name' => ["en" => "Image Quality", "ar" => "جودة الصورة"],
                'route' => "image.cropper",
                'route' => "image.quality",
                'icon' => "fa fa-paint-brush",
                'parent_id' => 5
            ],
            30 => [
                'name' => ["en" => "image-cropper", "ar" => "إقتصاص الصور"],
                'route' => "image.cropper",
                'icon' => "fa fa-crop",
                'parent_id' => 5
            ],
            31 => [
                'name' => ["en" => "Governorates", "ar" => "المحافظات"],
                'route' => "governorates.index",
                'icon' => "fa fa-list",
                'parent_id' => null
            ],
            32 => [
                'name' => ["en" => "Cities", "ar" => "المدن"],
                'route' => "cities.index",
                'icon' => "fa fa-list",
                'parent_id' => null
            ],
        ];

        foreach ($menus as $menu) {
            Menu::firstOrCreate(['route' => $menu['route'], 'name->en' => $menu['name']['en']], $menu);
        }
    }
}
