<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index(){
      
        return view('admin.modules.profile.index');
    }
    public function update($uuid,Request $request){
        $data = $request->except('_token');
        $data['updated_at'] = new \DateTime();
        $admin = User::where('uuid',Auth::user()->uuid)->first();

        //avatar
        if ($request->hasFile('avatar')) {
            $image_path = public_path('images/users') . '/' . $admin->avatar;
            $imageName = time() . '-' . $request->avatar->getClientOriginalName();
    
            $request->avatar->move(public_path('images/users'), $imageName);
          
            $data['avatar'] = $imageName;
    
            if ($admin->avatar && file_exists($image_path)) {
                unlink($image_path);
            }
        } else {
            $data['avatar'] = $admin->avatar;
        }
     
        if ($admin) {
            $admin->update($data);
            toast('Cập nhật thông tin thành công ', 'success');
        } else {
            toast('admin not found', 'error');
        }
        return back();
    }

    public function changePassword(Request $request)
    {
        $user = Auth::user();
        // Kiểm tra mật khẩu cũ
        if (!Hash::check($request->old_password, $user->password)) {
            return back()->with('error', 'Mật khẩu cũ không đúng');
        }
   
        // Kiểm tra mật khẩu mới và mật khẩu xác nhận
        if ($request->new_password !== $request->confirm_password) {
            return back()->with('error', 'Mật khẩu mới và xác thực mật khẩu không giống nhau');
        }

        // Cập nhật mật khẩu mới
        $user->password = Hash::make($request->new_password);

        if ($user->save()) {
            toast('Đổi mật khẩu thành công', 'success');
        } else {
            toast('Đổi mật khẩu không thành công', 'error');
        }
        return back();
    }
}
