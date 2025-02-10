@extends('website.includes.layouts')
@section('content')
@section('swagged', 'active')

<div class="swagged-sec1">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <?php
                $a = DB::table('web_settings')
                    ->where('key', 'What’s Car Swagged Auto is?')
                    ->first();
                ?>
                <h2>What’s Car Swagged Auto is?</h2>
                <p>{{ $a->description }}</p>

                <h2 id="works">How It Works</h2>
                <?php
                $b = DB::table('web_settings')
                    ->where('value', 'Buying a Car')
                    ->first();
                ?>
                <h4 id="buy-car">Buying a Car</h4>
                <p> {{ $b->description }}</p>
                <h4 id="sell-car">Selling a Car</h4>
                <?php
                $c = DB::table('web_settings')
                    ->where('value', 'Selling a Car')
                    ->first();
                ?>
                <p> {{ $c->description }}</p>
                <h4 id="final-sale">Finalizing the Sale</h4>
                <?php
                $d = DB::table('web_settings')
                    ->where('value', 'Finalizing the Sale')
                    ->first();
                ?>
                <p> {{ $d->description }}</p>

                <div class="faq">
                    <h2>Frequently Asked Questions</h2>
                    <h4 id="buy-faq">Buyer Questions</h4>
                    <ul class="accordian">
                        @foreach ($buyerfaqs as $buyer)
                            <li>
                                <h4>{{ $buyer->question }}?</h4>
                                <div>
                                    <p>{{ $buyer->answer }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <h4 id="sell-faq">Seller Questions</h4>
                    <ul class="accordian">
                        @foreach ($sellerfaqs as $seller)
                            <li>
                                <h4>{{ $seller->question }}?</h4>
                                <div>
                                    <p>{{ $seller->answer }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                    <h4 id="sign-faq">Sign in Questions</h4>
                    <ul class="accordian">
                        @foreach ($signinfaqs as $signin)
                            <li>
                                <h4>{{ $signin->question }}?</h4>
                                <div>
                                    <p>{{ $signin->answer }}</p>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="h-100">
                    <div class="drag">
                        <h2>About Us</h2>
                        <ul class="drag-list">
                            <li class="active"><a href="#works">HOW IT WORKS</a></li>
                            <li><a href="#buy-car">Buying a Car</a></li>
                            <li><a href="#sell-car">Selling a Car</a></li>
                            <li><a href="#final-sale">Finalizing the Sale</a></li>
                        </ul>
                        <h2>FAQ</h2>
                        <ul class="drag-list">
                            <li><a href="#buy-faq">Buyer FAQ</a></li>
                            <li><a href="#sell-faq">Seller FAQ</a></li>
                            <li><a href="#sign-faq">Sign in FAQ</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
