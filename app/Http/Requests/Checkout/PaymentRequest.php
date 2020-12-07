<?php

namespace App\Http\Requests\Checkout;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PaymentRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'tour_id' => [
                'required',
                Rule::exists('tours', 'id'),
            ],
            'customer_name' => 'required|string',
            'customer_phone' => 'required|min:9',
            'customer_email' => 'required|email',
            'customer_email_confirm' => 'required|email|same:customer_email',
            'customer_address' => 'required|min:20',
            'country' => 'required|string|min:2',
            'state' => 'required',
            'zipcode' => 'required|integer',
            'batch' => 'required|date|after:tomorrow',
            'adult_count' => 'required|integer|min:1|max:10',
            'child_count' => 'nullable|integer|min:0|max:10',
            'city' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'tour_id' => 'ID Tour',
            'customer_name' => 'tên',
            'customer_phone' => 'số điện thoại',
            'customer_email' => 'địa chỉ email',
            'customer_email_confirm' => 'xác thực email',
            'customer_address' => 'địa chỉ',
            'state' => 'quận/huyện',
            'batch' => 'ngày khởi hành',
            'adult_count' => 'người lớn',
            'child_count' => 'trẻ em',
            'policy_terms' => 'chính sách bảo mật'
        ];
    }
}
