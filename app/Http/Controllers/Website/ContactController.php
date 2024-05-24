<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Http\Requests\Website\ContactRequest;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
class ContactController extends Controller
{
    public function contact(){
        return view('website.modules.contact.index');
    }

    public function postContact(ContactRequest $request){
        $data = $request->except('_token');
        $data['uuid'] = Str::uuid();
        $data['created_at'] = new \DateTime();

        Contact::create($data);
        Alert::success('Đã gửi yêu cầu thành công', 'Chúng tôi sẽ liên hệ sớm nhất có thể');
        return back();
     
    }
    public function postSubscribe(Request $request){
        $data = $request->except('_token');
        $data['uuid'] = Str::uuid();
        $data['created_at'] = new \DateTime();

        DB::table('tp_subscribe')->insert($data);
        Alert::success('Đã đăng ký nhận thông báo thành công', 'Chúng tôi sẽ liên hệ sớm nhất có thể');
        return back();
    }
}
