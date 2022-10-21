<?php

use Illuminate\Support\Facades\Route;

Route::get('/','HomeController@index')->name('/');


Route::controller('SimulateController')->middleware(['role:Super Admin'])->group(function () {
    Route::get('simulate','index')->name('simulate.index');
    Route::post('simulate/{command}','runCommand')->name('simulate.command');
});

Route::get('file-manager', 'FileManagerController@index')->name('file.manager');

Route::controller('RouteController')->group(function () {
    Route::get('routes','index')->name('routes.index');
    Route::get('routes/download','download')->name('routes.download');
    Route::get('routes/sync-routes','syncRoutes')->name('routes.syncRoutes');
    Route::get('routes/sync-permissions','syncPermissions')->name('routes.syncPermissions');
    Route::get('routes/{route}/edit','edit')->name('routes.edit');
    Route::put('routes/{route}/update','update')->name('routes.update');
    Route::get('routes/assign-roles','assign')->name('routes.assign');
    Route::post('routes/assign-roles','assignRoles')->name('routes.assign-roles');
});


Route::resource('users','UserController');
Route::controller('UserController')->group(function () {
    Route::post('users/multidelete', 'multidelete')->name('users.multidelete');
    Route::get('users/excel/export', 'export')->name('users.excel.export');
    Route::get('users/excel/import', 'import')->name('users.excel.import.form');
    Route::post('users/excel/import', 'saveImport')->name('users.excel.import');
    Route::get('users/search/form', 'search')->name('users.search.form');
    Route::get('departments/{department}/users','index')->name('departments.users.index');
    Route::get('departments/{department}/users/create','create')->name('departments.users.create');
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
Route::post('content_types/visible/toggle/{content_type}', 'ContentTypeController@toggleVisible')->name('content_types.visible.toggle');


Route::resource('menus', 'MenuController');
Route::controller('MenuController')->group(function () {
    Route::get('menus/{menu}/subs/create', 'create')->name('menus.subs.create');
    Route::post('menus/{menu}/toggle/visible', 'toggleVisible')->name('menus.toggle.visible');
    Route::post('menus/reorder', 'reorder')->name('menus.reorder');
});


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
Route::controller('CityController')->group(function () {
    Route::get('governorates/{governorate}/cities', 'index')->name('governorates.cities.index');
    Route::get('governorates/{governorate}/cities/create', 'create')->name('governorates.cities.create');
    Route::post('cities/multidelete', 'multidelete')->name('cities.multidelete');
    Route::post('governorates/{governorate}/cities/multidelete', 'multidelete')->name('governorates.cities.multidelete');
});

Route::resource('langs', 'LangController');

Route::resource('employee_attachments', 'Test\EmployeeAttachmentController');
Route::post('employee_attachments/multidelete', 'Test\EmployeeAttachmentController@multidelete')->name('employee_attachments.multidelete');
