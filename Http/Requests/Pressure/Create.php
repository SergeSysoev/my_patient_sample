<?php

namespace App\Http\Requests\Pressure;

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
            'low' => 'required|integer',
            'high' => 'required|integer',
            'date' => 'required|date',
            'patient_id' => 'required|integer|exists:patients,id'
        ];
    }
}
