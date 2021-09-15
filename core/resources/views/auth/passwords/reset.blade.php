@extends('layouts.auth-layout')
@section('page-title')
    Reset Password
@endsection
@section('content')
<section class="register-form py-5">
    <div class="center-container">
        <div class="login-form-area">
            <div class="card">
                <div class="card-body">
                    <div class="login-title-area">
                        <h2>Reset your password</h2>
                        <p>Reset your account password so you can continue using our customer experience.</p>
                    </div>
                       <form method="POST" action="{{ route('reset.password.post') }}" >
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input id="email" type="text" class="form-control autocar-input @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                         <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" id="password" class="form-control autocar-input @error('password') is-invalid @enderror" name="password" placeholder="New Password" required autocomplete="new-password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="password-confirm">Confirm Password</label>
                            <input type="password" id="password-confirm" class="form-control autocar-input @error('password_confirmation') is-invalid @enderror" name="password_confirmation" placeholder="Confirm Password" required>
                            @error('password_confirmation')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row ">
                            <div class="col-8 pb-4">
                                 <button type="submit" class="mt-3 reset-button btn btn-primary btn-block btn-blue text-uppercase">Reset Password</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
