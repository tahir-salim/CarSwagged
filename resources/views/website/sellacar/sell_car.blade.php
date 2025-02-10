@extends('website.includes.layouts')
@section('content')
@section('sellacar', 'active')


<div class="sell-sec1">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Sell on Car Swagged Auto! <br> More money, fewer headaches</h2>
                <ul class="sell-list">
                    <li>
                        <div class="sell-box">
                            <span><i class="fas fa-comment"></i></span>
                            <p>Live support from listing to post-sale</p>
                        </div>
                    </li>
                    <li>
                        <div class="sell-box">
                            <span><i class="fas fa-check-circle"></i></span>
                            <p>Live support from listing to post-sale</p>
                        </div>
                    </li>
                    <li>
                        <div class="sell-box">
                            <span><i class="fas fa-calendar"></i></span>
                            <p>Live support from listing to post-sale</p>
                        </div>
                    </li>
                    <li>
                        <div class="sell-box">
                            <span><i class="fas fa-comment-dollar"></i></span>
                            <p>Live support from listing to post-sale</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="sell-sec2">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Our customers love us!</h2>
                <ul class="testi-slider2">
                    @foreach ($testimonials as $review)
                        <li>
                            <div class="testi-box">
                                <h6>{{ $review->user->name }} <span class="stars">
                                        @if ($review->rating == '5')
                                            <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i
                                                class="fas fa-star"></i> <i class="fas fa-star"></i> <i
                                                class="fas fa-star"></i>
                                        @elseif($review->rating == '4')
                                            <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i
                                                class="fas fa-star"></i> <i class="fas fa-star"></i> <i
                                                class="fas fa-star half-star"></i>
                                        @elseif($review->rating == '3')
                                            <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i
                                                class="fas fa-star"></i> <i class="fas fa-star half-star"></i> <i
                                                class="fas fa-star half-star"></i>
                                        @elseif($review->rating == '2')
                                            <i class="fas fa-star"></i> <i class="fas fa-star"></i> <i
                                                class="fas fa-star half-star"></i> <i class="fas fa-star half-star"></i>
                                            <i class="fas fa-star half-star"></i>
                                        @else
                                            <i class="fas fa-star"></i> <i class="fas fa-star half-star"></i> <i
                                                class="fas fa-star half-star"></i> <i class="fas fa-star half-star"></i>
                                            <i class="fas fa-star half-star"></i>
                                        @endif
                                    </span></h6>
                                <p>{{ $review->review }}</p>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="sell-sec3">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Apply in minutes and we’ll <br> respond within a day.</h2>
                <a href="{{ url('/seller/register') }}">Sell now - It’s free!</a>
            </div>
        </div>
    </div>
</div>
<div class="sell-sec4">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Why Car Swagged Auto?</h2>
                <ul class="auto-list">
                    <li>
                        <div class="auto-box">
                            <h6>6,700+</h6>
                            <p>Auctions completed</p>
                        </div>
                    </li>
                    <li>
                        <div class="auto-box">
                            <h6>85%+</h6>
                            <p>Sell-through rate</p>
                        </div>
                    </li>
                    <li>
                        <div class="auto-box">
                            <h6>$125M+</h6>
                            <p>Value of cars sold</p>
                        </div>
                    </li>
                    <li>
                        <div class="auto-box">
                            <h6>230k+</h6>
                            <p>Registered members</p>
                        </div>
                    </li>
                    <li>
                        <div class="auto-box">
                            <h6>9 out of 10</h6>
                            <p>Sellers strongly recommend Cars & Bids</p>
                        </div>
                    </li>
                    <li>
                        <div class="auto-box">
                            <h6>200k+</h6>
                            <p>Social media followers, and more from Doug DeMuro’s engaged audience</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="sell-sec5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Recent Sales</h2>
                <ul class="car-list">
                    @foreach ($cars as $newList)
                        @php
                            $getimageUrl = json_decode($newList->car_images)[0];
                            $bid = DB::table('post_bids')
                                ->where('post_id', $newList->id)
                                ->orderBy('bid_price', 'desc')
                                ->first();
                        @endphp
                        <li>
                            <div class="car-box">
                                <div class="img-box">
                                    <img src="{{ asset($getimageUrl) }}" alt="">
                                    <span class="day">Sold for
                                        ${{ isset($bid->bid_price) != null ? (int) $bid->bid_price : $newList->initial_bid_price }}</span>
                                </div>
                                <a
                                    href="{{ url('/detail/' . encrypt($newList->id)) }}">{{ $newList->year . ' ' . $newList->make . ' ' . $newList->model }}</a>
                                <p>~{{ $newList->mileage }}
                                    Miles,{{ $newList->transmission }},{{ $newList->body_style }}</p>
                                <h6>{{ $newList->user->address }}</h6>
                            </div>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="sell-sec6">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>Our Auctions</h2>
                <div class="auction">
                    <div class="row">
                        <div class="col-md-6">
                            <h4>Reserve Auction</h4>
                            <?php
                            $a = DB::table('web_settings')
                                ->where('key', 'Reserve Auction')
                                ->first();
                            ?>
                            <p>{{ $a->description }}</p>
                        </div>
                        <div class="col-md-6 pad-left">
                            <h4>No Reserve Auction</h4>
                            <?php
                            $b = DB::table('web_settings')
                                ->where('key', 'No Reserve Auction')
                                ->first();
                            ?>
                            <p>{{ $b->description }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="sell-sec7">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2>How it works</h2>
                <ul class="work-list">
                    <li>
                        <div class="work-box">
                            <div class="icon-box">
                                <i class="fas fa-clipboard-list-check"></i>
                                <span class="num">1</span>
                            </div>
                            <p>You submit information about your vehicle.</p>
                        </div>
                    </li>
                    <li>
                        <div class="work-box">
                            <div class="icon-box">
                                <i class="fas fa-check-circle"></i>
                                <span class="num">2</span>
                            </div>
                            <p>We’ll let you know if your car is accepted.</p>
                        </div>
                    </li>
                    <li>
                        <div class="work-box">
                            <div class="icon-box">
                                <i class="fas fa-camera-retro"></i>
                                <span class="num">3</span>
                            </div>
                            <p>If accepted, we’ll ask you for more information and photos of your car.</p>
                        </div>
                    </li>
                    <li>
                        <div class="work-box">
                            <div class="icon-box">
                                <i class="fas fa-clipboard-list"></i>
                                <span class="num">4</span>
                            </div>
                            <p>Your listing will be featured for a week.</p>
                        </div>
                    </li>
                    <li>
                        <div class="work-box">
                            <div class="icon-box">
                                <i class="fas fa-calendar"></i>
                                <span class="num">5</span>
                            </div>
                            <p>We’ll also ask for your scheduling preference.</p>
                        </div>
                    </li>
                    <li>
                        <div class="work-box">
                            <div class="icon-box">
                                <i class="fas fa-comments"></i>
                                <span class="num">6</span>
                            </div>
                            <p>We work with you to create a listing page that describes your vehicle.</p>
                        </div>
                    </li>
                    <li>
                        <div class="work-box">
                            <div class="icon-box">
                                <i class="fas fa-handshake"></i>
                                <span class="num">7</span>
                            </div>
                            <p>When your car sells, we’ll connect you with the high bidder so you can complete the
                                transaction!</p>
                        </div>
                    </li>
                </ul>
                <div class="started-now">
                    <a href="{{ url('/seller/register') }}">Get Started Now</a>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
