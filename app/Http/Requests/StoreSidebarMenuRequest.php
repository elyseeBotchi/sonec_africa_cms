<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSidebarMenuRequest extends FormRequest
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
            'menu_id' => 'required|exists:menus,id',
            'title' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'cta_label' => 'nullable|string|max:255',
            'cta_url' => 'nullable|string|max:255',
            'image' => 'nullable|image|max:2048',
            'img_url' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'menu_id.required' => 'Le champ menu_id est obligatoire.',
            'menu_id.exists' => 'Le menu sélectionné est invalide.',
            'title.string' => 'Le champ title doit être une chaîne de caractères.',
            'title.max' => 'Le champ title ne doit pas dépasser 255 caractères.',
            'description.string' => 'Le champ description doit être une chaîne de caractères.',
            'cta_label.string' => 'Le champ cta_label doit être une chaîne de caractères.',
            'cta_label.max' => 'Le champ cta_label ne doit pas dépasser 255 caractères.',
            'cta_url.string' => 'Le champ cta_url doit être une chaîne de caractères.',
            'cta_url.max' => 'Le champ cta_url ne doit pas dépasser 255 caractères.',
            'image.image' => 'Le champ image doit être une image valide.',
            'image.max' => 'La taille de l\'image ne doit pas dépasser 2048 Ko.',
            'img_url.string' => 'Le champ img_url doit être une chaîne de caractères.',
        ];
    }
}
