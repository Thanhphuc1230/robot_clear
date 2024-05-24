<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class SliderRequest extends FormRequest
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
            'name_vn' => request()->route('uuid') ? 'required|unique:tp_slider,name_vn,' . request()->route('uuid') . ',uuid' : 'required|unique:tp_slider',
            'stt' => request()->route('uuid') ? 'required:tp_slider,stt,' . request()->route('uuid') . ',uuid' : 'required:tp_slider',
            'avatar' => request()->route('uuid') ? 'nullable|unique:tp_slider,avatar,' . request()->route('uuid') . ',uuid' : 'required',
        ];
    }

    public function messages()
    {
        return [
            'name_vn.required' => 'Vui lòng nhập tên của slider',
            'name_vn.unique' => 'Slider này đã tồn tại',

            'stt.required' => 'Vui lòng nhập số thứ tự của slider',

            'avatar.required' => 'Vui lòng nhập hình ảnh slider',
        ];
    }
}
