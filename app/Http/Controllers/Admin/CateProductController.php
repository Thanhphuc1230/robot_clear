<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CateProductRequest;
use App\Models\CateProduct;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
class CateProductController extends BaseController
{
    protected $model;
    protected $nameItem;


    public function __construct()
    {
        parent::__construct('category_product');
        // Set your model class here
        $this->model = new CateProduct();
        $this->nameItem = 'Chủ đề sản phẩm';

        View::share('nameClass', 'category_product');
    }
    public function index(Request $request)
    {
        $query = $this->model::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name_vn', 'LIKE', "%{$searchTerm}%")
                ->orWhere('status', '=', $searchTerm === 'active' ? 1 : 0);
            });
        }

        $data['list'] = $query->orderBy('parent_id','asc')->paginate(10);
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
            // Lấy chủ đề
        $data['category'] = $this->model
            ::where('status', 1)
            ->where('parent_id', 0)
            ->with('children.children') 
            ->orderBy('name_vn', 'asc')
            ->get();//Lấy chủ đề cha
        $data['action'] = 'create';
        $data['nameItem'] = $this->nameItem;
        return $this->view_admin('detail', $data);
    }

    public function store(CateProductRequest $request)
    {
        $data = $request->except('_token','return_back','return_list');
        $data['uuid'] = Str::uuid();
        $data['created_at'] = new \DateTime();
        $data['slug'] = Str::slug($request->input('name_vn'));

        //avatar
        $image = $request->avatar;
        if ($image) {
            $imageName = time() . '-' . $image->getClientOriginalName();

            $image->move(public_path('images/page'), $imageName);
            $data['avatar'] = $imageName;
        }

        $this->model::create($data);

        $data['nameItem'] = $this->nameItem;
        toast('Thêm ' . $this->nameItem . ' thành công', 'success');

        if ($request->has('return_back')) {
            return back();
        } elseif ($request->has('return_list')) {
            return $this->route_admin('index');
        }
    }

    public function edit($uuid,$currentPage)
    {
        $page = $this->model::where('uuid', $uuid);

        if ($page->exists()) {
            $data['page'] = $page->first();

            // Lấy chủ đề
            $data['category'] = $this->model
                ::where('status', 1)
                ->where('parent_id', 0)
                ->orderBy('name_vn', 'asc')
                ->get();
            $data['action'] = 'edit';
            $data['nameItem'] = $this->nameItem;

            // Lưu lại trang hiện tại vào tham số trong URL
            $data['currentPage'] = $currentPage ;
            return $this->view_admin('detail', $data);
        } else {
            toast('Không tìm thấy ' . $this->nameItem, 'error');
            return back();
        }
    }

    public function update(CateProductRequest $request, string $uuid)
    {
        $current = $this->model::where('uuid', $uuid)->first();

        $data = $request->except('_token','return_back','return_list','currentPage');
        $data['updated_at'] = new \DateTime();
        $data['slug'] = Str::slug($request->input('name_vn'));

        $this->model::where('uuid', $uuid)->update($data);

        toast('Cập nhật ' . $this->nameItem . ' thành công', 'success');

        $currentPage = $request->input('currentPage');
        return $this->route_admin('index', [], [], $currentPage);
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
