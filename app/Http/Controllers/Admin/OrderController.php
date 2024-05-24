<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
class OrderController extends BaseController
{
    protected $model;
    private $nameItem;

    public function __construct()
    {
        parent::__construct('order');
        // Set your model class here
        $this->nameItem = 'Đơn Hàng';

        View::share('nameClass', 'order');
    }
    public function index(Request $request)
    {
        $query = DB::table('tp_order_shipping')->join('tp_order_status', 'tp_order_shipping.id_order_shipping', '=', 'tp_order_status.shipping_id')->select('tp_order_shipping.email', 'tp_order_shipping.phone', 'tp_order_status.total', 'tp_order_status.status', 'tp_order_status.checkout_payment_method', 'tp_order_status.uuid_order_status', 'tp_order_status.created_at', 'tp_order_status.updated_at');

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('tp_order_shipping.email', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('tp_order_shipping.phone', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('tp_order_shipping.email', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('tp_order_status.created_at', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('status', '=', $searchTerm === 'active' ? 1 : 0);
            });
        }

        $data['list'] = $query->paginate(10);

        $data['nameItem'] = $this->nameItem;

        return $this->view_admin('list', $data);
    }

    public function status($uuid, $status, $name)
    {
        $this->model::where('uuid', $uuid)->update([$name => $status]);

        $mess = $status == 1 ? 'Kích hoặt' : 'Tắt';

        toast($mess . ' ' . $this->nameItem . ' thành công', 'success');
        return redirect()->back();
    }
    public function create()
    {
        $data['page_content'] = $this->model::where('status', 1)->where('parent_id', 0)->get();
        $data['action'] = 'create';
        $data['nameItem'] = $this->nameItem;
        return $this->view_admin('detail', $data);
    }

    public function edit($uuid)
    {   
        // Thông tin và địa chỉ người đặt
        $data['user_order']  = DB::table('tp_order_status')
        ->join('tp_order_shipping', 'tp_order_status.shipping_id', 'tp_order_shipping.id_order_shipping')
        ->select('tp_order_shipping.fullname_order', 'tp_order_shipping.phone', 'tp_order_shipping.email', 'tp_order_shipping.address',
         'tp_order_shipping.notes', 'tp_order_status.checkout_payment_method', 'tp_order_status.total','tp_order_status.id_order_status')
         ->where('tp_order_status.uuid_order_status', $uuid)->first();

        //Danh sách sản phẩm người dùng đặt
        $data['list'] = DB::table('tp_order_product')
        ->join('tp_product', 'tp_order_product.product_id', 'tp_product.id_product')
        ->where('order_status_id', $data['user_order']->id_order_status )
        ->get();
        if (!empty($data['user_order'])) {
    
            $data['action'] = 'edit';
            $data['nameItem'] = $this->nameItem;
            return $this->view_admin('detail', $data);
        } else {
            toast('Không tìm thấy ' . $this->nameItem, 'error');
            return back();
        }
    }

    public function destroy(string $uuid)
    {
        $page = $this->model::where('uuid', $uuid)->first();

        if ($page->exists()) {
            $page->delete();
            toast('Xóa ' . $this->nameItem . ' thành công', 'success');
            toast('Delete page content successfully.', 'success');
            return back();
        } else {
            $page->delete();
            toast('Không tìm thấy ' . $this->nameItem, 'error');
            return back();
        }
    }
}
