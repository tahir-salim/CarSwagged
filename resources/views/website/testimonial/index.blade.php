<div class="hm-sec2">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h2>Our customers love us! </h2>
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
            <div class="col-md-6">
                <h2>Get the Daily Email</h2>
                <form action="{{URL::to('newsletter')}}" method="POST">@csrf
                <div class="subscribe">
                    <input type="text" name="email" placeholder="Email address">
                    <button type="submit">Subscribe</button>
                </div>
                <ul class="parsley-errors-list filled mt-2" id="parsley-id-39">
                                <li class="parsley-required text-danger">
                                    @error('email')
                                        {{ $errors->first('email') }}
                                    @enderror
                                </li>
                            </ul>
                </form>
            </div>
        </div>
    </div>
</div>