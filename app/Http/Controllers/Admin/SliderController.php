<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
class SliderController extends BaseController
{
    protected $model;
    private $nameItem;

    public function __construct()
    {
        parent::__construct('slider');
        // Set your model class here
        $this->model = new Slider();
        $this->nameItem = 'Slider';

        View::share('nameClass', 'slider');
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
        $data['action'] = 'create';
        $data['nameItem'] = $this->nameItem;
        return $this->view_admin('detail', $data);
    }

    public function store(SliderRequest $request)
    {
        $data = $request->except('_token', 'return_back', 'return_list');
        $data['uuid'] = Str::uuid();
        $data['created_at'] = new \DateTime();

        //avatar
        $image = $request->avatar;
        if ($image) {
            $imageName = time() . '-' . $image->getClientOriginalName();

            $image->move(public_path('images/slider'), $imageName);
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
            $data['action'] = 'edit';
            $data['nameItem'] = $this->nameItem;
            return $this->view_admin('detail', $data);
        } else {
            toast('Không tìm thấy ' . $this->nameItem, 'error');
            return back();
        }
    }

    public function update(SliderRequest $request, string $uuid)
    {
        $current = $this->model::where('uuid', $uuid)->first();

        $data = $request->except('_token', 'return_back', 'return_list');
        $data['updated_at'] = new \DateTime();

        if ($request->hasFile('avatar')) {
            if ($request->hasFile('avatar')) {
                $image_path = public_path('images/slider') . '/' . $current->avatar;
                $imageName = time() . '-' . $request->avatar->getClientOriginalName();

                $request->avatar->move(public_path('images/slider'), $imageName);

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
}
