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
Route::controller('UserController')->group(function () {
    Route::post('users/multidelete', 'multidelete')->name('users.multidelete');
    Route::get('users/excel/export', 'export')->name('users.excel.export');
    Route::get('users/excel/import', 'import')->name('users.excel.import.form');
    Route::post('users/excel/import', 'saveImport')->name('users.excel.import');
    Route::get('users/search/form', 'search')->name('users.search.form');
});


Route::controller('ProfileController')->group(function () {
    Route::get('profile', 'index')->name('profile.index');
    Route::put('profile/info', 'info')->name('profile.info');
    Route::put('profile/avatar', 'avatar')->name('profile.avatar');
    Route::put('profile/password', 'password')->name('profile.password');
    Route::put('profile/roles', 'roles')->name('profile.roles');
    Route::put('profile/permissions', 'permissions')->name('profile.permissions');
});


Route::resource('departments','DepartmentController');
Route::post('departments/multidelete', 'DepartmentController@multidelete')->name('departments.multidelete');


Route::resource('roles','RoleController');
Route::controller('RoleController')->group(function () {
    Route::post('roles/get/permissions', 'getPermissions')->name('roles.permissions');
    Route::post('roles/multidelete', 'multidelete')->name('roles.multidelete');
});


Route::resource('permissions','PermissionController')->except('show');
Route::post('permissions/multidelete', 'PermissionController@multidelete')->name('permissions.multidelete');


Route::resource('settings','SettingController')->except('show');
Route::controller('SettingController')->group(function () {
    Route::post('settings/type/input', 'getTypeInput')->name('settings.type.input');
    Route::post('settings/multidelete', 'multidelete')->name('settings.multidelete');
    Route::post('settings/{setting}/column/{column}/toggle', 'columnToggle')->name('settings.column.toggle');
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
Route::post('announcements/multidelete', 'AnnouncementController@multidelete')->name('announcements.multidelete');
Route::post('announcements/{announcement}/column/{column}/toggle', 'AnnouncementController@columnToggle')->name('announcements.column.toggle');
Route::get('announcements/search/form', 'AnnouncementController@search')->name('announcements.search.form');


Route::controller('LanguageController')->as('languages.')->prefix('languages')->group(function () {
    Route::get('/', 'index')->name('index');
    Route::get('{language}/edit', 'edit')->name('edit');
    Route::put('{language}', 'update')->name('update');
    Route::post('{language}/column/{column}/toggle', 'columnToggle')->name('column.toggle');
    Route::get('{language}', 'show')->name('show');
    Route::get('{language}/trans/{key}/edit', 'transEdit')->name('trans.edit');
    Route::post('{language}/trans/{key}/update', 'transUpdate')->name('trans.update');
});

Route::resource('clients', 'ClientController');
Route::post('clients/multidelete', 'ClientController@multidelete')->name('clients.multidelete');

Route::get('commands', 'CommandController@index')->name('commands.index');
Route::post('commands/{command}/info', 'CommandController@commandInfo')->name('commands.command.info');
Route::post('commands/call', 'CommandController@call')->name('commands.call');

Route::resource('oauth_socials', 'OauthSocialController');
Route::post('oauth_socials/multidelete', 'OauthSocialController@multidelete')->name('oauth_socials.multidelete');
Route::post('oauth_socials/{oauth_social}/column/{column}/toggle', 'OauthSocialController@columnToggle')->name('oauth_socials.column.toggle');

Route::resource('social_medias', 'SocialMediaController');
Route::post('social_medias/multidelete', 'SocialMediaController@multidelete')->name('social_medias.multidelete');
Route::post('social_medias/{oauth_social}/column/{column}/toggle', 'SocialMediaController@columnToggle')->name('social_medias.column.toggle');
