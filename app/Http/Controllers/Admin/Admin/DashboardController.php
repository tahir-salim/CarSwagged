<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.admin.index');
    }
}
