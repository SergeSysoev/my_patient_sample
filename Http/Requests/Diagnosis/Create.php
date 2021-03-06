<?php

namespace App\Http\Requests\Diagnosis;

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
            'value' => 'required',
            'type_id' => 'required|exists:diagnosis_types,id',
            'patient_id' => 'required|exists:patients,id',
        ];
    }
}
