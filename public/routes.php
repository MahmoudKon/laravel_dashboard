<?php 

use Illuminate\Support\Facades\Route; 

Route::group(['middleware' => ['web', 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'auth'] ], function () {

	Route::controller('App\Http\Controllers\Backend\HomeController')->group(function () {
		Route::get('dashboard','index')->name('dashboard./');
	});

	Route::controller('App\Http\Controllers\Backend\RouteController')->group(function () {
		Route::get('dashboard/routes','index')->name('dashboard.routes.index');
		Route::get('dashboard/routes/download','download')->name('dashboard.routes.download');
		Route::get('dashboard/routes/sync','sync')->name('dashboard.routes.sync');
		Route::get('dashboard/routes/{route}/edit','edit')->name('dashboard.routes.edit');
		Route::put('dashboard/routes/{route}/update','update')->name('dashboard.routes.update');
		Route::get('dashboard/routes/assign-roles','assign')->name('dashboard.routes.assign');
		Route::post('dashboard/routes/assign-roles','assignRoles')->name('dashboard.routes.assign-roles');
	});

	Route::controller('App\Http\Controllers\Backend\UserController')->group(function () {
		Route::get('dashboard/users','index')->name('dashboard.users.index');
		Route::get('dashboard/users/create','create')->name('dashboard.users.create');
		Route::post('dashboard/users','store')->name('dashboard.users.store');
		Route::get('dashboard/users/{user}','show')->name('dashboard.users.show');
		Route::get('dashboard/users/{user}/edit','edit')->name('dashboard.users.edit');
		Route::put('dashboard/users/{user}','update')->name('dashboard.users.update');
		Route::delete('dashboard/users/{user}','destroy')->name('dashboard.users.destroy');
		Route::post('dashboard/users/multidelete','multidelete')->name('dashboard.users.multidelete');
		Route::get('dashboard/users/excel/export','export')->name('dashboard.users.excel.export');
		Route::get('dashboard/users/excel/import','import')->name('dashboard.users.excel.import.form');
		Route::post('dashboard/users/excel/import','saveImport')->name('dashboard.users.excel.import');
		Route::get('dashboard/users/search/form','search')->name('dashboard.users.search.form');
		Route::get('dashboard/departments/{department}/users','index')->name('dashboard.departments.users.index');
		Route::get('dashboard/departments/{department}/users/create','create')->name('dashboard.departments.users.create');
	});

	Route::controller('App\Http\Controllers\Backend\ProfileController')->group(function () {
		Route::get('dashboard/profile','index')->name('dashboard.profile.index');
		Route::put('dashboard/profile/info','info')->name('dashboard.profile.info');
		Route::put('dashboard/profile/avatar','avatar')->name('dashboard.profile.avatar');
		Route::put('dashboard/profile/password','password')->name('dashboard.profile.password');
		Route::put('dashboard/profile/roles','roles')->name('dashboard.profile.roles');
		Route::put('dashboard/profile/permissions','permissions')->name('dashboard.profile.permissions');
	});

	Route::controller('App\Http\Controllers\Backend\DepartmentController')->group(function () {
		Route::get('dashboard/departments','index')->name('dashboard.departments.index');
		Route::get('dashboard/departments/create','create')->name('dashboard.departments.create');
		Route::post('dashboard/departments','store')->name('dashboard.departments.store');
		Route::get('dashboard/departments/{department}','show')->name('dashboard.departments.show');
		Route::get('dashboard/departments/{department}/edit','edit')->name('dashboard.departments.edit');
		Route::put('dashboard/departments/{department}','update')->name('dashboard.departments.update');
		Route::delete('dashboard/departments/{department}','destroy')->name('dashboard.departments.destroy');
		Route::post('dashboard/departments/multidelete','multidelete')->name('dashboard.departments.multidelete');
	});

	Route::controller('App\Http\Controllers\Backend\AggregatorController')->group(function () {
		Route::get('dashboard/aggregators','index')->name('dashboard.aggregators.index');
		Route::get('dashboard/aggregators/create','create')->name('dashboard.aggregators.create');
		Route::post('dashboard/aggregators','store')->name('dashboard.aggregators.store');
		Route::get('dashboard/aggregators/{aggregator}','show')->name('dashboard.aggregators.show');
		Route::get('dashboard/aggregators/{aggregator}/edit','edit')->name('dashboard.aggregators.edit');
		Route::put('dashboard/aggregators/{aggregator}','update')->name('dashboard.aggregators.update');
		Route::delete('dashboard/aggregators/{aggregator}','destroy')->name('dashboard.aggregators.destroy');
		Route::post('dashboard/aggregators/multidelete','multidelete')->name('dashboard.aggregators.multidelete');
	});

	Route::controller('App\Http\Controllers\Backend\RoleController')->group(function () {
		Route::get('dashboard/roles','index')->name('dashboard.roles.index');
		Route::get('dashboard/roles/create','create')->name('dashboard.roles.create');
		Route::post('dashboard/roles','store')->name('dashboard.roles.store');
		Route::get('dashboard/roles/{role}','show')->name('dashboard.roles.show');
		Route::get('dashboard/roles/{role}/edit','edit')->name('dashboard.roles.edit');
		Route::put('dashboard/roles/{role}','update')->name('dashboard.roles.update');
		Route::delete('dashboard/roles/{role}','destroy')->name('dashboard.roles.destroy');
		Route::post('dashboard/roles/get/permissions','getPermissions')->name('dashboard.roles.permissions');
		Route::post('dashboard/roles/multidelete','multidelete')->name('dashboard.roles.multidelete');
	});

	Route::controller('App\Http\Controllers\Backend\PermissionController')->group(function () {
		Route::get('dashboard/permissions','index')->name('dashboard.permissions.index');
		Route::get('dashboard/permissions/create','create')->name('dashboard.permissions.create');
		Route::post('dashboard/permissions','store')->name('dashboard.permissions.store');
		Route::get('dashboard/permissions/{permission}','show')->name('dashboard.permissions.show');
		Route::get('dashboard/permissions/{permission}/edit','edit')->name('dashboard.permissions.edit');
		Route::put('dashboard/permissions/{permission}','update')->name('dashboard.permissions.update');
		Route::delete('dashboard/permissions/{permission}','destroy')->name('dashboard.permissions.destroy');
		Route::post('dashboard/permissions/multidelete','multidelete')->name('dashboard.permissions.multidelete');
	});

	Route::controller('App\Http\Controllers\Backend\CountryController')->group(function () {
		Route::get('dashboard/countries','index')->name('dashboard.countries.index');
		Route::get('dashboard/countries/create','create')->name('dashboard.countries.create');
		Route::post('dashboard/countries','store')->name('dashboard.countries.store');
		Route::get('dashboard/countries/{country}','show')->name('dashboard.countries.show');
		Route::get('dashboard/countries/{country}/edit','edit')->name('dashboard.countries.edit');
		Route::put('dashboard/countries/{country}','update')->name('dashboard.countries.update');
		Route::delete('dashboard/countries/{country}','destroy')->name('dashboard.countries.destroy');
		Route::post('dashboard/countries/multidelete','multidelete')->name('dashboard.countries.multidelete');
	});

	Route::controller('App\Http\Controllers\Backend\OperatorController')->group(function () {
		Route::get('dashboard/operators','index')->name('dashboard.operators.index');
		Route::get('dashboard/operators/create','create')->name('dashboard.operators.create');
		Route::post('dashboard/operators','store')->name('dashboard.operators.store');
		Route::get('dashboard/operators/{operator}','show')->name('dashboard.operators.show');
		Route::get('dashboard/operators/{operator}/edit','edit')->name('dashboard.operators.edit');
		Route::put('dashboard/operators/{operator}','update')->name('dashboard.operators.update');
		Route::delete('dashboard/operators/{operator}','destroy')->name('dashboard.operators.destroy');
		Route::post('dashboard/operators/multidelete','multidelete')->name('dashboard.operators.multidelete');
		Route::get('dashboard/countries/{country}/operators','index')->name('dashboard.countries.operators.index');
		Route::get('dashboard/countries/{country}/operators/create','create')->name('dashboard.countries.operators.create');
	});

	Route::controller('App\Http\Controllers\Backend\SettingController')->group(function () {
		Route::get('dashboard/settings','index')->name('dashboard.settings.index');
		Route::get('dashboard/settings/create','create')->name('dashboard.settings.create');
		Route::post('dashboard/settings','store')->name('dashboard.settings.store');
		Route::get('dashboard/settings/{setting}','show')->name('dashboard.settings.show');
		Route::get('dashboard/settings/{setting}/edit','edit')->name('dashboard.settings.edit');
		Route::put('dashboard/settings/{setting}','update')->name('dashboard.settings.update');
		Route::delete('dashboard/settings/{setting}','destroy')->name('dashboard.settings.destroy');
		Route::post('dashboard/settings/type/input','getTypeInput')->name('dashboard.settings.type.input');
		Route::post('dashboard/settings/multidelete','multidelete')->name('dashboard.settings.multidelete');
	});

	Route::controller('App\Http\Controllers\Backend\CategoryController')->group(function () {
		Route::get('dashboard/categories','index')->name('dashboard.categories.index');
		Route::get('dashboard/categories/create','create')->name('dashboard.categories.create');
		Route::post('dashboard/categories','store')->name('dashboard.categories.store');
		Route::get('dashboard/categories/{category}','show')->name('dashboard.categories.show');
		Route::get('dashboard/categories/{category}/edit','edit')->name('dashboard.categories.edit');
		Route::put('dashboard/categories/{category}','update')->name('dashboard.categories.update');
		Route::delete('dashboard/categories/{category}','destroy')->name('dashboard.categories.destroy');
		Route::get('dashboard/categories/{category}/subs','index')->name('dashboard.categories.subs.index');
		Route::get('dashboard/categories/{category}/subs/create','create')->name('dashboard.categories.subs.create');
		Route::post('dashboard/categories/multidelete','multidelete')->name('dashboard.categories.multidelete');
	});

	Route::controller('App\Http\Controllers\Backend\ContentTypeController')->group(function () {
		Route::get('dashboard/content_types','index')->name('dashboard.content_types.index');
		Route::get('dashboard/content_types/create','create')->name('dashboard.content_types.create');
		Route::post('dashboard/content_types','store')->name('dashboard.content_types.store');
		Route::get('dashboard/content_types/{content_type}','show')->name('dashboard.content_types.show');
		Route::get('dashboard/content_types/{content_type}/edit','edit')->name('dashboard.content_types.edit');
		Route::put('dashboard/content_types/{content_type}','update')->name('dashboard.content_types.update');
		Route::delete('dashboard/content_types/{content_type}','destroy')->name('dashboard.content_types.destroy');
		Route::post('dashboard/content_types/multidelete','multidelete')->name('dashboard.content_types.multidelete');
	});

	Route::controller('App\Http\Controllers\Backend\ContentController')->group(function () {
		Route::get('dashboard/contents','index')->name('dashboard.contents.index');
		Route::get('dashboard/contents/create','create')->name('dashboard.contents.create');
		Route::post('dashboard/contents','store')->name('dashboard.contents.store');
		Route::get('dashboard/contents/{content}','show')->name('dashboard.contents.show');
		Route::get('dashboard/contents/{content}/edit','edit')->name('dashboard.contents.edit');
		Route::put('dashboard/contents/{content}','update')->name('dashboard.contents.update');
		Route::delete('dashboard/contents/{content}','destroy')->name('dashboard.contents.destroy');
		Route::post('dashboard/contents/type/input','getTypeInput')->name('dashboard.contents.type.input');
		Route::post('dashboard/contents/multidelete','multidelete')->name('dashboard.contents.multidelete');
	});

	Route::controller('App\Http\Controllers\Backend\PostController')->group(function () {
		Route::get('dashboard/posts','index')->name('dashboard.posts.index');
		Route::get('dashboard/posts/create','create')->name('dashboard.posts.create');
		Route::post('dashboard/posts','store')->name('dashboard.posts.store');
		Route::get('dashboard/posts/{post}','show')->name('dashboard.posts.show');
		Route::get('dashboard/posts/{post}/edit','edit')->name('dashboard.posts.edit');
		Route::put('dashboard/posts/{post}','update')->name('dashboard.posts.update');
		Route::delete('dashboard/posts/{post}','destroy')->name('dashboard.posts.destroy');
		Route::get('dashboard/contents/{content}/posts','index')->name('dashboard.contents.posts.index');
		Route::get('dashboard/contents/{content}/posts/create','create')->name('dashboard.contents.posts.create');
		Route::post('dashboard/posts/multidelete','multidelete')->name('dashboard.posts.multidelete');
		Route::post('dashboard/posts/active-toggle','activeToggle')->name('dashboard.posts.active.toggle');
		Route::get('dashboard/posts/{post}/short-url','shortUrlForm')->name('dashboard.posts.short.url');
		Route::post('dashboard/posts/{post}/short-url','shortUrl')->name('dashboard.posts.short.url');
	});

	Route::controller('App\Http\Controllers\Backend\MenuController')->group(function () {
		Route::get('dashboard/menus','index')->name('dashboard.menus.index');
		Route::get('dashboard/menus/create','create')->name('dashboard.menus.create');
		Route::post('dashboard/menus','store')->name('dashboard.menus.store');
		Route::get('dashboard/menus/{menu}','show')->name('dashboard.menus.show');
		Route::get('dashboard/menus/{menu}/edit','edit')->name('dashboard.menus.edit');
		Route::put('dashboard/menus/{menu}','update')->name('dashboard.menus.update');
		Route::delete('dashboard/menus/{menu}','destroy')->name('dashboard.menus.destroy');
		Route::get('dashboard/menus/{menu}/subs/create','create')->name('dashboard.menus.subs.create');
		Route::post('dashboard/menus/{menu}/toggle/visible','toggleVisible')->name('dashboard.menus.toggle.visible');
		Route::post('dashboard/menus/reorder','reorder')->name('dashboard.menus.reorder');
	});

	Route::controller('App\Http\Controllers\Backend\NotificationController')->group(function () {
		Route::post('dashboard/read/notifications/{id?}','readNotification')->name('dashboard.read.notifications');
	});

	Route::controller('App\Http\Controllers\Backend\ImageCropperController')->group(function () {
		Route::get('dashboard/image-cropper','index')->name('dashboard.image.cropper');
	});

	Route::controller('App\Http\Controllers\Backend\FileManagerController')->group(function () {
		Route::get('dashboard/file-manager','index')->name('dashboard.file.manager');
	});

});

