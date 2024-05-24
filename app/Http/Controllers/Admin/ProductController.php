<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProductRequest;
use App\Models\CateProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\View;
class ProductController extends BaseController
{
    protected $model;
    private $nameItem;

    public function __construct()
    {
        parent::__construct('product');
        // Set your model class here
        $this->model = new Product();
        $this->nameItem = 'Sản phẩm';

        View::share('nameClass', 'product');
    }
    public function index(Request $request)
    {
        $query = $this->model::with('cate');

        // Filter by search term
        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name_vn', 'LIKE', "%{$searchTerm}%")->orWhereHas('cate', function ($q) use ($searchTerm) {
                    $q->where('name_vn', 'LIKE', "%{$searchTerm}%");
                });
            });
        }

        // Filter by category
        if ($request->has('category') && $request->input('category') != 0) {
            $id_category = $request->input('category');
            // Get all child categories recursively
            $categoryChild = $this->getAllChildCategories($id_category);
            $query->whereIn('category_id', $categoryChild);
        }

        // Paginate the results
        $data['list'] = $query->orderBy('category_id', 'asc')->has('cate')->paginate(10)->appends($request->query());

        // Get all categories for option search
        $data['category'] = CateProduct::with([
            'children' => function ($query) {
                $query->select('id_category_product', 'name_vn', 'parent_id');
            },
        ])
            ->where('status', 1)
            ->where('parent_id', 0)
            ->get();
        $data['nameItem'] = $this->nameItem;

        return $this->view_admin('list', $data);
    }
    private function getAllChildCategories($category_id)
    {
        $categoryChild = [$category_id];
        $childCategories = CateProduct::where('parent_id', $category_id)->pluck('id_category_product')->toArray();
        foreach ($childCategories as $childCategory) {
            $categoryChild = array_merge($categoryChild, $this->getAllChildCategories($childCategory));
        }
        return $categoryChild;
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
        // Lấy chủ đề bài viết
        $data['category'] = CateProduct::with([
            'children' => function ($query) {
                $query->select('id_category_product', 'name_vn', 'parent_id');
            },
        ])
            ->where('status', 1)
            ->where('parent_id', 0)
            ->get();
        $data['action'] = 'create';
        $data['nameItem'] = $this->nameItem;
        return $this->view_admin('detail', $data);
    }

    public function store(ProductRequest $request)
    {
        $data = $request->except('_token', 'return_back', 'return_list');
        $data['uuid'] = Str::uuid();
        $data['created_at'] = new \DateTime();
        $data['slug'] = Str::slug($request->input('name_vn'));

        //avatar
        $image = $request->avatar;
        if ($image) {
            $imageName = time() . '-' . $image->getClientOriginalName();

            $image->move(public_path('images/products'), $imageName);
            $data['avatar'] = $imageName;
        }

        // detail image

        $files = [];
        if ($request->hasFile('image_detail')) {
            foreach ($request->file('image_detail') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('images/products/'), $name);
                $files[] = $name;
            }
        }

        $data['image_detail'] = json_encode($files);

        $this->model::create($data);
        toast('Thêm ' . $this->nameItem . ' thành công', 'success');
        if ($request->has('return_back')) {
            return back();
        } elseif ($request->has('return_list')) {
            return $this->route_admin('index');
        }
    }

    public function edit($uuid)
    {
        $page = $this->model::where('uuid', $uuid);

        if ($page->exists()) {
            $data['page'] = $page->first();
            $data['category'] = CateProduct::with([
                'children' => function ($query) {
                    $query->select('id_category_product', 'name_vn', 'parent_id');
                },
            ])
                ->where('status', 1)
                ->where('parent_id', 0)
                ->get();

            $data['action'] = 'edit';
            $data['nameItem'] = $this->nameItem;
            return $this->view_admin('detail', $data);
        } else {
            toast('Không tìm thấy ' . $this->nameItem, 'error');
            return back();
        }
    }

    public function update(ProductRequest $request, string $uuid)
    {
        $current = $this->model::where('uuid', $uuid)->first();

        $data = $request->except('_token', 'return_back', 'return_list');
        $data['updated_at'] = new \DateTime();
        $data['slug'] = Str::slug($request->input('name_vn'));

        if ($request->hasFile('avatar')) {
            $image_path = public_path('images/products') . '/' . $current->avatar;
            $imageName = time() . '-' . $request->avatar->getClientOriginalName();

            $request->avatar->move(public_path('images/products'), $imageName);

            $data['avatar'] = $imageName;

            if ($current->avatar && file_exists($image_path)) {
                unlink($image_path);
            }
        } else {
            $data['avatar'] = $current->avatar;
        }

        // Xử lý hình ảnh chi tiết
        $files = [];
        $files_remove = [];
        if ($request->hasfile('image_detail')) {
            foreach ($request->file('image_detail') as $file) {
                $name = time() . rand(1, 100) . '.' . $file->extension();
                $file->move(public_path('images/products/'), $name);
                $files[] = $name;
            }
        }

        if (isset($data['images_uploaded'])) {
            $files_remove = array_diff(json_decode($data['images_uploaded_origin']), $data['images_uploaded']);
            $files = array_merge($data['images_uploaded'], $files);
        } else {
            $files_remove = json_decode($data['images_uploaded_origin']);
        }

        $current->image_detail = $files;
        if ($current->update()) {
            foreach ($files_remove as $file_name) {
                File::delete(public_path('images/products/' . $file_name));
            }
        }
        //luu y phan nay
        $data['image_detail'] = $files;

        unset($data['images_uploaded']);
        unset($data['images_uploaded_origin']);

        $this->model::where('uuid', $uuid)->update($data);

        toast('Cập nhật ' . $this->nameItem . ' thành công', 'success');

        return $this->route_admin('index');
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
