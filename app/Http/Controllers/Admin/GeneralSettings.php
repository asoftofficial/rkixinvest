<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings as ModelsGeneralSettings;
use Illuminate\Http\Request;

class GeneralSettings extends Controller
{

    public function update(Request $request)
    {

        $settings = ModelsGeneralSettings::first();


        $settings->web_title        = $request->web_title;
        $settings->description = $request->description;
        $settings->refrel_system      = $request->refrel_system;
        $settings->refrellevel_type      = $request->refrellevel_type;
        $settings->reward_system      = $request->reward_system;
        $settings->email_verification      = $request->email_verification;
        $settings->update();
     return back()->with('success','settings chnaged successfully');

    // return back()->with('success','settings chnaged successfully');
    // ModelsGeneralSettings::create([
    //     'web_title' => $request->web_title,
    //     'description' => $request->description,
    //     'refrel_system' => $request->refrel_system,
    //     'refrellevel_type'=>$request->refrellevel_type,
    //     'reward_system'=>$request->reward_system,
    //     'email_verification'=>$request->confirmation_email,



    }
}
