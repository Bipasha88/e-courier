<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserCreateRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function register_post(UserCreateRequest $request)
    {
        $role = "0";

        if($request->role == "Merchant")
            $role = "2";
        elseif ($request->role == "Rider")
            $role = "3";
        $request->password = bcrypt($request->input('password'));

        User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password,
            "address" => $request->address,
            "city" => $request->city,
            "zone" => $request->zone,
            "phone" => $request->phone,
            "role" => $role,
        ]);

        return redirect()->route('login');

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

}
