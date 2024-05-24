<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use RealRashid\SweetAlert\Facades\Alert;
class CartController extends Controller
{
    public function cart(){
        $data['cart'] = Cart::content();
        if(count($data['cart']) == 0){
            Alert::error('Chưa có sản phẩm nào trong giỏ hàng');
            return redirect()->route('website.home');
        }
        return view('website.modules.cart.cart',$data);
    }

    public function addToCart(Request $request,$uuid,$quantity = 1 )
    {      
        if($request->quantity){
            $quantity = $request->quantity;
        }
        $products = Product::with('cate')
        ->where('tp_product.uuid',$uuid)
        ->first();

         Cart::add(['id' => $products->id_product, 'name' => $products->name_vn, 'qty' => $quantity, 'price' => $products->price,
        'weight' => 0, 'options' => ['avatar' => $products->avatar,'uuid'=>$products->uuid,'name_cate'=>$products->cate->name_vn,'name_en' => $products->name_en,]]);
        Alert::success('Đã thêm vào giỏ hàng thành công', 'Bạn có thể xem chi tiết trong giỏ hàng');
        return back();
    }
    public function updateCart(Request $request){
        foreach($request->quantity as $key => $quantity){
            Cart::update($key, $quantity); 
        }
        Alert::success('Cập nhật giỏ hàng thành công');
        return back();
      
    }
    public function removeItemCart ($rowId) {
        Cart::remove($rowId);
        Alert::success('Xóa sản phẩm trong giỏ hàng thành công');
        return back();
    }
}
