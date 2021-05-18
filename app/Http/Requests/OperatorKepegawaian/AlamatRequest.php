<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class AlamatRequest extends FormRequest
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
            'jalan'         => 'required|max:60',
            'kelurahan_desa'=> 'required|max:50',
            'kecamatan'     => 'required|max:60',
            'kabupaten_kota'=> 'required|max:50',
            'provinsi'      => 'required|max:50'
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
            'jalan.required'            => 'Nama jalan tidak boleh kosong',
            'jalan.max'                 => 'Maksimal Nama jalan 60 karakter',
            'kelurahan_desa.required'   => 'Nama kelurahan/desa tidak boleh kosong',
            'kelurahan_desa.max'        => 'Maksimal Nama kelurahan/desa 50 karakter',
            'kecamatan.required'        => 'Nama kecamatan tidak boleh kosong',
            'kecamatan.max'             => 'Maksimal Nama kecamatan 60 karakter',
            'kabupaten_kota.required'   => 'Nama kabupaten/kota tidak boleh kosong',
            'kabupaten_kota.max'        => 'Maksimal Nama kabupaten/kota 50 karakter',
            'provinsi.required'         => 'Nama provinsi tidak boleh kosong',
            'provinsi.max'              => 'Maksimal Nama provinsi 50 karakter',
        ];
    }
}
