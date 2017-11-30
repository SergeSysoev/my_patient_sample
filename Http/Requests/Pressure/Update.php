<?php

namespace App\Http\Requests\Pressure;

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
            'low' => 'integer',
            'high' => 'integer',
            'date' => 'date',
            'patient_id' => 'integer|exists:patients,id'
        ];
    }
}