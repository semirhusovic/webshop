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
        return [
            'en.title' => ['required','string','min:5','max:40'],
            'sr.title' => ['required','string','min:5','max:40'],
            'link' => ['required','string','min:5','max:40'],
            'duration' => ['required','integer','min:1','max:15'],
            'isActive' => ['required'],
            'order' => ['required','integer','unique:sliders','min:1','max:5'],
            'image' => ['required','mimes:jpeg,png,jpg'],
        ];

    }

    public function messages()
    {
        return [
            'sr.title.required' => 'The title in Serbian is required.',
            'en.title.required' => 'The title in English is required.',
        ];
    }
}
