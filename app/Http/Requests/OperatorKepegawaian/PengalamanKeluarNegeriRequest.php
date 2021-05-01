<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class PengalamanKeluarNegeriRequest extends FormRequest
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
            'nip_pegawai'   => 'required',
            'negara'        => 'required|max:30|string',
            'tujuan'        => 'required|max:100|string',
            'lama'          => 'required|max:20',
            'membiayai'     => 'required|max:60|string',
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
            'nip_pegawai.required'       => 'Nip pegawai tidak boleh kosong',
            'negara.required'  => 'Nama negara tidak boleh kosong',
            'negara.max'       => 'Maksimal Nama negara 30 karakter',
            'negara.string'    => 'Inputan berupa huruf',
            'tujuan.required'             => 'Tujuan tidak boleh kosong',
            'tujuan.max'                  => 'Maksimal tujuan 100 karakter',
            'lama.required'             => 'Lama tidak boleh kosong',
            'lama.max'                  => 'Maksimal lama 20 karakter',
            'membiayai.required'    => 'Yang membiayai tidak boleh kosong',
            'membiayai.max'         => 'Maksimal Yang membiayai 60 karakter',
            'membiayai.string'      => 'Inputan berupa huruf',
        ];
    }
}
