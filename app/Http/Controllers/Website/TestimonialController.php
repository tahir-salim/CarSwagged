<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Testimonial;
use Auth;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{

    public function index()
    {
        $testimonials = Testimonial::all();
        return view('admin.admin.testimonials.index', compact('testimonials'));
    }

    public function add_testimonial(Request $request, $id)
    {

        $review = new Testimonial();
        $review->user_id = Auth::user()->id;
        $review->post_id = decrypt($id);
        $review->review = $request->review;
        $review->rating = $request->rating;
        $review->save();
        return back();
    }

    public function change_status(Request $request, $id)
    {
        $review = Testimonial::find(decrypt($id));
        $review->status = $request->testimonial_status;
        $review->save();
        return back();
    }
}
