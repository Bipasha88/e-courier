<?php

namespace App\Http\Controllers;

use App\Models\CourierService;
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
        $services = CourierService::all();
        return view('merchant.createOrder',compact('sender','products','services'));
    }

    public function storeOrder(Request $request){
        dd($request->all());
    }
}
