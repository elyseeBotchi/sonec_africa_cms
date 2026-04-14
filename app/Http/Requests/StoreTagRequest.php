<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTagRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:tags,slug', 
            'page_key' => 'nullable|string|max:255'           

        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Le libellé est obligatoire',
            'name.string' => 'Le libellé doit être une chaîne de caractères',
            'slug.required' => 'Le slug est obligatoire.',
            'slug.unique' => 'Ce slug existe déjà. Veuillez en choisir un autre.',
        ];
    }
}
