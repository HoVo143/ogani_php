<?php

use App\Http\Controllers\ArticleCategoryController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Client\CartController;
use App\Http\Controllers\Client\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\GoogleLoginController;
use App\Http\Controllers\ProductCategory;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TextSendMailController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;

// client
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/shop', [ShopController::class, 'index'])->name('shop');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
//article client
Route::get('/show-article', [App\Http\Controllers\Client\ArticleController::class, 'show'])->name('show.article');

// cart
require(__DIR__ . '/cart/web.php'); // magic method php

// dem nay quang vao page khac
Route::prefix('cart')->name('cart.')->group(function()
{
    Route::get('/', [App\Http\Controllers\Client\CartController::class, 'index'])->name('cart')->middleware('auth');
    Route::get('/add-to-cart/{id}', [App\Http\Controllers\Client\CartController::class, 'addProductToCart'])->name('add-product')->middleware('auth');
    Route::get('/delete-product-in-cart/{id}', [App\Http\Controllers\Client\CartController::class, 'deleteProductInCart'])->name('delete-product-in-cart')->middleware('auth');
    // xoa tat ca cart
    Route::get('/delete-all', [App\Http\Controllers\Client\CartController::class, 'deleteAllItems'])->name('delete-all');
    // tang/giam so luong san pham
    Route::get('/update-item-in-cart/{id}/{qty?}', [App\Http\Controllers\Client\CartController::class, 'updateItemInCart'])->name('update-in-cart');
});


//checkout
Route::get('/checkout', [App\Http\Controllers\Client\OrderController::class, 'index'])->name('checkout');
Route::post('/checkout/place-order', [App\Http\Controllers\Client\OrderController::class, 'placeOrder'])->name('checkout.place-order');


// login
Route::get('/giaodienlogin', [UserController::class, 'giaodienlogin'])->name('giaodienlogin');
Route::post('/dangnhap', [UserController::class, 'dangnhap'])->name('dangnhap');
Route::post('/dangxuat', [UserController::class, 'dangxuat'])->name('dangxuat');
// end login

// admin
Route::prefix('admin')->middleware('auth.admin')->group(function (){ // thêm /admin sẵn

    Route::get('/', function () {
        return view('admin.pages.index');
    })->name('admin.index');
    
    Route::get('/user', function () {
        return view('admin.pages.user.user');
    })->name('admin.user');
    
    // Route::get('/product', function () {
    //     return view('admin.pages.product.product');
    // })->name('admin.product');
    
    Route::get('/blog', function () {
        return view('admin.pages.blog');
    })->name('admin.blog');
    
    //product
    Route::get('/product/productlist', [ProductController::class , 'index'])->name('admin.product.productlist');
    Route::post('/product/save', [ProductController::class, 'store'])->name('admin.product.save');
    Route::get('/product/detail/{id}', [ProductController::class, 'edit'])->name('admin.product.detail');
    Route::post('/product/edit/{id}', [ProductController::class, 'update'])->name('admin.product.edit');
    Route::get('/product/create', [ProductController::class, 'create'])->name('admin.product.create');
    // Route::get('/product/productlist/{id}', [ProductController::class , 'show'])->name('admin.product.detail');
    Route::get('/product/delete/{id}', [ProductController::class , 'destroy'])->name('admin.product.delete');
    // Route::post('/product/update/{id}', [ProductController::class , 'update'])->name('admin.product.update');
    
    //user
    Route::get('/user/userlist', [UserController::class , 'index'])->name('admin.user.userlist');
    Route::get('/user/userlist/{id}', [UserController::class , 'show'])->name('admin.user.detail');
    Route::get('/user/delete/{id}', [UserController::class , 'destroy'])->name('admin.user.delete');
    Route::post('/user/update', [UserController::class , 'update'])->name('admin.user.update');
    Route::post('/user/save', [UserController::class, 'store'])->name('admin.user.save');
   
    //product_category
    // Route::get('/product_category', [ProductCategoryController::class, 'create'])->name('admin.product_category');
    Route::resource('product-category', ProductCategoryController::class);
    Route::get('product-category/create', [ProductCategoryController::class, 'create'])->name('product-category.create');

    // Route::resource('product-category-list', ProductCategoryController::class);


    //article
    Route::resource('article', ArticleController::class );
    Route::get('article/create', [ArticleController::class, 'create'])->name('article.create');
    //article category
    Route::resource('article-category', ArticleCategoryController::class);
    Route::get('article-category/create', [ArticleCategoryController::class, 'create'])->name('article-category.create');
    Route::post('article-category/{article_category}/restore', [ArticleCategoryController::class, 'restore'])->name('article-category.restore');


});



Auth::routes();

// Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/product-get-slug', [ProductController::class, 'getSlug'])->name('product.get.slug');

Route::post('/article-get-slug', [ArticleController::class, 'getSlug'])->name('article.get.slug');

Route::post('/write/generate', [ArticleController::class, 'generate'])->name('write-generate');


//test mail
Route::get('/test-send-mail', [TextSendMailController::class, 'sendMail']);


// dang nhap bang google
Route::get('/auth/google/redirect',[GoogleLoginController::class, 'redirect'])->name('google.redirect'); //giao dien
Route::get('/auth/google/callback', [GoogleLoginController::class, 'callback']); // su li dang nhap vao home