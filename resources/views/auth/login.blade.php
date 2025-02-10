@extends('admin.full-layout')

@section('content')
    <div class="card">
        <div class="card-body">
            <div class="text-center m-b-15">
                @php
                    $logo = DB::table('web_settings')
                        ->where('key', 'Car Swagged Logo')
                        ->first();
                    $getUrl = json_decode($logo->value);
                    $image = implode($getUrl);
                @endphp
                <a href="{{ url('/') }}" class="logo logo-admin"><img src="{{ asset($image) }}" height="100"
                        alt="logo"></a>
            </div>
            <div class="p-3">
                <form class="form-horizontal m-t-20" method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                                name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                                placeholder="{{ __('Email Address') }}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <input id="password" type="password"
                                class="form-control @error('password') is-invalid @enderror" name="password" required
                                autocomplete="current-password" placeholder="{{ __('Password') }}">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group text-center row m-t-20">
                        <div class="col-12">
                            <button type="submit" class="btn btn-success btn-block waves-effect waves-light"
                                type="submit">{{ __('Log In') }}</button>
                        </div>
                    </div>
                    <div class="form-group m-t-10 mb-0 row">


                        <div class="col-sm-6 m-t-20">
                            @if (Route::has('password.request'))
                                <a class="text-muted" href="{{ route('password.request') }}">
                                    <i class="mdi mdi-lock"></i> <small>{{ __('Forgot Your Password?') }}</small>
                                </a>
                            @endif

                        </div>
                    </div>
                </form>
                <div class="form-group text-center row m-t-20">
                    <div class="col-12">
                        <form method="GET" action="{{ url('auth/google') }}">
                            <button type="submit" class="btn btn-success btn-block waves-effect waves-light">
                                Signin With Google
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
