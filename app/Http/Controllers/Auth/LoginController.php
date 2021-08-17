<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected function redirectTo(){
        if( Auth()->user()->role == 1){
            return route('admin.dashboard');
        }
        elseif( Auth()->user()->role == 2){
            return route('merchant.dashboard');
        }
        elseif( Auth()->user()->role == 3){
            return route('rider.dashboard');
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    public function login(LoginRequest $request)
    {
        $credentials = ['email' => $request->email, 'password' => $request->password, 'status' => '1'];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if( Auth()->user()->role == 1){
                return redirect()->route('admin.dashboard');
            }
            elseif( Auth()->user()->role == 2){
                return redirect()->route('merchant.dashboard');
            }
            elseif( Auth()->user()->role == 3){
                return redirect()->route('rider.dashboard');
            }
        }
        else {
            return back()
                ->withInput($request->only('email', 'remember'))
                ->withErrors(['invalid' => 'Wrong Email or Password or Your Account is not active']);
        }
    }
}
