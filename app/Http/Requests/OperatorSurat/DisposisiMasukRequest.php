<?php

namespace App\Http\Requests\OperatorSurat;

use Illuminate\Foundation\Http\FormRequest;

class DisposisiMasukRequest extends FormRequest
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
            'indeks'  => ['required','string'],
            'tanggal_disposisi'  => ['required','string'],
        ];
        
    }

    public function messages()
    {
        return [
            'indeks.required'  => 'Indeks tidak boleh kosong',
            'tanggal_disposisi.required'  => 'Tanggal Disposisi tidak boleh kosong',
        ];
    }
}
