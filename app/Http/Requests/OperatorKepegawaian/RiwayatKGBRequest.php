<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class RiwayatKGBRequest extends FormRequest
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
            'id_golongan'  => 'required',
            'mulai_berlaku' => 'required',
            'batas_berlaku' => 'required',
            'mkg'          => 'required',
            'jumlah_gaji'  => 'required|integer',
            'penjabat'    => 'required|max:60|string',
            'nomor'       => 'required|max:60',
            'tanggal'     => 'required',
            'peraturan'    => 'required|max:100|string',
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
            'nip.required'              => 'NIP tidak boleh kosong',
            'mulai_berlaku.required'      => 'Dari tidak boleh kosong',
            'batas_berlaku.required'      => 'Sampai tidak boleh kosong',
            'penjabat.required'         => 'Penjabat tidak boleh kosong',
            'penjabat.max'              => 'Maksimal Penjabat 60 karakter',
            'penjabat.string'            => 'Inputan berupa huruf',
            'nomor.required'  => 'Nomor tidak boleh kosong',
            'nomor.max'       => 'Maksimal Nomor 60 karakter',
            'tanggal.required'              => 'Tanggal tidak boleh kosong',
            'peraturan.required'         => 'Peraturan tidak boleh kosong',
            'peraturan.max'              => 'Maksimal peraturan 60 karakter',
            'peraturan.string'            => 'Inputan berupa huruf',
            'id_golongan.required'      => 'Golongan tidak boleh kosong',
            'mkg.required'               => 'MKG tidak boleh kosong',
            'jumlah_gaji.required'         => 'Jumlah gaji tidak boleh kosong',
            'jumlah_gaji.integer'            => 'Inputan berupa angka',
        ];
    }
}
