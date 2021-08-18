<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\admin\GeneralSettings;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\photoController;
use App\Http\Controllers\rewardController;
use App\Http\Controllers\Users\DashboardController;
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

Route::get('/', [App\Http\Controllers\FrontendController::class, 'home']);
Route::get('show/verification/form',[App\Http\Controllers\Users\DashboardController::class,'showVerificationForm'])->name('verification_form');
Route::post('/verify/code',[App\Http\Controllers\Users\DashboardController::class,'checkVerificationForm'])->name('verificationForm.post');
Route::get('resend/code',[DashboardController::class, 'resendCode'])->name('resend.code');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('IsAdmin');
Route::get('/verify_email/{email_verification_code}',[App\Http\Controllers\Auth\RegisterController::class,'email_verification'])->name('email.verification');
// Route::get('/register/{user?}',[App\Http\Controllers\Auth\RegisterController::class,'showRegistrationForm'])->name('register');
// User Routes
$userNameSpace = 'App\Http\Controllers\Users';
Route::namespace($userNameSpace)->middleware(['auth','IsUser','verification'])->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('/my-account', 'DashboardController@account')->name('account');
        Route::post('update-account', 'DashboardController@updateAccount')->name('update-account');
        Route::get('/user/profile', [DashboardController::class, 'user_profile'])->name('show.profile');
        Route::post('/update/profile/{id}', [DashboardController::class, 'update_profile'])->name('update.profile');
    });


$adminNameSpace = 'App\Http\Controllers\Admin';
Route::namespace($adminNameSpace)->middleware(['auth', 'IsAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('packages', 'PackageController');
    //user routes
    Route::get('users','DashboardController@users')->name('users');
    Route::resource('/userprofile','UserController');
    Route::post('/user/email',[UserController::class,'sendmail'])->name('user.email');
    Route::get('user/funds',[UserController::class,'showFundsForm'])->name('show.fund');
    Route::post('add/funds',[UserController::class,'addFund'])->name('add.fund');
    Route::post('sub/funds',[UserController::class,'subFund'])->name('sub.fund');

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
    Route::get('fund/settings',[GeneralSettings::class,'fundsSettings'])->name('fund.settings');
    Route::post('fund/settings',[GeneralSettings::class,'fundupdate'])->name('post.fund.settings');
    Route::post('user/blocked/{id}',[UserController::class,'blocked'])->name('blocked.user');
});


Route::get('photo/form',[photoController::class,'photoform'])->name('photo.form');
Route::post('photo/store',[photoController::class,'photostore'])->name('photo.store');
