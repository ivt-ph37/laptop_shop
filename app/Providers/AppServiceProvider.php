<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Model\Categoies;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['user.header.header_category','user.product.product_detail'],function($view)
        {
            $categories = Categoies::all();
            $category = Categoies::with('childrenCategories')->where('parent_id', 0)->get();
            $view->with('categories', $categories)->with('category', $category);

        });
    }
}
