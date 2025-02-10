@extends("website.includes.layouts")
@section("content")
@section("auction",'active')

@push('custom-styles')


<script>
    function difftimer(id){
    var id = id;
   var auchour = $('.auchour'+id).val();
   var aucmin = $('.aucmin'+id).val();
    var hours2 = (parseInt(aucmin) / 60);
var rhours2 = Math.floor(hours2);
var minutes2 = (hours2 - rhours2) * 60;
var rminutes2 = Math.round(minutes2);
    var timer82 = auchour+" : "+rminutes2+" : 01";
    var interval = setInterval(function() {
    var timer8 = timer82.split(':');
    //by parsing integer, I avoid all extra string processing
    var hours2 = parseInt(timer8[0], 10);
    var minutes2 = parseInt(timer8[1], 10);
    var seconds2 = parseInt(timer8[2], 10);
    --seconds2;
    minutes2 = (seconds2 < 0) ? --minutes2 : minutes2;
    hours2 = (minutes2 < 0) ? --hours2 : hours2;
    if (hours2 < 0) clearInterval(interval);
    seconds2 = (seconds2 < 0) ? 59 : seconds2;
    seconds2 = (seconds2 < 10) ? '0' + seconds2 : seconds2;
    minutes2 = (minutes2 < 0) ? 59 : minutes2;
    minutes2 = (minutes2 < 10) ? '0' + minutes2 : minutes2;
    //minutes2 = (minutes2 < 10) ?  minutes2 : minutes2;
    if(hours2 <= 0){
        $('.countdown-timer2'+id).html( minutes2 + ':' + seconds2);
    }else if(minutes2 <= 0){
        $('.countdown-timer2'+id).html( minutes2 + ':' + seconds2);
    }else{
    $('.countdown-timer2'+id).html( hours2 + ':' + minutes2 + ':' + seconds2);
    }
    timer82 = hours2 + ':' + minutes2 + ':' + seconds2;
    }, 1000);

}

</script>

@endpush

    <div class="main">
        <div class="hm-sec1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        <div class="left-side">
                            <div class="row">
                                <div class="col-md-6 pad-r-zero">
                                @php 
                                $yearsfrom = DB::table('car_posts')->orderBy('year','asc')->groupBy('year')->get();
                                $yearsto = DB::table('car_posts')->orderBy('year','asc')->groupBy('year')->get();
                                @endphp    
                               <form action="{{url('/')}}" id="auction_filter_form">
                                            <ul class="auc-list">
                                        <li><h4>Auctions</h4></li>
                                        <li>
                                           
                                        <select name="year_from" class="auc_filter auc_filter_from">
                                        
                                        @foreach($yearsfrom as $yearsfrom)
                                        <option @selected($yearsfrom->year == $year_from)>{{$yearsfrom->year}}</option>
                                        @endforeach
                                        </select>
                                        </li>
                                        <li>
                                        <select name="year_to" class="auc_filter auc_filter_to">
                                      
                                       @foreach($yearsto as $yearsto)
                                        <option @selected($yearsto->year == $year_to)>{{$yearsto->year}}</option>
                                        @endforeach
                                        </select>
                                        </li>
                                        <li>
                                        <select name="transmission" class="auc_filter auc_filter_transmission">
                                            <option value="All" @selected('Automatic' == $transmission)>All</option>
                                            <option value="Automatic" @selected('Automatic' == $transmission)>Automatic</option>
                                            <option value="Manual" @selected('Manual' == $transmission)>Manual</option>
                                        </select>
                                        </li>
                                        <li>
                                        <select name="body_style" class="auc_filter auc_filter_body">
                                            <option value="All" @selected('All' == $body_style)>All</option>
                                            <option value="Coupe" @selected('Coupe' == $body_style)>Coupe</option>
                                            <option value="Convertible" @selected('Convertible' == $body_style)>Convertible</option>
                                            <option value="Hatchback" @selected('Hatchback' == $body_style)>Hatchback</option>
                                            <option value="Sedan" @selected('Sedan' == $body_style)>Sedan</option>
                                            <option value="SUV/Crossover" @selected('SUV/Crossover' == $body_style)>SUV/Crossover</option>
                                            <option value="Truck" @selected('Truck' == $body_style)>Truck</option>
                                            <option value="Van/Minivan" @selected('Van/Minivan' == $body_style)>Van/Minivan</option>
                                            <option value="Wagon" @selected('Wagon' == $body_style)>Wagon</option>
                                        </select>
                                        </li>
                                    </ul>
                                    </form>
                                </div>
                                <div class="col-md-6 pad-l-zero text-right">
                                    <ul class="cat-menu">
                                        <li data-targetit="box-1" class="{{ $zip_search != true ? 'active' : ''}}"><a href="#">Ending soon</a></li>
                                        <li data-targetit="box-2"><a href="#">Newly Listed</a></li>
                                        <li data-targetit="box-3"><a href="#">No reserve</a></li>
                                        <li data-targetit="box-4"><a href="#">Lowest mileage</a></li>
                                        <li data-targetit="box-5" class="{{ $zip_search == true ? 'active' : ''}}"><a href="#" >Closest to me</a></li>
                                    </ul>
                                </div>

                                <div class="col-md-12">
                                    <div class="innerbox">
                                        <div class="box-1 {{ $zip_search != true ? 'showfirst' : ''}}">
                                            
                                        @if(count($EndingSoon) > 0 )
                                        <ul class="car-list">
                                            @foreach($EndingSoon as $newList)
                                                @php
                                                    $getimageUrl = json_decode($newList->car_images)[0];
                                                    $currentDate = Carbon\Carbon::now();
                                                    $createdAt = Carbon\Carbon::parse($newList->created_at);
                                                    $dateDiff = $createdAt->diffInDays($currentDate);
                                                    $bidend = Carbon\Carbon::parse($newList->bid_end_time);
                                                    $biddays = $currentDate->diffInDays($bidend);
                                                    $bidminute = $currentDate->diffInMinutes($bidend);
                                                    $bidhours = $currentDate->diffInHours($bidend);
                                                    $totalBids = App\Models\PostBid::where('post_id',$newList->id)->orderBy('bid_price','desc')->first();
                                                @endphp
                                                @if($biddays <= 7 && $currentDate <= $bidend)
                                                <li>
                                                    <div class="car-box">
                                                        <div class="img-box">
                                                            <img src="{{asset($getimageUrl)}}" alt="">
                                                            <span class="day"><i class="fas fa-clock"></i>@if($biddays > 0)<span>{{$biddays}} days</span> @else<span class="countdown-timer2{{$newList->id}} countdowncheck" data-id = "{{$newList->id}}">{{$newList->id}}</span>@endif<span class="bid">Bid</span>${{isset($totalBids->bid_price) != null ? (int)$totalBids->bid_price : 0}}</span>
                                                        </div>
                                                        <a href="{{url('/detail/'.encrypt($newList->id))}}">{{$newList->year." ".$newList->make." ".$newList->model}}</a>
                                                        <p>~{{$newList->mileage}} Miles,{{$newList->transmission}},{{$newList->body_style}}</p>
                                                        <h6>{{$newList->user->address}}</h6>
                                                    </div>
                                                </li>
                                                @endif
                                                <input class="aucmin{{$newList->id}}" type="hidden" value="{{$bidminute}}">
                                                <input class="auchour{{$newList->id}}" type="hidden" value="{{$bidhours}}">
                                                <script>
                                                    difftimer({{$newList->id}})
                                                </script>
                                            @endforeach
                                            </ul>
                                        @else
                                        <p class="mt-4 ">No auctions match. Please broaden your selections, or <a href="{{url('/')}}">start over</a>.</p>
                                        @endif
                                        
                                        </div>
                                        <div class="box-2">

                                        @if(count($newlyListing) > 0)
                                        <ul class="car-list">
                                            working
                                                @foreach($newlyListing as $newList)
                                                @php
                                                    $getimageUrl = json_decode($newList->car_images)[0];
                                                    $currentDate = Carbon\Carbon::now();
                                                    $createdAt = Carbon\Carbon::parse($newList->created_at);
                                                    $dateDiff = $createdAt->diffInDays($currentDate);
                                                    $bidend = Carbon\Carbon::parse($newList->bid_end_time);
                                                    $biddays = $currentDate->diffInDays($bidend);
                                                    $bidminute = $currentDate->diffInMinutes($bidend);
                                                    $bidhours = $currentDate->diffInHours($bidend);
                                                    $totalBids = App\Models\PostBid::where('post_id',$newList->id)->orderBy('bid_price','desc')->first();
                                                @endphp
                                                @if($currentDate <= $bidend)
                                                <li>
                                                    <div class="car-box">
                                                        <div class="img-box">
                                                            <img src="{{asset($getimageUrl)}}" alt="">
                                                            <span class="day"><i class="fas fa-clock"></i>@if($biddays > 0)<span>{{$biddays}} days</span> @else<span class="countdown-timer2{{$newList->id}} countdowncheck" data-id = "{{$newList->id}}">{{$newList->id}}</span>@endif<span class="bid">Bid</span>${{isset($totalBids->bid_price) != null ? (int)$totalBids->bid_price : $newList->initial_bid_price}}</span>
                                                        </div>
                                                        <a href="{{url('/detail/'.encrypt($newList->id))}}">{{$newList->year." ".$newList->make." ".$newList->model}}</a>
                                                        <p>~{{$newList->mileage}} Miles,{{$newList->transmission}},{{$newList->body_style}}</p>
                                                        <h6>{{$newList->user->address}}</h6>
                                                    </div>
                                                </li>
                                                <input class="aucmin{{$newList->id}}" type="hidden" value="{{$bidminute}}">
                                                <input class="auchour{{$newList->id}}" type="hidden" value="{{$bidhours}}">
                                                <script>
                                                    difftimer({{$newList->id}})
                                                </script>
                                                @endif
                                                @endforeach
                                            </ul>
                                        @else
                                        <p class="mt-4 ">No auctions match. Please broaden your selections, or <a href="{{url('/')}}">start over</a>.</p>
                                        @endif
                                            
                                        </div>
                                        <div class="box-3">
                                            
                                        @if(count($NoReserve) > 0)
                                        <ul class="car-list">
                                                
                                                @foreach($NoReserve as $newList)
                                                @php
                                                    $getimageUrl = json_decode($newList->car_images)[0];
                                                    $currentDate = Carbon\Carbon::now();
                                                    $createdAt = Carbon\Carbon::parse($newList->created_at);
                                                    $dateDiff = $createdAt->diffInDays($currentDate);
                                                    $bidend = Carbon\Carbon::parse($newList->bid_end_time);
                                                    $biddays = $currentDate->diffInDays($bidend);
                                                    $bidminute = $currentDate->diffInMinutes($bidend);
                                                    $bidhours = $currentDate->diffInHours($bidend);
                                                    $totalBids = App\Models\PostBid::where('post_id',$newList->id)->orderBy('bid_price','desc')->first();
                                                @endphp
                                                @if($currentDate <= $bidend)
                                                <li>
                                                    <div class="car-box">
                                                        <div class="img-box">
                                                            <img src="{{asset($getimageUrl)}}" alt="">
                                                            <span class="day"><i class="fas fa-clock"></i>@if($biddays > 0)<span>{{$biddays}} days</span> @else<span class="countdown-timer2{{$newList->id}} countdowncheck" data-id = "{{$newList->id}}">{{$newList->id}}</span>@endif<span class="bid">Bid</span>${{isset($totalBids->bid_price) != null ? (int)$totalBids->bid_price : 0}}</span>
                                                        </div>
                                                        <a href="{{url('/detail/'.encrypt($newList->id))}}">{{$newList->year." ".$newList->make." ".$newList->model}}</a>
                                                        <p><span>NO RESERVE</span>~{{$newList->mileage}} Miles,{{$newList->transmission}},{{$newList->body_style}}</p>
                                                        <h6>{{$newList->user->address}}</h6>
                                                    </div>
                                                </li>
                                                <input class="aucmin{{$newList->id}}" type="hidden" value="{{$bidminute}}">
                                                <input class="auchour{{$newList->id}}" type="hidden" value="{{$bidhours}}">
                                                <script>
                                                    difftimer({{$newList->id}})
                                                </script>
                                                @endif
                                                @endforeach
                                               
                                            </ul>

                                        @else
                                        <p class="mt-4 ">No auctions match. Please broaden your selections, or <a href="{{url('/')}}">start over</a>.</p>
                                        @endif
                                        
                                        </div>
                                        <div class="box-4">
                                        
                                        @if(count($LowMileage) > 0)
                                        <ul class="car-list">
                                            @foreach($LowMileage as $newList)
                                                @php
                                                    $getimageUrl = json_decode($newList->car_images)[0];
                                                    $currentDate = Carbon\Carbon::now();
                                                    $createdAt = Carbon\Carbon::parse($newList->created_at);
                                                    $dateDiff = $createdAt->diffInDays($currentDate);
                                                    $bidend = Carbon\Carbon::parse($newList->bid_end_time);
                                                    $biddays = $currentDate->diffInDays($bidend);
                                                    $bidminute = $currentDate->diffInMinutes($bidend);
                                                    $bidhours = $currentDate->diffInHours($bidend);
                                                    $totalBids = App\Models\PostBid::where('post_id',$newList->id)->orderBy('bid_price','desc')->first();
                                                @endphp
                                                @if($currentDate <= $bidend)
                                                <li>
                                                    <div class="car-box">
                                                        <div class="img-box">
                                                            <img src="{{asset($getimageUrl)}}" alt="">
                                                            <span class="day"><i class="fas fa-clock"></i>@if($biddays > 0)<span>{{$biddays}} days</span> @else<span class="countdown-timer2{{$newList->id}} countdowncheck" data-id = "{{$newList->id}}">{{$newList->id}}</span>@endif<span class="bid">Bid</span>${{isset($totalBids->bid_price) != null ? (int)$totalBids->bid_price : 0}}</span>
                                                        </div>
                                                        <a href="{{url('/detail/'.encrypt($newList->id))}}">{{$newList->year." ".$newList->make." ".$newList->model}}</a>
                                                        <p>~{{$newList->mileage}} Miles,{{$newList->transmission}},{{$newList->body_style}}</p>
                                                        <h6>{{$newList->user->address}}</h6>
                                                    </div>
                                                </li>
                                                <input class="aucmin{{$newList->id}}" type="hidden" value="{{$bidminute}}">
                                                <input class="auchour{{$newList->id}}" type="hidden" value="{{$bidhours}}">
                                                <script>
                                                    difftimer({{$newList->id}})
                                                </script>
                                                @endif
                                                @endforeach
                                            </ul>

                                        @else
                                        <p class="mt-4 ">No auctions match. Please broaden your selections, or <a href="{{url('/')}}">start over</a>.</p>
                                        @endif
                                        
                                        </div>
                                        <div class="box-5 {{ $zip_search == true ? 'showfirst' : ''}}">
                                        @if($zip_search == true)   
                                        <ul class="car-list">
                                                @foreach($zipcodes as $newList)
                                                @php
                                                    $getimageUrl = json_decode($newList->car_images)[0];
                                                    $currentDate = Carbon\Carbon::now();
                                                    $createdAt = Carbon\Carbon::parse($newList->created_at);
                                                    $dateDiff = $createdAt->diffInDays($currentDate);
                                                    $bidend = Carbon\Carbon::parse($newList->bid_end_time);
                                                    $biddays = $currentDate->diffInDays($bidend);
                                                    $bidminute = $currentDate->diffInMinutes($bidend);
                                                    $bidhours = $currentDate->diffInHours($bidend);
                                                    $totalBids = App\Models\PostBid::where('post_id',$newList->id)->orderBy('bid_price','desc')->first();
                                                @endphp
                                                <li>
                                                    <div class="car-box">
                                                        <div class="img-box">
                                                            <img src="{{asset($getimageUrl)}}" alt="">
                                                            <span class="day"><i class="fas fa-clock"></i>@if($biddays > 0)<span>{{$biddays}} days</span> @else<span class="countdown-timer2{{$newList->id}} countdowncheck" data-id = "{{$newList->id}}">{{$newList->id}}</span>@endif<span class="bid">Bid</span>${{isset($totalBids->bid_price) != null ? (int)$totalBids->bid_price : 0}}</span>
                                                        </div>
                                                        <a href="{{url('/detail/'.encrypt($newList->id))}}">{{$newList->year." ".$newList->make." ".$newList->model}}</a>
                                                        <p>~{{$newList->mileage}} Miles,{{$newList->transmission}},{{$newList->body_style}}</p>
                                                        <h6>{{$newList->user->address}}</h6>
                                                    </div>
                                                </li>
                                                <input class="aucmin{{$newList->id}}" type="hidden" value="{{$bidminute}}">
                                                <input class="auchour{{$newList->id}}" type="hidden" value="{{$bidhours}}">
                                                <script>
                                                    difftimer({{$newList->id}})
                                                </script>
                                                @endforeach
                                            </ul>
                                            @else
                                        <div class="carClosestWrp">
                                                <h5>Cars closest to me</h5>
                                                <p>We need your zip code to determine which cars are closest to you.</p>
                                                <form action="{{URL::to('/')}}">
                                                    <div class="row align-items-center">
                                                        <div class="col-md-5">
                                                            <label for="">Zip Code</label>
                                                            <input type="text" name="zip_code" >
                                                        </div>
                                                        <div class="col-md-7">
                                                            <label for="">Max distance from you</label>
                                                            <select name="search_miles" id="">
                                                                <option value="500">500 miles</option>
                                                                <option value="1000">1000 miles</option>
                                                                <option value="1500">1500 miles</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <button type="submit">Save</button>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <a href="#">In USA?</a>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="right-side">
                            <div class="more-abt">
                                <img src="{{asset('website/assets/images/more.jpg')}}" alt="">
                                <h6>Car Swagged Auto is the best marketplace for modern enthusiast cars.</h6>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. </p>
                                <a href="{{url('/swagged-auto')}}">More About Us</a>
                            </div>
                            <div class="new-list-box mb-0">
                            <h2>New Listings</h2>
                            </div>



                        @foreach($newlyListing_5 as $newList)
                            @php
                                $getimageUrl = json_decode($newList->car_images)[0];
                                $currentDate = Carbon\Carbon::now();
                                $createdAt = Carbon\Carbon::parse($newList->created_at);
                                $dateDiff = $createdAt->diffInDays($currentDate);
                                $bidend = Carbon\Carbon::parse($newList->bid_end_time);
                                $remaining_days = $currentDate->diffInDays($bidend);
                            @endphp
                                      
                            @if($currentDate <= $bidend)
                            <div class="new-list-box">
                                <div class="row">
                                    <div class="col-md-8 pad-r-zero">
                                        <div class="big">
                                            <img src="{{asset($getimageUrl)}}" alt="">
                                        </div>
                                    </div>
                                   <div class="col-md-4 pad-l-zero">
                                    @if(json_decode($newList->car_images) > 1)
                                    <div class="small">
                                        <img src="{{json_decode($newList->car_images)[1]}}" alt="">
                                    </div>
                                    @endif
                                    @if(json_decode($newList->car_images) > 2)
                                    <div class="small">
                                        <img src="{{json_decode($newList->car_images)[1]}}" alt="">
                                    </div>
                                    @endif
                                   </div>
                                </div>
                                <a href="{{url('/detail/'.encrypt($newList->id))}}">{{$newList->year." ".$newList->make." ".$newList->model}}</a>
                                <p>~{{$newList->mileage}} Miles,{{$newList->transmission}},{{$newList->body_style}}</p>
                                <ul>
                                    <li>{{$newList->body_style}} , {{$newList->exterior_color}}</li>
                                    <li>{{$newList->transmission}}</li>
                                  
                                </ul>
                                <h6>{{$newList->user->address}}</h6>
                            </div>
                            @endif
                            @endforeach

                            

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('website.testimonial.index')
    </div>

    <script>
        $('.auc_filter').change( function(){
            $('#auction_filter_form').submit();
        });
    </script>
@endsection
