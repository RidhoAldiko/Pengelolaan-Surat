<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class KursusAtauPelatihanRequest extends FormRequest
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
            'nama_kursus'   => 'required|max:200|string',
            'tanda_lulus'   => 'required|max:200|string',
            'tempat'         => 'required',
            'mulai'         => 'required',
            'selesai'       => 'required'
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
            'tempat.required'           => 'Tempat  tidak boleh kosong',
            'nama_kursus.required'            => 'nama_kursus tidak boleh kosong',
            'nama_kursus.max'                 => 'Maksimal nama_kursus 200 karakter',
            'nama_kursus.string'              => 'Inputan berupa huruf',
            'tanda_lulus.required'    => 'Tanda lulus tidak boleh kosong',
            'tanda_lulus.max'         => 'Maksimal tanda_lulus 200 karakter',
            'tanda_lulus.string'      => 'Inputan berupa huruf',
            'mulai.required'   => 'Tanggal mulai tidak boleh kosong',
            'selesai.required'   => 'Tanggal selesai tidak boleh kosong',
        ];
    }
}
