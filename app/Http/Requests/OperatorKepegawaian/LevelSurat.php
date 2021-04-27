<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class LevelSurat extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return [
            'nama_level' => 'required|max:70',
            'urutan_level' => 'required'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'level.required'   => 'Nama Level Surat tidak boleh kosong',
            'level.max'        => 'Maksimal Nama Level Surat 70 karakter',
            'urutan_level.required'   => 'Urutan Level tidak boleh kosong',
        ];
    }
}
