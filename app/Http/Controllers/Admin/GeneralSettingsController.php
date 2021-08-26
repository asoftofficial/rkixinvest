<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings as ModelsGeneralSettings;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class GeneralSettingsController extends Controller
{

    public function index()
    {
        return view('admin.settings.generalsettings.index');
    }

    public function Update(Request $request)
    {
        $settings = ModelsGeneralSettings::first();
        $settings->web_title   = $request->web_title;
        $settings->description = $request->description;
        $settings->update();
        return back()->with('success','settings chnaged successfully');
    }

    public function rewardUpdate(Request $request)
    {
        $settings = ModelsGeneralSettings::first();
        $settings->reward_system = $request->reward_system;
        $settings->update();
        return back()->with('success','reward settings chnaged successfully');
    }

    public function refrelUpdate(Request $request)
    {
        $settings = ModelsGeneralSettings::first();
        $settings->refrel_system    = $request->refrel_system;
        $settings->refrellevel_type = $request->refrellevel_type;
        $settings->update();
        return back()->with('success','referal settings chnaged successfully');
    }

    // user balance settings
    public function fundsSettings()
    {
        return view('admin.settings.generalsettings.fund-settings');
    }

    public function fundUpdate(Request $request)
    {
        $settings = ModelsGeneralSettings::first();
        $addFundStatus = empty($request->addfund) ? "off" : $request->addfund;
        $removeFundStatus = empty($request->removefund) ? "off" : $request->removefund;
        $settings->add_fund = $addFundStatus;
        $settings->remove_fund = $removeFundStatus;
        $settings->update();
        return back()->with('success','funds settings updated successfully');
    }

    //email verification settings by admin panel
    public function showEmailSettings()
    {
        return view('admin.settings.generalsettings.email-settings');
    }

    public function emailSettings(Request $request)
    {
        $settings = ModelsGeneralSettings::first();
        $emailStatus = empty($request->email) ? "off" : $request->email;
        $settings->email_verification = $emailStatus;
        $settings->Update();
        return back()->with('success','email settings updated successfully');
    }

    //manage kyc settings by admin panel
    public function showKycSettings()
    {
        return view('admin.settings.generalsettings.kyc-settings');
    }

    public function kycSettings(Request $request)
    {
        $settings = ModelsGeneralSettings::first();
        $kycStatus = empty($request->kyc) ? "off" : $request->kyc;
        $settings->kyc = $kycStatus;
        $settings->Update();
        return back()->with('success','KYC settings updated successfully');
    }

    public function generalinfo()
    {
        $sociallinks = SocialLink::first();
        return view('admin.settings.generalsettings.general-information',compact('sociallinks'));
    }

    public function generalinfoUpdate(Request $request)
    {
        $settings = ModelsGeneralSettings::first();
        $settings->email = $request->email;
        $settings->phone = $request->phone;
        $settings->address = $request->address;
        $settings->Update();
        return back()->with('success','info updated successfully');
    }

    public function sociallinks(Request $request)
    {
        $sociallinks = SocialLink::first();
        $sociallinks->facebook = $request->facebook;
        $sociallinks->twitter = $request->twitter;
        $sociallinks->pintrest = $request->pintrest;
        $sociallinks->linkedin = $request->linkedin;
        $sociallinks->Update();
        return back()->with('success','social media links updated successfully');
    }
}
