<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class DokumenPegawaiRequest extends FormRequest
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
            'nama_dokumen'  => 'required|max:60|string'
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
            'nip_pegawai.required'     => 'Nip pegawai tidak boleh kosong',
            'nama_dokumen.required'     => 'Nama diklat penjenjangan tidak boleh kosong',
            'nama_dokumen.max'          => 'Maksimal nama diklat penjenjangan 60 karakter',
            'nama_dokumen.string'       => 'Inputan berupa huruf',
        ];
    }
}
