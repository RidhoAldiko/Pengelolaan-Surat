<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class LevelSuratRequest extends FormRequest
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
            'nama_level' => 'required|string|max:70',
            'urutan_level' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'nama_level.required'   => 'Nama Nama Level tidak boleh kosong',
            'nama_level.string'     => 'Nama Nama Level berupa string',
            'nama_level.max'        => 'Maksimal Nama Nama Level 70 karakter',
            'urutan_level.required'  => 'Urutan Level tidak boleh kosong',
        ];
    }
}
