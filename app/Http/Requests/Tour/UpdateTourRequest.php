<?php

namespace App\Http\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTourRequest extends FormRequest
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
            'name' => 'required|string|min:20|max:255',
            'slug' => [
                'nullable',
                'unique:tours',
                'min:10',
                'max:255',
                'regex:'.REGEX_SLUG
            ],
            'address' => 'required|string|min:10|max:255',
            'description' => 'required|string|min:100',
            'thumbnail' => 'required|mimes:jpeg,jpg,png',
            'banner' => 'required|mimes:jpeg,jpg,png',
            'content' => 'required|string|min:100',
            'adult_price' => 'integer|min:1000|gte:child_price',
            'child_price' => 'integer|min:1000',
            'google_map' => 'nullable|json',
            'publish' => 'nullable|boolean',
            'category_id' => 'required|exists:categories,id'
        ];
    }
}
