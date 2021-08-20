<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Package;

class PackagesController extends Controller
{
    public function index(Request $request)
    {
        dd("hello");
        $data['packages'] = Package::all();
        return view('users.packages.index',$data);
    }
}
