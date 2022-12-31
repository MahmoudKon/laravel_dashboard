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

        $this->insertParents();
        $this->insertSecondLevel();
        $this->insertThirdLevel();
    }

    protected function insertParents()
    {
        $menus = [
            [
                'name' => ["en" => "Dashboard", "ar" => "لوحة التحكم"],
                'route' => "/",
                'icon' => "fas fa-tachometer",
            ], [
                'name' => ["en" => "Configurations", "ar" => "التكوينات"],
                'route' => null,
                'icon' => "fa fa-gears",
                'parent_id' => null
            ], [
                'name' => ["en" => "Countries", "ar" => "البلاد"],
                'icon' => "fas fa-globe-africa",
            ], [
                'name' => ["en" => "Routes", "ar" => "المسارات"],
                'icon' => "fas fa-anchor",
            ], [
                'name' => ["en" => "Roles", "ar" => "الصلاحيات"],
                'route' => "roles.index",
                'icon' => "fas fa-check",
            ], [
                'name' => ["en" => "Permissions", "ar" => "الأذونات"],
                'route' => "permissions.index",
                'icon' => "fas fa-shield",
            ], [
                'name' => ["en" => "Departments", "ar" => "الأقسام"],
                'icon' => "fas fa-home",
            ], [
                'name' => ["en" => "Users", "ar" => "المستخدمين"],
                'icon' => "fas fa-users",
            ], [
                'name' => ["en" => "Announcements", "ar" => "الإعلانات"],
                'icon' => "fas fa-bullhorn",
                'route' => "announcements.index",
            ], [
                'name' => ["en" => "Languages", "ar" => "اللغات"],
                'icon' => "fa-solid fa-language",
                'route' => "languages.index",
            ], [
                'name' => ["en" => "Clients", "ar" => "العملاء"],
                'icon' => "fa-solid fa-user-secret",
                'route' => "clients.index",
            ],
        ];

        $this->saveMenus($menus);
    }

    protected function insertSecondLevel()
    {
        $Configurations = Menu::where('name->en', 'Configurations')->First()->id;
        $Countries = Menu::where('name->en', 'Countries')->First()->id;
        $Routes = Menu::where('name->en', 'Routes')->First()->id;
        $Users = Menu::where('name->en', 'Users')->First()->id;
        $Departments = Menu::where('name->en', 'Departments')->First()->id;
        $menus = [
            [
                'name' => ["en" => "Simulate", "ar" => "المحاكاة"],
                'route' => "simulate.index",
                'icon' => "fas fa-clone",
                'parent_id' => $Configurations
            ], [
                'name' => ["en" => "Commands", "ar" => "الأوامر"],
                'route' => "commands.index",
                'icon' => "fa-solid fa-terminal",
                'parent_id' => $Configurations
            ], [
                'name' => ["en" => "Settings", "ar" => "الإعدادات"],
                'route' => "settings.index",
                'icon' => "fas fa-gear",
                'parent_id' => $Configurations
            ], [
                'name' => ["en" => "Database", "ar" => "قاعدة البيانات"],
                'route' => "database.index",
                'icon' => "fa-solid fa-database",
                'parent_id' => $Configurations
            ], [
                'name' => ["en" => "Menus", "ar" => "القوائم"],
                'route' => "menus.index",
                'icon' => "fas fa-bars",
                'parent_id' => $Configurations
            ], [
                'name' => ["en" => "Oauth Socials", "ar" => "Oauth Socials"],
                'route' => "oauth_socials.index",
                'icon' => "fas fa-icons",
                'parent_id' => $Configurations
            ], [
                'name' => ["en" => "Social Medias", "ar" => "وسائل التواصل الاجتماعي"],
                'route' => "social_medias.index",
                'icon' => "fas fa-icons",
                'parent_id' => $Configurations
            ], [
                'name' => ["en" => "Image Tools", "ar" => "أدوات الصور"],
                'icon' => "fas fa-image",
                'parent_id' => $Configurations
            ], [
                'name' => ["en" => "Content Types", "ar" =>"أنواع المحتوي"],
                'route' => "content_types.index",
                'icon' => "fa fa-folder",
                'parent_id' => $Configurations
            ], [
                'name' => ["en" => "File Manager", "ar" => "مدير الملفات"],
                'route' => "file.manager",
                'icon' => "fa fa-folder",
                'parent_id' => $Configurations
            ], [
                'name' => ["en" => "Governorates", "ar" => "المحافظات"],
                'route' => "governorates.index",
                'icon' => "fas fa-list",
                'parent_id' => $Countries
            ], [
                'name' => ["en" => "Cities", "ar" => "المدن"],
                'route' => "cities.index",
                'icon' => "fas fa-list",
                'parent_id' => $Countries
            ], [
                'name' => ["en" => "List Routes", "ar" => "عرض المسارات"],
                'route' => "routes.index",
                'icon' => "fa fa-list",
                'parent_id' => $Routes
            ], [
                'name' => ["en" => "Assign Roles", "ar" => "تمكين صلاحيات"],
                'route' => "routes.assign",
                'icon' => "fa fa-link",
                'parent_id' => $Routes
            ], [
                'name' => ["en" => "List Users", "ar" => "عرض المستخدمين"],
                'route' => "users.index",
                'icon' => "fas fa-list",
                'parent_id' => $Users
            ], [
                'name' => ["en" => "list Departments", "ar" => "عرض الأقسام"],
                'route' => "departments.index",
                'icon' => "fa fa-list",
                'parent_id' => $Departments
            ], [
                'name' => ["en" => "Create Departments", "ar" => "إنشاء قسم"],
                'route' => "departments.create",
                'icon' => "fa fa-plus",
                'parent_id' => $Departments
            ], [
                'name' => ["en" => "Create Users", "ar" => "إنشاء مستخدم"],
                'route' => "users.create",
                'icon' => "fas fa-plus",
                'parent_id' => $Users
            ],
        ];

        $this->saveMenus($menus);
    }

    protected function insertThirdLevel()
    {
        $Image_Tools = Menu::where('name->en', 'Image Tools')->First()->id;
        $menus = [
            [
                'name' => ["en" => "Image Quality", "ar" => "جودة الصورة"],
                'route' => "image.cropper",
                'route' => "image.quality",
                'icon' => "fas fa-paint-brush",
                'parent_id' => $Image_Tools
            ], [
                'name' => ["en" => "image-cropper", "ar" => "إقتصاص الصور"],
                'route' => "image.cropper",
                'icon' => "fas fa-crop",
                'parent_id' => $Image_Tools
            ],
        ];

        $this->saveMenus($menus);
    }

    protected function saveMenus($menus)
    {
        foreach ($menus as $menu) {
            $route  = $menu['route'] ?? null;
            $parent = $menu['parent_id'] ?? null;
            $name   = $menu['name']['en'];
            Menu::firstOrCreate(['route' => $route, 'name->en' => $name, 'parent_id' => $parent], $menu);
        }
    }
}
