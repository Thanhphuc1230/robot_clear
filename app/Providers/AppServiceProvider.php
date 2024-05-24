<?php

namespace App\Providers;

use App\Models\Ads;
use App\Models\CateProduct;
use App\Models\Menu;
use App\Models\News;
use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use App\Models\System;
use App\Models\Page;
use App\Models\Product;
use App\Models\Slider;
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
        Paginator::useBootstrap();

        View::composer('website.*', function ($view) {
            $data['website'] = System::first();

            // menu header
            $data['menus'] = Menu::with('children')->orderBy('stt', 'asc')->where('parent_id', 0)->get();

            //chính sách bảo mật
            $data['privacy'] = News::where('status', 1)->where('category_id', 2)->orderBy('stt', 'asc')->get();

            //Chủ đề sản phẩm
            $data['cateProduct'] = CateProduct::where('status', 1)->orderBy('stt', 'asc')->where('parent_id', 1)->get();

            // Slider
            $data['sliders'] = Slider::where('status', 1)->orderBy('stt', 'asc')->get();

            // Ads
            $data['ads'] = Ads::where('status', 1)->orderBy('stt', 'asc')->get();
            $view->with($data);
        });
    }
}
