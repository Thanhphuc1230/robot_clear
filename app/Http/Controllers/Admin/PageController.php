<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PageRequest;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
class PageController extends BaseController
{
    protected $model;
    private $nameItem;

    public function __construct()
    {
        parent::__construct('page');
        // Set your model class here
        $this->model = new Page();
        $this->nameItem = 'Trang nội dung';

        View::share('nameClass', 'page');
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
        $data['page_content'] = $this->model
            ::where('status', 1)
            ->where('parent_id', 0)
            ->get();
        $data['action'] = 'create';
        $data['nameItem'] = $this->nameItem;
        return $this->view_admin('detail', $data);
    }

    public function store(PageRequest $request)
    {
        $data = $request->except('_token', 'return_back', 'return_list');
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
            $data['page_content'] = $this->model
                ::where('status', 1)
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

    public function update(PageRequest $request, string $uuid)
    {
        $current = $this->model::where('uuid', $uuid)->first();

        $data = $request->except('_token', 'return_back', 'return_list');
        $data['updated_at'] = new \DateTime();
        $data['slug'] = Str::slug($request->input('name_vn'));

        if ($request->hasFile('avatar')) {
            if ($request->hasFile('avatar')) {
                $image_path = public_path('images/page') . '/' . $current->avatar;
                $imageName = time() . '-' . $request->avatar->getClientOriginalName();

                $request->avatar->move(public_path('images/page'), $imageName);

                $data['avatar'] = $imageName;

                if ($current->avatar && file_exists($image_path)) {
                    unlink($image_path);
                }
            } else {
                $data['avatar'] = $current->avatar;
            }
        }

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

    public function destroyAll(Request $request){
        $uuids = $request->input('uuids');

        foreach($uuids as $uuid) {
            $page = $this->model::where('uuid', $uuid)->first();
            $page->delete();
        }

        toast('Xóa các sản phẩm  thành công.', 'success');
            return back();
    }
}
