@extends('admin.layout')
@section('content')

@push('custom-styles')
<style>
    .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 100; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 50%; /* Could be more or less, depending on screen size */

}

.modal-content form{

width:100%;
}

.modal-content h2{
    text-align:center
}

.modal-content button{
    margin-top:12px;
}
#alert-ajax{
        display:none;
    }
.field-lable{
    font-weight: bold;
}
</style>

@endpush

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Update {{$user->name}} Profile</h4>

        </div>
    </div>
</div>
<div class="row">
    <!-- ============================================================== -->
    <!-- validation form -->
    <!-- ============================================================== -->
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        @if(session()->has('error'))
        <div class="alert alert-danger" role="alert">
            {{session('error')}}
        </div>
        @endif
        <div class="card">
            <div class="card-body">
                <form action={{url('user/update-profile',encrypt($user->id))}} method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('POST')
                    <div class="row mt-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6">
                            <label for="validationCustom01">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Name" value="{{$user->name}}" >
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('name')
                                    {{ $errors->first('name') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Email</label>
                            <input type="text" class="form-control" id="email" name="email" placeholder="Email" value="{{$user->email}}" disabled>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('email')
                                        {{ $errors->first('email') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Phone</label>
                            <input type="number" class="form-control" id="phone" name="phone" placeholder="XX-XXX-XXXXXX" value="{{$user->phone}}">
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('phone')
                                        {{ $errors->first('phone') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Address</label>
                            <input type="text" class="form-control" id="address" name="address" placeholder="Address" value="{{$user->address}}">
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('address')
                                        {{ $errors->first('address') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="Male" @selected($user->gender == 'Male')>Male</option>
                                <option value="Female" @selected($user->gender == 'Female')>Female</option>
                            </select>
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('gender')
                                        {{ $errors->first('gender') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Age</label>
                            <input type="number" class="form-control" id="age" name="age" placeholder="Age" value="{{$user->age}}">
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('age')
                                        {{ $errors->first('age') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="row mt-2">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col-6 ">
                            <label for="validationCustom02">Country</label>
                            <input type="text" class="form-control" id="country" name="country" placeholder="Country" value="{{$user->country}}">
                            <ul class="parsley-errors-list filled" id="parsley-id-39">
                                <li class="parsley-required">
                                    @error('country')
                                        {{ $errors->first('country') }}
                                    @enderror
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                    
                    <div class="row mt-2">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                            <button class="btn btn-primary" type="submit">Submit form</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end validation form -->
    <!-- ============================================================== -->
</div>

@endsection
@section('script')



@endsection