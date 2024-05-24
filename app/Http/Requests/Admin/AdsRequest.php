<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AdsRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name_vn' => request()->route('uuid') ? 'required|unique:tp_ads,name_vn,' . request()->route('uuid') . ',uuid' : 'required|unique:tp_ads',
            'link' => 'required',
            'avatar' => request()->route('uuid') ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048' : 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'stt' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_vn.required' => 'Vui lòng nhập tên đối tác ',
            'name_vn.unique' => 'Chủ đề sản phẩm này đã tồn tại',

            'avatar.required' => 'Vui lòng nhập hình ảnh đối tác',

            'stt.required' => 'Vui lòng nhập số thứ tự ',
            'link.required' => 'Vui lòng nhập đường dẫn của quảng cáo',
        ];
    }
}
