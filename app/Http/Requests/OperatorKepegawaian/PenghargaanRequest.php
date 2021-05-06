<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class PenghargaanRequest extends FormRequest
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
            'nip_pegawai'       => 'required',
            'nama_penghargaan'  => 'required|max:100|string',
            'tahun'             => 'required|max:5',
            'negara_instansi'   => 'required|max:60|string',
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
            'nama_penghargaan.required'  => 'Nama Penghargaan tidak boleh kosong',
            'nama_penghargaan.max'       => 'Maksimal Nama Penghargaan 100 karakter',
            'nama_penghargaan.string'    => 'Inputan berupa huruf',
            'tahun.required'             => 'Tahun tidak boleh kosong',
            'tahun.max'                  => 'Maksimal tahun 5 karakter',
            'negara_instansi.required'    => 'Negara/instansi tidak boleh kosong',
            'negara_instansi.max'         => 'Maksimal Negara/instansi 60 karakter',
            'negara_instansi.string'      => 'Inputan berupa huruf',
        ];
    }
}
