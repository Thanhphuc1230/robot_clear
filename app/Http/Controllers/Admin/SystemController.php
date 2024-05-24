<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function index(){
        $data['system'] = System::first();
        return view('admin.modules.system.index',$data);
    }

    public function update($id,Request $request){
        $data = $request->except('_token');
        $data['created_at'] = new \DateTime();
        $system = System::find($id);

        //Logo
        if ($request->hasFile('logo')) {
            $image_path = public_path('images/logo') . '/' . $system->logo;
            $imageName = time() . '-' . $request->logo->getClientOriginalName();
    
            $request->logo->move(public_path('images/logo'), $imageName);
          
            $data['logo'] = $imageName;
    
            if ($system->logo && file_exists($image_path)) {
                unlink($image_path);
            }
        } else {
            $data['logo'] = $system->logo;
        }
        //Favicon
        if ($request->hasFile('favicon')) {
            $image_path_favicon = public_path('images/logo') . '/' . $system->favicon;
            $imageNameFavicon = time() . '-' . $request->favicon->getClientOriginalName();
    
            $request->favicon->move(public_path('images/logo'), $imageNameFavicon);
          
            $data['favicon'] = $imageNameFavicon;
    
            if ($system->favicon && file_exists($image_path_favicon)) {
                unlink($image_path_favicon);
            }
        } else {
            $data['favicon'] = $system->favicon;
        }
        if ($system) {
            $system->update($data);
            toast('Cập nhật hệ thống thành công', 'success');
        } else {
            toast('System not found', 'error');
        }
        return back();
    }
}
