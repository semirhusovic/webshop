<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCountryRequest extends FormRequest
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
            'en.countryName' => ['required','string','min:3','max:40'],
            'sr.countryName' => ['required','string','min:3','max:40']
        ];
    }

    public function messages()
    {
        return [
            'sr.countryName.required' => 'The country name in Serbian is required.',
            'en.countryName.required' => 'The country name in English is required.',
        ];
    }
}
