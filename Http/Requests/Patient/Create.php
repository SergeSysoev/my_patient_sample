<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Requests\Address\Create as AddressRequest;
use Illuminate\Validation\Rule;

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
            'first_name' => 'required|max:255',
            'middle_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'sex' => 'required|integer|max:1',
            'birth_date' => 'required|max:25',
            'phone' => 'required|max:12',
            'med_history_number' => 'required|max:255',
            'chamber_id' => 'required|integer|exists:chambers,id',
        ];
    }
}
