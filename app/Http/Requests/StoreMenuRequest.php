<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreMenuRequest extends FormRequest
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
            'label' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:menus,slug',
            'url' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'position' => 'nullable|integer',
            'is_active' => 'boolean',
            'is_external' => 'boolean',
            'image' => 'nullable|image|max:2048',
            'type' => 'required|string',
            'description' => 'nullable|string',
            'img_src' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'label.required' => 'Le libellé du menu est obligatoire.',
            'slug.required' => 'Le slug est obligatoire.',
            'slug.unique' => 'Ce slug existe déjà. Veuillez en choisir un autre.',
            'url.required' => 'L\'URL est obligatoire.',
            'type.required' => 'Le type de menu est obligatoire.',
            'type.in' => 'Le type de menu doit être soit "link" soit "dropdown".',
        ];
    }
}
