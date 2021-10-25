<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostStoreRequest extends FormRequest
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
            'user_id' => 'required',
            'category_id' => 'required',
            'heading' => 'required',
            'text' => 'required',
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'zipcode' => 'required',
            'city_id' => 'required',
            'region_id' => 'required',
            'is_individual' => 'required',
            'price' => 'required',
            'terms' => 'required'
        ];
    }
}
