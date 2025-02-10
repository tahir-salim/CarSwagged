@extends("website.includes.layouts")
@section("content")
@section("auction",'active')

@push('custom-styles')
<style>
    .modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 2; /* Sit on top */
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
.bid_modal label{
    background-color: #dbdbdb;
    padding: 17px;
    margin-right: -2px;
}


.alertbid {
  padding: 20px;
  background-color: #f44336;
  color: white;
  opacity: 1;
  transition: opacity 0.6s;
  margin-bottom: 15px;
}

.alertbid.success {background-color: #04AA6D;}
.alertbid.info {background-color: #2196F3;}
.alertbid.warning {background-color: #ff9800;}

.closebidbtn {
  margin-left: 15px;
  color: white;
  font-weight: bold;
  float: right;
  font-size: 22px;
  line-height: 20px;
  cursor: pointer;
  transition: 0.3s;
}

.closebidbtn:hover {
  color: black;
}
</style>

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
    }else if(seconds2 <= 0){
        $('.countdown-timer2'+id).html( minutes2 + ':' + seconds2);
    } else{
    $('.countdown-timer2'+id).html( hours2 + ':' + minutes2 + ':' + seconds2);
    }
    timer82 = hours2 + ':' + minutes2 + ':' + seconds2;
    }, 1000);

}

</script>

@endpush

<div class="main">

@if(session()->has('success'))
<div class="alertbid success">
  <span class="closebidbtn">&times;</span>  
  {{session('success')}}
</div>

@elseif(session()->has('error'))

<div class="alertbid danger">
  <span class="closebidbtn">&times;</span>  
  {{session('error')}}
</div>

@endif
    <div class="swagged-dtl-sec1">
        <div class="container-fluid">
            <div class="row">
           
                <div class="col-md-12">
                   <div class="main-images">
                       <h2>{{$cardetail->year." ".$cardetail->make." ".$cardetail->model}}</h2>
                       <p>{{$cardetail->transmission." , ".$cardetail->enigne." , ".$cardetail->body_style}}</p>
                       @php
                            $imagesLists = json_decode($cardetail->car_images);
                            $imagesListCount = count($imagesLists);
                            $imageLastIndex = $imagesListCount-1;
                            $videosLists = json_decode($cardetail->car_videos);
                       @endphp
                       <div class="row">
                           <div class="col-md-8">
                               <div class="gal-main">
                                   <a href="{{asset($imagesLists[0])}}"  data-fancybox="gallery"><img src="{{asset($imagesLists[0])}}" class="main_image" alt=""></a>
                               </div>
                             
                           </div>
                           <div class="col-md-4 pad-l-zero">
                               <ul class="gal-other">
                                   @foreach ($imagesLists as $imageKey=>$imageList)
                                        @if($imageKey<5)
                                            <li><a href="{{asset($imageList)}}" data-fancybox="gallery"><img src="{{asset($imageList)}}" alt=""></a></li>
                                        @endif
                                   @endforeach
                                   @if($imagesListCount>5)
                                    <li class="all-photos"><a href="{{asset($imagesLists[$imageLastIndex])}}" data-fancybox="gallery"><img src="{{asset($imagesLists[$imageLastIndex])}}" alt=""><span>All Photos ({{$imagesListCount}})</span></a></li>
                                   @endif

                               </ul>
                           </div>
                       </div>
                   </div>
                </div>

                <div class="col-md-8">
                    <div class="s-dtl-left">

                    @php 
                    $current = Carbon\Carbon::now();
                    $bidend = Carbon\Carbon::parse($cardetail->bid_end_time);
                    @endphp

                        @if($cardetail->is_bid == 1)
                        @if($bidend <= $current )
                        <div class="time">
                            <div class="black" style="cursor:pointer;width:100%" href="">
                            <p>Sold for ${{$latest_bid != null ? (int)$latest_bid->bid_price : 0 }}</p>
                                <ul>
                                    <li>{{$bidend->format('d/m/Y')}}</li>
                                    <li>#Bids {{$cardetail->total_bid}}</li>
                                    <li>Comments {{count($comments)}}</li>
                                </ul>
                            </div>
                           
                        </div>

                        <div class="auction-ended-cta">
                            
                            <a href="{{url('/')}}" class="end-cta">This auction has ended, see more auctions <u>here</u></a>
                          
                        </div>
                        @else
                        @php
                    $currentdate = \Carbon\Carbon::now();
                    $endbidt = \Carbon\Carbon::parse($cardetail->bid_end_time);
                    $biddayst = $currentdate->diffInDays($endbidt);
                    @endphp
                        <div class="time">
                            <div class="black" style="cursor:pointer" href="">
                            <p><i class="fas fa-clock"></i> Time Left @if($biddayst > 0)<span>{{$biddayst}} days</span> @else<span class="countdown-timer"></span>@endif</p>
                                <ul>
                                    <li>High Bid ${{$latest_bid != null ? (int)$latest_bid->bid_price : 0 }}</li>
                                    <li>#Bids {{$cardetail->total_bid}}</li>
                                    <li>Comments {{count($comments)}}</li>
                                </ul>
                            </div>
                            @if(Auth::check())
                            <a href="#" class="bid_btn bid-btn">Place Bid</a>
                            @else
                            <a href="#" class="signUp bid-btn">Place Bid</a>
                            @endif
                        </div>
                        @endif
                    @endif
                        <div class="vehicle-detail">
                            <h4></h4>
                            <table class="table-striped">
                                <tr>
                                    <td>Make</td>
                                    <td>{{$cardetail->make}}</td>
                                    <td>Engine</td>
                                    <td>{{$cardetail->enigne}}</td>
                                </tr>
                                <tr>
                                    <td>Model</td>
                                    <td>{{$cardetail->model}}</td>
                                    <td>Drivetrain</td>
                                    <td>{{$cardetail->drivetrain}}</td>
                                </tr>
                                <tr>
                                    <td>Mileage</td>
                                    <td>{{$cardetail->mileage}}</td>
                                    <td>Transmission</td>
                                    <td>{{$cardetail->transmission}}</td>
                                </tr>
                                <tr>
                                    <td>VIN</td>
                                    <td>{{$cardetail->vin}}</td>
                                    <td>Body Style</td>
                                    <td>{{$cardetail->body_style}}</td>
                                </tr>
                                <tr>
                                    <td>Title Status</td>
                                    <td>{{$cardetail->title_status}}</td>
                                    <td>Exterior Color</td>
                                    <td>{{$cardetail->exterior_color}}</td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td>{{$cardetail->location}}</td>
                                    <td>Interior Type</td>
                                    <td>{{$cardetail->interior_type}}</td>
                                </tr>
                                <tr>
                                    <td>Seller</td>
                                    <td>{{$cardetail->user->name}}</td>
                                    <td>Seller Type</td>
                                    <td>{{$cardetail->user->seller_type}}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="doug-take">
                            <img src="{{asset('website/assets/images/doug.png')}}" alt="">
                            <div class="txt">
                                <h6>{{$cardetail->user->name}}</h6>
                                <p>{!! $cardetail->car_description !!}</p>
                            </div>
                        </div>
                        <div class="plain-txt">
                            <div class="content">
                                <h6>Highlights</h6>
                                {!! $cardetail->highlights !!}
                            </div>
                            <div class="content">
                                <h6>Equipment</h6>
                                {!! $cardetail->equipment !!}
                            </div>
                            <div class="content">
                                <h6>Modifications</h6>
                                {!! $cardetail->modifications !!}
                            </div>
                            <div class="content">
                                <h6>Known Flaws</h6>
                                {!! $cardetail->known_flaws !!}
                            </div>
                        </div>
                        @if(!empty($videosLists))
                            <div class="dtl-videos">
                                <h4>Video</h4>

                                <ul>
                                @foreach ($videosLists as $videoKey=>$videosList)
                                
                                    <li><a href="{{asset($videosList)}}" data-fancybox="gallery"><img src="{{asset($videosList)}}" alt=""></a><span class="icon"><i class="fas fa-play"></i></span></li>
                                
                                @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="seller-que" id="question">
                            <div class="head">
                                <h4>Seller Q&A ({{count($questions)}}) @if(Auth::check())<a href="#" id="askque_btn">Ask Question</a>@else<a href="#" class="signUp">Ask Question</a>@endif</h4>
                                
                                <!-- <a href="#">View all</a> -->
                            </div>
                            <ul class="inspecto-slider inspecto-list">
                            @foreach($questions as $question)    
                            <li>
                                    <div class="inspecto-box">
                                        <div class="user">
                                        <!-- <span class="light">21 Hours ago</span> -->
                                            <p><span class="icon"><i class="fas fa-user"></i></span> {{App\Models\User::find($question->user_id)->name}} <span class="check"><i class="fas fa-check"></i></span> </p>
                                            <h6><span>Q</span>: {{$question->question}}?</h6>
                                        </div>
                                        @if($question->answer != null)
                                        <div class="user">
                                            <p><span class="icon"><i class="fas fa-user"></i></span> {{$cardetail->user->name}} <span class="check"><i class="fas fa-check"></i></span> <span class="tag">Seller</span> </p>
                                            <h6><span>A</span>: {{$question->answer}}</h6>
                                        </div>
                                        @else                                        
                                        <span>Not yet answered</span>
                                        @endif
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <!-- Button trigger modal -->

                        <div id="askque" class="modal">

                    <!-- Modal content -->
                        <div class="modal-content">
                        <span class="close">&times;</span>
                        
                        <div class="cmnt-bids">
                            <h2>Ask Question</h2>
                            <div class="bid">
                           
                            <input type="text" name="question" class="question" placeholder="Enter here your Question">
                            <button type="submit" class="question_submit">Submit</button>
                           
                            </div>
                        </div>
                        
                        </div>

                    </div>
                        <div class="bid-car">
                            <h2>{{$cardetail->year." ".$cardetail->make." ".$cardetail->model}}</h2>
                            <div class="bid-box">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h6><span>Current Bid </span><span class="icon"><i class="fas fa-user"></i></span> Makes</h6>
                                        <h3>${{$latest_bid != null ? (int)$latest_bid->bid_price : 0 }}</h3>
                                        <p>As low as $1,380 per month* </p>
                                       @if($bidend >= $current )
                                        @if(Auth::check())
                                        <a href="#" class="bid_btn">Place Bid</a>
                                        @else
                                        <a href="#" class="signUp">Place Bid</a>
                                        @endif
                                        @endif
                                    </div>
                                    <div class="col-md-6">
                                        <ul>
                                            <li><span class="dark">Seller</span> <span class="icon"><i class="fas fa-user"></i></span> {{$cardetail->user->name}}</li>
                                            <li><span class="dark">Ending</span> <span class="icon"><i class="fas fa-calendar"></i></span>{{$cardetail->created_at->format('D, M d')}}</li>
                                            <li><span class="dark">Bids</span> <span class="icon"><i class="fas fa-hashtag"></i></span> {{count($totalbids)}}</li>
                                            <li><span class="dark">Views</span> <span class="icon"><i class="fas fa-eye"></i></span> {{$cardetail->views}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


<div id="bid_modal" class="modal bid_modal">
<!-- Modal content -->
    <div class="modal-content">
    <span class="close">&times;</span>
    
    <div class="cmnt-bids">
        <h2>Place Bid</h2>
        <h2>Current Bid: ${{$latest_bid != null ? $latest_bid->bid_price : 0 }}</h2>
        <form action="{{URL::to('bid-post',encrypt($cardetail->id))}}" method="POST" >
            @csrf
        <div class="bid">
        <label>$</label><input type="text" name="bid_price" class="bid_price" placeholder="Place Bid">
        <button type="submit" class="bid_submit">Bid Now</button>
       
        </div>
        </form>
    </div>
    
    </div>

</div>


     <div class="position-relative">
        
        <div class="cmnt-bids">

        <h2>Comments & Bids</h2>
        <div class="bid">
        <label class="reply-to" >Re: <span id="reply_name">the_thinking_man</span></label>
            
        <input type="hidden" name="post_id" id="post_id" value="{{$cardetail->id}}" >
            @if(Auth::check())
            <input type="text" id="comment" placeholder="Add Comment">
            <button type="button" class="comment_btn">Comment</button>
            
            <input type="hidden" name="seller_id" id="seller_id" value="{{$cardetail->user_id}}">
            <input type="hidden" name="comment_id" id="comment_id" value="" >
            <input type="hidden" name="comment_name" id="comment_name" value="" >
            @else
            <input type="text" id="comment" placeholder="Add Comment" >
                <button type="button" class="signUp">Comment</button>
            
            @endif
        </div>
        
        </div>
  </div> 

<style>
    .interact .btn.btn-reply {
    padding: 2px 0 3px;
    margin-left: 16px;
    font-size: 14px;
    line-height: 17px;
    color: #adadad;
    display: inline-flex;
    align-items: center;
    transition: none;
    cursor:pointer;
}
.interact .btn.btn-reply:after {
    margin-top: 4px;
    margin-left: 8px;
    content: "";
    display: inline-block;
    background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAEYSURBVHgB7ZbfjYJAEMZnJ/DGgyVsCWcHdx0cFZxXiViBJaDPhBArsATtQDqQAvjjN8lCfGFFdo0vfsmwOzCZ3+4wbCCCiqJYwDS9QCyJ27a9wi5pmi7Is7iua907URR9kWcxvVgfwPsBAc2Uae8tM5/jON6Mxc3eAdp7heEXkASwtXdAEAQ7DKXMbRBGYDU4zJomCmUpEf/zCMImoIf80ROaAmEEVV3X7Y3/bavnHIiSi5ymeHDCVJv7JaAHWDUVpJTSsKECgCbSXaq/YdrueAdxVtM0y6GLzFaXmP5j5WdyVxmGYaXIk/I8l7onfXJ5L7JoL4Cx5OI4A2zJnQGPkjsBkHyFIbUlF/k4rkeTOyvLMvnyrX8iN055my2av4UmAAAAAElFTkSuQmCC) no-repeat 0 0/100%;
    width: 12px;
    height: 12px;
}

.interact .btn.btn-flag {
    padding: 2px 0 3px;
    margin-left: 16px;
    font-size: 14px;
    line-height: 17px;
    color: #adadad;
    display: inline-flex;
    align-items: center;
    transition: none;
    cursor:pointer;
}


.interact .btn.btn-flag:after {
    margin-top: 1px;
    margin-left: 8px;
    content: "";
    display: inline-block;
    background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAACXBIWXMAABYlAAAWJQFJUiTwAAAAAXNSR0IArs4c6QAAAARnQU1BAACxjwv8YQUAAAFFSURBVHgB7VbLbYRADPXAHDlsOpgOQgehhHDhDBVE6SCpIEoHyRkh0kFIB5sKMiWsOPPJMwJpljDJZJfVXvZJlmyNPc82YwtBFpRlqZqmUaxLKbdxHO/oAIjZpWHXdU9QQ8hm5qshled5jyDTtJwUx2zMc2FmjMu/yA1M9IYKP9no+17BDoUQd2zXdX2VZdlQsZwiuB1wmsyXtm0/EKAHJymvYd/CjsbzCMlEhv8egiDgDlR7BCYQ/JokSWVmDHnmKkH0AKIb2IocIOkfGHubss79RtXhcImUeuzA+1EEMzLucTXZeZ6rJT+PTowLwfkJrK9orV20SMDvGcNG06SyXhSFpj92kTOBBQqSgiwF2Y9dZKwRJ4KjdhFP9q8EB+6iHSrZ+r5/b7ZwtV1k+y6r7SIbLpPsTsDTauiaTgF+huOfwWr4BtKIr+9SqtSTAAAAAElFTkSuQmCC) no-repeat 0 0/100%;
    width: 12px;
    height: 12px;
}

.text-small{
    font-size:12px;
}

.comment-widgets p{
line-height:1.5;
}

.comment-badge{
    font-size: 12px;
    background-color: #7d4fff;
    padding: 6px;
    border-radius: 4px;
    color: white;
    margin: -4px 0px 4px 6px;
}


.bid-badge{
    margin-bottom: 0;
    padding: 0 12px;
    background: #262626;
    border-radius: 8px;
    display: inline-flex;
    align-items: center;
    color: white;
    height: 31px;

}


.comment-profile{
    width: 30px;
    height: 30px;
    border-radius:50%;
}

.reply-to{
    font-size: 12px;
    border: 1px solid #c9c9c9;
    border-radius: 6px;
    padding: 4px 8px;
    margin: 0 5px 0 0;
    color: #009966;
    display:none;
}

.reply-comment{
    font-size: 14px;
    font-weight: 600;
    margin: 0 4px 0 0;
    color: #009966;
}

</style>
<div class="row d-flex justify-content-center mt-100 mb-100">
    <div class="col-lg-12">
        <div class="card border-none" >
            <div class="comment-widgets">
                <!-- Comment Row -->
                @foreach($comments as $comment)
                @php
                $currentDate = Carbon\Carbon::now();
                $createdAt = Carbon\Carbon::parse($comment->created_at);
                $dateDiff = $createdAt->diffForHumans();
                @endphp
                <div class="d-flex flex-row comment-row mt-4">
                    <div class="p-2 mr-2"><span class="icon"><img src="{{asset('profile/profile.png')}}" class="comment-profile"></span></div>
                    
                    @if($comment->is_bid == true)

                    <div class="comment-text w-100">    
                    <div class="d-flex"><h6 class="font-medium mb-2">{{$comment->user->name}}</h6><span class="text-muted text-small ml-2">{{$dateDiff}}</span></div> 
                    <span class="bid-badge">Bid ${{$comment->bid_amount}}</span>
                    </div>

                    @else
                    <div class="comment-text w-100">    
                    <div class="d-flex"><h6 class="font-medium mb-2">{{$comment->user->name}}</h6>@if($comment->is_seller == true)<span class="comment-badge">Seller</span>@elseif($comment->is_admin == true)<span class="comment-badge">Admin</span> @endif<span class="text-muted text-small ml-2">{{$dateDiff}}</span></div> 
                    @if($comment->reply_to_id != null)    
                    <p class="d-block mb-2" id="comment{{$comment->id}}"><a class="reply-comment" href="#comment{{$comment->reply_to_id}}" >Re: {{$comment->reply_to_name}}</a> {{$comment->comment}}</p>
                    @else
                    <p class="d-block mb-2" id="comment{{$comment->id}}">{{$comment->comment}}</p>
                    @endif
                    @if(Auth::check())
                        @if(auth()->user()->user_role_id == '3')
                        <div class="interact"><a href="#comment" class="btn btn-sm btn-link btn-reply" data-id="{{$comment->id}}" data-name="{{$comment->user->name}}">Reply</a>
                        <button class="btn btn-sm btn-link btn-flag">Flag as inappropriate</button></div>
                        @endif
                    @endif
                    </div>
                    @endif
                </div> <!-- Comment Row -->
              @endforeach
            </div> <!-- Card -->
        </div>
    </div>
</div>
</div>
</div>
            <div class="col-md-4">
                <div class="auc-end">
                    <h2>Auctions ending soon</h2>
                    
                    @foreach($auctions as $auction)
                    @php
                    $getauctionImage = json_decode($auction->car_images)[0];
                    $currentdate = \Carbon\Carbon::now();
                    $endbid = \Carbon\Carbon::parse($auction->bid_end_time);
                    $biddays = $currentdate->diffInDays($endbid);
                    $bidminute = $currentdate->diffInMinutes($endbid);
                    $bidhours = $currentdate->diffInHours($endbid);
                    @endphp
                    @if($currentdate <= $endbid)
                    <div class="car-box">
                        <div class="img-box">
                            <img src="{{asset($getauctionImage)}}" alt="">
                            <span class="day"><i class="fas fa-clock"></i>@if($biddays > 1)<span>{{$biddays}} days</span> @else<span class="countdown-timer2{{$auction->id}} countdowncheck" data-id = "{{$auction->id}}">{{$auction->id}}</span>@endif</span>
                        </div>
                        <a href="{{url('/detail/'.encrypt($auction->id))}}">{{$auction->year." ".$auction->make." ".$auction->model}}</a>
                        <p>~{{$auction->mileage}} Miles,{{$auction->transmission}},{{$auction->body_style}}</p>
                        <h6>{{$auction->user->address}}</h6>
                    </div>
                    <input class="aucmin{{$auction->id}}" type="hidden" value="{{$bidminute}}">
                    <input class="auchour{{$auction->id}}" type="hidden" value="{{$bidhours}}">
                    <script>
                        difftimer({{$auction->id}})
                    </script>
                    @endif
                    @endforeach
                </div>
            </div>
            </div>
        </div>
    </div>

    <div id="rating" class="modal">

<!-- Modal content -->
    <div class="modal-content">
    <span class="close">&times;</span>
    
    <div class="cmnt-bids">
        <h2>Add Rating</h2>
        <form action="{{URL::to('add-testimonial',encrypt($cardetail->id))}}" method="POST" >
       @csrf
      <h2> 
       <div class="rate">
    <input type="radio" id="star5" name="rating" value="5" />
    <label for="star5" title="text">5 stars</label>
    <input type="radio" id="star4" name="rating" value="4" />
    <label for="star4" title="text">4 stars</label>
    <input type="radio" id="star3" name="rating" value="3" />
    <label for="star3" title="text">3 stars</label>
    <input type="radio" id="star2" name="rating" value="2" />
    <label for="star2" title="text">2 stars</label>
    <input type="radio" id="star1" name="rating" value="1" />
    <label for="star1" title="text">1 star</label>
  </div>
  </h2>
        
        <textarea class="form-control mt-2" name="review"></textarea>
        <button type="submit" class="question_submit">Submit</button>
        </form>
    </div>
    
    </div>

</div>


<div class="hm-sec2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h2>Our customers love us! @if(Auth::check())<a href="#" id="rating_btn"> Add Rating</a> @else <a href="#" class="signUp"> Add Rating</a> @endif</h2>
                <ul class="testi-slider">
                @foreach($reviews as $review)   
                <li>
                        <div class="testi-box">
                            <h6>{{$review->user->name}} <span class="stars">
                            @if($review->rating == '5')
                            <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i>
                            @elseif($review->rating == '4')
                            <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star half-star"></i>
                            @elseif($review->rating == '3')
                            <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star half-star"></i> <i class="fas fa-star half-star"></i>
                            @elseif($review->rating == '2')
                            <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i class="fas fa-star half-star"></i> <i class="fas fa-star half-star"></i> <i class="fas fa-star half-star"></i>
                            @else
                            <i class="fas fa-star"></i> <i class="fas fa-star half-star"></i> <i class="fas fa-star half-star"></i> <i class="fas fa-star half-star"></i> <i class="fas fa-star half-star"></i>
                            @endif
                            </span></h6>
                            <p>{{$review->review}}</p>
                        </div>
                    </li>
                  @endforeach
                </ul>
            </div>
            <div class="col-md-6" >
                <h2>Get the Daily Email</h2>
                <div class="subscribe email-pop" >
                    <!-- <input type="text" placeholder="Email address"> -->
                    <button>Subscribe</button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@section('script')

<script src="{{asset('website/assets/js/jquery.js')}}"></script>
        <script src="{{asset('website/assets/js/custom.js')}}"></script>
        <script>
            new WOW().init();
        </script>
<script>

$('.comment_btn').on('click', function() {
       $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
       var comment = $('#comment').val();
       var postid = $('#post_id').val();
       var comment_id = $('#comment_id').val();
       var comment_name = $('#comment_name').val();
       var seller_id = $('#seller_id').val();
          $.ajax({
           type: "POST",
           dataType: 'json',
           url: '{{url("/comment/add")}}',
           
           data: {comment:comment, post_id:postid, seller_id:seller_id,comment_id:comment_id,comment_name:comment_name},
          success: function(data) {
            console.log(data.success)
            location.reload();
            }
       });
   });


   $('.question_submit').on('click', function() {
       $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
       var question = $('.question').val();
       var postid = $('#post_id').val();
       var seller_id = $('#seller_id').val();
             $.ajax({
           type: "POST",
           dataType: 'json',
           url: '{{url("/question/add")}}',
           data: {question:question, post_id:postid, seller_id:seller_id},
          success: function(data) {
            console.log(data.success)
          location.reload();
            }
       });
   });



   $(window).on('load', function() {
       $.ajaxSetup({
    headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });
  var postid = $('#post_id').val();
             $.ajax({
           type: "POST",
           dataType: 'json',
           url: '{{url("/setcookie")}}',
           data: {post_id:postid},
          success: function(data) {
            console.log('Page Successfully Run');
            }
       });
   });


   $('.btn-reply').click(function(){
      var id = $(this).data('id');
      var name = $(this).data('name');

      $('#comment_id').val(id);
      $('#comment_name').val(name);
      $('#reply_name').text(name);
      $('.reply-to').css('display','block');
   });

   $('.reply-to').click(function(){
    $('#comment_id').val('');
    $('#comment_name').val('');
    $('#reply_name').text('');
    $('.reply-to').css('display','none');
   })
</script>

<script>

    // Get the modal
var modal = document.getElementById("askque");

// Get the button that opens the modal
var btn = document.getElementById("askque_btn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks on the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it

    // Get the modal
var modal2 = document.getElementById("rating");

// Get the button that opens the modal
var btn2 = document.getElementById("rating_btn");

// Get the <span> element that closes the modal
var span2 = document.getElementsByClassName("close")[2];

// When the user clicks on the button, open the modal
btn2.onclick = function() {
  modal2.style.display = "block";
}
// When the user clicks on <span> (x), close the modal
span2.onclick = function() {
  modal2.style.display = "none";
}
var modal3 = document.getElementById('bid_modal');
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
    modal.style.display = "none";
  }else if (event.target == modal2) {
    modal2.style.display = "none";
  }else if (event.target == modal3) {
    modal3.style.display = "none";
  }
}

$('.bid_btn').click(function(){
    var span3 = document.getElementsByClassName("close")[1];
    $('#bid_modal').css('display','block');

    $(span3).click(function(){
        $('#bid_modal').css('display','none');
    });
});

</script>



<script>
var closebid = document.getElementsByClassName("closebidbtn");
var i;

for (i = 0; i < closebid.length; i++) {
  closebid[i].onclick = function(){
    var div = this.parentElement;
    div.style.opacity = "0";
    setTimeout(function(){ div.style.display = "none"; }, 600);
  }
}
</script>

<script>

var hours = (parseInt({{$minutes}}) / 60);
var rhours = Math.floor(hours);
var minutes = (hours - rhours) * 60;
var rminutes = Math.round(minutes);

    var timer2 = {{$hours}}+" : "+rminutes+" : 01";
    var interval = setInterval(function() {
    var timer = timer2.split(':');
    //by parsing integer, I avoid all extra string processing
    var hours = parseInt(timer[0], 10);
    var minutes = parseInt(timer[1], 10);
    var seconds = parseInt(timer[2], 10);
    --seconds;
    minutes = (seconds < 0) ? --minutes : minutes;
    hours = (minutes < 0) ? --hours : hours;
    if (hours < 0) clearInterval(interval);
    seconds = (seconds < 0) ? 59 : seconds;
    seconds = (seconds < 10) ? '0' + seconds : seconds;
    minutes = (minutes < 0) ? 59 : minutes;
    minutes = (minutes < 10) ? '0' + minutes : minutes;

    //minutes = (minutes < 10) ?  minutes : minutes;
    if(hours <= 0 ){
        $('.countdown-timer').html( minutes + ':' + seconds);
    }else if(minutes <= 0 ){
        $('.countdown-timer').html( minutes + ':' + seconds);
    }else {
    $('.countdown-timer').html( hours + ':' + minutes + ':' + seconds);
    }
    timer2 = hours + ':' + minutes + ':' + seconds;
    }, 1000);


</script>

@endsection

@endsection
