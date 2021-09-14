<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\ReferralbonusController;
use App\Http\Controllers\RoiController as ControllersRoiController;
use App\Http\Controllers\Users\DashboardController;
use App\Http\Controllers\Users\RoiController;
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

Route::get('/', [App\Http\Controllers\FrontendController::class, 'home'])->name('welcome');
Route::get('show/verification/form',[App\Http\Controllers\Users\DashboardController::class ,'showVerificationForm'])->name('verification_form');
Route::post('/verify/code',[App\Http\Controllers\Users\DashboardController::class ,'checkVerificationForm'])->name('verificationForm.post');
Route::get('resend/code',[DashboardController::class, 'resendCode'])->name('resend.code');
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('IsAdmin');
Route::get('/verify_email/{email_verification_code}',[App\Http\Controllers\Auth\RegisterController::class,'email_verification'])->name('email.verification');
Route::get('placeholder-image/{size}', [\App\Http\Controllers\FrontendController::class,'placeholderImage'])->name('placeholder.image');
Route::get('ajax-chart-data', [App\Http\Controllers\ChartDataController::class,'getData'])->name('ajaxChart');
// User Routes
$userNameSpace = 'App\Http\Controllers\Users';
Route::namespace($userNameSpace)->middleware(['auth','IsUser','verification','checkInvestments'])->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('/my-account', 'DashboardController@account')->name('account');
        Route::get('/packages', 'PackagesController@index')->name('packages');
        Route::post('update-account', 'DashboardController@updateAccount')->name('update-account');
        Route::get('/profile', 'DashboardController@user_profile')->name('show.profile');
        Route::post('/update/profile/{id}', 'DashboardController@update_profile')->name('update.profile');
        Route::post('/change/password',[DashboardController::class,'changePassword'])->name('update.password');
        Route::post('/invest',[InvestmentController::class,'invest'])->name('invest.post');
        Route::get('/transactions', 'TransactionController@index')->name('transactions');
        Route::get('/roi/{id}',[ControllersRoiController::class,'index'])->name('rois');
        //Referrals
        Route::get('/referrals', 'DashboardController@referrals')->name('referrals');

        // Deposit
        Route::get('/deposit/history', 'DepositController@index')->name('deposit');
        Route::get('/deposit/methods', 'DepositController@depositMethods')->name('deposit.methods');
        Route::post('/deposit', 'DepositController@store')->name('deposit.money');
        Route::get('/deposit/preview', 'DepositController@preview')->name('deposit.preview');
        Route::get('/pay-now', 'DepositController@payNow')->name('pay-now');
        Route::get('/deposit', 'DepositController@index')->name('deposit');
        Route::post('/deposit-manual','DepositController@manualDeposit')->name('deposit.manual');

        //Tranfer
        Route::get('/transfer', 'DashboardController@transfer')->name('transfer');
        Route::post('/transfer', 'DashboardController@transferPost')->name('transfer.post');
        Route::get('/transfer/code', 'DashboardController@transfercode')->name('transfer.code');
        Route::post('/transfer/code/update', 'DashboardController@updateTransferCode')->name('transfer.code.update');

        // Withdraw
        Route::get('/withdraw', 'WithdrawController@withdraw')->name('withdraw');
        Route::get('/withdraw/methods', 'WithdrawController@withdrawMethods')->name('withdraw.methods');
        Route::post('/withdraw', 'WithdrawController@store')->name('withdraw.money');
        Route::get('/withdraw/preview', 'WithdrawController@preview')->name('withdraw.preview');
        Route::post('/withdraw/preview', 'WithdrawController@withdrawSubmit')->name('withdraw.submit');
        Route::get('/withdraw/history', 'WithdrawController@withdrawLog')->name('withdraw.history');

        //investment routes
        Route::get('/investment',[InvestmentController::class,'showUserInvestments'])->name('investment');
    });


$adminNameSpace = 'App\Http\Controllers\Admin';
Route::namespace($adminNameSpace)->middleware(['auth', 'IsAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('view/profile','AdminDashboardController@viewProfile')->name('profile');
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('packages','PackageController');
    //user routes
    Route::get('users','DashboardController@users')->name('users');
    Route::resource('/userprofile','UserController');
    Route::post('change/password','UserController@changePassword')->name('change.password');
    Route::post('/user/email/{id}','UserController@sendmail')->name('user.email');
    Route::get('user/funds','UserController@showFundsForm')->name('show.fund');
    Route::post('add/funds','UserController@addFund')->name('add.fund');
    Route::post('sub/funds','UserController@subFund')->name('sub.fund');
    Route::get('referral/bonus',[ReferralbonusController::class,'refbonus'])->name('referral.bonus');
    Route::get('active/users','UserController@activeUsers')->name('show.active.users');

    //reward routes
    Route::get('reward','rewardController@index')->name('reward.index');
    Route::post('reward/create','rewardController@store')->name('reward.store');
    Route::delete('reward/delete/{id}','rewardController@destroy')->name('reward.destroy');
    Route::post('reward/update/{id}','rewardController@update')->name('reward.update');
    //settings routes
    Route::get('settings','GeneralSettingsController@index')->name('settings.index');
    Route::post('reward/settings','GeneralSettingsController@rewardUpdate')->name('reward.settings');
    Route::post('web/settings','GeneralSettingsController@Update')->name('web.settings');
    Route::post('referral/settings','GeneralSettingsController@referralUpdate')->name('referral.settings');
    Route::get('fund/settings','GeneralSettingsController@fundsSettings')->name('fund.settings');
    Route::post('fund/settings','GeneralSettingsController@fundupdate')->name('post.fund.settings');
    Route::post('fund/transfer','GeneralSettingsController@fundTransfer')->name('fund.transfer');
    Route::get('show/email/settings','GeneralSettingsController@showEmailSettings')->name('show.email.settings');
    Route::post('update/email/settings','GeneralSettingsController@emailSettings')->name('update.email.settings');
    Route::post('user/blocked/{id}','UserController@blocked')->name('blocked.user');

    Route::resource('deposit-gateways', '\App\Http\Controllers\Admin\DepositMethodsController');
    Route::get('slider',[AdminDashboardController::class,'slider'])->name('slider');
    Route::post('slider/update',[AdminDashboardController::class,'updateSlider'])->name('slider.edit');


    Route::get('withdraw/gateways/create','WithdrawMethodController@create')->name('withdraw.gateways.create');
    Route::post('withdraw/gateways/store','WithdrawMethodController@store')->name('withdraw.gateways.store');
    Route::put('withdraw/gateway/update/{gateway}','WithdrawMethodController@update')->name('withdraw.gateway.update');
    Route::get('withdraw/gateway/edit/{id}', 'WithdrawMethodController@edit')->name('withdraw.gateways.edit');
    Route::post('withdraw/gateway/activate','WithdrawMethodController@activate')->name('withdraw.method.activate');
    Route::post('withdraw/gateway/deactivate','WithdrawMethodController@deactivate')->name('withdraw.method.deactivate');
    Route::get('withdraw/gateways','WithdrawMethodController@index')->name('withdraw.gateways');
    Route::delete('withdraw/delete/{id}','WithdrawController@destroy')->name('destroy.method');
    Route::post('referrals',[ReferralbonusController::class,'update'])->name('referrals.post');
    Route::get('general/information','GeneralSettingsController@generalinfo')->name('general.info');
    Route::post('general/information/update','GeneralSettingsController@generalinfoUpdate')->name('general.info.update');
    Route::post('social/links/update','GeneralSettingsController@sociallinks')->name('social.links.update');
    Route::get('frontend/aboutus',[HomepageController::class,'about'])->name('aboutus.settings');
    Route::post('frontend/aboutus/update',[HomepageController::class,'updateAbout'])->name('aboutus.update.settings');
    Route::get('frontend/steps',[HomepageController::class,'steps'])->name('how.to.settings');
    Route::post('frontend/how/to/update',[HomepageController::class,'updateHowto'])->name('how.to.update.settings');
    Route::get('frontend/testimonial','TestimonialController@index')->name('testimonial.index');
    Route::post('frontend/testimonial/store','TestimonialController@store')->name('testimonial.store');
    Route::get('frontend/testimonial/show/{id}','TestimonialController@show')->name('testimonial.show');
    Route::get('frontend/testimonial/edit/{id}','TestimonialController@edit')->name('testimonial.edit');
    Route::post('frontend/testimonial/update/{id}','TestimonialController@update')->name('testimonial.update');
    Route::delete('frontend/testimonial/delete/{id}','TestimonialController@destroy')->name('testimonial.delete');
    //Withdraw Routes
    Route::get('withdraw/pending', 'WithdrawController@pending')->name('withdraw.pending');
    Route::get('withdraw/approved', 'WithdrawController@approved')->name('withdraw.approved');
    Route::get('withdraw/rejected', 'WithdrawController@rejected')->name('withdraw.rejected');
    Route::get('withdraw/log', 'WithdrawController@log')->name('withdraw.log');
    Route::get('withdraw/via/{method_id}/{type?}', 'WithdrawController@logViaMethod')->name('withdraw.method');
    Route::get('withdraw/{scope}/search', 'WithdrawController@search')->name('withdraw.search');
    Route::get('withdraw/date-search/{scope}', 'WithdrawController@dateSearch')->name('withdraw.dateSearch');
    Route::get('withdraw/details/{id}', 'WithdrawController@details')->name('withdraw.details');
    Route::post('withdraw/approve', 'WithdrawController@approve')->name('withdraw.approve');
    Route::post('withdraw/reject', 'WithdrawController@reject')->name('withdraw.reject');


    //Deposit Routes
    Route::get('deposit/pending', 'DepositController@pending')->name('deposit.pending');
    Route::get('deposit/approved', 'DepositController@approved')->name('deposit.approved');
    Route::get('deposit/rejected', 'DepositController@rejected')->name('deposit.rejected');
    Route::get('deposit/log', 'DepositController@log')->name('deposit.log');
    Route::get('deposit/via/{method_id}/{type?}', 'DepositController@logViaMethod')->name('deposit.method');
    Route::get('deposit/{scope}/search', 'DepositController@search')->name('deposit.search');
    Route::get('deposit/date-search/{scope}', 'DepositController@dateSearch')->name('deposit.dateSearch');
    Route::get('deposit/details/{id}', 'DepositController@details')->name('deposit.details');
    Route::post('deposit/approve', 'DepositController@approve')->name('deposit.approve');
    Route::post('deposit/reject', 'DepositController@reject')->name('deposit.reject');



    // Email Setting
    Route::get('email-template/global', 'EmailTemplateController@emailTemplate')->name('email.template.global');
    Route::post('email-template/global', 'EmailTemplateController@emailTemplateUpdate')->name('email.template.global');
    Route::get('email-template/setting', 'EmailTemplateController@emailSetting')->name('email.template.setting');
    Route::post('email-template/setting', 'EmailTemplateController@emailSettingUpdate')->name('email.template.setting');
    Route::get('email-template/index', 'EmailTemplateController@index')->name('email.template.index');
    Route::get('email-template/{id}/edit', 'EmailTemplateController@edit')->name('email.template.edit');
    Route::post('email-template/{id}/update', 'EmailTemplateController@update')->name('email.template.update');
    Route::post('email-template/send-test-mail', 'EmailTemplateController@sendTestMail')->name('email.template.test.mail');

    //investments reporting route
    Route::get('active/investments',[InvestmentController::class,'active_invest'])->name('active.investments');
    Route::get('pending/investments',[InvestmentController::class,'pending_invest'])->name('pending.investments');
    Route::delete('investment/delete/{id}',[InvestmentController::class,'destroy'])->name('investment.destroy');
    Route::get('total/investors','UserController@totalInvestors')->name('show.total.investors');
    Route::get('active/investors','UserController@activeInvestors')->name('show.active.investors');
});
