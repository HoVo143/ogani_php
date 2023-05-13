<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = session()->get('cart') ?? [];

        return view('client.pages.checkout', compact('cart'));
    }

    public function placeOrder(Request $request){
        dd($request);
        $request->validate([
            'full_name' =>'required|max:255',
            'address' =>'required|max:255',
            'phone' =>'required|regex::/(01)[0-9]{9}/',
        ]);

        $fullname = $request->get('full_name');
        $address = $request->get('address');
        $phone = $request->get('phone');
        $notes = $request->get('notes');
        $payment_method = $request->get('payment_method');

        if($payment_method === 'cod'){
            DB::transaction(

            );
        }
        else
        {

        };
    }
    
}
