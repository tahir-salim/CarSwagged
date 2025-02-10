<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
    <meta name="description" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Car Swagged Auto</title>
    <link rel="stylesheet" href="{{ asset('website/assets/css/layout.css') }}">
    <link rel="stylesheet" href="{{ asset('website/assets/css/style.css') }}">
    @stack('custom-styles')
    <link rel="icon" href="favicon.png" type="image/x-icon">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>

<body>
    <header>
        <div class="main-header">
            <div class="container-fluid">
                <div class="menu-Bar">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
                <div class="row align-items-center">
                    <div class="col-md-2 text-left">
                        <a href="{{ url('/') }}" class="logo">
                            @php
                                $logo = DB::table('web_settings')
                                    ->where('key', 'Car Swagged Logo')
                                    ->first();
                                $getUrl = json_decode($logo->value);
                                $image = implode($getUrl);
                            @endphp
                            <img src="{{ asset($image) }}" alt="" width="175px" height="175px">
                        </a>`
                    </div>
                    <div class="col-md-4">
                        <div class="search-bar">
                            <div class="fld">
                                <form action="{{ route('search.car') }}">
                                    <input type="text" name="search" placeholder="Search for cars">
                                    <span class="icon"><i class="fas fa-search"></i></span>
                                </form>
                            </div>
                            @if (!auth()->check())
                                <button class="sign-btn signUp">Sign Up</button>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6 text-right">
                        <div class="menuWrap">
                            <ul class="menu">
                                <li class="@yield('auction')"><a href="{{ url('/') }}">Auctions</a></li>
                                <li class="@yield('sellacar')"><a href="{{ url('/sell-car') }}">Sell a Car</a></li>
                                <li class="@yield('swagged')"><a href="{{ url('/swagged-auto') }}">What’s Car Swagged
                                        Auto is?</a></li>
                                <li><a href="#" class="email-pop">Daily Email</a></li>
                                @if (auth()->check())
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <button type="submit" class="list-btn">SignOut</button>
                                        </form>
                                    </li>
                                    {{-- <li>
                                        <a href="{{url('/login')}}">Dashboard</a>
                                    </li> --}}
                                @else
                                    <li>
                                        <a href="{{ url('/login') }}">SignIn</a>
                                    </li>
                                @endif


                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    @yield('content')

    <footer>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2">
                    <div class="widget">
                        <a href="{{ url('/') }}" class="flogo">
                            <img src="{{ asset($image) }}" alt="" width="175px" height="175px">
                        </a>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget">
                        <h6>HOW IT WORKS</h6>
                        <ul>
                            <li><a href="{{ url('/swagged-auto#buy-car') }}">Buying a Car</a></li>
                            <li><a href="{{ url('/swagged-auto#sell-car') }}">Selling a Car</a></li>
                            <li><a href="{{ url('/swagged-auto#final-sale') }}">Finalizing the Sale</a></li>
                            <li><a href="{{ url('/swagged-auto#buy-faq') }}">FAQs</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="widget">
                        <h6>SELLERS</h6>
                        <ul>
                            <li><a href="#">Submit Your Car</a></li>
                            <li><a href="#">Photography Guide</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="widget">
                        <h6>HELPFUL LINKS</h6>
                        <ul>
                            <li><a href="#">Support</a></li>
                            <li><a href="#">Shop C&B Merch</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="widget">
                        <ul class="footer-social">
                            @php
                                $facebook = DB::table('web_settings')
                                    ->where('key', 'Facebook')
                                    ->first();
                            @endphp
                            <li><a href="{{ $facebook->value }}"><i class="fab fa-facebook-f"></i></a></li>
                            @php
                                $twitter = DB::table('web_settings')
                                    ->where('key', 'Twitter')
                                    ->first();
                            @endphp
                            <li><a href="{{ $twitter->value }}"><i class="fab fa-twitter"></i></a></li>
                            @php
                                $instagram = DB::table('web_settings')
                                    ->where('key', 'Instagram')
                                    ->first();
                            @endphp
                            <li><a href="{{ $instagram->value }}"><i class="fab fa-instagram"></i></a></li>
                        </ul>
                        @php
                            $a = DB::table('web_settings')
                                ->where('key', 'Footer')
                                ->first();
                        @endphp
                        <p>{{ $a->description }}</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>


    <div class="overlay"></div>
    <div class="popup">
        <div class="closePop">
            <i class="fas fa-times"></i>
        </div>
        <div class="container">
            <div class="pop-inner">
                <h4>Get the Daily Email</h4>
                <p>Get the latest auctions and market info delivered right to your inbox, plus a heads up on exclusive
                    content from Doug.</p>
                <form action="{{ URL::to('newsletter') }}" method="POST">@csrf
                    <div class="subscribe">
                        <input type="text" name="email" placeholder="Email address">
                        <button type="submit">Subscribe</button>
                    </div>
                    <ul class="parsley-errors-list filled mt-2" id="parsley-id-39">
                        <li class="parsley-required text-danger">
                            @error('email')
                                {{ $errors->first('email') }}
                            @enderror
                        </li>
                    </ul>
                </form>

            </div>
        </div>
    </div>


    <!-- <div class="signUpPopSeller">
             <div class="closePop">
                 <i class="fas fa-times"></i>
             </div>
             <div class="container">
                 <div class="pop-inner">
                     <h4>Sign Up <span class="text-success">Seller</span></h4>
                     <p>Already have an account? <a href="#" class="text-success loginUp">Sign In here</a></p>
                     <form>
                    <input type="text" name="" placeholder="Email Address Here...." required="">
                    <input type="password" name="" placeholder="Password Here...." required="">
                    <input type="password" name="" placeholder="Confirm Password Here...." required="">
                    <div class="sbt">
                        <button>Submit</button>
                    </div>

                     </form>
                 </div>
             </div>
        </div>

        <div class="signUpPopBuyer">
             <div class="closePop">
                 <i class="fas fa-times"></i>
             </div>
             <div class="container">
                 <div class="pop-inner">
                     <h4>Sign Up <span class="text-success">Buyer</span></h4>
                     <p>Already have an account? <a href="#" class="text-success loginUp">Sign In here</a></p>
                     <form>
                    <input type="text" name="" placeholder="Email Address Here...." required="">
                    <input type="password" name="" placeholder="Password Here...." required="">
                    <input type="password" name="" placeholder="Confirm Password Here...." required="">
                    <div class="sbt">
                        <button>Submit</button>
                    </div>

                     </form>
                 </div>
             </div>
        </div>

        <div class="LoginPopup">
             <div class="closePop">
                 <i class="fas fa-times"></i>
             </div>
             <div class="container">
                 <div class="pop-inner">
                     <h4>Sign In</h4>
                     <p>Need to create an account? <a href="#" class="text-success signUp">Sign Up here</a></p>
                     <form>

                    <input type="text" name="" placeholder="Email Address Here...." required="">
                    <input type="password" name="" placeholder="Password Here...." required="">

                    <div class="sbt">
                        <button>Submit</button>
                    </div>

                     </form>
                 </div>
             </div>
        </div> -->

    <div class="signUpPop">
        <div class="closePop">
            <i class="fas fa-times"></i>
        </div>
        <div class="container">
            <div class="pop-inner">
                <h4>Sign Up</h4>
                <p>Already have an account? <a href="{{ url('/login') }}" class="text-success">Sign In here</a></p>
                <a href="{{ url('/seller/register') }}" class="btn btn-success">Become a Seller</a>

                <a href="{{ url('/register') }}" class="btn btn-info">Become a Buyer</a>
            </div>
        </div>
    </div>

    <script src="{{ asset('website/assets/js/jquery.js') }}"></script>
    <script src="{{ asset('website/assets/js/custom.js') }}"></script>
    <script>
        new WOW().init();
    </script>

    @yield('script')
</body>

</html>
