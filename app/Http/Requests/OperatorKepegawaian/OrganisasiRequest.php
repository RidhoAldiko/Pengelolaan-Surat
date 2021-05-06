<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class OrganisasiRequest extends FormRequest
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
            'waktu'              => 'required',
            'nama'              => 'required|max:100|string',
            'kedudukan'         => 'required|max:60|string',
            'tahun_mulai'       => 'required|max:5',
            'tahun_selesai'      => 'required|max:5',
            'tempat'   => 'required|string',
            'pimpinan'   => 'required|max:30|string',
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
            'waktu.required'            => 'Waktu Organisasi tidak boleh kosong',
            'nama.required'  => 'Nama organisasi tidak boleh kosong',
            'nama.max'       => 'Maksimal Nama organisasi 100 karakter',
            'nama.string'    => 'Inputan berupa huruf',
            'kedudukan.required'  => 'Kedudukan organisasi tidak boleh kosong',
            'kedudukan.max'       => 'Maksimal kedudukan organisasi 60 karakter',
            'kedudukan.string'    => 'Inputan berupa huruf',
            'tahun_mulai.required'             => 'Tahun mulai tidak boleh kosong',
            'tahun_mulai.max'                  => 'Maksimal tahun mulai 5 karakter',
            'tahun_selesai.required'             => 'Tahun selesai tidak boleh kosong',
            'tahin_selesai.max'                  => 'Maksimal tahun selesai 5 karakter',
            'tempat.required'    => 'Tempat tidak boleh kosong',
            'tempat.string'      => 'Inputan berupa huruf',
            'pimpinan.required'    => 'Pimpinan tidak boleh kosong',
            'pimpinan.max'         => 'Maksimal Pimpinan 30 karakter',
            'pimpinan.string'      => 'Inputan berupa huruf',
        ];
    }
}
