<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CateNewRequest extends FormRequest
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
            'name_vn' => request()->route('uuid') ? 'required|unique:tp_category_new,name_vn,' . request()->route('uuid') . ',uuid|max:255' : 'required|unique:tp_category_new|max:255', // Thêm quy tắc max với giá trị là 255
            'slug' => request()->route('uuid') ? 'required|unique:tp_category_new,slug,' . request()->route('uuid') . ',uuid' : 'required|unique:tp_category_new',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_vn.required' => 'Vui lòng nhập chủ đề sản phẩm',
            'name_vn.unique' => 'Chủ đề sản phẩm này đã tồn tại',
            'name_vn.max' => 'Tên chủ đề không được quá 255 ký tự', // Thông báo khi vượt quá 255 ký tự
            'slug.required' => 'Vui lòng nhập slug tin tức ',
            'slug.unique' => 'Slug tin tức này đã tồn tại',
            'meta_keywords.required' => 'Vui lòng nhập meta keywords',
            'meta_description.required' => 'Vui lòng nhập meta keywords description',
        ];
    }
}
