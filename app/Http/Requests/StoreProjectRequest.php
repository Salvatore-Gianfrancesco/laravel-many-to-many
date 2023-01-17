<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
            'name' => 'required|unique:projects,name|min:5|max:100',
            'body' => 'nullable|min:10|max:300',
            'cover_img' => 'nullable|image|max:250',
            'type_id' => 'nullable|exists:types,id'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Il nome del progetto è obbligatorio.',
            'name.unique' => 'E\' già presente un progetto con questo nome.',
            'name.min' => 'Il nome del progetto deve essere lungo almeno 5 caratteri.',
            'name.max' => 'Il nome del progetto deve essere lungo massimo 100 caratteri.',
            'body.min' => 'La descrizione del progetto deve essere lunga almeno 10 caratteri.',
            'body.max' => 'La descrizione del progetto deve essere lunga massimo 300 caratteri.',
            'cover_img.image' => 'Il file selezionato non è un\'immagine',
            'cover_img.max' => 'Il nome del file selezionato è troppo lungo. Deve essere massimo di 250 caratteri',
            'type_id.exists' => 'Il tipo selezionato non è valido'
        ];
    }
}
