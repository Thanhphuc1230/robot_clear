<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CateNewRequest;
use App\Models\CateNew;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
class CateNewController extends BaseController
{
    protected $model;
    protected $nameItem;

    public function __construct()
    {
        parent::__construct('category_new');
        // Set your model class here
        $this->model = new CateNew();
        $this->nameItem = 'Chủ đề tin tức';

        View::share('nameClass', 'category_new');
    }
    public function index(Request $request)
    {
        $query = $this->model::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name_vn', 'LIKE', "%{$searchTerm}%")->orWhere('status', '=', $searchTerm === 'active' ? 1 : 0);
            });
        }
        // Kiểm tra nếu đã chọn chủ đề
        if ($request->has('category') && $request->input('category') != 0) {
            $categoryId = $request->input('category');
            $query->where(function ($q) use ($categoryId) {
                $q->where('parent_id', $categoryId)
                  ->orWhere('id_category_new', $categoryId);
            });
        }

        $data['list'] = $query->paginate(10);
        $data['nameItem'] = $this->nameItem;

        $data['category'] = $this->model
            ::with([
                'children' => function ($query) {
                    $query->select('id_category_new', 'name_vn', 'parent_id'); // Chỉ chọn các cột id_category_new và name_vn
                },
            ])
            ->where('status', 1)
            ->where('parent_id', 0)
            ->get(); //Lấy chủ đề cha
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
        $data['category'] = $this->model
            ::with([
                'children' => function ($query) {
                    $query->select('id_category_new', 'name_vn', 'parent_id'); // Chỉ chọn các cột id_category_new và name_vn
                },
            ])
            ->where('status', 1)
            ->where('parent_id', 0)
            ->get(); //Lấy chủ đề cha
        $data['action'] = 'create';
        $data['nameItem'] = $this->nameItem;
        return $this->view_admin('detail', $data);
    }

    public function store(CateNewRequest $request)
    {
        $data = $request->except('_token', 'return_back', 'return_list');
        $data['uuid'] = Str::uuid();
        $data['created_at'] = new \DateTime();

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
        $detail = $this->model::where('uuid', $uuid);

        if ($detail->exists()) {
            $data['detail'] = $detail->first();
            $data['category'] = $this->model
                ::with([
                    'children' => function ($query) {
                        $query->select('id_category_new', 'name_vn', 'parent_id'); // Chỉ chọn các cột id_category_new và name_vn
                    },
                ])
                ->where('status', 1)
                ->where('parent_id', 0)
                ->get(); //Lấy chủ đề cha
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

    public function update(CateNewRequest $request, string $uuid)
    {
        $current = $this->model::where('uuid', $uuid)->first();

        $data = $request->except('_token', 'return_back', 'return_list','currentPage');
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

    public function destroyAll(Request $request)
    {
        // Lấy danh sách các UUID của các mục được chọn từ request
        $uuids = $request->input('uuids');

        // Kiểm tra nếu không có UUID nào được gửi lên
        if (empty($uuids)) {
            toast('Không có mục nào được chọn để xóa.', 'error');
            return redirect()->back();
        }

        // Xóa tất cả các mục có UUID nằm trong danh sách
        $deletedCount = $this->model::whereIn('uuid', $uuids)->delete();

        // Kiểm tra xem có mục nào được xóa thành công không
        if ($deletedCount > 0) {
            toast('Xóa ' . $deletedCount . ' mục thành công.', 'success');
        } else {
            toast('Không có mục nào được xóa.', 'error');
        }

        return redirect()->back();
    }
}
