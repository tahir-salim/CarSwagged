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
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="{{asset('admin/assets/css/datetimepicker.css')}}" rel="stylesheet" type="text/css"/>
@endpush

<div class="row mt-2">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <h2>Car Posts</h2>
    </div>
</div>

<div class="row mt-2">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-right">
        <a href="{{url('admin/car/create')}}" class="btn btn-primary">Create Car Post</a>
    </div>
</div>

<div class="row mt-2">
    <div class="col-12">
    @if(session()->has('success'))
        <div class="alert alert-success" id="alert">
            {{session('success')}}
        </div>
        @endif

        @if(session()->has('error'))
        <div class="alert alert-danger" id="alert">
            {{session('error')}}
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
                            <th>Seller</th>
                            <th>Seller Type</th>
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
                        $startTime = Carbon\Carbon::parse($carList->bid_start_time);
                        $endTime = Carbon\Carbon::parse($carList->bid_end_time);
                        $totalbid = $endTime->longAbsoluteDiffForHumans($startTime);                        
                        @endphp
                        <tr>
                            <td>{{$carList->make}}</td>
                            <td>{{$carList->model}}</td>
                            <td>{{$carList->user->name}}</td>
                            <td>{{$carList->user->seller_type}}</td>
                            <td>{{$carList->created_at}}</td>                           
                            <td>
                                @if ($carList->status == "Pending")
                                   <span class="badge badge-warning">{{$carList->status}}</span>
                                @elseif($carList->status == "Published")
                                    <span class="badge badge-pill badge-success">{{$carList->status}}</span>
                                @elseif($carList->status == "Rejected")
                                    <span class="badge badge-pill badge-danger">{{$carList->status}}</span>
                                @endif
                            </td>
                            <td>{{$carList->total_bid != null ? $carList->total_bid : 0}}</td>
                            <td>{{$carList->bid_start_time && $carList->bid_end_time != null ? $totalbid : 'Not Set'}}</td>
                            <td>{{$carList->bid_start_time}}</td>
                            <td>{{$carList->bid_end_time}}</td>
                            <td>$ {{$carList->initial_bid_price}}</td>
                            <td><label class="switch">
                            <input type="checkbox" data-id="{{$carList->id}}" class="is_featured" @checked($carList->is_featured == true)>
                            <span class="slider"></span>
                            </label></td>
                            <td style="white-space: nowrap; width: 100%;">
                                <a href="{{url('/admin/car/'.encrypt($carList->id).'/edit')}}" class="tabledit-edit-button btn btn-sm btn-success" style="float: none; margin: 0;" title="Edit this Car"><i class="fas fa-pencil-alt"></i></a>
                                <a type="button" class="tabledit-edit-button btn btn-sm btn-danger" style="float: none; margin: 0;" onclick="$('#del{{$carList->id}}').submit()" title="Delete this Car"><i class="fas fa-trash-alt"></i></a>
                                <a href="{{url('/admin/car/'.encrypt($carList->id))}}" class="tabledit-edit-button btn btn-sm btn-info" style="float: none; margin: 0;" title="Show Car Detail"><i class="fas fa-eye"></i></a>
                                @if ($carList->is_request == 1 && ($carList->bid_start_time == null || $carList->bid_start_time == null))
                                <a href="#" class="tabledit-edit-button btn btn-sm btn-success timer" data-id="{{encrypt($carList->id)}}" style="float: none; margin: 0;" data-toggle="modal" data-target="#exampleModal" title="Set Bid Time"><i class="fas fa-clock"></i></a>
                                @endif
                                <form action="{{URL::to('admin/car',encrypt($carList->id))}}" method="POST" id="del{{$carList->id}}">@csrf @method('DELETE')</form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Set Bid Time</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="{{URL::to('admin/car/set_bid_time')}}" method="POST">
        @csrf
      <div class="modal-body">
          <input type="hidden" id="car_bid_id" name="car_bid_id" value="">
        <label>Start Time</label>
        <div style="width: 250px; margin: 12px auto;">
    <div id="picker"></div>
    <input type="hidden" id="result" value="" name="bid_start_time" />
</div>

        <label>End Time</label>
        <div style="width: 250px; margin: 50px auto;">
    <div id="picker2"></div>
    <input type="hidden" id="result2" value="" name="bid_end_time" />
</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary timer_close" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
      </div>
      </form>
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
                    url:'{{url("/admin/car/featured")}}'+'/'+id,
                    success:function(data){
                        console.log('success');
                    }
                })
            });

            $('.timer').click(function(){
               var id = $(this).data('id');
            //    alert(id);
               $('#car_bid_id').val(id);
            });

            $('.timer_close').click(function(){
                $('#car_bid_id').val('');
            });


        });        
    </script>
     <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js" integrity="sha512-LGXaggshOkD/at6PFNcp2V2unf9LzFq6LE+sChH7ceMTDP0g2kn6Vxwgg7wkPP7AAtX+lmPqPdxB47A0Nz0cMQ==" crossorigin="anonymous"></script>
     <script type="text/javascript" src="{{asset('admin/assets/js/datetimepicker.js')}}"></script>
        <script type="text/javascript">
    $(document).ready( function () {
        $('#picker').dateTimePicker();
        $('#picker2').dateTimePicker();
    })
    </script>
@endsection
