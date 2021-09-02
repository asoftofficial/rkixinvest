<?php

namespace App\Http\Controllers;

use App\Models\Homepage;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //about us page settings
    public function about()
    {
        $aboutus = Homepage::first();
        return view('admin.settings.frontend-pages.about-us',compact('aboutus'));
    }

    public function updateAbout(Request $request){
        $aboutus = Homepage::first();
          if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "aboutus_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = public_path('uploads/aboutus/');
            $full_path = '/uploads/aboutus/'.$fileName;
            $request->file('image')->move($upload_path, $fileName);
            $file_path  = $full_path;
            $aboutus->section_image = $file_path;
        }
        $aboutus->section_title = $request->title;
        $aboutus->section_heading = $request->heading;
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

        $data = Homepage::first();
        $data->section_title = $request->title;
        $data->step1 = $request->step1;
        $data->step2 = $request->step2;
        $data->step3 = $request->step3;
        $data->step_content = $request->description;
        $data->update();
        return back()->with('success','how to section updated successfyully');
    }


}
