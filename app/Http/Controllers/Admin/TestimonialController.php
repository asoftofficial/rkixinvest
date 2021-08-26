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

        $testimonials = new Testimonial();
        $testimonials->username = $request->username;
        $testimonials->designation =$request->designation;
        $testimonials->content = $request->description;
        $testimonials->create();
        return back()->with('success','you have created testimonial successfully');
    }
}
