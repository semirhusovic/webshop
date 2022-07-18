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
        return [
            'en.productName' => ['required','string','min:3','max:40'],
            'sr.productName' => ['required','string','min:3','max:40'],
            'en.productDescription' => ['required','string','min:3','max:500'],
            'sr.productDescription' => ['required','string','min:3','max:500'],
            'productPrice' => ['required','numeric'],
            'productMonthsOfWarranty' => ['required','integer'],
            'image.*' => ['required','mimes:jpeg,png,jpg'],
            'category.*' => ['required'],
            'country_id' => ['required'],
            'manufacturer_id' => ['required'],
            'productManufacturingDate' => ['required','date'],
        ];
    }
}
