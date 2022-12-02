## Make clone to project
```
git clone https://github.com/MahmoudKon/laravel_9.git
```

## Go inside the project
```
cd laravel_9
```

## Create database
* copy .env.example and rename it to .env
* set database config in your inv file

## Create key
```
php artisan key:generate
```

## Install composer
```
composer install --ignore-platform-reqs

```

## Generat data
```
php artisan migrate --seed
```

## Run project
```
php artisan serve
```


## Photos

<p>1- Login Page</p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/login.png" alt="login page">
</p>

<p>2- Dashboard Page</p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/home.png" alt="home page">
</p>

<p>3- Full Translations Page [ ar / en ]</p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/trans.png" alt="trans page">
</p>

<p>4- Profile page</p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/profile.png" alt="profile page">
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/profile2.png" alt="profile page">
</p>

<p>5- Lock Screen page</p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/lockscreen.png" alt="lockscreen page">
</p>

<p>6- Settings for site</p>
- auto load setting in cache when site use it all time like [site name / logo / audios for notifications and alarms]
- can close setting if you won't use it again
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/settings.png" alt="settings page">
</p>

<p>7- Create / Update Setting Form</p>
- after select content type, will show input with selected type
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/setting-form.png" alt="setting-form page">
</p>

<p>8- Content Type For Settings</p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/content-types.png" alt="content-types page">
</p>

<p>9- Menu</p>
- full controll on menu
    1- drag and drop.
    2- close tap or specific link, to can't anyone open page. [only super admin role can open page]
    3- reorder.
    4- create / update / delete
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/menus.png" alt="menus page">
</p>

<p>9- Menu</p>
- full controll on menu
    1- drag and drop.
    2- close tap or specific link, to can't anyone open page. [only super admin role can open page]
    3- reorder.
    4- create / update / delete
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/menus.png" alt="menus page">
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/menu-form.png" alt="menu-form page">
</p>

<p>10- Roles</p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/roles.png" alt="roles page">
</p>

<p>11- Assign Routes To Roles</p>
    1- select controller to list his methods.
    2- when input is check for route in role, then role can use this route
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/assign-role-form.png" alt="assign-role-form page">
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/assign.png" alt="assign page">
</p>

<p>12- ease to search in relations table using yajra datatable</p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/users.png" alt="users page">
</p>

<p>13- ease to make your custom search</p>
    1- just create route like this [change users word and controller name]
        ``` Route::get('users/search/form', 'UserControllersearch')->name('users.search.form'); ```
    2- in {users} folder add `` search.blade.php `` have only inputs without form tag
    3- in Model have scopeFilter in this scope can add all your form conditions
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/search.png" alt="search page">
</p>

