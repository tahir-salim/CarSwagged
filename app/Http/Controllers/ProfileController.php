<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = User::find(Auth::id());
        return view('admin.common.profile', compact('user'));
    }

    public function edit()
    {
        $user = User::find(Auth::id());
        return view('admin.common.edit-profile', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::find(decrypt($id));
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->gender = $request->gender;
        $user->age = $request->age;
        $user->country = $request->country;
        $user->save();

        return view('admin.common.profile', compact('user'));
    }
}
