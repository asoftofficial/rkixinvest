@extends('layouts.auth-layout')
@section('page-title')
    Sign Up
@endsection
@section('content')
<section class="register-form py-5">
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="row justify-content-center">
            <div class="form-title text-center ">
                <h2>Let's get started</h2>
                <p>Follow the steps to quickly create an account</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
            <label for="fname" class="text-white">First Name</label>
                <input id="fname" name="first_name"  value="{{ old('first_name') }}" type="text" class="form-control autocar-input @error('first_name') is-invalid @enderror"" placeholder="First name">
                @error('first_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="col-md-6">
                <label for="lname" class="text-white">Last Name</label>
                <input id="lname" name="last_name" value="{{ old('last_name') }}" type="text" class="form-control autocar-input @error('last_name') is-invalid @enderror"" placeholder="Last name">
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="email" class="text-white">Email</label>
                <input id="email" name="email" type="text" class="form-control autocar-input  @error('email') is-invalid @enderror" placeholder="Email"  value="{{ old('email') }}">
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <label for="password" class="text-white">Password</label>
                <input id="password" name="password" type="password" class="form-control autocar-input  @error('email') is-invalid @enderror" placeholder="Password">
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="form-check form-check-inline">
                    <input class="form-check-input required @error('terms') is-invalid @enderror" type="checkbox" id="inlineCheckbox1" name="terms" value="option1">
                    <label class="form-check-label" for="inlineCheckbox1">I confirm I have read and agree to the Terms and Conditions and Privacy Policy</label>

                </div>
                <span class="forgot"><a href="{{ route('password.request') }}">Forgot password?</a></span>
                @error('terms')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <button type="submit" class="btn btn-primary btn-block btn-red text-uppercase">Sign Up</button>
            </div>
        </div>
    </form>
    <div class="form-footer">
        <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
    </div>
</section>
@endsection
