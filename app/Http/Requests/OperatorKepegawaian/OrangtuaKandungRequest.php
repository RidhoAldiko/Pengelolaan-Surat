<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class OrangtuaKandungRequest extends FormRequest
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
            'status'        => 'required',
            'nama'          => 'required|string|max:60',
            'tgl_lahir'     => 'required',
            'pekerjaan'     => 'required|string|max:50',
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
            'status.required'          => 'Status tidak boleh kosong',
            'nama.required'            => 'Nama tidak boleh kosong',
            'nama.max'                 => 'Maksimal nama 60 karakter',
            'nama.string'              => 'Inputan berupa huruf',
            'tgl_lahir.required'   => 'Tanggal lahir tidak boleh kosong',
            'pekerjaan.required'    => 'Tempat lahir tidak boleh kosong',
            'pekerjaan.max'         => 'Maksimal Tempat lahir 60 karakter',
            'pekerjaan.string'      => 'Inputan berupa huruf',
        ];
    }
}
