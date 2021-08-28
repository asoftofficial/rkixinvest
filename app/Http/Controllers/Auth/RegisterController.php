<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\GeneralSettings;
use App\Models\Referral;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Contracts\mail\Mailable;
use Illuminate\Support\Facades\Auth;
use Session;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    public function showRegistrationForm(Request $request)
    {
        $data['countries'] = Country::all();
        $data['sponser'] = User::where('username',$request->sponser)->first();
        $data['sponser'] = empty($data['sponser']) ? User::first() :  $data['sponser'];
        return view('auth.register',$data);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username'=> ['required','unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'terms' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $set = GeneralSettings::first();
        $getsponser = User::where('username',$data['referral'])->first();
        $sponserId = empty($getsponser) ? "1" : $getsponser->id;
            $user = new User();
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->username = Str::lower($data['username']);
            $user->email = $data['email'];
            $user->country = $data['country'];
            $user->post_code = $data['pcode'];
            $user->address = $data['address'];
            $user->type = 1;
            $user->password = Hash::make($data['password']);
            $code = $user->email_verification_code = mt_rand(000000,999999);
            // $code = $user->email_verification_code = openssl_random_pseudo_bytes(6);
            $user->save();

            // Adding Referrals to the database
            for($i=1; $i <= $set->referral_levels; $i++){
                if($sponserId>0 || !empty($sponserId)){
                    $ref = Referral::create([
                        'user_id' => $sponserId,
                        'ref_id' => $user->id,
                        'level' => 1
                    ]);
                    $sponserId = getparent($sponserId);
                }
            }
            // Send Verification Email if on from Admin panel
            if($set->email_verification=="on"){
                return sendEmailVerificationCode($data,$code);
            }
            //  return redirect()->route('verification_form')->with('success','please check your email');
    }

    public function email_verification($email_verification_code)
    {
       $user  = User::where('email_verification_code',$email_verification_code)->first();
       if(empty($user)){
           return redirect(route('register'))->with('errors','invalid url');
       }else{
           if($user->email_verified==1){
            return redirect(route('register'))->with('errors','email already verified');
           }else{
            $user->update([
                'email_verified_at' => \carbon\carbon::now(),
                'email_verification_code' => NULL,
                'email_verified' => 1
            ]);
            return redirect(route('login'))->with('err','Email successfully verified');
           }
       }
    }

    public function register(Request $request)
    {
        $set = GeneralSettings::first();
        if($set->email_verification=="off"){
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        Session::flash("message", "Your account has created successfully");
        return $this->registered($request, $user)
            ?: redirect('/login');
        }else{
            Session::flash("message", "Your account has created successfully! check your emai to verify your account");
            return redirect()->route('verification_form');
        }
    }


}
