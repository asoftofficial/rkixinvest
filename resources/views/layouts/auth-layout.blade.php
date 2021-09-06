<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('page-title') | {{ env('APP_NAME') }}</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom.css') }}">
    @stack('style')
</head>
<body style="background: linear-gradient( rgba(0, 0, 0, 0.8), rgba(0, 0, 0, 0.8) ), url({{$settings->form_image}});">
    <div id="app" class="body">
        <header class="auth-header">
            <div class="logo">
                <a href="/">
                    @if(empty($settings->dlogo))
                        <img src="{{route('placeholder.image','200x80')}}" alt="logo" />
                    @else
                        <img src="{{$settings->dlogo}}" alt="logo">
                    @endif</a>
            </div>
        </header>
        @yield('content')

        <footer class="auth-footer">
            <div class="footer-links">
                <a href="#">Privacy Policy</a> -
                <a href="#">Terms and conditions</a> -
                <a href="#">Cookies Policy</a>
            </div>
        </footer>
    </div>
    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
@stack('script')
</body>
</html>
