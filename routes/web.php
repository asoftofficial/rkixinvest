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
//Route::get('/plans', [App\Http\Controllers\Users\SubscriptionController::class, 'getPlans'])->name('getPlans');
Route::get('/search', [HomeController::class, 'search'])->name('search');

// Route::get('/newdashboard', [App\Http\Controllers\HomeController::class, 'newdashboard'])->name('newdashboard');
Auth::routes(['verify' => true]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('IsAdmin');

$userNameSpace = 'App\Http\Controllers\Users';
Route::namespace($userNameSpace)->middleware(['auth', 'verified', 'IsUser'])->prefix('user')->name('user.')->group(function () {
    Route::get('/plans','SubscriptionController@getPlans')->name('plans');
    Route::get('/checkout', 'SubscriptionController@checkout')->name('checkout');
    Route::post('/checkout', 'SubscriptionController@subscribtion')->name('subscribtion');

    Route::middleware(['IsSubscribed'])->group(function(){
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('/saved-articles', 'DashboardController@savedArticles')->name('saved-articles');
        Route::get('/issues', 'IssueController@index')->name('issues');
        Route::get('/viewer/{id}', 'IssueController@view')->name('viewer');
        Route::get('/my-account', 'DashboardController@account')->name('account');
        Route::get('/cancel-plan', 'SubscriptionController@cancelSubscription')->name('cancel-plan');
        Route::post('update-account', 'DashboardController@updateAccount')->name('update-account');
    });
});


$adminNameSpace = 'App\Http\Controllers\Admin';
Route::namespace($adminNameSpace)->middleware(['auth', 'IsAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('/banners', 'BannerController');
    Route::resource('/packages', 'PackageController');
    Route::resource('/collections', 'CollectionController');
    Route::get('/export-collections', 'CollectionController@export')->name('export-collections');
    Route::resource('/customers', 'CustomerController');
    Route::get('/export-customers', 'CustomerController@export')->name('export-customers');
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('/issues', 'IssueController');
    Route::resource('/plans', 'PlanController');
    Route::get('/export-plans', 'PlanController@export')->name('export-plans');
    Route::get('/export-plan-customers/{id}', 'PlanController@exportCustomers')->name('export-plan-customers');
    Route::resource('promotions', 'PromotionController');
    Route::resource('/magazines','MagazineController');
    Route::get('/users','DashboardController@users')->name('users');
    Route::resource('/userprofile','UserController');
    Route::post('/user/email',[UserController::class,'sendmail'])->name('user.email');
    //reward routes
    Route::get('/reward',[rewardController::class,'index'])->name('reward.index');
    Route::post('/reward/create',[rewardController::class,'store'])->name('reward.store');
    Route::delete('/reward/delete/{id}',[rewardController::class,'destroy'])->name('reward.destroy');
    Route::post('/reward/update/{id}',[rewardController::class,'update'])->name('reward.update');


});

Route::post('general/settings',[GeneralSettings::class,'store'])->name('general.settings.store');
Route::post('user/blocked/{id}',[UserController::class,'blocked'])->name('blocked.user')->middleware('auth');
