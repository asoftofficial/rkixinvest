<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('page-title') | {{$settings->web_title}}</title>
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/custom.css') }}">
    @stack('style')
    <style>
        body{
            background: linear-gradient( rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7) ), url({{asset($settings->form_image)}}) !important;
            background-size: cover !important;
            background-repeat: no-repeat !important;
        }
    </style>
</head>
<body>
    <div id="app" class="body">
        <header class="auth-header">
            <div class="logo">

                    @if(empty($settings->dlogo))
                        <a href="{{route('welcome')}}"><img src="{{route('placeholder.image','200x80')}}" alt="logo"/></a>
                    @else
                        <a href="{{route('welcome')}}"><img src="{{$settings->dlogo}}" alt="logo"></a>
                    @endif
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
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(Session::has('success'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.success("{{ session('success') }}");
        @endif

            @if(Session::has('error'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.error("{{ session('error') }}");
        @endif

            @if(Session::has('info'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.info("{{ session('info') }}");
        @endif

            @if(Session::has('warning'))
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.warning("{{ session('warning') }}");
        @endif

            @if($errors->any())
            toastr.options =
            {
                "closeButton" : true,
                "progressBar" : true
            }
        toastr.info("Some Errors Occurred Please Check and Try Again");

        @endif
    </script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Maven+Pro:wght@400;500;600;700;800;900&family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    @stack('script')
</body>
</html>
