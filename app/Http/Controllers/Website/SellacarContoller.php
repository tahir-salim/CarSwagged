<?php

namespace App\Http\Controllers\website;

use App\Http\Controllers\Controller;
use App\Models\CarPost;
use App\Models\Testimonial;

class SellacarContoller extends Controller
{
    public function index()
    {
        $testimonials = Testimonial::paginate(5);
        $cars = CarPost::with('user')->where('is_sale', true)->orderBy('created_at', 'desc')->paginate(6);
        return view('website.sellacar.sell_car', compact('testimonials', 'cars'));
    }
}
