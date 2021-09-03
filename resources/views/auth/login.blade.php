<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Login | {{env('APP_NAME')}}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom.css') }}">
    <style>

    </style>
</head>
<body>
    {{-- <header class="auth-header">
        <div class="logo">
            <a href="/"><img src="{{ asset('frontend/assets/images/logo.png') }}" alt=""></a>
        </div>
    </header> --}}

    <div class="main">
        <div class="row">
            <div class="col-md-5 login-form">
                    <div class="login-header">
                        <div class="logo">
                            @if(empty($settings->dlogo))
                            <img src="{{route('placeholder.image','200x80')}}"
                                alt="logo" />
                            @else
                                <img
                                src="{{$settings->dlogo}}"
                                alt="logo">
                            @endif
                        </div>
                    </div>
                    <div class="center-container">
                        <div class="login-form-area">
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
                                              <span><a href="{{ route('password.request') }}" class="btn-blue">Forgot password?</a></span>
                                          @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block .btn-blue">LOG IN</button>
                            </form>
                        </div>
                    </div>
            </div>
            <div class="col-md-7 login-right">
                <div class="center-container">
                    <div class="login-right-area">
                        <h2>Don't Have an Account Yet?</h2>
                        <p>Register in a few easy steps</p>
                        <a href="{{ route('register') }}" class="btn btn-primary btn-block .btn-blue">SIGN UP</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</body>
</html>

