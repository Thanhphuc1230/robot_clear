<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CateProduct;
use App\Models\News;
use App\Models\Product;

class ProductController extends NewsController
{
    public function categoryAll(){
        $data['categoryProduct'] = CateProduct::with('children')->where('parent_id',0)->first();

        $data['products'] = Product::with('cate')
        ->where('status', 1)
        ->paginate(20);
        return view('website.modules.product.category', $data);
    }

    public function categoryProduct($name_cate_child){
        $data['categoryProduct'] = CateProduct::with('children')->where('slug',$name_cate_child)->first();
       
        if (!$data['categoryProduct']) {
            return $this->categoryNews($name_cate_child,Null);
        }

        if($data['categoryProduct']->parent_id == 0){
            return $this->categoryAll();
        }
        $categoryProductId = $data['categoryProduct']->id_category_product;

        // Lấy danh sách ID của các children
        $childrenIds = $data['categoryProduct']->children->pluck('id_category_product');
    
        // Tạo mảng chứa ID của CateProduct và các children
        $categoryProductIds = $childrenIds->prepend($categoryProductId);
        $data['products'] = Product::with('cate')
        ->whereIn('category_id',$categoryProductIds)
        ->where('status', 1)
        ->paginate(20);
        return view('website.modules.product.category', $data);
    }


    public function categoryProductChild($name_cate,$name_cate_child){
        $data['categoryProduct'] = CateProduct::with('children')->where('slug',$name_cate_child)->first();
        if (!$data['categoryProduct']) {
            return $this->detailNew($name_cate,$name_cate_child);
        }
        $data['products'] = Product::with('cate')
        ->where('category_id', $data['categoryProduct']->id_category_product)
        ->where('status', 1)
        ->paginate(20);
        return view('website.modules.product.category', $data);
    }

    public function detailProduct($slug_product){
        // Lấy chi tiết sản phẩm
        $data['detail'] = Product::with('cate')->where('slug',$slug_product)->first();

        // Lấy sản phẩm tương tư khác sản phẩm chi tiết
        $data['sameProduct'] = Product::with('cate')->where('category_id',$data['detail']->cate->id_category_product)
        ->where('status',1)
        ->where('slug','!=',$data['detail']->slug)
        ->limit(4)
        ->get();
        return view('website.modules.product.detail',$data);
    }
}
