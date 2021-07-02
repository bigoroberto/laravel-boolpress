<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|max:255',
            'content' => 'required|min:3',
        ];
    }

    public function messages(){

        return[
            'title.required' => 'Il titolo è un campo obbligatorio!',
            'title.max' => 'Sono consentiti al massimo :max caratteri',
            'content.min' => 'Sono consentiti al minimo :min caratteri',
            'content.required' => 'Il contenuto è un campo obbligatorio!',
        ];

    }
}
