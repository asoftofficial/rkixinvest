<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::first();
        return view('admin.settings.frontend-pages.slider',compact('slider'));
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
        //
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
        //
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
           $slider = Slider::find($id);
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "slider_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = public_path('uploads/slider/');
            $full_path = '/uploads/slider/'.$fileName;
            $request->file('image')->move($upload_path, $fileName);
            $file_path  = $full_path;
            $slider->image = $file_path;
        }
        $slider->button_text = $request->button_text;
        $slider->link  = $request->link;
        $slider->slider_content = $request->description;
        $slider->update();
        return back()->with('success','slider updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
