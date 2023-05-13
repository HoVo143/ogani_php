<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(){
        $cart = session()->get('cart') ?? [];
        // $productCategories = ProductCategory::orderBy('name', 'desc')
        // ->get()
        // ->filter(function ($productCategory){
        //     return $productCategory->products->count() > 0;
        // })->slice(0 ,10);
        // dd($cart);
        // return view('client.pages.cart', compact('productCategories', 'cart'));
        return view('client.pages.cart', compact( 'cart'));

    }

    public function addProductToCart($id){

        $product = Product::find($id);
        $cart = session()->get('cart') ?? [];// nếu chưa có trả về mảng là rỗng

        //add product vô giỏ hàng
        $cart[$id]['id'] = $id;
        $cart[$id]['qty'] = ($cart[$id]['qty'] ?? 0 ) + 1;
        $cart[$id]['price'] = $product->price;
        $cart[$id]['name'] = $product->name;
        $cart[$id]['image'] = $product->image_url;
        // đẩy cart(nguyên array) vô trong lại cart
        session()->put('cart', $cart);
        //total
        
        // cach khac

        $totalCart = $this->totalCart($cart);
        session()->put('total_cart', $totalCart);

        return response()->json(['id' => $id, 'total_cart' => $totalCart]);
        // return response()->json(['id' => $id]);
    }

    public function deleteProductInCart($id){

        $cart = session()->get('cart') ?? [];// nếu chưa có trả về mảng là rỗng
        if(array_key_exists($id, $cart)){
            unset($cart[$id]);
            session()->put('cart', $cart);
            // cach khac
            $totalCart = $this->totalCart($cart);
            session()->put('total_cart', $totalCart);
            
        }
        return response()->json(['id' => $id , 'total_cart' => $totalCart]);
        // return response()->json(['id' => $id ]);


    }

    // cach khac
    public function totalCart(array $cart): string
    {
        $total = 0;
        if(count($cart) > 0 ){
            foreach ($cart as $item){
                $total += $item['qty'] * $item['price'];
            }
        }
        return number_format($total, 2);
    }

    public function deleteAllItems(){
        session()->put('cart') ?? [];// nếu chưa có trả về mảng là rỗng
        session()->put('total_cart', number_format(0 , 2));
        return redirect()->route('cart.cart');
        
    }

    public function updateItemInCart($id,$qty){
        $cart=session()->get('cart')??[];
        if(array_key_exists($id,$cart)){
            if($qty === 0){
                unset($cart[$id]);
            } else
            {
                $cart[$id]['qty']=$qty;

            }
            $cart[$id]['qty']=$qty;
            session()->put('cart', $cart);
            $totalCart = $this->totalCart($cart);
            session()->put('total_cart', $totalCart);
        }
        return response()->json(['id'=>$id]);

    }
}
