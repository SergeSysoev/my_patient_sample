<?php

namespace App\Http\Requests\Department;

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
//
//    public function messages()
//    {
//        return [
//            'name' => 'The :attribute field is required.',
//        ];
//    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'chief_id' => 'required|integer|exists:users,id',
        ];
    }
}
