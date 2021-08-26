<?php

namespace App\Http\Controllers;

use App\Models\Homepage;
use App\Models\SocialLink;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $sociallinks = SocialLink::first();
        $aboutus = Homepage::first();
        $data = Homepage::first();
        $testimonials = Testimonial::all();
        return view('front.index',compact('sociallinks','aboutus','data','testimonials'));
    }
}
