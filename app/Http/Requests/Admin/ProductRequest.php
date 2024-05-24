<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            //Tiêu đề
            'name_vn' => request()->route('uuid')
            ? 'required|unique:tp_product,name_vn,' . request()->route('uuid') . ',uuid|max:255'
            : 'required|unique:tp_product|max:255',

            // Giới thiệu
            'intro_vn' => 'required|max:65535',
            // Nội dung
            'content_vn'=> 'required',

            'meta_keywords' => 'required',
            'meta_description' => 'required',
            'price' => 'required',
            'category_id' => 'required|not_in:0',

            'avatar' => request()->route('uuid')
            ? 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            : 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name_vn.required' => 'Vui lòng nhập tiêu đề tiếng việt',
            'name_vn.unique' => 'Tiêu đề tiếng việt này đã tồn tại',
            'name_vn.max' => 'Tiêu đề tiếng việt này đã tồn tại',

            'intro_vn.required' => 'Vui lòng nhập giới thiệu tiếng việt',
            'intro_vn.max' => 'Giới thiệu không được vượt quá 65535 ký tự.',

            'content_vn.required' => 'Vui lòng nhập nội dung tiếng việt',
            'content_vn.unique' => 'Nội dung tiếng việt này đã tồn tại',

            'meta_keywords.required' => 'Vui lòng nhập từ khóa để Seo bài biết',
            'meta_description.required' => 'Vui lòng nhập mô tả để Seo bài biết',

            'category_id.required' => 'Vui lòng chọn chủ đề bài viết',

            'avatar.required' => 'Vui lòng nhập hình ảnh bài viết',

            'price.required' => 'Vui lòng nhập giá tiền sản phẩm',
        ];
    }
}
