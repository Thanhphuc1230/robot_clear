<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\MenuRequest;
use App\Models\CateNew;
use App\Models\CateProduct;
use App\Models\Menu;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
class MenuController extends BaseController
{
    protected $model;
    private $nameItem;

    public function __construct()
    {
        parent::__construct('menu');
        // Set your model class here
        $this->model = new Menu();
        $this->nameItem = 'Trang Menu';

        View::share('nameClass', 'menu');
    }

    public function status($uuid, $status, $name)
    {
        $this->model::where('uuid', $uuid)->update([$name => $status]);

        $mess = $status == 1 ? 'Kích hoặt' : 'Tắt';

        toast($mess . ' ' . $this->nameItem . ' thành công', 'success');
        return redirect()->back();
    }
    public function index()
    {
        //get page content
        $data['pageContent'] = Page::where('status', 1)->orderBy('stt', 'asc')->get();

        //get category new
        $data['category_new'] = CateNew::with([
            'children' => function ($query) {
                $query->select('id_category_new', 'name_vn', 'parent_id', 'uuid');
            },
        ])
            ->where('status', 1)
            ->where('parent_id', 0)
            ->orderBy('stt', 'asc')
            ->get();

        //get category product
        $data['category_product'] = CateProduct::with([
            'children' => function ($query) {
                $query->select('id_category_product', 'name_vn', 'parent_id', 'uuid');
            },
        ])
            ->where('status', 1)
            ->where('parent_id', 0)
            ->orderBy('stt', 'asc')
            ->get();

        $data['menus'] = Menu::with([
            'children' => function ($query) {
                $query->select('id_menu', 'name_vn', 'parent_id', 'uuid');
            },
        ])
            ->where('status', 1)
            ->where('parent_id', 0)
            ->orderBy('stt', 'asc')
            ->get();
        $data['action'] = 'create';
        $data['nameItem'] = $this->nameItem;

        return $this->view_admin('detail', $data);
    }

    public function store(Request $request)
    {
        $objectIds = $request->input('object_ids', []);
        if (empty($objectIds)) {
            $objectIds[0] = 0;
        }
        if ($objectIds) {
            foreach ($objectIds as $objectId) {
                $nameSlug = $this->getNameVn($request->type, $objectId);
                if ($nameSlug == NULL) {
                    return back()->with('error', 'Vui lòng chọn chính xác chủ đề và vị trí');
                }
                $data = [
                    'name_vn' => $nameSlug['name_vn'] ?? $request->name_vn,
                    'slug' => $nameSlug['slug'] ?? Str::slug($request->name_vn),
                    'object_id' => $objectId,
                    'parent_id' => $request->parent_id,
                    'stt' => $request->parent_id == 0 ? Menu::max('stt') + 1 : 1,
                    'uuid' => Str::uuid(),
                    'created_at' => now(),
                    'link' => $request->link ?? null,
                    'type' => $request->type,
                ];

                $this->model::create($data);
            }

            toast('Thêm ' . $this->nameItem . ' thành công', 'success');
        } else {
            toast('Không thêm ' . $this->nameItem . ' thành công', 'error');
        }

        return $this->route_admin('index');
    }

    private function getNameVn($type, $id)
    {
        switch ($type) {
            case 'page':
                $page = Page::find($id);
                return $page ? ['name_vn' => $page->name_vn, 'slug' => Str::slug($page->name_vn)] : null;
            case 'cate_new':
                $cateNew = CateNew::find($id);
                return $cateNew ? ['name_vn' => $cateNew->name_vn, 'slug' => Str::slug($cateNew->name_vn)] : null;
            case 'cate_product':
                $cateProduct = CateProduct::find($id);
                return $cateProduct ? ['name_vn' => $cateProduct->name_vn, 'slug' => Str::slug($cateProduct->name_vn)] : null;
            default:
                return back()->with('error', 'Vui lòng chọn chính xác chủ đề và vị trí');
        }
    }

    public function update(Request $request, string $uuid)
    {
        $data = $request->except('_token');
        $data['updated_at'] = new \DateTime();

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
            toast('Xoá menu thành công', 'success');
            return back();
        } else {
            $page->delete();
            toast('Không tìm thấy ' . $this->nameItem, 'error');
            return back();
        }
    }
}
