<?php

namespace App\Http\Controllers\Admin\Buyer;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.buyer.index');
    }
}
