<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\GeneralSettings as ModelsGeneralSettings;
use Illuminate\Http\Request;

class GeneralSettings extends Controller
{
    public function store(Request $request)
    {
    ModelsGeneralSettings::create([
        'web_title' => $request->web_title,
        'description' => $request->description,
        'refrel_system' => $request->refrel_system,
        'refrellevel_type'=>$request->refrellevel_type,
        'reward_system'=>$request->reward_system,
    ]);

    return back()->with('success','settings chnaged successfully');
    }
}
