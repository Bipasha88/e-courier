<?php

namespace App\Http\Controllers;

use App\Models\CourierService;
use App\Models\Order;
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

        $order = Order::create([
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'customer_email' => $request->customer_email,
            'customer_phone' => $request->customer_phone,
            'customer_address' =>$request->customer_address,
            'courier_charge' => $request->couriercharge,
            'cost' => $request->subtotal,
            'track_number'=>'12356',
        ]);

        $products = $request->input('products', []);
        $products_id = array();

        foreach ($products as $p => $product){

            $search = Product::firstOrCreate(
                ['name' => $product],
            )->id;

            array_push($products_id,$search);
        }
        $weights = $request->input('weights', []);
        $prices = $request->input('prices', []);

        for ($product=0; $product < count($products); $product++) {
            if ($products_id[$product] != '') {
                $order->products()->attach($products_id[$product],
                    ['weight' => $weights[$product],'price'=> $prices[$product]]);
            }
        }
        return redirect()->route('merchant.dashboard');
    }

}
