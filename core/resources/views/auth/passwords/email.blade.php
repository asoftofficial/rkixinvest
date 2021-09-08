
@extends('layouts.auth-layout')
@section('page-title')
    Reset email
@endsection
@section('content')
<section class="register-form py-5">
    <div class="center-container">
        <div class="login-form-area">
            <div class="card">
                <div class="card-body">
                    <div class="center-container">
                        <div class="login-form-area">
                            <div class="login-title-area">
                                <h2>Rest Your Passowrd</h2>
                                <p>Rest your account so you can continue using our customer experience.</p>
                            </div>
                         <form method="POST" action="{{ route('password.email') }}">
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
                            <button type="submit" class="btn btn-primary btn-block .btn-blue mt-3">Reset link</button>
                    </form>
                        </div>
                    </div>
                </div>
                {{-- <div class="form-footer">
                    <p>Create new account? <a href="{{ route('register') }}">Register</a></p>
                </div> --}}
            </div>
        </div>
    </div>
</section>
@endsection
