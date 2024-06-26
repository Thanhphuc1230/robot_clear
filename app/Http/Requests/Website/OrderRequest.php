<?php

namespace App\Http\Requests\Website;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
            'fullname_order' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'checkout_payment_method' => 'required',

        ];
    }
    public function messages()
    {
        return [
            'fullname_order.required' => 'Vui lòng nhập Họ và tên người nhận ',
            'address.required' => 'Vui lòng nhập địa chỉ người nhận ',
            'phone.required' => 'Vui lòng nhập số điện thoại người nhận ',
            'email.required' => 'Vui lòng nhập Email người nhận ',
            'checkout_payment_method.required' => 'Vui lòng chọn phương thức thanh toán ',
        ];
    }
}
