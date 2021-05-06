<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class GajiRequest extends FormRequest
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
            'id_golongan'  => 'required',
            'mkg'          => 'required|max:3',
            'jumlah_gaji'  => 'required|integer'
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
            'id_golongan.required'      => 'Golongan tidak boleh kosong',
            'mkg.required'               => 'MKG tidak boleh kosong',
            'mkg.max'                   => 'Maksimal MKG 3 karakter',
            'jumlah_gaji.required'         => 'Jumlah gaji tidak boleh kosong',
            'jumlah_gaji.integer'            => 'Inputan berupa angka',
        ];
    }
}
