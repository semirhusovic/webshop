<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePromotionRequest extends FormRequest
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
            'en.promotionName' => ['required','string','min:3','max:40'],
            'sr.promotionName' => ['required','string','min:3','max:40']
        ];
    }

    public function messages()
    {
        return [
            'sr.promotionName.required' => 'Promotion name in Serbian is required.',
            'en.promotionName.required' => 'Promotion name in English is required.',
        ];
    }
}
