<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class RiwayatPendidikanRequest extends FormRequest
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
        'jenis_pendidikan' => 'required|max:30',
        'nama_pendidikan' => 'required|max:60',
        'no_sttb' => 'required|max:30',
        'tgl_sttb' => 'required',
        'tempat' => 'required',
        'nama_kepsek' => 'required|max:50',
        'tanda_lulus' => 'required|max:50'
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
            'nip.max'                   => 'Maksimal NIP 18 karakter',
            'jenis_pendidikan.required' => 'Jenis pendidikan tidak boleh kosong',
            'jenis_pendidikan.max'      => 'Maksimal Jenis pendidikan 30 karakter',
            'nama_pendidikan.required'  => 'Nama pendidikan tidak boleh kosong',
            'nama_pendidikan.max'       => 'Maksimal Nama pendidikan 60 karakter',
            'no_sttb.required'         => 'Nomor STTB tidak boleh kosong',
            'no_sttb.max'              => 'Maksimal Nomor STTB 30 karakter',
            'tgl_sttb.required'         => 'Tanggal STTB tidak boleh kosong',
            'tempat.required'         => 'Temapat tidak boleh kosong',
            'nama_kepsek.required'      => 'Nama Kepala sekolah / Rektor tidak boleh kosong',
            'nama_kepsek.max'           => 'Maksimal Nama Kepala sekolah / Rektor 50 karakter',
            'tanda_lulus.required'      => 'Tanda Lulus tidak boleh kosong',
            'tanda_lulus.max'           => 'Maksimal Tanda Lulus 50 karakter',
        ];
    }
}
