<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Plan;
use App\Models\Banner;
use App\Http\Requests\BannerRequest;
use Exception;
class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::where('status',1)->get();
        $banners = Banner::paginate(10);
        return view('admin.banners.index', compact('plans', 'banners'));
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
    public function store(BannerRequest $request)
    {

        try{
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "collection_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = public_path('uploads/banners/');
            $full_path = '/uploads/banners/'.$fileName;
            $check = $request->file('image')->move($upload_path, $fileName);
            $banner = Banner::create([
                'bannerId'  => '123',
                'name'      => $request->name,
                'type'      => $request->type,
                'file_path' => $full_path,
                'plan_id'   => $request->plan_id,
                'start_date'=> $request->start_date,
                'end_date'  => $request->end_date,
                'display_area'=> $request->display_area,

            ]);
        }catch (Exception $ex) {
           return redirect()->back()->with("error", $ex->getMessage());
        }
       return redirect()->back()->with("success", "Banner Created Successfully!");
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
        $banner = Banner::findOrFail($id);
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "collection_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = public_path('uploads/banners/');
            $full_path = '/uploads/banners/'.$fileName;
            $check = $request->file('image')->move($upload_path, $fileName);
            $banner->file_path = $full_path;
        }
        $banner->name       = $request->name;
        $banner->type       = $request->type;
        $banner->plan_id    = $request->plan_id;
        $banner->start_date = $request->start_date;
        $banner->end_date   = $request->end_date;
        $banner->display_area = $request->display_area;
        $banner->update();
        return redirect()->back()->with("success", "Banner Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();
        return redirect()->back()->with("success", "Banner Deleted Successfully!");
    }
}
