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
<p>     * auto load setting in cache when site use it all time like [site name / logo / audios for notifications and alarms] </p>
<p>     * can close setting if you won't use it again </p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/settings.png" alt="settings page">
</p>

<p>7- Create / Update Setting Form</p>
<p> * after select content type, will show input with selected type </p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/setting-form.png" alt="setting-form page">
</p>

<p>8- Content Type For Settings</p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/content-types.png" alt="content-types page">
</p>

<p>9- Menu</p>
    <p> - full controll on menu </p>
    <p>     * drag and drop. </p>
    <p>     * close tap or specific link, to can't anyone open page. [only super admin role can open page] </p>
    <p>     * reorder. </p>
    <p>     * create / update / delete </p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/menus.png" alt="menus page">
</p>

<p>10- Roles</p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/roles.png" alt="roles page">
</p>

<p>11- Assign Routes To Roles</p>
    <p> * select controller to list his methods. </p>
    <p> * when input is check for route in role, then role can use this route </p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/assign-role-form.png" alt="assign-role-form page">
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/assign.png" alt="assign page">
</p>

<p>12- ease to search in relations table using yajra datatable</p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/users.png" alt="users page">
</p>

<p>13- ease to make your custom search</p>
    <p> * just create route like this [change users word and controller name] </p>
        ``` Route::get('users/search/form', 'UserControllersearch')->name('users.search.form'); ```
    <p> * in {users} folder add `` search.blade.php `` have only inputs without form tag </p> 
    <p> * in Model have scopeFilter in this scope can add all your form conditions </p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/search.png" alt="search page">
</p>

<p>14- Email System</p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/email-form.png" alt="email-form page">
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/email-body.png" alt="email-body page">
</p>


## features

<p> 1- on each controller have 3 properties</p>
<p>     * use_form_ajax => if true, form create / update will submit using ajax and display validation errors if have, after success will redirect to any page you set it on store method</p>
<p>     * use_button_ajax => if true, link create and update and delete will use ajax [ the form will open in modal ]</p>
<p>     * full_page_ajax or make use_form_ajax && use_button_ajax is true, open form and submit will do in the same page, no have redirect </p>

<p> 2- have command to create </p>
<p>  * Model with relations & fillable & scope filter and slug method to display the row name in breadcrumb section </p>
<p>  * Request class with all validations and attributs translation </p>
<p>  * Datatable class with load relations & columns & multidelete / create buttons </p>
<p>  * Service class to handle create / update </p>
<p>  * Controller with some method </p>
<p>  * append translation columns in translation files </p>
<p>  * append routes in route file </p>
<p>  * create new menu for new model </p>
<p>  * create form blade with all inputs from fillable </p>


<p> Use Command </p>
<p> 1- create your migration table in make migrate </p>
<p> some Notes: </p>
<p>    * to create translation column with type json, please add comment ('translations')</p>
<p>    * to create input image in form add comment ('image') for the column</p>
<p>    * to create input video in form add comment ('video') for the column</p>
<p>    * to create input audio in form add comment ('audio') for the column</p>
<p>    * to create input file in form add comment ('file') for the column</p>

<p>2- run this command</p>
```
php artisan make:crud table_name
```
<p>and can append all created file in specific new dir, use this argument '--namespace=New'</p>
<p>will append to namespace for class the namespace argument</p>

# and enjoy


### to contact with me for any question <a href='https://www.facebook.com/MahmoudK0n/'> facebook </a>

# Sorry for the poor explanation and my poor English


