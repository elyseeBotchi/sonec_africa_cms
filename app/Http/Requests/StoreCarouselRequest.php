<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreCarouselRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'cta_label' => 'nullable|string|max:255',
            'cta_url' => 'nullable|url|max:255',
            'image' => 'nullable|image|max:2048',
            'position' => 'nullable|integer',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Le titre est requis.',
            'title.string' => 'Le titre doit être une chaîne de caractères.',
            'title.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'subtitle.string' => 'Le sous-titre doit être une chaîne de caractères.',
            'subtitle.max' => 'Le sous-titre ne doit pas dépasser 255 caractères.',
            'description.string' => 'La description doit être une chaîne de caractères.',
            'cta_label.string' => 'Le label du CTA doit être une chaîne de caractères.',
            'cta_label.max' => 'Le label du CTA ne doit pas dépasser 255 caractères.',
            'cta_url.url' => "L'URL du CTA doit être une URL valide.",
            'cta_url.max' => "L'URL du CTA ne doit pas dépasser 255 caractères.",
            'image.image' => "Le fichier doit être une image.",
            'image.max' => "L'image ne doit pas dépasser 2 Mo.",
            'position.integer' => "La position doit être un entier.",
        ];
    }
}
