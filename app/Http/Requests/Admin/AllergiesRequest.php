<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AllergiesRequest extends FormRequest
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
            'allergy_cause_title'   => 'required|min:2'
        ];
    }

    /**
     * Get the validation custom message that apply to the request.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'allergy_cause_title.required'  => 'Allergy Cause Title field is required!',
            'allergy_cause_title.min'       => 'Allergy Cause Title field must consist of at least 2 characters!'
        ];
    }
}
