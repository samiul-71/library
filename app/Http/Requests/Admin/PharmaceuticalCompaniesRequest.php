<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PharmaceuticalCompaniesRequest extends FormRequest
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
            'name'          => 'required|min:2',
            'phone'         => 'required|min:9',
            'email'         => 'required'
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
            'name.required'         => "Pharmaceutical Company's name field is required!",
            'name.min'              => 'Name field must consist of at least 2 characters!',
            'phone.required'        => 'Phone no. field is required!',
            'phone.min'          => 'Phone no. field must consist of at least 9 characters!',
            'email.required'        => "Email field is required!"
        ];
    }
}
