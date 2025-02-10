<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class BuyerController extends Controller
{
    public function index()
    {
        $buyers = User::where('user_role_id', '4')->get();
        return view('admin.admin.buyers.index', compact('buyers'));
    }

    public function user_status(Request $request, $id)
    {
        $user = User::find(decrypt($id));
        $user->status = $request->user_status;
        $user->save();
        return back()->with('success', 'User Status has been Updated');
    }

    public function show($id)
    {
        $user = User::find(decrypt($id));
        return view('admin.admin.buyers.detail', compact('user'));
    }
}
