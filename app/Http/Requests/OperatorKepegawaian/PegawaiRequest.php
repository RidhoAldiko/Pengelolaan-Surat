<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class PegawaiRequest extends FormRequest
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
            'nip_pegawai' => ['required','string', 'max:18', 'unique:pegawai'],
            'nama_pegawai' => ['required', 'string', 'max:60'],
            'jenis_kelamin' => ['required','string'],
            'alamat' => ['required', 'string'],
            'id_unit' => ['required', 'string'],
            'id_golongan' => ['required', 'string'],
            'id_jabatan' => ['required', 'string'],
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
            'nip_pegawai.required'   => 'NIP tidak boleh kosong',
            'nip_pegawai.string'     => 'NIP berupa string',
            'nip_pegawai.max'        => 'Maksimal NIP 10 karakter',
            'nip_pegawai.unique'     => 'NIP tidak boleh sama',
            'nama_pegawai.required'  => 'Nama pegawai tidak boleh kosong',
            'nama_pegawai.max'       => 'Maksimal nama 60 karakter',
            'nama_pegawai.string'    => 'Nama berupa string',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
            'alamat.required'        => 'Alamat tidak boleh kosong',
            'id_unit.required'       => 'Unit wajib diisi',
            'id_golongan.required'   => 'Golongan wajib diisi',
            'id_jabatan.required'    => 'Jabatan wajib diisi',
        ];
    }
}
