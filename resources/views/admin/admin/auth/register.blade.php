@extends('admin.full-layout')

@section('content')

<div class="card">
    <div class="card-body">
        <div class="text-center m-b-15">
            <a href="{{url('/')}}" class="logo logo-admin"><img src="{{asset('website/assets/images/logo.png')}}" height="100" alt="logo"></a>
        </div>
        <div class="p-3">
            <form method="POST" action="{{ url('admin/registeration') }}">
                @csrf
                <div class="row mb-3">
                    <div class="col-12">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus placeholder="{{ __('Name') }}">

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="{{ __('Email Address')}}">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">

                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="{{ __('Password') }}">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">

                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                    </div>
                </div>

                 <div class="form-group text-center row m-t-20">
                    <div class="col-12">
                        <button type="submit" class="btn btn-success btn-block waves-effect waves-light" type="submit"> {{ __('Register') }}</button>
                    </div>
                </div>
                
            </form>
        </div>

    </div>
</div>

@endsection
