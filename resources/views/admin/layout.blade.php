<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="csrf-token" content="{{csrf_token()}}">
    <!-- Bootstrap CSS -->
    {{-- <link rel="stylesheet" href="{{ asset('admin/assets/vendor/bootstrap/css/bootstrap.min.css') }}">
    <link href="{{ asset('admin/assets/vendor/fonts/circular-std/style.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('admin/assets/libs/css/style.css') }}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css"
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
     <link rel="stylesheet" type="text/css" href="{{asset('admin/assets/vendor/image-uploader/image-uploader.min.css')}}">

    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/fontawesome/css/fontawesome-all.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/charts/chartist-bundle/chartist.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/charts/morris-bundle/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/charts/c3charts/c3.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/flag-icon-css/flag-icon.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/vendor/fonts/flag-icon-css/flag-icon.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/vendor/datatables/css/dataTables.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/vendor/datatables/css/buttons.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/vendor/datatables/css/select.bootstrap4.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('admin/assets/vendor/datatables/css/fixedHeader.bootstrap4.css') }}"> --}}
    <link href="{{ asset('admin/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('admin/assets/css/icons.css') }}" rel="stylesheet" type="text/css">
     <!-- DataTables -->
     <link href="{{asset('admin/assets/plugins/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{asset('admin/assets/plugins/datatables/buttons.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{asset('admin/assets/plugins/magnific-popup/magnific-popup.css')}}" rel="stylesheet" type="text/css">
     <!-- Responsive datatable examples -->
     <link href="{{asset('admin/assets/plugins/datatables/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('admin/assets/plugins/dropify/css/dropify.min.css')}}" rel="stylesheet">
    <link href="{{asset('admin/assets/plugins/summernote/summernote-bs4.css')}}" rel="stylesheet" />
    <link href="{{ asset('admin/assets/css/style.css') }}" rel="stylesheet" type="text/css">
    @stack('custom-styles')
    <title>Car Swagged Auto</title>
</head>
<body class="fixed-left">
    <div id="wrapper">
        <div class="left side-menu">
            <button type="button" class="button-menu-mobile button-menu-mobile-topbar open-left waves-effect">
                <i class="ion-close"></i>
            </button>

            <!-- LOGO -->
            <div class="topbar-left">
                <div class="text-center bg-logo">
                    <a href="{{url('/')}}" class="logo"><i class="mdi mdi-bowling text-success"></i>Car Swaggers</a>
                    <!-- <a href="index.html" class="logo"><img src="assets/images/logo.png" height="24" alt="logo"></a> -->
                </div>
            </div>
            <div class="sidebar-user">
                <img src="{{asset('admin/assets/images/users/avatar-6.jpg')}}" alt="user" class="rounded-circle img-thumbnail mb-1">
                @if(Auth::check())
                <h6 class="">{{Auth::user()->name}}</h6>
                @endif
                <ul class="list-unstyled list-inline mb-0 mt-2">
                    <li class="list-inline-item">
                        <a href="{{url('user/profile')}}" class="" data-toggle="tooltip" data-placement="top" title="Profile"><i class="dripicons-user text-purple"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class=""><i class="dripicons-power text-danger"></i></button>
                        </form>
                        {{-- <a href="#" class="" data-toggle="tooltip" data-placement="top" title="Log out"><i class="dripicons-power text-danger"></i></a> --}}
                    </li>
                </ul>
            </div>

            <div class="sidebar-inner slimscrollleft">
                @if(auth()->user()->user_role_id == 3)

                <div id="sidebar-menu">
                    <ul>
                        {{-- <li>
                            <a href="calendar.html" class="waves-effect"><i class="dripicons-to-do"></i><span> Calendar </span></a>
                        </li> --}}
                        <li>
                            <a class="waves-effect" href="{{url('seller/dashboard')}}"><i class="fa fa-fw fa-user-circle"></i><span> Dashboard </span></a>
                        </li>
                        <li >
                            <a class="waves-effect" href="{{url('seller/car')}}"><i class="fa fa-fw fa-user-circle"></i><span> Cars </span></a>
                        </li>
                        <!-- <li>
                            <a class="waves-effect"  href="#"><i class="fa fa-fw fa-user-circle"></i><span> Buyers </span></a>
                        </li>
                        <li >
                            <a class="waves-effect"  href="#"><i class="fa fa-fw fa-user-circle"></i><span> Sellers </span></a>
                        </li> -->
                        <li >
                            <a class="waves-effect"  href="{{url('seller/comments')}}"><i class="fa fa-fw fa-comment"></i><span> Comments </span></a>
                        </li>
                        <li >
                            <a class="waves-effect"  href="{{url('seller/questions')}}"><i class="fa fa-fw fa-question"></i><span> Questions </span></a>
                        </li>
                        <li >
                            <a class="waves-effect"  href="{{url('seller/seller-request')}}"><i class="fa fa-fw fa-file"></i><span> Request For Admin </span></a>
                        </li>
                    </ul>
                </div>

                @elseif(auth()->user()->user_role_id == 4)
                    <div id="sidebar-menu">
                        <ul>
                            <li></li>
                        </ul>
                    </div>
                @elseif(auth()->user()->user_role_id == 1 || auth()->user()->user_role_id == 2)
                    <div id="sidebar-menu">
                        <ul>
                            <li>
                                <a class="waves-effect" href="{{url('admin/dashboard')}}"><i class="fa fa-fw fa-user-circle"></i><span> Dashboard </span></a>
                            </li>
                            <li >
                                <a class="waves-effect" href="{{url('admin/car')}}"><i class="fa fa-fw fa-user-circle"></i><span> Cars </span></a>
                            </li>
                            <li>
                                <a class="waves-effect"  href="{{url('admin/buyers')}}"><i class="fa fa-fw fa-user-circle"></i><span> Buyers </span></a>
                            </li>
                            <li >
                                <a class="waves-effect"  href="{{url('admin/sellers')}}"><i class="fa fa-fw fa-user-circle"></i><span> Sellers </span></a>
                            </li>

                            <li >
                            <a class="waves-effect"  href="{{url('admin/comments')}}"><i class="fa fa-fw fa-comments"></i><span> Comments </span></a>
                        </li>

                        <li >
                            <a class="waves-effect"  href="{{url('admin/testimonials')}}"><i class="far fa-fw fa-comments" ></i><span> Testimonials </span></a>
                        </li>
                       
                        <li >
                            <a class="waves-effect"  href="{{url('admin/seller-requests')}}"><i class="far fa-fw fa-file"></i><span> Seller Requests </span></a>
                        </li>
                       
                        <li >
                            <a class="waves-effect"  href="{{url('admin/faq')}}"><i class="far fa-fw fa-question-circle"></i><span> Faq </span></a>
                        </li>

                        <li >
                            <a class="waves-effect"  href="{{url('admin/settings')}}"><i class="fa fa-fw fa-cog"></i><span> Settings </span></a>
                        </li>
                        
                        </ul>
                    </div>
                @endif
                <div class="clearfix"></div>
            </div> <!-- end sidebarinner -->
        </div>

        <div class="content-page">
            <!-- Start content -->
            <div class="content">

                <!-- Top Bar Start -->
                <div class="topbar">

                    <nav class="navbar-custom">

                        <ul class="list-inline float-right mb-0">
                            <li class="list-inline-item dropdown notification-list">
                                <a class="nav-link dropdown-toggle arrow-none waves-effect nav-user" data-toggle="dropdown" href="#" role="button"
                                   aria-haspopup="false" aria-expanded="false">
                                    <img src="{{asset('admin/assets/images/users/avatar-6.jpg')}}" alt="user" class="rounded-circle">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right profile-dropdown ">
                                    <!-- item-->
                                    <div class="dropdown-item noti-title">
                                        <h5>Welcome</h5>
                                    </div>
                                    <a class="dropdown-item" href="{{url('user/profile')}}"><i class="mdi mdi-account-circle m-r-5 text-muted"></i> Profile</a>
                                    <div class="dropdown-divider"></div>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button class="dropdown-item" href="{{url('/logout')}}"><i class="mdi mdi-logout m-r-5 text-muted"></i>Logout</button>
                                    </form>
                                </div>
                            </li>
                        </ul>

                        <ul class="list-inline menu-left mb-0">
                            <li class="float-left">
                                <button class="button-menu-mobile open-left waves-light waves-effect">
                                    <i class="mdi mdi-menu"></i>
                                </button>
                            </li>
                        </ul>

                        <div class="clearfix"></div>
                    </nav>
                </div>
                <!-- Top Bar End -->

                <div class="page-content-wrapper ">

                    <div class="container-fluid">

                        @yield('content')

                    </div><!-- container -->

                </div> <!-- Page content Wrapper -->

            </div> <!-- content -->

        </div>
    </div>




    <div class="dashboard-wrapper">
        <div class="container-fluid dashboard-content">

        </div>
    </div>

    {{-- <script src="{{ asset('admin/assets/vendor/jquery/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/bootstrap/js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/slimscroll/jquery.slimscroll.js') }}"></script>
    <script src="{{ asset('admin/assets/vendor/multi-select/js/jquery.multi-select.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/js/main-js.js') }}"></script>
    <script type="text/javascript" src="{{asset('admin/assets/vendor/image-uploader/image-uploader.min.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('admin/assets/vendor/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('admin/assets/vendor/datatables/js/buttons.bootstrap4.min.js') }}"></script>
     <script src="{{ asset('admin/assets/vendor/datatables/js/data-table.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js "></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js "></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js "></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js "></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js "></script>
    <script src="https://cdn.datatables.net/rowgroup/1.0.4/js/dataTables.rowGroup.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.2.7/js/dataTables.select.min.js"></script>
    <script src="https://cdn.datatables.net/fixedheader/3.1.5/js/dataTables.fixedHeader.min.js"></script> --}}
<script>
    setTimeout(() => {
  const box = document.getElementById('alert');
  
  box.style.display = 'none';

}, 3000);
</script>
    <script src="{{asset('admin/assets/js/jquery.min.js')}}"></script>

    <script src="{{asset('admin/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/modernizr.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/detect.js')}}"></script>
    <script src="{{asset('admin/assets/js/fastclick.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.slimscroll.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.blockUI.js')}}"></script>
    <script src="{{asset('admin/assets/js/waves.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.nicescroll.js')}}"></script>
    <script src="{{asset('admin/assets/js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/dropify/js/dropify.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/summernote/summernote-bs4.min.js')}}"></script>
    <!-- Required datatable js -->
    <script src="{{asset('admin/assets/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/dataTables.bootstrap4.min.js')}}"></script>
    <!-- Buttons examples -->
    <script src="{{asset('admin/assets/plugins/datatables/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/buttons.bootstrap4.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/buttons.colVis.min.js')}}"></script>
    <!-- Responsive examples -->
    <script src="{{asset('admin/assets/plugins/datatables/dataTables.responsive.min.js')}}"></script>
    <script src="{{asset('admin/assets/plugins/datatables/responsive.bootstrap4.min.js')}}"></script>

    <script src="{{asset('admin/assets/plugins/chart.js/chart.min.js')}}"></script>
    <script src="{{asset('admin/assets/pages/dashboard.js')}}"></script>

    <!-- App js -->
    <script src="{{asset('admin/assets/js/app.js')}}"></script>

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
    </script>
    @yield('script')
</body>
