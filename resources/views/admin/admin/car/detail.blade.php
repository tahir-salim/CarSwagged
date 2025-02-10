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
            <h4 class="page-title">Car Post Detail</h4>

            
        </div>
       
        <div id="status_reason" class="modal">

<!-- Modal content -->
    <div class="modal-content">
    
    <div class="cmnt-bids">
        <h2>Reason</h2>
        <form class="bid" action="{{URL::to('admin/car-status')}}" method="POST">
            @csrf
        <input type="hidden" id="status_id" name="status_id" value="{{$carList->id}}" />
        <input type="text" name="reason" class="question form-control" placeholder="Enter here Rejected Reason">
        <button type="submit" class="question_submit btn btn-success">Submit</button>
       
</form>
    </div>
    
    </div>

</div>
        
    </div>
    
</div>
<div class="row">
    
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
    <div class="alert alert-success" id="alert-ajax">
            </div>
            @if(session()->has('message'))
            <div class="alert alert-success" id="alert" >
                {{session('message')}}
            </div>
            @endif
        <div class="card">
            <div class="card-body">
            <div class=" mb-2" >
                <label>Change Status : </label>
                <select class="form-control" name="status" id="change_status">
                    <option value="Rejected" @selected($carList->status == 'Rejected')>Rejected</option>
                    <option value="Pending" @selected($carList->status == 'Pending')>Pending</option>
                    <option value="Published" @selected($carList->status == 'Published')>Published</option>
                </select>
                
            </div>
                <table class="table table-striped mb-0">
                    <tr>
                        <td>Seller Name</td>
                        <td>{{$carList->user->name}}</td>
                        <td>Seller Type</td>
                        <td>{{$carList->user->seller_type}}</td>
                    </tr>
                    <tr>
                        <td>Make</td>
                        <td>{{$carList->make}}</td>
                        <td>Model</td>
                        <td>{{$carList->model}}</td>
                    </tr>
                    <tr>
                        <td>Year</td>
                        <td>{{$carList->year}}</td>
                        <td>Engine</td>
                        <td>{{$carList->enigne}}</td>
                    </tr>
                    <tr>
                        <td>Drivetrain</td>
                        <td>{{$carList->drivetrain}}</td>
                        <td>Mileage</td>
                        <td>{{$carList->mileage}}</td>
                    </tr>
                    <tr>
                        <td>Transmission</td>
                        <td>{{$carList->transmission}}</td>
                        <td>Title Status</td>
                        <td>{{$carList->title_status}}</td>
                    </tr>
                    <tr>
                        <td>VIN</td>
                        <td>{{$carList->vin}}</td>
                        <td>Body Style</td>
                        <td>{{$carList->body_style}}</td>
                    </tr>
                    <tr>
                        <td>Exterior color</td>
                        <td>{{$carList->exterior_color}}</td>
                        <td>Location</td>
                        <td>{{$carList->location}}</td>
                    </tr>
                    <tr>
                        <td>Interior Type</td>
                        <td>{{$carList->interior_type}}</td>
                        <td>Is Reserved ?</td>
                        <td>{{$carList->is_reserved}}</td>
                    </tr>
                    <tr>
                        <td>Initial Bid Price</td>
                        <td>$ {{$carList->initial_bid_price}}</td>
                        <td></td>
                        <td></td>
                    </tr>
                </table>

                <div class="row mt-4">
                    <div class="col-6">
                        <label>Car Description</label>
                        {!!$carList->car_description!!}
                    </div>
                    <div class="col-6">
                        <label>Highlights</label>
                        {!!$carList->highlights!!}
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-6">
                        <label>Equipment</label>
                        {!!$carList->equipment!!}
                    </div>
                    <div class="col-6">
                        <label>Modifications</label>
                        {!!$carList->modifications!!}
                    </div>
                </div>

                <div class="row mt-4">
                    <div class="col-6">
                        <label>Equipment</label>
                        {!!$carList->equipment!!}
                    </div>
                    <div class="col-6">
                        <label>Known Flaws</label>
                        {!!$carList->known_flaws!!}
                    </div>
                </div>
              
               
                <div class="row mt-2">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 " id="car_image">
                        <div class="popup-gallery car_image">
                            @foreach(json_decode($carList->car_images) as $car_image)
                            <a class="float-left" href="{{asset($car_image)}}" title="Project 1">
                                <div class="img-fluid">
                                    <img src="{{asset($car_image)}}" alt="" width="320" height="240">
                                </div>
                            </a>
                            @endforeach
                        </div>
                    </div>
                </div>
                @if(!empty($carList->car_videos))
                    
                    <div class="row mt-2">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 " id="car_videos">
                            <div class="popup-gallery car_videos">
                                <div class="row">
                                    <div class="col-12">
                                        @foreach(json_decode($carList->car_videos) as $car_video)
                                        <a class="float-left" href="{{($car_video)}}" title="Project 1">
                                        <video width="320" height="240" controls type="video/mp4 video/3gp video/avi">
                                            <source src="{{asset($car_video)}}">
                                            Your browser does not support the video tag.
                                        </video>
                                        @endforeach
                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end validation form -->
    <!-- ============================================================== -->
</div>




@endsection
@section('script')



<script>

$(document).ready(function(){
    
$('#change_status').change(function(){

$.ajaxSetup({
headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
}
});

var status = $('#change_status').val();

var id = $('#status_id').val();

    $.ajax({
    type: 'POST',
    url: '{{url("/admin/car-status")}}',
    dataType: 'json',
    data: {status:status, status_id:id},
    success: function(data){
       
        if(status == 'Rejected'){

    $('#status_reason').css('display','block');
        }else{
         console.log(data[1]);
         $('#alert-ajax').text(data[1]);
         $('#alert-ajax').css('display','block');
        }


    }
});



setTimeout(() => {
  const box = document.getElementById('alert');
  box.style.display = 'none';
}, 3000);

setTimeout(() => {
  const box2 = document.getElementById('alert-ajax');
  box2.style.display = 'none';
}, 3000);

});

});


</script>

<script>
    $('.image').on('mouseenter',function(){
        var id 
        alert($(this).attr('id'));
    });
    $('.car_image').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            verticalFit: true
		}
	});
    $('.car_image').magnificPopup({
		delegate: 'a',
		type: 'image',
		tLoading: 'Loading image #%curr%...',
		mainClass: 'mfp-img-mobile',
		gallery: {
			enabled: true,
			navigateByImgClick: true,
			preload: [0,1] // Will preload 0 - before current, and 1 after the current image
		},
		image: {
			tError: '<a href="%url%">The image #%curr%</a> could not be loaded.',
            verticalFit: true
		}
	});
</script>

@endsection