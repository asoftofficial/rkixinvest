<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Plan;
use App\Models\Promotion;
use Illuminate\Http\Request;

class PromotionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['plans'] = Plan::where(['status'=>1])->get();
        $data['promotions'] = Promotion::paginate(10);
        return view('admin.promotions.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'name' => 'required',
            'image' => 'required|image',
            'desc' => 'required',
            'plan' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'discount' => 'required',
            'code' => 'nullable|min:6',
        ]);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = "collection_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
        $upload_path = public_path('uploads/promotions/');
        $full_path = '/uploads/promotions/'.$fileName;
        $check = $request->file('image')->move($upload_path, $fileName);
        for ($i=1; $i<=$request->number_of_codes; $i++){
            try{
                $code = empty($request->code) || $request->number_of_codes > 1 ? rand(000000,999999) : $request->code;
                $limit_per_user = empty($request->limit_per_user) ? '-1' : $request->limit_per_user;
                $limit_per_coupon = empty($request->limit_per_coupon) ? '-1' : $request->limit_per_coupon;
                $banner = Promotion::create([
                    'name'      => $request->name,
                    'desc' => $request->desc,
                    'discount_type'      => $request->type,
                    'logo' => $full_path,
                    'plan_id'   => $request->plan,
                    'start_date'=> $request->start_date,
                    'end_date'  => $request->end_date,
                    'discount' => $request->discount,
                    'code' => $code,
                    'limit_per_user' => $limit_per_user,
                    'limit_per_coupon' => $limit_per_coupon
                ]);
            }catch (Exception $ex) {
                return redirect()->back()->with("error", $ex->getMessage());
            }
        }
        $msg = $request->number_of_codes > 1 ? "Promotions Created Successfully!" : "Promotion Created Successfully!";
        return redirect()->back()->with("success", $msg);
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
        $promotion = Promotion::findOrFail($id);
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "collection_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = public_path('uploads/promotions/');
            $full_path = '/uploads/promotions/'.$fileName;
            $check = $request->file('image')->move($upload_path, $fileName);
            $promotion->logo = $full_path;
        }
        $code = empty($request->code) ? rand(000000,999999) : $request->code;
        $limit_per_user = empty($request->limit_per_user) ? '-1' : $request->limit_per_user;
        $limit_per_coupon = empty($request->limit_per_coupon) ? '-1' : $request->limit_per_coupon;
        $promotion->name      = $request->name;
        $promotion->desc = $request->desc;
        $promotion->discount_type = $request->type;
        $promotion->plan_id   = $request->plan;
        $promotion->start_date = $request->start_date;
        $promotion->end_date  = $request->end_date;
        $promotion->discount = $request->discount;
        $promotion->code = $code;
        $promotion->limit_per_user = $limit_per_user;
        $promotion->limit_per_coupon = $limit_per_coupon;
        $promotion->save();
        return redirect()->back()->with("success", "Promotion Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promotion = Promotion::findOrFail($id);
        $promotion->delete();
        return redirect()->back()->with("success", "Promotion Deleted Successfully!");
    }
}
