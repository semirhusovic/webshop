<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
        $rules = [
            'productPrice' => ['required','numeric'],
            'productMonthsOfWarranty' => ['required','integer'],
            'image' => ['required'],
            'image.*' => ['required','mimes:jpeg,png,jpg,webp'],
            'category.*' => ['required'],
            'category' => ['required'],
            'country_id' => ['required'],
            'manufacturer_id' => ['required'],
            'productManufacturingDate' => ['required','date'],
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.productName'] = 'required|string|max:40|min:3';
            $rules[$locale . '.productDescription'] = 'required|string|max:500|min:3';
        }

        return $rules;
    }
}
