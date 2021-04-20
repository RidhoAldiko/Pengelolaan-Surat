<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class UnitKerjaRequest extends FormRequest
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
            'nama_unit' => 'required|max:70|string'
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
            'nama_unit.required'   => 'Nama unit kerja tidak boleh kosong',
            'nama_unit.string'     => 'Nama unit kerja berupa string',
            'nama_unit.max'        => 'Maksimal Nama unit kerja 70 karakter'
        ];
    }
}
