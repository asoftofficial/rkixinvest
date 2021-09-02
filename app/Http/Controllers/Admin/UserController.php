<?php namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Mail\test;
use App\Models\GeneralSettings;
use App\Models\Investment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use PhpParser\Node\Stmt\TryCatch;

class UserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $users=User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $data = [$request->email,$request->password,$request->fname,$request->lname];
        $request->validate([
        'fname'=> 'required',
        'lname'=> 'required',
        'username'=> 'required',
        'email'=> 'required',
        'role'=> 'required',
        'image'=> 'required',
        'password'=> 'required|confirmed'
        ]);
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = "user_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
        $upload_path = public_path('uploads/users/');
        $full_path = '/uploads/users/'.$fileName;
        $request->file('image')->move($upload_path, $fileName);
        $file_path  = $full_path;
        User::create([
        'first_name'=> $request->fname,
        'last_name'=> $request->lname,
        'email'=> $request->email,
        'username'=> $request->username,
        'role'=> $request->role,
        'password'=>bcrypt($request->password),
        'image' => $file_path,
        ]);

        // Sending Email to new user with details
        Mail::send('admin.users.emails.userinfo', compact('data'), function ($message) use ($data) {
                $message->to($data[0]);
            }
        );
        return back()->with('success', 'user created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $user=User::findOrFail($id);
        return view('admin.users.userprofile', compact('user'));
    }

    public function update(Request $request, $id) {
        $users=User::findOrFail($id);
        if($request->hasFile('image')){
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileName = "user_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
            $upload_path = public_path('uploads/users/');
            $full_path = '/uploads/users/'.$fileName;
            $request->file('image')->move($upload_path, $fileName);
            $file_path  = $full_path;
             $users->image=$file_path;
        }
        $users->first_name=$request->fname;
        $users->last_name=$request->lname;
        $users->email=$request->email;
        $users->update();
        return redirect()->back()->with('success', 'profile updated successfully!');
    }
    public function changePassword(Request $request,$id)
    {
        $request->validate([
            'oldpas' => 'required',
            'newpas' => 'required',
        ]);
        $user = User::find($id);
        $user->password = bcrypt($request->newpas);
        $user->update();
        return back()->with('success','password updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $users=User::findOrFail($id);
        $users->delete();
        return redirect()->back()->with("success", "User Deleted Successfully!");
    }

    //block unblock user by admin
    public function blocked(Request $request, $id) {
        $user=User::findOrFail($id);
        $status=$user->blocked==1 ? 0: 1;
        $user->blocked=$status;
        $user->update();
        return back()->with('success', 'User Status updated');
    }

    public function sendmail(Request $request,$id)
    {
        $user = User::find($id);
        sendGeneralEmail($user->email,$request->subject,$request->body,$user->username);
        return back()->with('success', 'email has sent');
    }

    // user funds form
    public function showFundsForm() {
        return view('admin.users.modals.funds');
    }

    //add fund
    public function addFund(Request $request) {
        $settings = GeneralSettings::first();
        if($settings->add_fund == 'on'){
        $this->validate($request, ['amount'=> 'required|integer'
            ]);
        $user=User::findOrFail($request->user_id);
        $old_balance=$user->balance;
        $total_balance = $user->balance=$request->amount+$old_balance;
        $user->update();
        $trx = trx($user->id,$request->amount,1,'Funds added by admin','deposit');
        //send email to notify the user
            sendEmail($user, 'BAL_ADD', [
                'post_balance' => $old_balance,
                'amount' => $request->amount,
                'currency' => 'USD',
                'trx' => $trx->id,
                'total_balance'=> $total_balance,
                ]);
        Session::flash("message", "Fund added successfully");
        return back();
        }else{
            return back()->with('error','Add fund settings is off.');
        }

    }
    // deduction of balance
    public function subFund(Request $request) {
        $settings = GeneralSettings::first();
        if($settings->remove_fund == 'on'){
        $this->validate($request, [ 'amount'=> 'required|integer'
            ]);
        $user=User::findOrFail($request->user_id);
        $current_balance=$user->balance;
        if($current_balance <= 0){
        return back()->with('error','user balance is already 0.00');
        }else
        $total_balance = $user->balance = $current_balance - $request->amount;
        if($total_balance <0){
            $user->balance = $current_balance;
            return back()->with('info','User balance is low');
        }
        $user->update();
        $trx = trx($user->id,$request->amount,1,'Funds deducted by admin','debit');
         //send email to notify the user
            sendEmail($user, 'BAL_SUB', [
                'post_balance' => $current_balance,
                'amount' => $request->amount,
                'currency' => 'USD',
                'trx' => $trx->id,
                'total_balance'=> $total_balance,
            ]);
        return back()->with('success','Fund Deducted Successfully');
         }else{
            return back()->with('error','Subtraction settings is off.');
        }

    }


    //total investors
    public function totalInvestors()
    {
        $total_investors = Investment::all();
        return view('admin.users.pages.total-investors',compact('total_investors'));
    }
      //active investors
    public function activeInvestors()
    {
         $active_investors = Investment::where('status',1)->get();
        return view('admin.users.pages.active-investors',compact('active_investors'));
    }

    //find active users
    public function activeUsers()
    {
        $active_users = User::where('blocked',1)->get();
        return view('admin.users.pages.active-users',compact('active_users'));
    }

    //user kyc view
    public function kyc()
    {
        $kyc = User::find('kyc')->first();
        dd($kyc);
        return view('users.profile.pages.kyc','kyc');
    }

    public function storeKyc(Request $request)
    {
        $request->validate([
            'kyc' =>'required'
        ]);
        $user_kyc = new User();
         $extension = $request->file('kyc')->getClientOriginalExtension();
         $fileName = "kyc_".rand(11111,99999).'_'.time().'_'.substr($request->name,0, 6).'.'.$extension;
         $upload_path = public_path('uploads/kyc/');
         $full_path = '/uploads/kyc/'.$fileName;
         $request->file('kyc')->move($upload_path, $fileName);
         $file_path  = $full_path;
         $user_kyc->kyc=$file_path;
         $user_kyc->update();
         return back()->with('succes','file submitted');


    }

}
