@extends('admin.layout')

@section('content')

<div class="row">
    <div class="col-sm-12">
        <div class="page-title-box">
            <h4 class="page-title">Car Post Detail</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
        <div class="card">
            <div class="card-body">
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
                                    <img src="{{asset($car_image)}}" alt=""  width="320" height="240">
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
                                        <a class="float-left" href="{{asset($car_video)}}" title="Project 1">
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