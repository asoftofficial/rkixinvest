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
        dd($request);
        $settings = ModelsGeneralSettings::first();
        if(empty($request->add_fund)){
        $settings->add_fund = 'off';
        $settings->update();
        }elseif(empty($request->remove_fund)){
        $settings->remove_fund = 'off';
        $settings->update();
        }else{
        $settings->add_fund = $request->add_fund;
        $settings->remove_fund = $request->add_fund;
        $settings->update();
        }
     return back()->with('success','funds settings updated successfully');
    }
}
