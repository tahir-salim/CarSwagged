<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\BuyerQuestion;
use App\Models\CarPost;
use App\Models\Faq;
use App\Models\NewsLetter;
use App\Models\PostBid;
use App\Models\PostComment;
use App\Models\Testimonial;
use App\Models\WebSetting;
use Auth;
use Carbon\Carbon;
use Cookie;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Mail;

class AuctionController extends Controller
{
    public function index(Request $request)
    {

//     $url = "https://maps.googleapis.com/maps/api/geocode/json?address=99501&key=AIzaSyDaP0CZQw8m5Zj_q7bVbrCbGL7u0SA7EqE&region=US";
//     $result_string = file_get_contents($url);
// $result = json_decode($result_string, true);
// $result1[]=$result['results'][0];
// $result2[]=$result1[0]['geometry'];
// $result3[]=$result2[0]['location'];
// $lat = $result3[0]['lat'];
// $lon = $result3[0]['lng'];

//     $data = DB::table("users")
//         ->select("users.id"
//             ,DB::raw("6371 * acos(cos(radians(" . $lat . "))
//             * cos(radians(24.796314203654312))
//             * cos(radians(67.05106599367201) - radians(" . $lon . "))
//             + sin(radians(" .$lat. "))
//             * sin(radians(24.796314203654312))) AS distance"))
//             ->groupBy("users.id")
//             ->get();
//   dd($data);

        if ($request->year_from || $request->year_to || $request->transmission || $request->body_style) {

            if ($request->year_from == null) {
                $year_from = $request->year_to;
                $year_to = $request->year_to;
            } elseif ($request->year_to == null) {
                $year_from = $request->year_from;
                $year_to = $request->year_from;
            } else {
                $year_from = $request->year_from;
                $year_to = $request->year_to;
            }
            if ($request->transmission == null) {
                $transmission = 'All';
            } else {
                $transmission = $request->transmission;
            }

            if ($request->body_style == null) {
                $body_style = 'All';
            } else {
                $body_style = $request->body_style;
            }

            if ($transmission == 'All' && $body_style == 'All') {
                $EndingSoon = CarPost::with('user')->whereBetween('year', array($year_from, $year_to))->where('is_bid', true)->orderBy('bid_end_time', 'asc')->get();
                $newlyListing = CarPost::with('user')->whereBetween('year', array($year_from, $year_to))->where('is_bid', true)->orderBy('created_at', 'desc')->get();
                $NoReserve = Carpost::with('user')->where('is_reserved', 'No')->whereBetween('year', array($year_from, $year_to))->where('is_bid', true)->get();
                $LowMileage = Carpost::with('user')->where('is_low_mileage', true)->whereBetween('year', array($year_from, $year_to))->where('is_bid', true)->get();
            } elseif ($body_style == 'All') {
                $EndingSoon = CarPost::with('user')->whereBetween('year', array($year_from, $year_to))->where('transmission', $transmission)->where('is_bid', true)->orderBy('bid_end_time', 'asc')->get();
                $newlyListing = CarPost::with('user')->whereBetween('year', array($year_from, $year_to))->where('transmission', $transmission)->where('is_bid', true)->orderBy('created_at', 'desc')->get();
                $NoReserve = Carpost::with('user')->where('is_reserved', 'No')->whereBetween('year', array($year_from, $year_to))->where('transmission', $transmission)->where('is_bid', true)->get();
                $LowMileage = Carpost::with('user')->where('is_low_mileage', true)->whereBetween('year', array($year_from, $year_to))->where('transmission', $transmission)->where('is_bid', true)->get();
            } elseif ($transmission == 'All') {
                $EndingSoon = CarPost::with('user')->whereBetween('year', array($year_from, $year_to))->where('body_style', $body_style)->where('is_bid', true)->orderBy('bid_end_time', 'asc')->get();
                $newlyListing = CarPost::with('user')->whereBetween('year', array($year_from, $year_to))->where('body_style', $body_style)->where('is_bid', true)->orderBy('created_at', 'desc')->get();
                $NoReserve = Carpost::with('user')->where('is_reserved', 'No')->whereBetween('year', array($year_from, $year_to))->where('body_style', $body_style)->where('is_bid', true)->get();
                $LowMileage = Carpost::with('user')->where('is_low_mileage', true)->whereBetween('year', array($year_from, $year_to))->where('body_style', $body_style)->where('is_bid', true)->get();
            } else {
                $EndingSoon = CarPost::with('user')->whereBetween('year', array($year_from, $year_to))->where('transmission', $transmission)->where('body_style', $body_style)->where('is_bid', true)->orderBy('bid_end_time', 'asc')->get();
                $newlyListing = CarPost::with('user')->whereBetween('year', array($year_from, $year_to))->where('transmission', $transmission)->where('body_style', $body_style)->where('is_bid', true)->orderBy('created_at', 'desc')->get();
                $NoReserve = Carpost::with('user')->where('is_reserved', 'No')->whereBetween('year', array($year_from, $year_to))->where('transmission', $transmission)->where('body_style', $body_style)->where('is_low_mileage', true)->where('is_bid', true)->get();
                $LowMileage = Carpost::with('user')->whereBetween('year', array($year_from, $year_to))->where('transmission', $transmission)->where('body_style', $body_style)->where('is_low_mileage', true)->where('is_bid', true)->get();
                
                
                // $lowYourWork = CarPost::with(['car'=>function($lowYourWork,$transmission,$questions){
                //     $lowYourWork->where('bid_price',$transmission)
                //     ->where('is_low_mileage',true)
                //     ->orderBy('created_at','desc')
                //     ->get();
                // },'user'=>function($lowYourWork,$transmission,$questions){
                //     $lowYourWork->where('submited_at','!=',null)
                //     ->where('transmission',$transmission)
                //     ->where('question_type',$questions)
                //     ->get();
                // }])->where('body_style',$body_style)
                // ->where('is_bid', true)
                // ->get();
            }

        } else {
            $year_from = 'null';
            $year_to = 'null';
            $transmission = 'null';
            $body_style = 'null';

            $EndingSoon = Carpost::with('user')->where('is_bid', true)->orderBy('bid_end_time', 'asc')->get();
            $newlyListing = CarPost::with('user')->where('is_bid', true)->orderBy('created_at', 'desc')->get();
            $NoReserve = Carpost::with('user')->where('is_reserved', 'No')->where('is_bid', true)->get();
            $LowMileage = Carpost::with('user')->where('is_low_mileage', true)->where('is_bid', true)->get();
        }
        $currentDate = date("Y-m-d");
        $backDate = date('Y-m-d', strtotime("-7 day", strtotime($currentDate)));
        $forwardDate = date('Y-m-d', strtotime("+7 day", strtotime($currentDate)));
        $currentDate = date('Y-m-d', strtotime("+1 day", strtotime($currentDate)));

        $newlyListing_5 = CarPost::with('user')->where('is_bid', true)->orderBy('created_at', 'desc')->paginate(5);

        $reviews = Testimonial::orderBy('id', 'DESC')->get();
        if ($request->zip_code) {
            $zipcodes = CarPost::with('user')->orderBy('created_at', 'desc')->where('zip_code', $request->zip_code)->where('is_bid', true)->get();
            $zip_search = true;
            return view('website.auction.index', compact('newlyListing', 'newlyListing_5', 'NoReserve', 'EndingSoon', 'LowMileage', 'reviews', 'zipcodes', 'zip_search', 'year_from', 'year_to', 'transmission', 'body_style'));
        } else {
            $zip_search = false;
            return view('website.auction.index', compact('newlyListing', 'newlyListing_5', 'NoReserve', 'EndingSoon', 'LowMileage', 'reviews', 'zip_search', 'year_from', 'year_to', 'transmission', 'body_style'));
        }
        //$getCarPost = CarPost::get();
        // dd($remaining_days = Carbon::now()->diffInDays(Carbon::parse('2022-06-07 00:00:00')));
        // $newlyListing = CarPost::with('user')->where('created_at','>=',$backDate)->where('created_at','<=',$currentDate)->get();
    }

    public function setCookie(Request $request)
    {
        $id = $request->post_id;
        $value = $request->cookie('pageViews' . $id);
        if (!$value) {
            $cardetail = CarPost::find($id);
            $cardetail->views = $cardetail->views + 1;
            $cardetail->save();
        }
        $response = new Response('Set Cookie');
        $response->cookie('pageViews' . $id, 'CurrentPage', 1440);
        return $response;
    }

    public function detail(Request $request, $id)
    {

        $id = decrypt($id);
        $cardetail = CarPost::with('user')->where('id', $id)->first();
        $questions = BuyerQuestion::where('post_id', $id)->get();
        $reviews = Testimonial::with('user')->where('post_id', $id)->where('status', 'Approved')->get();
        $comments = PostComment::with('user')->orderBy('id', 'DESC')->where('status', 'Active')->where('post_id', $id)->get();
        $latest_bid = PostBid::orderBy('bid_price', 'desc')->where('post_id', $id)->first();
        $totalbids = PostBid::where('post_id', $id)->get();
        $auctions = CarPost::orderBy('bid_end_time', 'asc')->where('bid_end_time', '!=', null)->where('bid_start_time', '!=', null)->paginate(5);
        $now = Carbon::now();
        $hours = $now->diffInHours($cardetail->bid_end_time);
        $minutes = $now->diffInMinutes($cardetail->bid_end_time);
        $cardetail->save();
        return view('website.auction.details', compact('cardetail', 'questions', 'reviews', 'comments', 'latest_bid', 'totalbids', 'auctions', 'hours', 'minutes'));
    }

    public function swagged()
    {
        $buyerfaqs = Faq::where('question_type', 'buyer')->get();
        $sellerfaqs = Faq::where('question_type', 'seller')->get();
        $signinfaqs = Faq::where('question_type', 'signin')->get();
        return view('website.swagged.swagged_auto', compact('buyerfaqs', 'sellerfaqs', 'signinfaqs'));
    }

    public function bid_post(Request $request, $id)
    {

        $id = decrypt($id);
        $bids = PostBid::orderBy('bid_price', 'desc')->where('post_id', $id)->first();
        if (isset($bids->bid_price)) {
            if ($request->bid_price <= $bids->bid_price) {
                return back()->with('error', 'Bid Amount must be Greater than current bid price');
            }
        }
        $bid = new PostBid();
        $bid->post_id = $id;
        $bid->bid_price = $request->bid_price;
        $bid->user_id = Auth::user()->id;
        $bid->status = 'Active';
        $bid->save();

        $totalbids = PostBid::where('post_id', $id)->get();

        $car = CarPost::find($id);
        $car->total_bid = count($totalbids);
        $car->save();

        $comment = new PostComment();
        $comment->post_id = $id;
        $comment->bid_amount = $request->bid_price;
        $comment->seller_id = false;
        $comment->comment = 'Bid';
        $comment->is_bid = true;
        $comment->user_id = Auth::user()->id;
        $comment->status = 'Active';
        $comment->save();
        return back()->with('success', 'Your Bid has been Successfully Placed');
    }

    public function search(Request $request)
    {

        $currentDate = date("Y-m-d");
        $search = $request->search;
        $backDate = date('Y-m-d', strtotime("-7 day", strtotime($currentDate)));
        $forwardDate = date('Y-m-d', strtotime("+7 day", strtotime($currentDate)));
        $currentDate = date('Y-m-d', strtotime("+1 day", strtotime($currentDate)));
        $EndingSoon = Carpost::with('user')->where('make', 'LIKE', '%' . $search . '%')->Orwhere('model', 'LIKE', '%' . $search . '%')->orderBy('bid_end_time', 'asc')->get();
        $newlyListing = CarPost::with('user')->where('make', 'LIKE', '%' . $search . '%')->Orwhere('model', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'desc')->get();
        $newlyListing_5 = CarPost::with('user')->where('make', 'LIKE', '%' . $search . '%')->Orwhere('model', 'LIKE', '%' . $search . '%')->orderBy('created_at', 'desc')->paginate(5);
        $NoReserve = Carpost::with('user')->where('make', 'LIKE', '%' . $search . '%')->Orwhere('model', 'LIKE', '%' . $search . '%')->where('is_reserved', 'No')->get();
        $LowMileage = Carpost::with('user')->where('make', 'LIKE', '%' . $search . '%')->Orwhere('model', 'LIKE', '%' . $search . '%')->where('is_low_mileage', true)->get();

        return view('website.auction.search_detail', compact('newlyListing', 'newlyListing_5', 'NoReserve', 'EndingSoon', 'LowMileage', 'search'));

    }

    public function newsletter(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required | unique:newsletters,email',
        ]);

        $newsletter = new NewsLetter();
        $newsletter->email = $request->email;
        $newsletter->save();
        Mail::send('emails.daily-mail', $newsletter->toArray(), function ($message) {
            $message->to('dajeco5120@wnpop.com', 'Car Swagged')->subject('Daily Email');
        });
        return back();
    }

}
