<?php

namespace App\Http\Requests\OperatorSurat;

use Illuminate\Foundation\Http\FormRequest;

class EffortSuratRequest extends FormRequest
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
            'tanggal_effort'  => ['required','string'],
        ];
    }

    public function messages()
    {
        return [
            'indeks.required'  => 'Indeks tidak boleh kosong',
            'tanggal_effort.required'  => 'Tanggal Effort tidak boleh kosong',
        ];
    }
}
