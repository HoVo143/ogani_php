<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// client
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// Route::get('/', function () {
//     return view('client.pages.home');
// })->name('home');

// Route::get('/blog', function () {
//     return view('client.pages.blog');
// })->name('blog');

// Route::get('/shop', function () {
//     return view('client.pages.shop');
// })->name('shop');

// Route::get('/contact', function () {
//     return view('client.pages.contact');
// })->name('contact');

// admin
Route::prefix('admin')->group(function (){ // thêm /admin sẵn

    Route::get('/', function () {
        return view('admin.pages.index');
    })->name('admin.index');
    
    Route::get('/user', function () {
        return view('admin.pages.user.user');
    })->name('admin.user');
    
    Route::get('/product', function () {
        return view('admin.pages.product.product');
    })->name('admin.product');
    
    Route::get('/blog', function () {
        return view('admin.pages.blog');
    })->name('admin.blog');
    
 

    Route::get('/product/productlist', [ProductController::class , 'index'])->name('admin.product.productlist');

    Route::get('/product/productlist/{id}', [ProductController::class , 'show'])->name('admin.product.detail');
    Route::get('/product/delete/{id}', [ProductController::class , 'destroy'])->name('admin.product.delete');
    Route::post('/product/update/{id}', [ProductController::class , 'update'])->name('admin.product.update');

    Route::post('/product/save', [ProductController::class, 'store'])->name('admin.product.save');
        




    Route::get('/user/userlist', [UserController::class , 'index'])->name('admin.user.userlist');
    Route::get('/user/userlist/{id}', [UserController::class , 'show'])->name('admin.user.detail');
    Route::get('/user/delete/{id}', [UserController::class , 'destroy'])->name('admin.user.delete');
    Route::post('/user/update', [UserController::class , 'update'])->name('admin.user.update');
    // 
    Route::post('/user/save', [UserController::class, 'store'])->name('admin.user.save');
   
    

});


