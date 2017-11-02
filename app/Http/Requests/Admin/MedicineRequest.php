<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class MedicineRequest extends FormRequest
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
            'name'              => 'required|min:3',
            'code'              => 'required|min:2',
            'medicine_type_id'  => 'required'
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
            'name.required'             => 'Name Field is Required',
            'name.min'                  => 'Name Field must consist of at least 3 characters',
            'code.required'             => 'Medicine Code Field is Required',
            'code.min'                  => 'Medicine Code Field must consist of at least 3 characters',
            'medicine_type_id.required' => 'Medicine Type Field is required'
        ];
    }
}
