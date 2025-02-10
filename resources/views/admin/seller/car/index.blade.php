@extends('admin.layout')
@section('content')

@push('custom-styles')
<style>
   .switch {
  position: relative;
  display: inline-block;
  width: 46px;
  height: 24px;
  margin: 0 14px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 4px;
  bottom: 3px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(20px);
  -ms-transform: translateX(20px);
  transform: translateX(20px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
</style>

@endpush

<div class="row mt-2">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <h2>Car Posts</h2>
    </div>
</div>
<div class="row mt-2">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
        <a href="{{url('seller/car/create')}}" class="btn btn-primary">Create Car Post</a>
    </div>
</div>
<div class="row mt-2">



    <div class="col-12">
    @if(session()->has('message'))
<div class="alert alert-success" role="alert" id="alert">
{{session('message')}}
</div>
@endif
        <div class="card">
            <div class="card-body">
                <h4 class="mt-0 header-title">Car Posts</h4>
                <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                    <thead>
                        <tr>
                            <th>Make</th>
                            <th>Model</th>
                            {{-- <th>Seller</th>
                            <th>Seller Type</th> --}}
                            <th>Post Created Date</th>
                            <th>Status</th>
                            <th>Total Bid</th>
                            <th>Total Bid Time</th>
                            <th>Bid Start Time</th>
                            <th>Bid End Time</th>
                            <th>Initial Bid Price</th>
                            <th>Featured</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carLists as $carList)

                        @php 
                        $currentdate = Carbon\Carbon::now();
                        $createAt = Carbon\Carbon::parse($carList->created_at);
                        $bidStart = Carbon\Carbon::parse($carList->bid_start_time);
                        $bidEnd = Carbon\Carbon::parse($carList->bid_end_time);
                        $bidTime =  $bidStart->diffForHumans($bidEnd);
                        $bidTimeDay = $bidStart->diffForHumans()
                        @endphp
                        <tr>
                            <td>{{$carList->make}}</td>
                            <td>{{$carList->model}}</td>
                            {{-- <td>{{$carList->user->name}}</td>
                            <td>{{$carList->user->seller_type}}</td> --}}
                            <td>{{$carList->created_at}}</td>
                            <td>
                                @if ($carList->status == "Pending")
                                   <span class="badge badge-warning">{{$carList->status}}</span>
                                @elseif($carList->status == "Approved" || $carList->status == "Published")
                                    <span class="badge badge-pill badge-success">{{$carList->status}}</span>
                                @elseif($carList->status == "Rejected")
                                    <span class="badge badge-pill badge-danger">{{$carList->status}}</span>
                                @endif
                            </td>
                            <td>{{$carList->total_bid != null ? $carList->total_bid : 0 }}</td>
                            <td>{{0}}</td>
                            <td>{{$carList->bid_start_time != null ? $carList->bid_start_time : 'Not Set'}}</td>
                            <td>{{$carList->bid_end_time != null ? $carList->bid_end_time : 'Not Set' }}</td>
                            <td>$ {{$carList->initial_bid_price}}</td>
                            <td><label class="switch">
                            <input type="checkbox" data-id="{{$carList->id}}" class="is_featured" @checked($carList->is_featured == true)>
                            <span class="slider"></span>
                            </label></td>
                            <td style="white-space: nowrap; width: 15%;">
                                {{-- <a type="button" class="tabledit-edit-button btn btn-sm btn-success" style="float: none; margin: 4px;"><i class="fas fa-pencil-alt"></i></a>
                                <a type="button" class="tabledit-edit-button btn btn-sm btn-danger" style="float: none; margin: 4px;"><i class="fas fa-trash-alt"></i></a> --}}
                                <a type="button" href="{{url('/seller/car/'.encrypt($carList->id))}}" class="tabledit-edit-button btn btn-sm btn-info" style="float: none; margin: 4px;"><i class="fas fa-eye"></i></a>
                                @if ($carList->is_request == 0 && ($carList->bid_start_time == null || $carList->bid_end_time == null))
                                <a type="button" href="{{url('/seller/car/request/'.$carList->id)}}" class="tabledit-edit-button btn btn-sm btn-warning" style="float: none; margin: 4px;"><i class="fas fa-arrow-up"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
@section('script')
    <script>
        $(document).ready(function(){
            $('#datatable').DataTable();
        });

        $(document).ready(function(){

$('.is_featured').change(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
        }
    });

    var id = $(this).data('id');
    $.ajax({
        type:'POST',
        dataType:'json',
        url:"{{url('/seller/car/featured')}}"+"/"+id,
        success:function(data){
            console.log('success');
        }
    })
})
});
    </script>
@endsection
