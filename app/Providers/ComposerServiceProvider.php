<?php

namespace App\Providers;

use App\Models\ProductCategory;
use App\View\Composers\ProfileComposer;
use Illuminate\Support\Facades;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
       
        $arrayProductCategoryView = [
            'Clients.pages.checkout',
            'Clients.pages.cart',
            'Clients.pages.home',

        ];
        View::composer( $arrayProductCategoryView, function ($view) {
            $productCategories = ProductCategory::orderBy('name', 'desc')
            ->get()
            ->filter(function ($productCategory){
                return $productCategory->products->count() > 0;
            })->slice(0 ,10);
            $view->with('productCategories', $productCategories);
        });
    } 
}
