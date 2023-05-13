<?php

namespace App\Http\Controllers;

use App\Models\ProductCategory;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(){
        $productCategories = ProductCategory::orderBy('name', 'desc')
        ->get()
        ->filter(function ($productCategory){
            return $productCategory->products->count() > 0;
        })->slice(0 ,10);
        return view('client.pages.contact', compact('productCategories'));
    }
}
