<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class Type3ExcelRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'type3_text' => 'required',
            'input_format' => 'required',
            'cell_color' => 'required'
        ];
    }
}
