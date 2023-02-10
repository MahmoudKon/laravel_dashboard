<?php

use Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index')->name('/');


Route::controller('SimulateController')->middleware(['role:Super Admin'])->group(function () {
    Route::get('simulate','index')->name('simulate.index');
    Route::post('simulate/{command}','runCommand')->name('simulate.command');
});

Route::get('file-manager', 'FileManagerController@index')->name('file.manager');

Route::controller('RouteController')->as('routes.')->prefix('routes')->group(function () {
    Route::get('/','index')->name('index');
    Route::get('download','download')->name('download');
    Route::get('sync-routes','syncRoutes')->name('syncRoutes');
    Route::get('sync-permissions','syncPermissions')->name('syncPermissions');
    Route::get('{route}/edit','edit')->name('edit');
    Route::put('{route}/update','update')->name('update');
    Route::get('assign-roles','assign')->name('assign');
    Route::post('assign-roles','assignRoles')->name('assign-roles');
});

Route::controller('DatabaseController')->as('database.')->prefix('database')->group(function () {
    Route::get('/','index')->name('index');
    Route::get('{table}','show')->name('show');
});


Route::resource('users','UserController');
Route::controller('UserController')->prefix('users')->as('users.')->group(function () {
    Route::post('multidelete', 'multidelete')->name('multidelete');
    Route::get('excel/export', 'export')->name('excel.export');
    Route::get('excel/import', 'import')->name('excel.import.form');
    Route::post('excel/import', 'saveImport')->name('excel.import');
    Route::get('search/form', 'search')->name('search.form');
    Route::get('force/logout', 'forceLogout')->name('force.logout');
});


Route::controller('ProfileController')->prefix('profile')->as('profile.')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::put('info', 'info')->name('info');
    Route::put('avatar', 'avatar')->name('avatar');
    Route::put('password', 'password')->name('password');
    Route::put('roles', 'roles')->name('roles');
    Route::put('permissions', 'permissions')->name('permissions');
});


Route::resource('departments','DepartmentController');
Route::post('departments/multidelete', 'DepartmentController@multidelete')->name('departments.multidelete');


Route::resource('roles','RoleController');
Route::controller('RoleController')->as('roles.')->prefix('roles')->group(function () {
    Route::post('get/permissions', 'getPermissions')->name('permissions');
    Route::post('multidelete', 'multidelete')->name('multidelete');
    Route::get('{role}/clone/routes', 'cloneRoutes')->name('clone.routes');
    Route::post('{role}/clone/routes', 'saveCloneRoutes')->name('save.clone.routes');
});


Route::resource('permissions','PermissionController')->except('show');
Route::post('permissions/multidelete', 'PermissionController@multidelete')->name('permissions.multidelete');


Route::resource('settings','SettingController')->except('show');
Route::controller('SettingController')->prefix('settings')->as('settings.')->group(function () {
    Route::post('type/input', 'getTypeInput')->name('type.input');
    Route::post('multidelete', 'multidelete')->name('multidelete');
    Route::post('{setting}/column/{column}/toggle', 'columnToggle')->name('column.toggle');
});



Route::resource('content_types','ContentTypeController')->except('show');
Route::post('content_types/multidelete', 'ContentTypeController@multidelete')->name('content_types.multidelete');
Route::post('content_types/{setting}/column/{column}/toggle', 'ContentTypeController@columnToggle')->name('content_types.column.toggle');


Route::controller('MenuController')->prefix('menus')->as('menus.')->group(function () {
    Route::get('{menu}/subs/create', 'create')->name('subs.create');
    Route::post('{menu}/toggle/visible', 'toggleVisible')->name('toggle.visible');
    Route::post('reorder', 'reorder')->name('reorder');
    Route::get('sync', 'sync')->name('sync');
});
Route::resource('menus', 'MenuController')->except('show');


Route::controller('ImageToolController')->group(function () {
    Route::get('image-cropper', 'imageCrop')->name('image.cropper');
    Route::get('image-quality', 'ChangeQuality')->name('image.quality');
});


Route::get('emails/read', 'EmailController@read')->name('emails.read');
Route::resource('emails', 'EmailController')->only(['index', 'store', 'create', 'destroy', 'show']);
Route::post('emails/count', 'EmailController@count')->name('emails.count');
Route::post('emails/list', 'EmailController@list')->name('emails.list');
Route::post('emails/new/{limit?}', 'EmailController@new')->name('emails.list.new');



Route::resource('governorates', 'GovernorateController')->except('show');
Route::post('governorates/multidelete', 'GovernorateController@multidelete')->name('governorates.multidelete');

Route::resource('cities', 'CityController')->except('show');
Route::post('cities/multidelete', 'CityController@multidelete')->name('cities.multidelete');

Route::resource('announcements', 'AnnouncementController');
Route::controller('AnnouncementController')->as('announcements.')->prefix('announcements')->group(function () {
    Route::post('multidelete', 'multidelete')->name('multidelete');
    Route::post('{announcement}/column/{column}/toggle', 'columnToggle')->name('column.toggle');
    Route::get('search/form', 'search')->name('search.form');
});


Route::controller('LanguageController')->as('languages.')->prefix('languages')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('{language}/edit', 'edit')->name('edit');
    Route::put('{language}', 'update')->name('update');
    Route::post('{language}/column/{column}/toggle', 'columnToggle')->name('column.toggle');
    Route::get('{language}', 'show')->name('show');
    Route::get('{language}/trans/create', 'transCreate')->name('trans.create');
    Route::post('{language}/trans', 'transStore')->name('trans.store');
    Route::get('{language}/trans/{key}/edit', 'transEdit')->name('trans.edit');
    Route::put('{language}/trans/{key}', 'transUpdate')->name('trans.update');
});

Route::resource('clients', 'ClientController');
Route::post('clients/multidelete', 'ClientController@multidelete')->name('clients.multidelete');

Route::controller('CommandController')->as('commands.')->prefix('commands')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::post('{command}/info', 'commandInfo')->name('command.info');
    Route::post('call', 'call')->name('call');
});

Route::resource('oauth_socials', 'OauthSocialController');
Route::controller('OauthSocialController')->as('oauth_socials.')->prefix('oauth_socials')->group(function () {
    Route::post('multidelete', 'multidelete')->name('multidelete');
    Route::post('{oauth_social}/column/{column}/toggle', 'columnToggle')->name('column.toggle');
});

Route::resource('social_medias', 'SocialMediaController');
Route::post('social_medias/multidelete', 'SocialMediaController@multidelete')->name('social_medias.multidelete');
Route::post('social_medias/{oauth_social}/column/{column}/toggle', 'SocialMediaController@columnToggle')->name('social_medias.column.toggle');
