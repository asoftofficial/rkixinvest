<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings as ModelsGeneralSettings;
use Illuminate\Http\Request;

class GeneralSettings extends Controller
{

    public function index()
        {
           return view('admin.settings.generalsettings.index');
        }

    public function Update(Request $request)
    {


        $settings = ModelsGeneralSettings::first();
        $settings->web_title        = $request->web_title;
        $settings->description = $request->description;
        $settings->update();
     return back()->with('success','settings chnaged successfully');
    }

    public function rewardUpdate(Request $request)
    {


        $settings = ModelsGeneralSettings::first();
        $settings->reward_system      = $request->reward_system;
        $settings->update();
     return back()->with('success','reward settings chnaged successfully');
    }

    public function refrelUpdate(Request $request)
    {


        $settings = ModelsGeneralSettings::first();

        $settings->refrel_system      = $request->refrel_system;
        $settings->refrellevel_type      = $request->refrellevel_type;
        $settings->update();

     return back()->with('success','referal settings chnaged successfully');
    }
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
}
