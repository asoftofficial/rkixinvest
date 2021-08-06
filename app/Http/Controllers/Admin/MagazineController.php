<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Magazine;
use Illuminate\Http\Request;

class MagazineController extends Controller
{

    public function index()
    {
        $magazines = Magazine::all();
        $countries = Country::orderBy('name', 'ASC')->get();
        return view('admin.magazines.index',compact('countries','magazines'));
    }



    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'logo' => 'required|image',
            'description' => 'required',
            'country_id' => 'integer|required',
            'first_published' => 'required',
        ]);
        $extension = $request->file('logo')->getClientOriginalExtension();
        $fileName = "magazine_".rand(11111,99999).'_'.time().'_'.substr($request->title,0, 6).'.'.$extension;
        $upload_path = public_path('uploads/magazines/');
        $full_path = '/uploads/magazines/'.$fileName;
        $check = $request->file('logo')->move($upload_path, $fileName);
            try{
                $magazine = Magazine::create([
                    'title'      => $request->title,
                    'desc' => $request->description,
                    'logo' => $full_path,
                    'country_id'   => $request->country_id,
                    'first_published'=> $request->first_published
                ]);
            }catch (Exception $ex) {
                return redirect()->back()->with("error", $ex->getMessage());
            }
        return redirect()->back()->with("success", "Magazine Created Successfully!");
    }


    public function show($id)
    {
        //
    }





    public function update(Request $request, $id)
    {
        $mag = Magazine::findOrFail($id);
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "collection_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = public_path('uploads/magazines/');
            $full_path = '/uploads/magazines/'.$fileName;
            $check = $request->file('image')->move($upload_path, $fileName);
            $mag->file_path = $full_path;
        }
        $mag->name       = $request->name;
        $mag->type       = $request->type;
        $mag->plan_id    = $request->plan_id;
        $mag->start_date = $request->start_date;
        $mag->end_date   = $request->end_date;
        $mag->display_area = $request->display_area;
        $mag->update();
        return redirect()->back()->with("success", "Banner Updated Successfully!");
    }




    public function destroy($id)
    {
        $magazine = Magazine::findOrFail($id);
        $magazine->delete();
        return redirect()->back()->with("success", "magazine Deleted Successfully!");
    }
}
