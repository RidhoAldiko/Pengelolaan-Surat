<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AsistenRequest extends FormRequest
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
            'nama_asisten' => 'required|max:70|string'
        ];
    }
    
    public function messages()
    {
        return [
            'nama_asisten.required'   => 'Nama Asisten tidak boleh kosong',
            'nama_asisten.string'     => 'Nama Asisten berupa string',
            'nama_asisten.max'        => 'Maksimal Nama Asisten 70 karakter'
        ];
    }
}
