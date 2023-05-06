<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addProductToCart($id){

        $product = Product::find($id);
        $cart = session()->get('cart') ?? [];// nếu chưa có trả về mảng là rỗng

        //add product vô giỏ hàng
        $cart[$id]['qty'] = 1;
        $cart[$id]['price'] = $product->price;
        $cart[$id]['name'] = $product->name;
        $cart[$id]['image'] = $product->image_url;

        // đẩy cart(nguyên array) vô trong lại cart
        session()->put('cart', $cart);
        
        return response()->json(['id' => $id]);
    }
}
