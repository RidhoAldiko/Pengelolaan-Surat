<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StafAhliRequest extends FormRequest
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
            'nama_staf_ahli' => 'required|max:70|string'
        ];
    }

    public function messages()
    {
        return [
            'nama_staf_ahli.required'   => 'Nama Staf Ahli tidak boleh kosong',
            'nama_staf_ahli.string'     => 'Nama Staf Ahli berupa string',
            'nama_staf_ahli.max'        => 'Maksimal Nama Staf Ahli 70 karakter'
        ];
    }
}
