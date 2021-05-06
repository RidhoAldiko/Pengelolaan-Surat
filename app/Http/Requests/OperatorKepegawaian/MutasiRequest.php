<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class MutasiRequest extends FormRequest
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
            'nip_pegawai'    => 'required',
            'jenis_mutasi'   => 'required',
            'asal'          => 'required|max:60|string',
            'tujuan'         => 'required|max:60|string',
            'tanggal'        => 'required'
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
            'jenis_mutasi.required'           => 'Jenis mutasi tidak boleh kosong',
            'asal.required'            => 'Asal tidak boleh kosong',
            'asal.max'                 => 'Maksimal asal 60 karakter',
            'asal.string'              => 'Inputan berupa huruf',
            'tujuan.required'    => 'Tujuan mutasi tidak boleh kosong',
            'tujuan.max'         => 'Maksimal tujuan mutasi 60 karakter',
            'tujuan.string'      => 'Inputan berupa huruf',
            'tanggal.required'   => 'Tanggal tidak boleh kosong',
        ];
    }
}
