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

    public function store(Request $request)
    {

        $request->validate([
            'username'    => 'required',
            'designation' => 'required',
            'description'     => 'required',
        ]);
        Testimonial::create([
            'username'=>$request->username,
            'content'=>$request->description,
            'designation'=>$request->designation,
        ]);
        return back()->with('success','you have created testimonial successfully');
        // $testimonials = new Testimonial;
        // dd($testimonials);
        // $testimonials->username = $request->username;
        // $testimonials->designation =$request->designation;
        // $testimonials->content = $request->description;
        // $testimonials->create();
        // return back()->with('success','you have created testimonial successfully');
    }

    public function update(Request $request, $id)
    {
        $testimonials = Testimonial::find($id);
        $testimonials->username = $request->username;
        $testimonials->designation = $request->designation;
        $testimonials->content = $request->description;
        $testimonials->update();
        return back()->with('success','testimonial updated successfully');
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::find($id);
        $testimonial->delete();
        return back()->with('success','testimonial deleted');
    }
}
