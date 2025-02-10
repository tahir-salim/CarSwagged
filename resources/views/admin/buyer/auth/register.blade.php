@extends('admin.full-layout')

@section('content')

    <div class="card">
        <div class="card-body">
            <div class="text-center m-b-15">
                <a href="{{url('/')}}" class="logo logo-admin"><img src="{{asset('website/assets/images/logo.png')}}" height="100" alt="logo"></a>
            </div>
            <div class="p-3">
                <form method="POST" action="{{ url('buyer/registeration') }}">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autocomplete="name" autofocus placeholder="{{ __('Name') }}">

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autocomplete="email" placeholder="{{ __('Email Address')}}">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">

                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" autocomplete="new-password" placeholder="{{ __('Password') }}">

                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-12">

                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" autocomplete="new-password" placeholder="{{ __('Confirm Password') }}">
                        </div>
                    </div>


                    
                <div class="row mb-3">
                    <div class="col-12">

                        <select class="form-control @error('gender') is-invalid @enderror" name="gender" >
                            <option disabled selected>Select Gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>

                        @error('gender')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">

                        <input type="text" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" name="phone"  placeholder="Phone">
                        @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>


                <div class="row mb-3">
                    <div class="col-12">

                        <input type="text" class="form-control @error('age') is-invalid @enderror" value="{{ old('age') }}" name="age"  placeholder="Age">
                        @error('age')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">

                        <input type="text" class="form-control @error('country') is-invalid @enderror" value="{{ old('country') }}" name="country"  placeholder="Country">
                        @error('country')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12">

                        <textarea class="form-control @error('address') is-invalid @enderror"  name="address" placeholder="Address"></textarea>
                        @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
