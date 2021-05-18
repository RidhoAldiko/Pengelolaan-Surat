<?php

namespace App\Http\Requests\OperatorSurat;

use Illuminate\Foundation\Http\FormRequest;

class TeruskanDisposisiMasukRequest extends FormRequest
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
            'id'  => ['required','string'],
            'instruksi'  => ['required','string'],
        ];
    }

    public function messages()
    {
        return [
            'id.required'  => 'Tujuan Disposisi tidak boleh kosong',
            'instruksi.required'  => 'Intruksi / informasi tidak boleh kosong',
        ];
    }
}
