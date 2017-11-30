<?php

namespace App\Http\Requests\Address;

use Illuminate\Foundation\Http\FormRequest;

class Create extends FormRequest
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
            'street' => 'required|max:255',
            'house' => 'required|max:255',
            'building' => 'max:255',
            'apartment' => 'max:255',
            'city_id' => 'required|integer|exists:cities,id'
        ];
    }
}
