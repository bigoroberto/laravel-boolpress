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
            'title' => 'required|max:200',
            'content' => 'required|min:3',
            'category_id' => 'nullable|exists:cateories,id',
        ];
    }

    public function messages(){

        return[
            'title.required' => 'Il titolo è un campo obbligatorio!',
            'title.max' => 'Sono consentiti al massimo :max caratteri',
            'content.required' => 'Il contenuto è un campo obbligatorio!',
            'content.min' => 'Sono consentiti al minimo :min caratteri',
            'category_id.exists' => 'La categoria scelta non è presente,'
        ];

    }
}
