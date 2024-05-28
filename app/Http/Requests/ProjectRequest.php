<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required |min:3|max:60',
            'href'=> 'required|min:10',
            'image' => 'image|mimes:png,jpg|max:20480'
        ];
    }
    public function messages(): array
    {
        return [
            'title.required' => 'Il titolo è obbligatorio' ,
            'title.min' => 'Il titolo deve contenere :min caratteri' ,
            'title.max' => 'Il titolo deve contenere :max caratteri' ,
            'href.required' => 'Il link è obbligatorio' ,
            'href.min' => 'Il link deve contenere :min caratteri',
            'image.image'=> 'Il file caricato deve essere un\'immagine',
            'image.mimes'=> 'Il file caricato deve essere in un formato jpg o png ',
            'image.max'=> 'Il file caricato non può pesare più di :max kb',
        ];
    }
}
