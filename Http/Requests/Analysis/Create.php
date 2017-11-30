<?php

namespace App\Http\Requests\Analysis;

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
            'result' => 'required',
            'file' => 'required',
            'type_id' => 'required|exists:analysis_types,id',
            'patient_id' => 'required|exists:patients,id',
        ];
    }
}
