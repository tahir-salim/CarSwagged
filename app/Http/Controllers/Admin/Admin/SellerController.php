<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\SellerRequest;
use App\Models\User;

class SellerController extends Controller
{
    public function index()
    {
        $sellers = User::where('user_role_id', '3')->get();
        return view('admin.admin.sellers.index', compact('sellers'));
    }

    public function show($id)
    {
        $user = User::find(decrypt($id));
        return view('admin.admin.sellers.detail', compact('user'));
    }

    public function seller_request()
    {
        $requests = SellerRequest::all();
        return view('admin.admin.sellers.requests', compact('requests'));
    }

    public function seller_request_status($id)
    {
        $req = SellerRequest::find(decrypt($id));
        $req->status = $req->status == 'Active' ? 'Inactive' : 'Active';
        $req->save();
        return back();
    }
}
