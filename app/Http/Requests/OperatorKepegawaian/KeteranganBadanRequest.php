<?php

namespace App\Http\Requests\OperatorKepegawaian;

use Illuminate\Foundation\Http\FormRequest;

class KeteranganBadanRequest extends FormRequest
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
            'tinggi'        => 'required|integer',
            'berat_badan'   => 'required|integer',
            'rambut'        => 'required|string|max:30',       
            'bentuk_muka'   => 'required|string|max:30',
            'warna_kulit'   => 'required|string|max:30',
            'ciri_khas'     => 'required|max:50',
            'cacat_tubuh'   => 'required|max:50'
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
            'tinggi.required'            => 'tinggi tidak boleh kosong',
            'tinggi.integer'             => 'Tinggi berupa angka',
            'berat_badan.required'       => 'berat badan tidak boleh kosong',
            'berat_badan.integer'        => 'Tinggi berupa angka',
            'rambut.required'            => 'rambut tidak boleh kosong',
            'rambut.max'                 => 'Maksimal rambut 30 karakter',
            'rambut.string'              => 'Inputan berupa huruf',
            'bentuk_muka.required'            => 'bentuk muka tidak boleh kosong',
            'bentuk_muka.max'                 => 'Maksimal bentuk muka 30 karakter',
            'bentuk_muka.string'              => 'Inputan berupa huruf',
            'ciri_khas.required'         => 'ciri khas tidak boleh kosong',
            'ciri_khas.max'              => 'Maksimal ciri khas 50 karakter',
            'cacat_tubuh.required'         => 'cacat tubuh tidak boleh kosong',
            'cacat_tubuh.max'              => 'Maksimal cacat tubuh 50 karakter',
        ];
    }
}
