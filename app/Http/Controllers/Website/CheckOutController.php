<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Requests\Website\OrderRequest;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Mail\AlertOrder;
use Illuminate\Support\Facades\Mail;
class CheckOutController extends Controller
{
    public function checkout()
    {
        if (Cart::count() == 0) {
            Alert::error('Giỏ hàng đang trống', 'Không có sản phẩm trong giỏ hàng của bạn');
            return redirect()
                ->route('website.index');
        }
        return view('website.modules.cart.checkout');
    }

    public function checkoutStore(OrderRequest $request)
    {
        //Thêm thông tin người đặt hàng
        $uuidOfShipping = Str::uuid();
        $data = [
            'fullname_order' => $request->fullname_order,
            'uuid_order_shipping' => $uuidOfShipping,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'notes' => $request->notes,
            'created_at' => new \DateTime(),
        ];

       $idShipping = DB::table('tp_order_shipping')->insertGetId($data);

        // Tình trạng đơn hàng
        $order_status = [
            'uuid_order_status' => Str::uuid(),
            'shipping_id' => $idShipping,
            'checkout_payment_method' => $request->checkout_payment_method,
            'total' => $request->total,
            'created_at' => new \DateTime(),
        ];

        $idOrderStatus= DB::table('tp_order_status')->insertGetId($order_status);
        $content = Cart::content();
        // Sản phẩm đặt
        foreach ($content as $product_content) {
            $v_data['uuid_order_product'] = Str::uuid();
            $v_data['order_status_id'] = $idOrderStatus;
            $v_data['product_id'] = $product_content->id;
            $v_data['quantity'] = $product_content->qty;
            $v_data['created_at'] = new \DateTime();
            DB::table('tp_order_product')->insert($v_data);
        }


        // Gửi thông báo khi đặt hàng
        $email = DB::table('tp_system')->value('email_alert'); // Email address of the recipient

        Mail::to($email)->send(new AlertOrder());
        return redirect()->route('website.orderSuccess');
    }

    public function orderSuccess()
    {
        Cart::destroy();
        return view('website.modules.cart.orderSuccess');
    }
}
