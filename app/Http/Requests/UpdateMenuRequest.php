<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateMenuRequest extends FormRequest
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
            'label' => 'filled|string|max:255',
            'url' => 'nullable|string|max:255',
            'type' => 'filled|in:link,dropdown,megamenu',
            'position' => 'nullable|integer',
            'parent_id' => 'nullable|exists:menus,id',
            'description' => 'nullable|string',
            'is_active' => 'sometimes|boolean',
            'is_external' => 'sometimes|boolean',
            'image' => 'nullable|image|max:2048',
            'img_src' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'label.filled' => 'Le champ label est obligatoire.',
            'label.string' => 'Le champ label doit être une chaîne de caractères.',
            'label.max' => 'Le champ label ne doit pas dépasser 255 caractères.',
            'url.string' => 'Le champ url doit être une chaîne de caractères.',
            'url.max' => 'Le champ url ne doit pas dépasser 255 caractères.',
            'type.filled' => 'Le champ type est obligatoire.',
            'type.in' => 'Le champ type doit être l\'un des suivants : link, dropdown, megamenu.',
            'position.integer' => 'Le champ position doit être un entier.',
            'parent_id.exists' => 'Le menu parent sélectionné est invalide.',
            'description.string' => 'Le champ description doit être une chaîne de caractères.',
            'is_active.boolean' => 'Le champ is_active doit être un booléen.',
            'is_external.boolean' => 'Le champ is_external doit être un booléen.',
            'image.image' => 'Le fichier téléchargé doit être une image.',
            'image.max' => 'La taille de l\'image ne doit pas dépasser 2 Mo.',
        ];
    }
}
