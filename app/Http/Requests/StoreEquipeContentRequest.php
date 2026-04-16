<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreEquipeContentRequest extends FormRequest
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
            'page_key' => 'required|string|max:255',
            // section equipe
            'equipes' => 'nullable|array',
            'equipes.*.id' => 'nullable|exists:equipes,id',
            'equipes.*.name' => 'nullable|string|max:255',
            'equipes.*.role' => 'nullable|string|max:255',
            'equipes.*.description' => 'nullable|string',
            'equipes.*.linkedin_url' => 'nullable|max:255',
            'equipes.*.twitter_url' => 'nullable|max:255',
            'equipes.*.facebook_url' => 'nullable|max:255',
            'equipes.*.instagram_url' => 'nullable|max:255',
            'equipes.*.photo' => 'nullable|image|max:2048',
            'equipes.*.photo_url' => 'nullable|string|max:255',
            'equipes.*.section_key' => 'nullable|string|max:255',

            // accroche
            'accroche_title' => 'nullable|string',
            'accroche_subtitle' => 'nullable|string',
            'accroche_description' => 'nullable|string',
            'accroche_cta_label' => 'nullable|string',
            'accroche_cta_url' => 'nullable|string',
            'accroche_section_key' => 'nullable|string|max:255',

            // valeurs
            'valeurs' => 'nullable|array',
            'valeurs.*.id' => 'nullable|exists:section_pages,id',
            'valeurs.*.title' => 'nullable|string',
            'valeurs.*.description' => 'nullable|string',
            'valeurs.*.subtitle' => 'nullable|string',
            'valeurs.*.icon' => 'nullable|string|max:255',
            'valeurs.*.section_key' => 'nullable|string|max:255',
            'valeurs.*.page_key' => 'nullable|string|max:255',

            // chiffres
            'chiffres' => 'nullable|array',
            'chiffres.*.id' => 'nullable|exists:chiffres,id',
            'chiffres.*.label' => 'nullable|string',
            'chiffres.*.value' => 'nullable|string',
            'chiffres.*.description' => 'nullable|string',
            'chiffres.*.icon' => 'nullable|string|max:255',
            'chiffres.*.section_key' => 'nullable|string|max:255',
            'chiffres.*.page_key' => 'nullable|string|max:255',

            // gouvernances
            'gouvernances' => 'nullable|array',
            'gouvernances.*.id' => 'nullable|exists:section_pages,id',
            'gouvernances.*.title' => 'nullable|string',
            'gouvernances.*.description' => 'nullable|string',
            'gouvernances.*.subtitle' => 'nullable|string',
            'gouvernances.*.icon' => 'nullable|string|max:255',
            'gouvernances.*.section_key' => 'nullable|string|max:255',
            'gouvernances.*.page_key' => 'nullable|string|max:255',

            // banniere
            'banniere_title' => 'nullable|string|max:255',
            'banniere_subtitle' => 'nullable|string|max:255',
            // 'banniere_description' => 'nullable|string',
            'banniere_cta_label' => 'nullable|string|max:255',
            'banniere_cta_url' => 'nullable|string',
            'banniere_image_url' => 'nullable|string',
            'banniere_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banniere_section_key' => 'nullable|string|max:255',

            // SEO
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string|max:255',
            'seo_page_key' => 'required|string|max:255',

            // Chiffres vision
            'chiffres_vision' => 'nullable|array',
            'chiffres_vision.*.id' => 'nullable|exists:chiffres,id',
            'chiffres_vision.*.label' => 'nullable|string',
            'chiffres_vision.*.value' => 'nullable|string',
            'chiffres_vision.*.description' => 'nullable|string',
            'chiffres_vision.*.icon' => 'nullable|string|max:255',
            'chiffres_vision.*.section_key' => 'nullable|string|max:255',
            'chiffres_vision.*.page_key' => 'nullable|string|max:255',

            // Presentation
            'section_presentation_title' => 'nullable|string|max:255',
            'section_presentation_description' => 'nullable|string',
            'section_presentation_section_key' => 'nullable|string|max:255',

            // Vision - mot du président
            'vision_title' => 'nullable|string|max:255',
            'vision_description' => 'nullable|string',
            'vision_section_key' => 'nullable|string|max:255',

            // section premiere
            'section_premiere_title' => 'nullable|string|max:255',
            'section_premiere_description' => 'nullable|string',
            'section_premiere_cta_label' => 'nullable|string|max:255',
            'section_premiere_cta_url' => 'nullable|string',
            'section_premiere_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'section_premiere_image_url' => 'nullable|string',
            'section_premiere_section_key' => 'nullable|string|max:255',


        ];
    }

    public function messages()
    {
        return [
            'required' => 'Le champ :attribute est obligatoire.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'max' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
            'image' => 'Le champ :attribute doit être une image.',
            'mimes' => 'Le champ :attribute doit être une image de type :values.',
            'exists' => 'Le champ :attribute doit exister dans la base de données.',
            'url' => 'Le champ :attribute doit être une URL valide.',
        ];
    }
}
