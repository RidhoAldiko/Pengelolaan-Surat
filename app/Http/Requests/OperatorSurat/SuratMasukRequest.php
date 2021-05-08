<?php

namespace App\Http\Requests\OperatorSurat;

use Illuminate\Foundation\Http\FormRequest;

class SuratMasukRequest extends FormRequest
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
            'pengirim' => ['required','string'],
            'nomor_surat' => ['required','string'],
            'tanggal_surat' => ['required','string'],
            'perihal' => ['required','string'],
            'isi_ringkasan' => ['required','string'],
            'file_surat' => ['required', 'file','mimes:pdf','max:512'],
        ];
    }
    public function messages()
    {
        return [
            'pengirim.required'  => 'Pengirim tidak boleh kosong',
            'nomor_surat.required'  => 'Nomor Surat tidak boleh kosong',
            'tanggal_surat.required'  => 'Tanggal tidak boleh kosong',
            'perihal.required'  => 'Perihal tidak boleh kosong',
            'isi_ringkasan.required'  => 'Isi Ringkasan tidak boleh kosong',
            'file_surat.required'  => 'File Surat tidak boleh kosong',
            'file_surat.mimes'  => 'File Surat harus berupa PDF',
            'file_surat.max'  => 'File Surat maksimal berukan 512kb',
        ];
    }
}
