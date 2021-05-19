<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class PangkatCPNSRequest extends FormRequest
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
            'nip_pegawai' => 'required',
            'id_golongan' => 'required',
            'tmt'         => 'required',
            'gaji_pokok'  => 'required|integer',
            'penjabat'    => 'required|max:60|string',
            'nomor'       => 'required|max:60',
            'tanggal'     => 'required'
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
            'nip_pegawai.required'      => 'Nip pegawai tidak boleh kosong',
            'id_golongan.required'      => 'Golongan tidak boleh kosong',
            'tmt.required'               => 'TMT tidak boleh kosong',
            'gaji_pokok.required'         => 'Jumlah gaji tidak boleh kosong',
            'gaji_pokok.integer'            => 'Inputan berupa angka',
            'penjabat.required'         => 'Penjabat tidak boleh kosong',
            'penjabat.max'              => 'Maksimal Penjabat 60 karakter',
            'penjabat.string'            => 'Inputan berupa huruf',
            'nomor.required'  => 'Nomor tidak boleh kosong',
            'nomor.max'       => 'Maksimal Nomor 60 karakter',
            'tanggal.required'              => 'Tanggal tidak boleh kosong'
        ];
    }
}
