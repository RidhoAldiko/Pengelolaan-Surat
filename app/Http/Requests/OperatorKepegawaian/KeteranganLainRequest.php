<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class KeteranganLainRequest extends FormRequest
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
            'jenis'         => 'required',
            'penjabat'      => 'required|max:60|string',
            'nomor'         => 'required|max:60|string',
            'tanggal'       => 'required'
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
            'jenis.required'           => 'Jenis  tidak boleh kosong',
            'penjabat.required'            => 'Penjabat tidak boleh kosong',
            'penjabat.max'                 => 'Maksimal penjabat 60 karakter',
            'penjabat.string'              => 'Inputan berupa huruf',
            'nomor.required'    => 'Nomor tidak boleh kosong',
            'nomor.max'         => 'Maksimal Nomor 60 karakter',
            'nomor.string'      => 'Inputan berupa huruf',
            'tanggal.required'   => 'Tanggal tidak boleh kosong',
        ];
    }
}
