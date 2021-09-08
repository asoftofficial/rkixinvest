<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login | {{env('APP_NAME')}}</title>
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom.css') }}">
    <style>

    </style>
</head>
<body>
    <div class="main">
        <div class="row">
            <div class="col-md-5 login-form">
                    <div class="login-header">
                        <div class="logo">
                            @if(empty($settings->dlogo))
                                <img src="{{route('placeholder.image','200x80')}}" alt="logo" />
                            @else
                                <img src="{{$settings->dlogo}}" alt="logo">
                            @endif
                        </div>
                    </div>
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
                            <button type="submit" class="btn btn-primary btn-block .btn-blue">Reset link</button>
                    </form>
                        </div>
                    </div>
            </div>
            <div class="col-md-7 login-right" style="background: linear-gradient( rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8) ), url({{'/'.$settings->form_image}});">
                <div class="center-container">
                    <div class="login-right-area">
                        <h2>Already Have an Account</h2>
                        <p>Log In Now</p>
                        <a href="{{ route('login') }}" class="btn btn-primary btn-block .btn-blue">Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
</body>
</html>


