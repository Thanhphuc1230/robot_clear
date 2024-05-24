<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
class UserController extends BaseController
{
    protected $model;
    private $nameItem;

    public function __construct()
    {
        parent::__construct('users');
        // Set your model class here
        $this->model = new User();
        $this->nameItem = 'Thành viên';

        View::share('nameClass', 'users');
    }
    public function index(Request $request)
    {
        $query = $this->model::query();

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('fullname', 'LIKE', "%{$searchTerm}%")
                ->orWhere('email','LIKE', "%{$searchTerm}%")
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
        $data['action'] = 'create';
        $data['nameItem'] = $this->nameItem;
        return $this->view_admin('detail', $data);
    }

    public function store(UserRequest $request)
    {
        $data = $request->except('_token', 'password_confirmation', 'return_back', 'return_list');
        $data['password'] = Hash::make($request->password);
        $data['uuid'] = Str::uuid();
        $data['created_at'] = new \DateTime();
        $data['email_verified_at'] = new \DateTime();
        //avatar
        $image = $request->avatar;
        if ($image) {
            $imageName = time() . '-' . $image->getClientOriginalName();

            $image->move(public_path('images/users'), $imageName);
            $data['avatar'] = $imageName;
        }

        $this->model::create($data);
        toast('Thêm ' . $this->nameItem . ' thành công', 'success');
        return $this->route_admin('index');
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

    public function update(UserRequest $request, string $uuid)
    {
        $current = $this->model::where('uuid', $uuid)->first();
        // Kiểm tra xem mật khẩu cũ nhập vào có khớp với mật khẩu hiện tại không
        if(!empty($request->old_password)){
            if (!Hash::check($request->old_password, $current->password)) {
                return redirect()->back()->withErrors(['old_password' => 'Mật khẩu cũ không chính xác']);
            }
        }
        $data = $request->except('_token', 'password_confirmation','old_password', 'return_back', 'return_list');
        $data['updated_at'] = new \DateTime();
        
        // Xử lý password
        if (empty($request->password)) {
            $data['password'] = $current->password;
        }else{
            $data['password'] = Hash::make($request->password);
        }
        if ($request->hasFile('avatar')) {
            if ($request->hasFile('avatar')) {
                $image_path = public_path('images/users') . '/' . $current->avatar;
                $imageName = time() . '-' . $request->avatar->getClientOriginalName();

                $request->avatar->move(public_path('images/users'), $imageName);

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