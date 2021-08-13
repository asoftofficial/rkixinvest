@extends('layouts.auth-layout')
@section('page-title')
    Verify account
@endsection
@section('content')
<section class="register-form py-5">
    <form method="POST" action="{{route('email.verification')}}">
        @csrf



        <div class="row justify-content-center align-items-center mt-5">
            <div class="col-md-12 align-items-center">
                  <div class="row justify-content-center">
            <div class="form-title text-center ">
                <h2>Let's Verify your account</h2>
            </div>
        </div>
                <label for="vcode" class="text-white">Verification code</label>
                <input id="vcode" name="Vcode" type="text" class="form-control autocar-input mb-1 @error('vcode') is-invalid @enderror" placeholder="Enter your code">
                @error('pcode')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>


        <div class="row mt-3 justify-content-center">
            <div class="col-md-6">
                <button type="submit" class="btn btn-primary btn-block btn-red text-uppercase">Verify</button>
            </div>
        </div>
    </form>
</section>
@endsection
