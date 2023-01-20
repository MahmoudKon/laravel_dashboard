## Make clone to project
```
git clone https://github.com/MahmoudKon/new_laravel_9.git
```

## Go inside the project
```
cd  new_laravel_9
```

## Create database
* copy .env.example and rename it to .env
* set database config in your inv file

## Install composer
```
composer install --ignore-platform-reqs

```

## Create key
```
php artisan key:generate
```

## Install npm and build assets
```
npm install && npm run dev
```

## Generat data
```
php artisan migrate --seed
```

## Run project
```
php artisan queue:work
php artisan storage:link
php artisan serve
```


## Photos

<b>1- Login Page</b>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/login.png" alt="login page">
</p>

<b>2- Dashboard Page</b>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/home.png" alt="home page">
</p>

<b>3- Full Translations Page [ ar / en ]</b>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/trans.png" alt="trans page">
</p>

<b>4- Profile page</b>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/profile.png" alt="profile page">
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/profile2.png" alt="profile page">
</p>

<b>5- Lock Screen page</b>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/lockscreen.png" alt="lockscreen page">
</p>

<b>6- Settings for site</b>
* autoload setting in cache when site use it all time like [site name / logo / audios for notifications and alarms] </p>
* can close setting if you won't use it again </p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/settings.png" alt="settings page">
</p>

<b>7- Create / Update Setting Form</b>
- after select content type, will show input with selected type </p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/setting-form.png" alt="setting-form page">
</p>

<b>8- Content Type For Settings</b>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/content-types.png" alt="content-types page">
</p>

<b>9- Menu</b>
##### - full controll on menu :
* drag and drop.
* close tap or specific link, to can't anyone open page. [only super admin role can open page]
* reorder.
* create / update / delete
* can update menu seeder and click on sync menus button will update menu 
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/menus.png" alt="menus page">
</p>

<b>10- Roles</b>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/roles.png" alt="roles page">
</p>

<b>11- Assign Routes To Roles</b>
- select controller to list his methods. </p>
- when input is check for route in role, then role can use this route </p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/assign-role-form.png" alt="assign-role-form page">
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/assign.png" alt="assign page">
</p>

<b>12- ease to search in relations table using yajra datatable</p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/users.png" alt="users page">
</p>

<b>13- ease to make your custom search</b>

- just create route like this [change users word and controller name]
```
    Route::get('{users}/search/form', '{UserController}@search')->name('{users}.search.form');
```
- in {users} folder add `` search.blade.php `` have only inputs without form tag 
- in Model have scopeFilter in this scope can add all your form conditions
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/search.png" alt="search page">
</p>

<p>14- Email System</p>
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/email-form.png" alt="email-form page">
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/email-body.png" alt="email-body page">
</p>

<p>15- Languages</p>
- An easy way to active or disabled a language
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/lang.png" alt="Languages page">
</p>

<p>16- New page to list lang files</p>
- can create or edit for language file keys
<p>
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/translation-page.png" alt="email-form page">
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/edit-translation.png" alt="email-body page">
    <img src="https://github.com/MahmoudKon/new_laravel_9/blob/master/photos/create-translation.png" alt="email-body page">
</p>


## features

#### 1- on each controller have 3 properties</p>
* use_form_ajax => if true, form create / update will submit using ajax and display validation errors if have, after success will redirect to any page you set it on store method</p>
* use_button_ajax => if true, link create and update and delete will use ajax [ the form will open in modal ]</p>
* full_page_ajax or make use_form_ajax && use_button_ajax is true, open form and submit will do in the same page, no have redirect </p>

#### 2- have command to create
- Model with relations & fillable & scope filter and slug method to display the row name in breadcrumb section
- Request class with all validations and attributs translation
- Datatable class with load relations & columns & multidelete / create buttons
- Service class to handle create / update
- Controller with some method
- append translation columns in translation files
- append routes in route file
- create new menu for new model
- create form blade with all inputs from fillable


### Use Command
##### 1- create your migration table and make migrate </p>
<b> some Notes: </b>
- to create translation column with type json, please add comment ('translations')
- to create input image in form add comment ('image') for the column
- to create input video in form add comment ('video') for the column
- to create input audio in form add comment ('audio') for the column
- to create input file in form add comment ('file') for the column

###

#### 2- run this command
```
php artisan make:crud table_name
```
###### and can append all created file in specific new dir, use this argument '--namespace=New'
###### will append to namespace for class the namespace argument

#### and enjoy


##### to contact with me for any question <a href='https://www.facebook.com/MahmoudK0n/'> facebook </a>

#### Sorry for the poor explanation and my poor English


