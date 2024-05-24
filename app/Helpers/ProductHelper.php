<?php
use App\Models\CateProduct;
use App\Models\Product;

function products($id_category_product){
    $cateChild = CateProduct::where('parent_id', $id_category_product)->pluck('id_category_product');
    $cateId = $cateChild->toArray();
    $cateId[] = $id_category_product;
    $data['products'] = Product::with('cate')->whereIn('category_id', $cateId)
    ->where('status', 1)
    ->orderBy('stt', 'asc')
    ->limit(8)
    ->get();

    return $data['products'];
}