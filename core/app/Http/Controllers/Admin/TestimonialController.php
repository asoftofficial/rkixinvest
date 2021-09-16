<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.settings.frontend-pages.testimonial',compact('testimonials'));
    }

    public function show($id)
    {
        $testimonial = Testimonial::find($id);
        return view('admin.settings.frontend-pages.modals.testimonial.show',compact('testimonial'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'username'    => 'required',
            'designation' => 'required',
            'description' => 'required',
            'image'     => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = "testimonial_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
        $upload_path = 'uploads/testimonial/';
        $full_path = '/uploads/testimonial/'.$fileName;
        $request->file('image')->move($upload_path, $fileName);
        $file_path  = $full_path;

        Testimonial::create([
            'username'=>$request->username,
            'content'=>$request->description,
            'designation'=>$request->designation,
            'image' =>  $file_path,
        ]);
        return back()->with('success','You have created testimonial successfully');
    }

    public function update(Request $request, $id)
    {
        $testimonials = Testimonial::find($id);
         if($request->hasFile('image')){
             $request->validate([
                 'image' =>'image|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
             ]);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "testimonial_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = 'uploads/testimonial/';
            $full_path = '/uploads/testimonial/'.$fileName;
            $request->file('image')->move($upload_path, $fileName);
            $file_path  = $full_path;
            $testimonials->image   = $file_path;
        }
        $testimonials->username = $request->username;
        $testimonials->designation = $request->designation;
        $testimonials->content = $request->description;
        $testimonials->update();
        return back()->with('success','Testimonial updated successfully');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        $testimonial->delete();
        return back()->with('success','Testimonial Deleted');
    }
}
