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
            'nip_pegawai' => ['required','string', 'max:18'],
            'nama_pegawai' => ['required', 'string', 'max:60'],
            'nomor_karpeg' => ['required', 'string', 'max:25'],
            'tempat_lahir' => ['required', 'string', 'max:30'],
            'tanggal_lahir' => ['required', 'string'],
            'jenis_kelamin' => ['required','string'],
            'agama' => ['required','string'],
            'status_perkawinan' => ['required','string'],
            'id_unit' => ['required', 'string'],
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
            'nip_pegawai.max'        => 'Maksimal NIP 18 karakter',
            'nama_pegawai.required'  => 'Nama pegawai tidak boleh kosong',
            'nama_pegawai.max'       => 'Maksimal nama 60 karakter',
            'nama_pegawai.string'    => 'Nama berupa string',
            'tempat_lahir.string'    => 'Tempat Lahir berupa string',
            'tempat_lahir.max'       => 'Maksimal nama 30 karakter',
            'tempat_lahir.required'    => 'Tempat Lahir tidak boleh kosong',
            'tanggal_lahir.string'    => 'Tanggal Lahir berupa string',
            'tanggal_lahir.required'    => 'Tanggal Lahir tidak boleh kosong',
            'nomor_karpeg.string'    => 'Nomor Karpeg berupa string',
            'nomor_karpeg.required'    => 'Nomor Karpeg tidak boleh kosong',
            'nomor_karpeg.max'        => 'Maksimal NIP 25 karakter',
            'jenis_kelamin.required' => 'Jenis kelamin tidak boleh kosong',
            'agama.required'       => 'Agama wajib diisi',
            'status_perkawinan.required'       => 'Status Perkawinan wajib diisi',
            'id_unit.required'       => 'Unit wajib diisi',
            'id_jabatan.required'    => 'Jabatan wajib diisi',
        ];
    }
}
