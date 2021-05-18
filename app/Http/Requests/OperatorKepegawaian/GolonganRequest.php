<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class GolonganRequest extends FormRequest
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
            'nama_golongan' => 'required|max:70',
            'pangkat' => 'required|max:70'
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
            'nama_golongan.required'   => 'Nama golongan tidak boleh kosong',
            'nama_golongan.max'        => 'Maksimal Nama golongan 70 karakter',
            'pangkat.required'   => 'Nama pangkat tidak boleh kosong',
            'pangkat.max'        => 'Maksimal Nama pangkat 70 karakter'
        ];
    }
}
