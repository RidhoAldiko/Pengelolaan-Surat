<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class HobiRequest extends FormRequest
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
            'hobi.*'  => 'required|string|max:25'
        ];
    }
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'hobi.required'   => 'Hobi tidak boleh kosong',
            'hobi.string'     => 'Hobi berupa string',
            'hobi.max'        => 'Maksimal Hobi 25 karakter'
        ];
    }
}
