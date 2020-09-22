<?php

namespace App\Http\Requests\Article;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticle extends FormRequest
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
            'title' => 'required|min:5|max:60|string',
            'heading' => 'required|min:5|string',
            'content' => 'required',
            'image' => 'required|mimes:jpeg,bmp,png,jpg,gif,svg|max:2000'
        ];
    }
}
