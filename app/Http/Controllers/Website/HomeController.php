<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\About;
use App\Models\CateNew;
use App\Models\CateProduct;
use App\Models\News;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Slider;
class HomeController extends Controller
{
    public function home()
    {
        // Slider
        $data['sliders'] = Slider::where('status', 1)->orderBy('stt', 'asc')->get();

        $data['flashSale'] = Product::with('cate')->where('discount','!=',0)->orderBy('stt', 'asc')->get();

        $data['categoryProductHot'] = CateProduct::with('products')->where('home',1)->orderBy('stt', 'asc')->get();

        $data['latestNew'] = News::with('cate')->orderBy('stt', 'asc')->get();
        return view('website.modules.home.index', $data);
    }
}
