<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

class Update extends FormRequest
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
            'first_name' => 'max:255',
            'middle_name' => 'max:255',
            'last_name' => 'max:255',
            'sex' => 'integer|max:1',
            'birth_date' => 'max:25',
            'phone' => 'required|max:12',
            'med_history_number' => 'max:255',
            'chamber_id' => 'integer|exists:chambers,id',
        ];
    }
}
