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
        // About us
        $data['about'] = About::first();

        $data['cateProductHome'] = CateProduct::with('children')->where('status', 1)->where('home', 1)->orderBy('stt', 'asc')->get();

        // Lấy ID của tất cả các mảng con
        $allIds = $data['cateProductHome'] ->pluck('id_category_product')->toArray();
        foreach ($data['cateProductHome']  as $cate) {
            $childIds = $cate->children->pluck('id_category_product')->toArray();
            $allIds = array_merge($allIds, $childIds);
        }
        
      
        return view('website.modules.home.index', $data);
    }
}
