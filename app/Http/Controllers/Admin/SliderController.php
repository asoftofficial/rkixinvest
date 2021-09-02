<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Slider;
use Illuminate\Http\Request;

use function PHPUnit\Framework\returnSelf;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.Slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $slider = new Slider;
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = "slider_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
        $upload_path = public_path('uploads/slider/');
        $full_path = '/uploads/slider/'.$fileName;
        $request->file('image')->move($upload_path, $fileName);
        $file_path  = $full_path;
        $slider->image = $file_path;
        $slider->button_text = $request->button_text;
        $slider->link  = $request->link;
        $slider->slider_content = $request->description;
        $slider->save();
        return redirect()->route('admin.slider.index')->with('success','Slider Created Successfully');
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
        $slider = Slider::find($id);
        return view('admin.Slider.edit',compact('slider'));
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
    public function remove($id)
    {
        dd("hello");
        $slider = Slider::find($id);
        $slider->delete();
        return back()->with('success','Slider deleted successfully');
    }
}
