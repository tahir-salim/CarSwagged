<?php

namespace App\Http\Controllers\Admin\Seller;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

class RegisterController extends Controller
{
    public function index()
    {
        return view('admin.seller.auth.register');
    }

    protected function create(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email',
            'password' => 'required|confirmed|min:6',
            'seller_type' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'age' => 'required',
            'country' => 'required',
            'address' => 'required',
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->seller_type = $request->seller_type;
        $user->password = Hash::make($request->password);
        $user->user_role_id = 3;
        $user->gender = $request->gender;
        $user->phone = $request->phone;
        $user->age = $request->age;
        $user->country = $request->country;
        $user->address = $request->address;

        if ($user->save()) {
            return redirect('/');
        } else {
            return redirect('login');
        }
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->user();

            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {

                Auth::login($finduser);

                return redirect()->intended('/');

            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password' => encrypt('123456dummy'),
                    'user_role_id' => 3,
                ]);

                Auth::login($newUser);

                return redirect()->intended('/');
            }

        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
