<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAutrePageRequest extends FormRequest
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
            'slug' => 'nullable|string',
            'title' => 'nullable|string',
            'content' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            // 'slug.string' => 'Le champ slug doit être une chaîne de caractères.',
            // 'slug.unique' => 'Ce slug existe déjà. Veuillez en choisir un autre.',
            'title.string' => 'Le champ title doit être une chaîne de caractères.',
            'content.string' => 'Le champ content doit être une chaîne de caractères.',
        ];
    }
}
