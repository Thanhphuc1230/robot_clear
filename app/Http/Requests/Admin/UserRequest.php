<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'fullname' => 'required|max:255',
            
            'email' => request()->route('uuid')
                ? 'required|unique:users,email,' . request()->route('uuid') . ',uuid'
                : 'required|unique:users',

            'password' => request()->route('uuid') 
            ? 'confirmed' 
            : 'required|confirmed|min:8|regex:/^(?=.*[a-zA-Z])(?=.*\d).+$/',
        
        ];
    }
    public function messages()
    {
        return [
            'fullname.required' => 'Vui lòng nhập Họ và tên ',
            'name_vn.max' => 'Tiêu đề không nhập quá 255 ký tự',
            'email.required' => 'Vui lòng nhập email',
            'email.unique' => 'Email này đã tồn tại rồi',
            'email.email' => 'Đây không phải là email',

            'password.required' => 'Vui lòng nhập mật khẩu',
            'password.confirmed' => 'Mật khẩu xác nhận không chính xác',
            'password.min'  => 'Mật khẩu ít nhất 8 ký tự',
            'password.regex' => 'Mật khẩu phải có cả chữ và số',

        ];
    }
}
