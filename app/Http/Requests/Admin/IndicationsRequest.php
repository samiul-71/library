<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class IndicationsRequest extends FormRequest
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
            'code'          => 'required|min:2',
            'key_word'      => 'required|min:2'
            //
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
            'code.required'         => 'Indication code field is required!',
            'code.min'              => 'Indication code field must consist of at least 2 characters!',
            'key_word.required'     => 'Key word(s) field is required!',
            'key_word.min'          => 'Key word(s) field must consist of at least 2 characters!'
        ];
    }
}
