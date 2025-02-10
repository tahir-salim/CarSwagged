<?php

namespace App\Http\Controllers\Admin\Seller;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.seller.index');
    }
}
