<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
            'fullname' => 'required',
            'email'    => 'required',
            'content' => 'required',
            'subject' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'fullname.required' => 'Vui lòng nhập Họ và tên ',
            'email.required' => 'Vui lòng nhập email',
            'content.required' => 'Vui lòng nhập nội dung ',
            'subject.required' => 'Vui lòng nhập tiêu đề ',
        ];
    }
}
