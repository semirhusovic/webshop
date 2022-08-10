<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePromotionRequest extends FormRequest
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
        $rules =  [
            //
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.promotion_name'] = 'required|string|max:50|min:3';
        }
        return $rules;
    }
}
