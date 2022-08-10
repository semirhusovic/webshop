<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSliderRequest extends FormRequest
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
            'link' => ['required','string','min:5','max:40'],
            'duration' => ['required','integer','min:1','max:15'],
            'isActive' => ['required'],
            'position' => ['required','integer','min:1','max:5'],
            'image.*' => ['required','mimes:jpeg,png,jpg,webp'],
        ];
        foreach (config('translatable.locales') as $locale) {
            $rules[$locale . '.title'] = 'required|string|max:40|min:5';
        }

        return $rules;
    }
}
