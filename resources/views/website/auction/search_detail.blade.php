@extends("website.includes.layouts")
@section("content")
@section("auction",'active')
    <div class="main">
        <div class="hm-sec1">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-9">
                        <div class="left-side">
                        <h1 class="my-3">Search : {{$search}}</h1>
                            <div class="row">
                            
                                <div class="col-md-5 pad-r-zero">
                                
                                    <ul class="auc-list">
                                        <li><h4>Results ({{count($EndingSoon)}})</h4></li>
                                        
                                    </ul>
                                </div>
                                <div class="col-md-7 pad-l-zero text-right">
                                    <ul class="cat-menu">
                                        <li data-targetit="box-1" class="active"><a href="#">Ending soon</a></li>
                                        <li data-targetit="box-2"><a href="#">Newly Listed</a></li>
                                        <li data-targetit="box-3"><a href="#">No reserve</a></li>
                                        <li data-targetit="box-4"><a href="#">Lowest mileage</a></li>
                                    </ul>
                                </div>

                                <div class="col-md-12">
                                    <div class="innerbox">
                                        <div class="box-1 showfirst">
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
                                                @if($biddays <= 7)
                                                <li>
                                                    <div class="car-box">
                                                        <div class="img-box">
                                                            <img src="{{asset($getimageUrl)}}" alt="">
                                                            <span class="day"><i class="fas fa-clock"></i>{{ ($bidhours <= 0) ? $bidminute.' Minutes' : (($biddays <= 0) ? $bidhours.' Hours' : $biddays.' Days')}}<span class="bid">Bid</span>${{isset($totalBids->bid_price) != null ? (int)$totalBids->bid_price : 0}}</span>
                                                        </div>
                                                        <a href="{{url('/detail/'.encrypt($newList->id))}}">{{$newList->year." ".$newList->make." ".$newList->model}}</a>
                                                        <p>~{{$newList->mileage}} Miles,{{$newList->transmission}},{{$newList->body_style}}</p>
                                                        <h6>{{$newList->user->address}}</h6>
                                                    </div>
                                                </li>
                                                @endif
                                            @endforeach
                                            </ul>
                                        </div>
                                        <div class="box-2">
                                            <ul class="car-list">
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
                                                <li>
                                                    <div class="car-box">
                                                        <div class="img-box">
                                                            <img src="{{asset($getimageUrl)}}" alt="">
                                                            <span class="day"><i class="fas fa-clock"></i>{{ ($bidhours <= 0) ? $bidminute.' Minutes' : (($biddays <= 0) ? $bidhours.' Hours' : $biddays.' Days')}}<span class="bid">Bid</span>${{isset($totalBids->bid_price) != null ? (int)$totalBids->bid_price : 0}}</span>
                                                        </div>
                                                        <a href="{{url('/detail/'.encrypt($newList->id))}}">{{$newList->year." ".$newList->make." ".$newList->model}}</a>
                                                        <p>~{{$newList->mileage}} Miles,{{$newList->transmission}},{{$newList->body_style}}</p>
                                                        <h6>{{$newList->user->address}}</h6>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        <div class="box-3">
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
                                                <li>
                                                    <div class="car-box">
                                                        <div class="img-box">
                                                            <img src="{{asset($getimageUrl)}}" alt="">
                                                            <span class="day"><i class="fas fa-clock"></i>{{ ($bidhours <= 0) ? $bidminute.' Minutes' : (($biddays <= 0) ? $bidhours.' Hours' : $biddays.' Days')}}<span class="bid">Bid</span>${{isset($totalBids->bid_price) != null ? (int)$totalBids->bid_price : 0}}</span>
                                                        </div>
                                                        <a href="{{url('/detail/'.encrypt($newList->id))}}">{{$newList->year." ".$newList->make." ".$newList->model}}</a>
                                                        <p><span>NO RESERVE</span>~{{$newList->mileage}} Miles,{{$newList->transmission}},{{$newList->body_style}}</p>
                                                        <h6>{{$newList->user->address}}</h6>
                                                    </div>
                                                </li>
                                                @endforeach
                                               
                                            </ul>
                                        </div>
                                        <div class="box-4">
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
                                                <li>
                                                    <div class="car-box">
                                                        <div class="img-box">
                                                            <img src="{{asset($getimageUrl)}}" alt="">
                                                            <span class="day"><i class="fas fa-clock"></i>{{ ($bidhours <= 0) ? $bidminute.' Minutes' : (($biddays <= 0) ? $bidhours.' Hours' : $biddays.' Days')}}<span class="bid">Bid</span>${{isset($totalBids->bid_price) != null ? (int)$totalBids->bid_price : 0}}</span>
                                                        </div>
                                                        <a href="{{url('/detail/'.encrypt($newList->id))}}">{{$newList->year." ".$newList->make." ".$newList->model}}</a>
                                                        <p>~{{$newList->mileage}} Miles,{{$newList->transmission}},{{$newList->body_style}}</p>
                                                        <h6>{{$newList->user->address}}</h6>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                 
                </div>
            </div>
        </div>
       
    </div>
@endsection
