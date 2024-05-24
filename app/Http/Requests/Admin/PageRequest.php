<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PageRequest extends FormRequest
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
            'name_vn' => request()->route('uuid')
            ? 'required|unique:tp_page,name_vn,' . request()->route('uuid') . ',uuid|max:255'
            : 'required|unique:tp_page|max:255',
            'content_vn' => 'required',
            'meta_keywords' => 'required',
            'meta_description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_vn.required' => 'Vui lòng nhập tiêu đề bài viết',
            'name_vn.unique' => 'Tiêu đề bài viết này đã tồn tại',
            'name_vn.max' => 'Tiêu đề không nhập quá 255 ký tự',
            'content_vn.required' => 'Vui lòng nhập nội dung bài viết',
            'meta_keywords.required' => 'Vui lòng nhập từ khóa cho bài viết',
            'meta_description.required' => 'Vui lòng nhập mô tả bài viết',
        ];
    }
}
