<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use App\Models\Roi;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class RoiController extends Controller
{
    public function index($id)
    {
        $investment = Investment::find($id);
        return view('users.Rois.index',compact('investment'));
    }
}
