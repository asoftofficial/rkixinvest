<?php

use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\GeneralSettingsController;
use App\Http\Controllers\Admin\DepositGateways;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\photoController;
use App\Http\Controllers\ReferralbonusController;
use App\Http\Controllers\rewardController;
use App\Http\Controllers\RoiController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\TestimonialController as ControllersTestimonialController;
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
Route::get('placeholder-image/{size}', [HomeController::class,'placeholderImage'])->name('placeholder.image');
// Route::get('/register/{user?}',[App\Http\Controllers\Auth\RegisterController::class,'showRegistrationForm'])->name('register');
// User Routes
$userNameSpace = 'App\Http\Controllers\Users';
Route::namespace($userNameSpace)->middleware(['auth','IsUser','verification','checkInvestments'])->prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('/my-account', 'DashboardController@account')->name('account');
        Route::get('/packages', [App\Http\Controllers\Users\PackagesController::class,'index'])->name('packages');
        Route::post('update-account', 'DashboardController@updateAccount')->name('update-account');
        Route::get('/user/profile', [DashboardController::class, 'user_profile'])->name('show.profile');
        Route::post('/update/profile/{id}', [DashboardController::class, 'update_profile'])->name('update.profile');
        Route::post('/change/password/{id}',[DashboardController::class,'changePassword'])->name('update.password');
        Route::post('/invest',[InvestmentController::class,'invest'])->name('invest.post');
        Route::get('/transactions', [App\Http\Controllers\Users\TransactionController::class, 'index'])->name('transactions');
        Route::get('/roi/{id}',[RoiController::class,'index'])->name('rois');
        // Withdraw
        Route::get('/withdraw', 'WithdrawController@withdraw')->name('withdraw');
        Route::post('/withdraw', 'WithdrawController@withdrawStore')->name('withdraw.money');
        Route::get('/withdraw/preview', 'WithdrawController@withdrawPreview')->name('withdraw.preview');
        Route::post('/withdraw/preview', 'WithdrawController@withdrawSubmit')->name('withdraw.submit');
        Route::get('/withdraw/history', 'WithdrawController@withdrawLog')->name('withdraw.history');
    });


$adminNameSpace = 'App\Http\Controllers\Admin';
Route::namespace($adminNameSpace)->middleware(['auth', 'IsAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('packages','PackageController');
    //user routes
    Route::get('users','DashboardController@users')->name('users');
    Route::resource('/userprofile','UserController');
    Route::post('change/password/{id}',[UserController::class,'changePassword'])->name('change.password');
    Route::post('/user/email',[UserController::class,'sendmail'])->name('user.email');
    Route::get('user/funds',[UserController::class,'showFundsForm'])->name('show.fund');
    Route::post('add/funds',[UserController::class,'addFund'])->name('add.fund');
    Route::post('sub/funds',[UserController::class,'subFund'])->name('sub.fund');
    Route::get('referral/bonus',[ReferralbonusController::class,'refbonus'])->name('referral.bonus');

    //reward routes
    Route::get('reward',[rewardController::class,'index'])->name('reward.index');
    Route::post('reward/create',[rewardController::class,'store'])->name('reward.store');
    Route::delete('reward/delete/{id}',[rewardController::class,'destroy'])->name('reward.destroy');
    Route::post('reward/update/{id}',[rewardController::class,'update'])->name('reward.update');
    //settings routes
    Route::get('settings',[GeneralSettingsController::class,'index'])->name('settings.index');
    Route::post('reward/settings',[GeneralSettingsController::class,'rewardUpdate'])->name('reward.settings');
    Route::get('web/settings',[GeneralSettingsController::class,'Update'])->name('web.settings');
    Route::get('referral/settings',[GeneralSettingsController::class,'referralUpdate'])->name('referral.settings');
    Route::get('fund/settings',[GeneralSettingsController::class,'fundsSettings'])->name('fund.settings');
    Route::post('fund/settings',[GeneralSettingsController::class,'fundupdate'])->name('post.fund.settings');
    Route::get('show/email/settings',[GeneralSettingsController::class,'showEmailSettings'])->name('show.email.settings');
    Route::post('update/email/settings',[GeneralSettingsController::class,'emailSettings'])->name('update.email.settings');
    Route::get('show/kyc/settings',[GeneralSettingsController::class,'showKycSettings'])->name('show.kyc.settings');
    Route::post('update/kyc/settings',[GeneralSettingsController::class,'kycSettings'])->name('update.kyc.settings');
    Route::post('user/blocked/{id}',[UserController::class,'blocked'])->name('blocked.user');
    Route::get('deposit/gateways',[DepositGateways::class,'index'])->name('deposit.geteways');
    Route::get('withdraw/gateways/create',[\App\Http\Controllers\Admin\WithdrawMethodController::class,'create'])->name('withdraw.gateways.create');
    Route::post('withdraw/gateways/store',[\App\Http\Controllers\Admin\WithdrawMethodController::class,'store'])->name('withdraw.gateways.store');
    Route::get('method/edit/{id}', [\App\Http\Controllers\Admin\WithdrawMethodController::class,'edit'])->name('withdraw.gateways.edit');
    Route::post('withdraw/gateway/activate',[\App\Http\Controllers\Admin\WithdrawMethodController::class,'activate'])->name('withdraw.method.activate');
    Route::post('withdraw/gateway/deactivate',[\App\Http\Controllers\Admin\WithdrawMethodController::class,'deactivate'])->name('withdraw.method.deactivate');
    Route::get('withdraw/gateways',[\App\Http\Controllers\Admin\WithdrawMethodController::class,'index'])->name('withdraw.gateways');
    Route::post('referrals',[ReferralbonusController::class,'update'])->name('referrals.post');
    Route::get('general/information',[GeneralSettingsController::class,'generalinfo'])->name('general.info');
    Route::post('general/information/update',[GeneralSettingsController::class,'generalinfoUpdate'])->name('general.info.update');
    Route::post('social/links/update',[GeneralSettingsController::class,'sociallinks'])->name('social.links.update');
    Route::get('frontend/aboutus',[HomepageController::class,'about'])->name('aboutus.settings');
    Route::post('frontend/aboutus/update',[HomepageController::class,'updateAbout'])->name('aboutus.update.settings');
    Route::get('frontend/steps',[HomepageController::class,'steps'])->name('how.to.settings');
    Route::post('frontend/how/to/update',[HomepageController::class,'updateHowto'])->name('how.to.update.settings');
    Route::get('frontend/testimonial',[App\Http\Controllers\Admin\TestimonialController::class,'index'])->name('testimonial.index');
    Route::post('frontend/testimonial/store',[App\Http\Controllers\Admin\TestimonialController::class,'store'])->name('testimonial.store');
    Route::get('frontend/testimonial/show/{id}',[App\Http\Controllers\Admin\TestimonialController::class,'show'])->name('testimonial.show');
    Route::get('frontend/testimonial/edit/{id}',[App\Http\Controllers\Admin\TestimonialController::class,'edit'])->name('testimonial.edit');
    Route::post('frontend/testimonial/update/{id}',[App\Http\Controllers\Admin\TestimonialController::class,'update'])->name('testimonial.update');
    Route::delete('frontend/testimonial/delete/{id}',[App\Http\Controllers\Admin\TestimonialController::class,'destroy'])->name('testimonial.delete');

    //slider route
    Route::resource('slider','SliderController');
    // Email Setting
    Route::get('email-template/global', 'EmailTemplateController@emailTemplate')->name('email.template.global');
    Route::post('email-template/global', 'EmailTemplateController@emailTemplateUpdate')->name('email.template.global');
    Route::get('email-template/setting', 'EmailTemplateController@emailSetting')->name('email.template.setting');
    Route::post('email-template/setting', 'EmailTemplateController@emailSettingUpdate')->name('email.template.setting');
    Route::get('email-template/index', 'EmailTemplateController@index')->name('email.template.index');
    Route::get('email-template/{id}/edit', 'EmailTemplateController@edit')->name('email.template.edit');
    Route::post('email-template/{id}/update', 'EmailTemplateController@update')->name('email.template.update');
    Route::post('email-template/send-test-mail', 'EmailTemplateController@sendTestMail')->name('email.template.test.mail');
});
