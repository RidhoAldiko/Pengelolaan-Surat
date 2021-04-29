<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class PenggunaRequest extends FormRequest
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
            'nip_pegawai' => ['required','string', 'max:60'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role' => ['required', 'string'],
        ];
    }

    public function messages()
    {
        return [
            'nip_pegawai.required'   => 'NIP tidak boleh kosong',
            'nip_pegawai.string'     => 'NIP berupa string',
            'nip_pegawai.max'        => 'Maksimal NIP 60 karakter',
            'email.required'  => 'Email tidak boleh kosong',
            'email.string'  => 'Email harus berupa string',
            'email.unique'  => 'Email sudah terdaftar',
            'role.required'   => 'Role tidak boleh kosong',
            
        ];
    }
}
