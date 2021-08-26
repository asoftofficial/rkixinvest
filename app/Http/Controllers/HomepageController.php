<?php

namespace App\Http\Controllers;

use App\Models\Homepage;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //about us page settings
    public function about()
    {
        $aboutus = Homepage::first();
        return view('admin.settings.frontend-pages.about-us',compact('aboutus'));
    }

    public function updateAbout(Request $request)
    {
        $aboutus = Homepage::first();
        $aboutus->section_title = $request->title;
        $aboutus->section_heading = $request->heading;
        $aboutus->section_image = $request->image;
        $aboutus->section_description = $request->description;
        $aboutus->button_text = $request->button_text;
        $aboutus->link = $request->link;
        $aboutus->update();
        return back()->with('success','about us section updated successfyully');
    }

    // how to page settings
     public function steps()
    {
        $data = Homepage::first();
        return view('admin.settings.frontend-pages.how-to',compact('data'));
    }

    public function updateHowto(Request $request)
    {
        dd($request);
        $data = Homepage::first();
        $data->section_title = $request->title;
        $data->section_heading = $request->heading;
        $data->section_image = $request->image;
        $data->section_description = $request->description;
        $data->button_text = $request->button_text;
        $data->link = $request->link;
        $data->update();
        return back()->with('success','about us section updated successfyully');
    }
}
