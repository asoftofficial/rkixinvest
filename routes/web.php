<?php

use App\Http\Controllers\admin\GeneralSettings;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\rewardController;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return redirect('user/dashboard');
})->middleware('auth');

Auth::routes(['verify' => true]);
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('IsAdmin');

$userNameSpace = 'App\Http\Controllers\Users';
Route::namespace($userNameSpace)->middleware(['auth', 'verified', 'IsUser'])->prefix('user')->name('user.')->group(function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('/my-account', 'DashboardController@account')->name('account');
        Route::post('update-account', 'DashboardController@updateAccount')->name('update-account');
});


$adminNameSpace = 'App\Http\Controllers\Admin';
Route::namespace($adminNameSpace)->middleware(['auth', 'IsAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('packages', 'PackageController');
    Route::get('users','DashboardController@users')->name('users');
    Route::resource('/userprofile','UserController');
    Route::post('/user/email',[UserController::class,'sendmail'])->name('user.email');
    //reward routes
    Route::get('reward',[rewardController::class,'index'])->name('reward.index');
    Route::post('reward/create',[rewardController::class,'store'])->name('reward.store');
    Route::delete('reward/delete/{id}',[rewardController::class,'destroy'])->name('reward.destroy');
    Route::post('reward/update/{id}',[rewardController::class,'update'])->name('reward.update');
    //settings routes
    Route::get('settings',[GeneralSettings::class,'index'])->name('settings.index');
    Route::post('reward/settings',[GeneralSettings::class,'rewardUpdate'])->name('reward.settings');
    Route::get('web/settings',[GeneralSettings::class,'Update'])->name('web.settings');
    Route::get('refrel/settings',[GeneralSettings::class,'refrelUpdate'])->name('refrel.settings');
    // Route::post('general/settings',[GeneralSettings::class,'webUpdate'])->name('web.settings');
    Route::post('user/blocked/{id}',[UserController::class,'blocked'])->name('blocked.user');
});




