<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RiderController extends Controller
{
    public function index(){
        if (Auth()->user()->role == 3) {
            return view('rider.dashboard.index');
        }
        else{
            return redirect()->route('logout');
        }
    }
}
