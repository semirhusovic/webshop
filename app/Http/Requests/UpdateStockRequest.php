<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStockRequest extends FormRequest
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
            'product_id' => ['required','integer'],
            'size_id' => ['required','integer'],
            'color_id' => ['required','integer'],
            'quantity' => ['required','integer'],
            'unit_of_measure' => ['required','string']
        ];
    }
}
