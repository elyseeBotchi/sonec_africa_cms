<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSecteurExpertiseRequest extends FormRequest
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
            'secteur_expertise_section_key' => 'nullable|string|max:255',
            'page_key' => 'nullable|string|max:255',
            'secteur_expertise_name' => 'required|string|max:255',
            'secteur_expertise_title_hero' => 'nullable|string|max:255',
            'secteur_expertise_subtitle' => 'nullable|string|max:255',
            'secteur_expertise_resume' => 'nullable|string',
            'secteur_expertise_slug' => ['nullable', 'string', 'max:255', \Illuminate\Validation\Rule::unique('solutions', 'slug')->ignore($this->route('solution'))],
            'secteur_expertise_contact_email' => 'nullable|email|max:255',
            'secteur_expertise_contact_phone' => 'nullable|string|max:20',
            'secteur_expertise_description' => 'nullable|string',
            'secteur_expertise_mis_avant' => 'nullable|boolean',
            'secteur_expertise_image_couverture' => 'nullable',
            'secteur_expertise_image_url' => 'nullable|url',
            'secteur_expertise_cta_label_1' => 'nullable|string|max:255',
            'secteur_expertise_cta_url_1' => 'nullable|string',
            'secteur_expertise_cta_label_2' => 'nullable|string|max:255',
            'secteur_expertise_cta_url_2' => 'nullable|string',
            'secteur_expertise_icon' => 'nullable|string',
            'secteur_expertise_icon_url' => 'nullable|string',
            

            // Accroche
            'accroche_title' => 'nullable|string|max:255',
            'accroche_subtitle' => 'nullable|string|max:255',
            'accroche_description' => 'nullable|string',
            'accroche_cta_label' => 'nullable|string|max:255',
            'accroche_cta_url' => 'nullable|string|max:255',
            'accroche_section_key' => 'nullable|string|max:255',
            'accroche_page_key' => 'nullable|string|max:255',

         
            // Chiffres
            'chiffres' => 'nullable|array',
            'chiffres.*.label' => 'nullable|string|max:255',
            'chiffres.*.value' => 'nullable|string|max:255',
            'chiffres.*.description' => 'nullable|string',
            'chiffres.*.icon' => 'nullable|string',
            'chiffres.*.icon_url' => 'nullable|url',
            'chiffres.*.page_key' => 'nullable|string|max:255',

            // Partenaires
            'partenaires' => 'nullable|array',
            'partenaires.*.name' => 'nullable|string|max:255',
            'partenaires.*.logo' => 'nullable|string',
            'partenaires.*.logo_url' => 'nullable|url',
            'partenaires.*.section_key' => 'nullable|string|max:255',
            'partenaires.*.page_key' => 'nullable|string|max:255',

            // Personnalisation sections dynamiques
            'personnalisation_sections' => 'nullable|array',
            'personnalisation_sections.*.title' => 'nullable|string|max:255',
            'personnalisation_sections.*.content' => 'nullable|string',
            'personnalisation_sections.*.page_key' => 'nullable|string|max:255',

            // SEO
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string|max:255',
            'seo_page_key' => 'required|string|max:255',
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
            'array' => 'Le champ :attribute doit être un tableau.',
            'email' => 'Le champ :attribute doit être une adresse email valide.',
        ];
    }
}
