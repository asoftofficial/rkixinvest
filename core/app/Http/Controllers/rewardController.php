<?php

namespace App\Http\Controllers;

use App\Models\Reward;
use Illuminate\Http\Request;

class rewardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reward = Reward::all();
        return view('admin.reward.index',compact('reward'));

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
        $this->validate($request,[
            'title' => ['required','string','max:255'],
            'amount'=> ['required','integer'],
            'status' => ['required'],
            // 'referral' => ['required'],
            'description' => ['required'],
            'image' =>'image|image|mimes:jpeg,png,jpg,gif,svg|max:2048'


        ]);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = "reward_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
        $upload_path = 'uploads/reward/';
        $full_path = '/uploads/reward/'.$fileName;
        $request->file('image')->move($upload_path, $fileName);
        $file_path  = $full_path;

        $status = $request->status ? 'enabled' : 'disabled';
        Reward::create([
            'title' => $request->title,
            'amount' => $request->amount,
            'status' => $status,
            'referral' =>$request->referral,
            'image' => $file_path,
            'description' =>$request->description,
        ]);

        return back()->with('success','reward created successfully');
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
        $reward = Reward::findOrFail($id);
        if($request->hasFile('image')){
            $request->validate([
                 'image' =>'image|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
             ]);
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "reward_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = 'uploads/reward/';
            $full_path = '/uploads/reward/'.$fileName;
            $request->file('image')->move($upload_path, $fileName);
            $file_path  = $full_path;
            $reward->image   = $file_path;
        }
        $status = $request->status ? 'enabled' : 'disabled';
        $reward->title       = $request->title;
        $reward->amount       = $request->amount;
        $reward->status    = $status;
        $reward->referral = $request->refrel;
        $reward->description   = $request->description;
        $reward->update();
        return redirect()->back()->with("success", "reward Updated Successfully!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reward = Reward::findOrFail($id);
        $reward->delete();
        return redirect()->back()->with("success", "reward Deleted Successfully!");
    }





}
