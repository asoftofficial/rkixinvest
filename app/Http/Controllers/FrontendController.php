<?php

namespace App\Http\Controllers;

use App\Models\Homepage;
use App\Models\Slider;
use App\Models\SocialLink;
use App\Models\Testimonial;
use App\Models\Transaction;
use App\Models\Withdrawal;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        $data['sociallinks'] = SocialLink::first();
        $data['frontdata'] = Homepage::first();
        $data['testimonials'] = Testimonial::all();
        $data['sliders'] = Slider::paginate(1);
        $data['withdrawals'] = Withdrawal::with(['user','method'])->orderBy('id','desc')->paginate(10);
        // $deposit_amount = Transaction::where('trx_type','deposit')->get();
        $data['emptyMessage'] = "No withdraws found";
        return view('front.index',$data);
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
