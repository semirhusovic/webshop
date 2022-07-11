<?php

namespace App\Http\Requests;

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

//'title' => $request->title,
//'link' => $request->link,
//'order' => $request->order,
//'duration' => $request->duration,
//'isActive' => $request->isActive ? 1 : 0

    public function rules()
    {
        return [
//            'title' => ['required','string','min:5','max:40'],
            'link' => ['required','string','min:5','max:40'],
            'duration' => ['required','integer','min:1','max:15'],
            'isActive' => ['required'],
            'order' => ['integer','unique:sliders','min:1','max:5'],
            'image' => ['required','mimes:jpeg,png,jpg']
        ];
    }
}
