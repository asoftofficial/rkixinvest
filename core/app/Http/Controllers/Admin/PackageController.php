<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pack = Package::all();
        return view('admin.packages.index',compact('pack'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
        'name' => ['required'],
        'min_invest'  =>['required','integer'],
        'max_invest'  =>['required','integer'],
        'roi'  =>['required'],
        'roi_type'  =>['required'],
        'duration' => ['required','integer'],
        'duration_type' => ['required']
        ]);
        if($request->duration_type=="day" && $request->roi_type=="weekly" || $request->roi_type=="monthly" || $request->roi_type=="yearly"){
            return back()->with('error','Invalid ROI Type.');
        }
        if($request->duration_type=="week" && $request->roi_type=="monthly" || $request->roi_type=="yearly"){
            return back()->with('error','Invalid ROI Type.');
        }
        if($request->duration_type=="month" && $request->roi_type=="yearly"){
            return back()->with('error','Invalid ROI Type.');
        }
        Package::create([
                'title' => $request->name,
                'min_invest' => $request->min_invest,
                'max_invest' => $request->max_invest,
                'roi' => $request->roi,
                'roi_type' =>$request->roi_type,
                'duration' => $request->duration,
                'duration_type' => $request->duration_type,
                // 'description' =>$request->description,
        ]);
            return back()->with('success','Package created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data = Package::findOrFail($id);
        return back()->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

        'min_invest'  =>['integer'],
        'max_invest'  =>['integer'],
        'duration' => ['integer'],
        ]);
        $package = Package::findOrFail($id);
        $package->title         = $request->name;
        $package->min_invest    = $request->min_invest;
        $package->max_invest    = $request->max_invest;
        $package->roi           = $request->roi;
        $package->roi_type      = $request->roi_type;
        $package->duration      = $request->duration;
        $package->duration_type = $request->duration_type;
        $package->update();
        return back()->with("success", "package Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $package = Package::findOrFail($id);
        $package->delete();
        return back()->with("success", "package Deleted Successfully!");
    }
}
