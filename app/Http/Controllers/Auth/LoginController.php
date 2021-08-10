<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        if(Auth::user()->type==1){
            return redirect()->route('user.dashboard');
        }elseif(Auth::user()->type==2){
            dd("brand");
        }else{
            return redirect()->route('admin.dashboard');
        }
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function login(Request $request)
     {
         $request->validate([
             'email' => 'required',
             'password' => 'required'
         ]);
         $fieldType = filter_var($request->email, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
         $credentials = $request->only($fieldType, 'password');
         if (Auth::attempt($credentials)) {
            if(Auth::user()->type==1){
                return redirect()->route('user.dashboard');
            }elseif(Auth::user()->type==2){
                dd("brand");
            }else{
                return redirect()->route('admin.dashboard');
            }
         }

         return redirect("login")->withErrors('Oppes! You have entered invalid credentials');
     }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }


    //
}
