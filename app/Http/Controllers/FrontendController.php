<?php

namespace App\Http\Controllers;

use App\Models\Homepage;
use App\Models\SocialLink;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $sociallinks = SocialLink::first();
        $aboutus = Homepage::first();
        $data = Homepage::first();
        return view('front.index',compact('sociallinks','aboutus','data'));
    }
}
