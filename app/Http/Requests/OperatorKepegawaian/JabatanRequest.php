<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class JabatanRequest extends FormRequest
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
            'nama_jabatan' => 'required|string|max:70'
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
            'nama_jabatan.required'   => 'Nama jabatan tidak boleh kosong',
            'nama_jabatan.string'     => 'Nama jabatan berupa string',
            'nama_jabatan.max'        => 'Maksimal Nama jabatan 70 karakter'
        ];
    }
}
