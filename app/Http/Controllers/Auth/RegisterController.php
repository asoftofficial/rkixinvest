<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
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

    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
       // dd($data);
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

            $user = new User();
            $user->first_name = $data['first_name'];
            $user->last_name = $data['last_name'];
            $user->username = Str::lower($data['username']);
            $user->email = $data['email'];
            $user->type = 1;
            $user->password = Hash::make($data['password']);
            $code = $user->email_verified_code = Str::random(50);
            $user->save();
            Mail::send('admin.users.emails.email_verification', compact('data','code'), function ($message) use ($data) {
                $message->to($data['email']);
            });
    }

    public function email_verification($email_verification_code)
    {
       $email_verify  = User::where('email_verification_code',$email_verification_code)->first();
       if(!$email_verify){
           return redirect(route('register'))->with('errors','invalid url');
       }else{
           if($email_verify->email_verified_at){
            return redirect(route('register'))->with('errors','email already verified');
           }else{
            $email_verify->update([
                'email_verified_at' => \carbon\carbon::now(),
            ]);
            return redirect(route('admin.dashboard'))->with('success','email successfylly verified');
           }

       }
    }

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        event(new Registered($user = $this->create($request->all())));
        Session::flash("message", "Your account has created successfully Please Verify your email to login to your account!");
        return $this->registered($request, $user)
            ?: redirect('/login');
    }
}
