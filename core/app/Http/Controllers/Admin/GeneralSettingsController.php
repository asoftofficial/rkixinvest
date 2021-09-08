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
         if($request->hasFile('favicon')){
            $extension = $request->file('favicon')->getClientOriginalExtension();
            $fileName = "favicon_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = 'uploads/web/';
            $full_path = '/uploads/web/'.$fileName;
            $request->file('favicon')->move($upload_path, $fileName);
            $file_path  = $full_path;
            $settings->fav_icon   = $file_path;
        }
        if($request->hasFile('dlogo')){
            $extension = $request->file('dlogo')->getClientOriginalExtension();
            $fileName = "logo_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = 'uploads/web/';
            $full_path = '/uploads/web/'.$fileName;
            $request->file('dlogo')->move($upload_path, $fileName);
            $file_path  = $full_path;
            $settings->dlogo  = $file_path;
        }
        if($request->hasFile('llogo')){
            $extension = $request->file('llogo')->getClientOriginalExtension();
            $fileName = "logo_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = 'uploads/web/';
            $full_path = '/uploads/web/'.$fileName;
            $request->file('llogo')->move($upload_path, $fileName);
            $file_path  = $full_path;
            $settings->llogo  = $file_path;
        }
        if($request->hasFile('form_image')){
            $extension = $request->file('form_image')->getClientOriginalExtension();
            $fileName = "form_image_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = 'uploads/web/';
            $full_path = 'uploads/web/'.$fileName;
            $request->file('form_image')->move($upload_path, $fileName);
            $file_path  = $full_path;
            $settings->form_image  = $file_path;
        }
        $settings->web_title   = $request->web_title;
        $settings->description = $request->description;
        $settings->footer  = $request->footer;
        $settings->update();
        return back()->with('success','Settings Changed Successfully');
    }

    public function rewardUpdate(Request $request)
    {
        $settings = ModelsGeneralSettings::first();
        $reward_status = $request->reward ? 'on' : 'off';
        $settings->reward_system = $reward_status;
        $settings->Update();
        return back()->with('success','Reward Settings Changed Successfully');
    }

    public function referralUpdate(Request $request)
    {
        $settings = ModelsGeneralSettings::first();
        $ref_status = $request->ref_system ? 'on' : 'off';
        $settings->referral_system    = $ref_status;
        $settings->referral_levels = $request->ref_level;
        $settings->update();
        return back()->with('success','Referral Settings Changed Successfully');
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
        return back()->with('success','Funds Settings Updated Successfully');
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
        return back()->with('success','Info Updated Successfully');
    }

    public function sociallinks(Request $request)
    {
        $sociallinks = SocialLink::first();
        $sociallinks->facebook = $request->facebook;
        $sociallinks->twitter = $request->twitter;
        $sociallinks->pintrest = $request->pintrest;
        $sociallinks->linkedin = $request->linkedin;
        $sociallinks->Update();
        return back()->with('success','Social Media Links Updated Successfully');
    }

    //fund tranfers settings
    public function fundTransfer(Request $request)
    {
      $settings = ModelsGeneralSettings::first();
      $settings->min_transfer = $request->min_transfer;
      $settings->max_transfer = $request->max_transfer;
      $settings->transfer_charges = $request->charges;
      $settings->fund_transfer = $request->fund_transfer ? 'on' :'off';
      $settings->Update();
      return back()->with('success','Fund Transfer Settings Updated');
    }
}
