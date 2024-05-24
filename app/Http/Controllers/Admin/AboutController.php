<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index(){
        $data['about'] = About::first();
        return view('admin.modules.about.index',$data);
    }

    public function update($id,Request $request){
        $data = $request->except('_token');
        $data['created_at'] = new \DateTime();
        $system = About::find($id);

        //avatar
        if ($request->hasFile('avatar')) {
            $image_path = public_path('images/about') . '/' . $system->avatar;
            $imageName = time() . '-' . $request->avatar->getClientOriginalName();
    
            $request->avatar->move(public_path('images/about'), $imageName);
          
            $data['avatar'] = $imageName;
    
            if ($system->avatar && file_exists($image_path)) {
                unlink($image_path);
            }
        } else {
            $data['avatar'] = $system->avatar;
        }
       
        if ($system) {
            $system->update($data);
            toast('Cập nhật thông tin thành công', 'success');
        } else {
            toast('System not found', 'error');
        }
        return back();
    }
}
