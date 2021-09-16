<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page-title') | {{$settings->web_title}}</title>
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('/assets/dashboard/css/adminlte.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/backend/css/style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/plugins/toastr/css/toastr.min.css')}}">
    @stack('style')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
    @include('users.partials.nav')
    <!-- Main Sidebar Container -->
    @include('users.partials.sidebar')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <div class="content">
            @if (request()->route()->getName() !== "admin.issues.show" )
                @include('users.partials.breadcrumb')
            @endif
        <!-- Main content -->
            @yield('content')
        </div>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE -->
<script src="{{asset('assets/dashboard//js/adminlte.js')}}"></script>
<!-- OPTIONAL SCRIPTS -->
<script src="{{asset('assets/plugins/chart.js/Chart.min.js')}}"></script>
<script src="{{asset('assets/plugins/toastr/js/toastr.min.js')}}"></script>
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
@stack('script')
</body>
</html>
