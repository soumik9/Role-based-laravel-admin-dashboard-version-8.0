<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('setlocale/{locale}', function ($lang) {
	\Session::put('locale', $lang);
	return redirect()->back();
})->name('setlocale');


// Frontend Routes
Route::get('/', 					[App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');




Route::group(['middleware' => 'language'], function () {

	// Admin Routes
	Route::prefix('admin')->group(function () {

		Route::get('/login', 					[App\Http\Controllers\Auth\LoginController::class, 'login'])->name('login');
		Route::post('/login', 					[App\Http\Controllers\Auth\LoginController::class, 'login_go'])->name('login_go');
		Route::get('/logout', 					[App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

		Route::get('forget-password', 			[App\Http\Controllers\Auth\ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget.password.get');
		Route::post('forget-password', 			[App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forget.password.post');

		Route::get('reset-password/{token}', 	[App\Http\Controllers\Auth\ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset.password.get');
		Route::post('reset-password', 			[App\Http\Controllers\Auth\ForgotPasswordController::class, 'submitResetPasswordForm'])->name('reset.password.post');

		// Admin Authenticated Routes
		Route::group(['middleware' => ['auth']], function () {

			Route::get('/dashboard', 			[App\Http\Controllers\Admin\DashboardController::class, 'dashboard'])->name('dashboard');

			// Profile
			Route::get('/profile', 				[App\Http\Controllers\UserController::class, 'profile'])->name('profile');
			Route::post('/profile/update', 		[App\Http\Controllers\UserController::class, 'profile_update'])->name('profile.update');

			// User
			Route::prefix('users')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\Admin\UserController::class, 'index'])->name('users.index');
				Route::get('/create', 			[App\Http\Controllers\Admin\UserController::class, 'create'])->name('users.create');
				Route::post('/store', 			[App\Http\Controllers\Admin\UserController::class, 'store'])->name('users.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\UserController::class, 'edit'])->name('users.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\UserController::class, 'update'])->name('users.update');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\UserController::class, 'destroy'])->name('users.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\Admin\UserController::class, 'status_update'])->name('users.status_update');
			});

			// Role
			Route::prefix('roles')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
				Route::get('/create', 			[App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
				Route::post('/store', 			[App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
				Route::post('/destroy', 		[App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
			});

			// Permission
			Route::prefix('permissions')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\PermissionController::class, 'index'])->name('permissions.index');
				Route::get('/create', 			[App\Http\Controllers\PermissionController::class, 'create'])->name('permissions.create');
				Route::post('/store', 			[App\Http\Controllers\PermissionController::class, 'store'])->name('permissions.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\PermissionController::class, 'edit'])->name('permissions.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\PermissionController::class, 'update'])->name('permissions.update');
				Route::post('/destroy', 		[App\Http\Controllers\PermissionController::class, 'destroy'])->name('permissions.destroy');
			});

			// Currency
			Route::prefix('currencies')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\Admin\CurrencyController::class, 'index'])->name('currencies.index');
				Route::get('/create', 			[App\Http\Controllers\Admin\CurrencyController::class, 'create'])->name('currencies.create');
				Route::post('/store', 			[App\Http\Controllers\Admin\CurrencyController::class, 'store'])->name('currencies.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\Admin\CurrencyController::class, 'edit'])->name('currencies.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\Admin\CurrencyController::class, 'update'])->name('currencies.update');
				Route::post('/destroy', 		[App\Http\Controllers\Admin\CurrencyController::class, 'destroy'])->name('currencies.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\Admin\CurrencyController::class, 'status_update'])->name('currencies.status_update');
			});

			// Setting
			Route::prefix('setting')->group(function () {
				Route::get('/file-manager/index', 			 [App\Http\Controllers\Admin\FileManagerController::class, 'index'])->name('filemanager.index');
				Route::get('/website-setting/edit', 		 [App\Http\Controllers\Admin\SettingController::class, 'edit'])->name('website-setting.edit');
				Route::post('/website-setting/update/{id}',  [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('website-setting.update');
			});

			// CMS category
			Route::prefix('cmscategory')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\CmsCategoryController::class, 'index'])->name('cmscategory.index');
				Route::get('/create', 			[App\Http\Controllers\CmsCategoryController::class, 'create'])->name('cmscategory.create');
				Route::post('/store', 			[App\Http\Controllers\CmsCategoryController::class, 'store'])->name('cmscategory.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\CmsCategoryController::class, 'edit'])->name('cmscategory.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\CmsCategoryController::class, 'update'])->name('cmscategory.update');
				Route::post('/destroy', 		[App\Http\Controllers\CmsCategoryController::class, 'destroy'])->name('cmscategory.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\CmsCategoryController::class, 'status_update'])->name('cmscategory.status_update');
			});

			// CMS Pages
			Route::prefix('cmspages')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\CmsPageController::class, 'index'])->name('cmspages.index');
				Route::get('/create', 			[App\Http\Controllers\CmsPageController::class, 'create'])->name('cmspages.create');
				Route::post('/store', 			[App\Http\Controllers\CmsPageController::class, 'store'])->name('cmspages.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\CmsPageController::class, 'edit'])->name('cmspages.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\CmsPageController::class, 'update'])->name('cmspages.update');
				Route::post('/destroy', 		[App\Http\Controllers\CmsPageController::class, 'destroy'])->name('cmspages.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\CmsPageController::class, 'status_update'])->name('cmspages.status_update');
			});

			// Testimonials
			Route::prefix('testimonials')->group(function () {
				Route::get('/index', 			[App\Http\Controllers\TestimonialController::class, 'index'])->name('testimonials.index');
				Route::get('/create', 			[App\Http\Controllers\TestimonialController::class, 'create'])->name('testimonials.create');
				Route::post('/store', 			[App\Http\Controllers\TestimonialController::class, 'store'])->name('testimonials.store');
				Route::get('/edit/{id}', 		[App\Http\Controllers\TestimonialController::class, 'edit'])->name('testimonials.edit');
				Route::post('/update/{id}', 	[App\Http\Controllers\TestimonialController::class, 'update'])->name('testimonials.update');
				Route::post('/destroy', 		[App\Http\Controllers\TestimonialController::class, 'destroy'])->name('testimonials.destroy');
				Route::get('/status_update', 	[App\Http\Controllers\TestimonialController::class, 'status_update'])->name('testimonials.status_update');
			});

		});
	});

});
