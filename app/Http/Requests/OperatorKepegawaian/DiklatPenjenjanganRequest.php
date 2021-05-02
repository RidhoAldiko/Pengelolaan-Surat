<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class DiklatPenjenjanganRequest extends FormRequest
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
            'nama_diklat'   => 'required|max:60|string',
            'tahun'         => 'required|max:5',
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
            'nama_diklat.required'     => 'Nama diklat penjenjangan tidak boleh kosong',
            'nama_diklat.max'          => 'Maksimal nama diklat penjenjangan 60 karakter',
            'nama_diklat.string'       => 'Inputan berupa huruf',
            'tahun.required'            => 'Tahun tidak boleh kosong',
            'tahun.max'                 => 'Maksimal tahun 5 karakter',
            'nomor.required'        => 'Nomor tidak boleh kosong',
            'nomor.max'             => 'Maksimal nomor 60 karakter',
            'nomor.string'          => 'Inputan berupa huruf',
            'tanggal.required'      => 'Tanggal tidak boleh kosong'
        ];
    }
}
