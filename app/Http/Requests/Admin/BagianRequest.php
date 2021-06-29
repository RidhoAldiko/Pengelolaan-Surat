<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class BagianRequest extends FormRequest
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
            'id_asisten' => 'required',
            'nama_bagian' => 'required|string'
        ];
    }

    public function messages()
    {
        return [
            'id_asisten.required'   => 'Asisten tidak boleh kosong',
            'nama_bagian.required'   => 'Bagian tidak boleh kosong',
            'nama_bagian.string'     => 'Bagian berupa string',
        ];
    }
}
