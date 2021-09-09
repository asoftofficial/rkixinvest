@extends('layouts.auth-layout')
@section('page-title')
    Log In
@endsection
@section('content')
<section class="register-form py-5">
    <div class="center-container">
        <div class="login-form-area">
            <div class="card">
                <div class="card-body">
                    <div class="login-title-area">
                        <h2>Log into Your Account</h2>
                        <p>Log your account so you can continue using our customer experience.</p>
                    </div>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input id="exampleInputEmail1" type="text" class="form-control autocar-input @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control autocar-input" name="password" id="exampleInputPassword1" placeholder="Password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                         </div>
                        <div class="login-form-footer">
                            <div class="form-group form-check">
                                <input  class="form-check-input" type="checkbox" name="remember"  {{ old('remember') ? 'checked' : '' }} id="exampleCheck1">
                                <label class="form-check-label" for="exampleCheck1">Remember me</label>
                            </div>
                            @if (Route::has('password.request'))
                                <span><a href="{{ route('password.request') }}" class="text-blue">Forgot password?</a></span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-blue btn-block .btn-blue">LOG IN</button>
                    </form>
                    <div class="form-footer .login-form-footer">
                        <p>Create new account? <a href="{{ route('register') }}">Register</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
