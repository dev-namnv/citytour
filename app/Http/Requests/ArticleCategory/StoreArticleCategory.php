<?php

namespace App\Http\Requests\ArticleCategory;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleCategory extends FormRequest
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
            'name' => 'required|string|min:5|unique:article_categories,name',
            'active' => 'required'
        ];
    }
}
