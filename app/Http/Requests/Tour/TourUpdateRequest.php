<?php

namespace App\Http\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;

class TourUpdateRequest extends FormRequest
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
            'name' => 'required|min:10|max:255',
            'address' => 'required|max:255',
            'thumbnail' => 'mimes:png,jpg,jpeg|max:5000',
            'banner' => 'mimes:png,jpg,jpeg|max:5000',
            'slide.*' => 'mimes:png,jpg,jpeg|max:5000',
            'adult_price' => 'required|numeric|min:0|max:20000000',
            'child_price' => 'required|numeric|min:0|max:20000000',
            'category_id' => 'required|numeric',
            'description' => 'required',
            'note' => 'required',
            'schedule.*' => 'required',
            'batches.*' => 'required|date|after:now',
        ];
    }
}
