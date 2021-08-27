<?php

namespace App\Http\Controllers;

use App\Models\Collection;
use App\Models\Country;
use App\Models\Issue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Plan;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function newdashboard()
    {
        return view('frontend.dashboard.index');
    }

    public function search(){
        return view('users.search');
    }

    public function admindashboard(){
        return view('backend.index');
    }

    public function adminplans(){
        return view('backend.plans.index');
    }

    public function adminplandetails(){
        return view('backend.plans.details');
    }

    public function admincollections(){
        return view('backend.collections.index');
    }

    public function adminbanner(){
        return view('backend.banners.index');
    }

    public function admincustomers(){
        return view('backend.customers.index');
    }

    public function adminissues(){
        return view('backend.issues.index');
    }

    public function adminpromotions(){
        return view('backend.promotions.index');
    }

    public function adminProfile(){
        return view('backend.profile');
    }

    public function placeholderImage($size = null){
        $imgWidth = explode('x',$size)[0];
        $imgHeight = explode('x',$size)[1];
        $text = $imgWidth . '×' . $imgHeight;
        $fontFile = realpath('font') . DIRECTORY_SEPARATOR . 'RobotoMono-Regular.ttf';
        $fontSize = round(($imgWidth - 50) / 8);
        if ($fontSize <= 9) {
            $fontSize = 9;
        }
        if($imgHeight < 100 && $fontSize > 30){
            $fontSize = 30;
        }

        $image     = imagecreatetruecolor($imgWidth, $imgHeight);
        $colorFill = imagecolorallocate($image, 100, 100, 100);
        $bgFill    = imagecolorallocate($image, 175, 175, 175);
        imagefill($image, 0, 0, $bgFill);
        $textBox = imagettfbbox($fontSize, 0, $fontFile, $text);
        $textWidth  = abs($textBox[4] - $textBox[0]);
        $textHeight = abs($textBox[5] - $textBox[1]);
        $textX      = ($imgWidth - $textWidth) / 2;
        $textY      = ($imgHeight + $textHeight) / 2;
        header('Content-Type: image/jpeg');
        imagettftext($image, $fontSize, 0, $textX, $textY, $colorFill, $fontFile, $text);
        imagejpeg($image);
        imagedestroy($image);
    }

}
