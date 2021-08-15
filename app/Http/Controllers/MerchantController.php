<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MerchantController extends Controller
{
    public function index()
    {
        if (Auth()->user()->role == 2) {
            return view('merchant.dashboard.index');
        } else {
            return redirect()->route('logout');
        }
    }

    public function createOrder(){
        $sender = Auth::user();
        $products = Product::all();
        return view('merchant.createOrder',compact('sender','products'));
    }

    public function storeOrder(Request $request){
        dd(array_sum($request->prices));
    }
}
