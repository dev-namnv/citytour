<?php

namespace App\Http\Requests\Contacts;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class SendContactRequest extends FormRequest
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
    public function rules(Request $request)
    {
        if (key_exists('reply_for',$request->all())) {
            return [
                'reply_for' => 'required',
                'name' => 'required|max:100',
                'email' => 'required|email|max:100',
                'subject' => 'required|min:10|max:100',
                'messages' => 'required|min:20',
            ];
        } else {
            return [
                'firstName' => 'required|max:100',
                'lastName' => 'required|max:100',
                'email' => 'required|email|max:100',
                'subject' => 'required|min:10|max:100',
                'phone' => 'required|regex:/^0([0-9]{9})$/',
                'messages' => 'required|min:20'
            ];
        }
    }
}
