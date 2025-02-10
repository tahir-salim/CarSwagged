<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="{{asset('admin/assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/icons.css')}}" rel="stylesheet" type="text/css">
    <link href="{{asset('admin/assets/css/style.css')}}" rel="stylesheet" type="text/css">
    <title>Admin - Car Swagged Auto</title>
</head>
<body>

    <div class="fixed-left">
        <div class="accountbg"></div>
        <div class="wrapper-page">
            @yield('content')
        </div>
    </div>

   <!-- jQuery  -->
   <script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>
   <script src="{{asset('admin/assets/js/popper.min.js')}}"></script>
   <script src="{{asset('admin/assets/js/bootstrap.min.js')}}"></script>
   <script src="{{asset('admin/assets/js/modernizr.min.js')}}"></script>
   <script src="{{asset('admin/assets/js/detect.js')}}"></script>
   <script src="{{asset('admin/assets/js/fastclick.js')}}"></script>
   <script src="{{asset('admin/assets/js/jquery.slimscroll.js')}}"></script>
   <script src="{{asset('admin/assets/js/jquery.blockUI.js')}}"></script>
   <script src="{{asset('admin/assets/js/waves.js')}}"></script>
   <script src="{{asset('admin/assets/js/jquery.nicescroll.js')}}"></script>
   <script src="{{asset('admin/assets/js/jquery.scrollTo.min.js')}}"></script>

   <!-- App js -->
   <script src="{{asset('admin/js/app.js')}}"></script>
    @yield('script')
</body>
