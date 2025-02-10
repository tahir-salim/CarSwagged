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
</style>

@endpush

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">User Detail</h4>
        </div>
    </div>
</div>
<div class="row">
    
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
   
        <div class="card">
            <div class="card-body">
          
                <table class="table table-striped mb-0">
                    <tr>
                        <td>Name</td>
                        <td>{{$user->name}}</td>
                        <td>Email</td>
                        <td>{{$user->email}}</td>
                    </tr>
                    <tr>
                       
                    <td>Phone</td>
                        <td>{{$user->phone}}</td>
                        <td>Address</td>
                        <td>{{$user->address}}</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>{{$user->gender}}</td>
                        <td>Age</td>
                        <td>{{$user->age}}</td>
                    </tr>
                    <tr>
                        <td>Country</td>
                        <td>{{$user->country}}</td>
                        <td>Status</td>
                        <td>{{$user->status}}</td>
                    </tr>
                    <tr>
                        <td>Seller Type</td>
                        <td>{{$user->seller_type}}</td>
                       
                    </tr>
                   
                </table>


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