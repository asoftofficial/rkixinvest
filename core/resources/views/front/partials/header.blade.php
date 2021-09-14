<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{$settings->fav_icon}}">
    <title>{{$settings->web_title}}</title>
    <!-- Bootstrap core CSS -->
    <link href="{{ asset('assets/plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome-free/css/all.min.css') }}">
    {{-- Carousal Style --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">



    <!-- Custom styles for this template -->
    <style>
        :root {
            --blue: #0172FF;
            --black: #000000;
            --gray: #474747;
            --light-gray: #EEEEEE;
            --white: #FFFFFF;
        }

    </style>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <style>
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p,
        li,
        a {
            font-family: 'Rubik', sans-serif !important;
        }

    </style>
    <link rel="stylesheet" href="{{ asset('assets/frontend/css/front.css') }}">
    @stack('style')

</head>

<body>
    <header>
        <!--topbar area start-->
        @include('front.partials.topbar')
        <!--topbar area end-->

        <!--navbar start-->
        @include('front.partials.navbar')
        <!--navbar end-->
    </header>
