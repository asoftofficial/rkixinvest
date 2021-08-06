<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

            $users = User::all();
            return view('admin.users.index' ,compact('users'));

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
            'fname' => ['required'],
            'lname' => ['required'],
            'email' => ['required'],



    ]);

    User::create([
        'first_name' => $request->fname,
            'last_name' => $request->lname,
            'email' => $request->email,





    ]);
return back()->with('success','user created successfully');
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
        $users = User::findOrFail($id);
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "packages_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = public_path('uploads/packages/');
            $full_path = '/uploads/packages/'.$fileName;
            $check = $request->file('image')->move($upload_path, $fileName);
            // $packages->file_path  = $full_path;
        }

        $users->first_name        = $request->fname;
        $users->last_name = $request->lname;
        $users->email      = $request->email;
        $users->update();
        // return redirect()->back()->with("success", "package Updated Successfully!");
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $users = User::findOrFail($id);
        $users->delete();
        return redirect()->back()->with("success", "User Deleted Successfully!");
    }




    public function blocked(Request $request,$id)
    {

        $a = $request->id;
        $b = User::findOrFail($id)->id;
        $c = User::findOrFail($id)->blocked;
        if($a == $b && $c== 0){
            User::where('id', $b)->update(['Blocked' => 1]);
        }elseif($a == $b && $c !==0){
            User::where('id', $b)->update(['Blocked' => 0]);
        }

return back();

    }


    public function sendmail(Request $request)
    {

         $data = [$request->subject,$request->body];
        $user = $request->hidden_email;
        Mail::send('admin.users.emails.test', compact('data'), function ($message) use ($user, $data) {

            $message->to($user)     ;
        });

    //    Mail::to($user)->send(new test);

return back()->with('success','email has sent');
    }
}
