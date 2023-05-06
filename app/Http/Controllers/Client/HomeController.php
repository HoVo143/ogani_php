<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Article;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        // hàm này trả về một danh sách 10 danh mục sản phẩm có sản phẩm và sắp xếp chúng theo thứ tự giảm dần theo tên.
        $productCategories = ProductCategory::orderBy('name', 'desc')->get()->filter(function ($productCategory){
            return $productCategory->products->count() > 0;
        })->values()->slice(0, 10);

        //
        $products = DB::table('product')->join('product_category', 'product.product_category_id', '=', 'product_category.id')
            ->select('product.*','product_category.name as category_name')
            ->where('product_category.deleted_at',NULL)
            ->orderBy('product.id', 'desc')
            ->limit(8)
            ->get();

        $arrayProductCategory = $products->pluck('category_name')->unique();

        // eloquent ORM
        $latesProducts = Product::orderBy('id', 'desc')->limit(3)->get(); // có thể thay id thành create_at
        //or dung`
        // query builder
        // $latesProducts = DB::table('product')->orderBy('create_at', 'desc')->limit(3)->get();

        //
        $articles = Article::orderBy('count_click', 'desc')->limit(3)->get();
        // dd($arrayProductCategory);
        // $productCategories = ProductCategory::limit(10)->get();
        return view('client.pages.home', compact('productCategories', 'products', 'arrayProductCategory', 'latesProducts', 'articles'));
    }

    
  
}
