<?php

namespace App\Http\Requests\Tour;

use Illuminate\Foundation\Http\FormRequest;

class TourCreateRequest extends FormRequest
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
            'tour_name' => 'required|min:10|max:255',
            'tour_address' => 'required|min:10|max:255',
            'thumbnail' => 'required|mimes:jpeg,bmp,png,gif|max:5000',
            'banner' => 'required|mimes:jpeg,bmp,png,gif|max:5000',
            'slide.*' => 'mimes:jpeg,bmp,png,gif|max:5000',
            'price_adult' => 'required|numeric|min:0|max:20000000',
            'price_child' => 'required|numeric|min:0|max:20000000',
            'tour_category' => 'required|numeric',
            'tour_description' => 'required',
            'tour_note' => 'required',
            'schedule.*' => 'required',
            'batches.*' => 'required|date|after:now',
        ];
    }
}
