<?php

namespace App\Http\Requests;

use Astrotomic\Translatable\Validation\RuleFactory;
use Illuminate\Foundation\Http\FormRequest;

class StoreSliderRequest extends FormRequest
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


    public function rules()
    {
        $rules =  [
            'link' => ['required','string','min:5','max:40'],
            'duration' => ['required','integer','min:1','max:15'],
            'isActive' => ['required'],
            'position' => ['required','integer','unique:sliders','min:1','max:15'],
            'image' => ['required'],
            'image.*' => ['required','mimes:jpeg,png,jpg,webp'],
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.title'] = 'required|string|max:40|min:5';
        }

        return $rules;
    }
}
