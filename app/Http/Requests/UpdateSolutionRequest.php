<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSolutionRequest extends FormRequest
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
            'infos_section_key' => 'nullable|string|max:255',
            'page_key' => 'nullable|string|max:255',
            'infos_title' => 'nullable|string|max:255',
            'infos_subtitle' => 'nullable|string|max:255',
            'infos_resume_solution' => 'nullable|string',
            'infos_slug_solution' => ['nullable', 'string', 'max:255', \Illuminate\Validation\Rule::unique('solutions', 'slug')->ignore($this->route('solution'))],
            'infos_contact_email_solution' => 'nullable|email|max:255',
            'infos_contact_phone_solution' => 'nullable|string|max:20',
            'infos_cible_solution' => 'nullable|string',
            'infos_description_solution' => 'nullable|string',
            'infos_disponibilite_solution' => 'nullable|string|max:255',
            'infos_mis_avant_solution' => 'nullable|boolean',
            'infos_image_couverture_solution' => 'nullable',
            'infos_image_url_solution' => 'nullable|url',
            'infos_cta_label' => 'nullable|string|max:255',
            'infos_cta_url' => 'nullable|string',
            'infos_icon' => 'nullable|string',
            'infos_icon_url' => 'nullable|string',

            // Accroche
            'accroche_title' => 'nullable|string|max:255',
            'accroche_subtitle' => 'nullable|string|max:255',
            'accroche_description' => 'nullable|string',
            'accroche_cta_label' => 'nullable|string|max:255',
            'accroche_cta_url' => 'nullable|string|max:255',
            'accroche_section_key' => 'nullable|string|max:255',
            'accroche_page_key' => 'nullable|string|max:255',
            'accroche_id'=> 'nullable|exists:solution_accroches,id',

            // Fonctionnalités
            'fonctionnalites' => 'nullable|array',
            'fonctionnalites.*.id' => 'nullable|exists:solution_fonctionnalites,id',
            'fonctionnalites.*.title' => 'nullable|string|max:255',
            'fonctionnalites.*.description' => 'nullable|string',
            'fonctionnalites.*.icon' => 'nullable|string',
            // 'fonctionnalites.*.icon_url' => 'nullable|url',
            'fonctionnalites.*.section_key' => 'nullable|string|max:255',
            'fonctionnalites.*.page_key' => 'nullable|string|max:255',

            // Chiffres
            'chiffres' => 'nullable|array',
            'chiffres.*.id' => 'nullable|exists:solution_chiffres,id',
            'chiffres.*.label' => 'nullable|string|max:255',
            'chiffres.*.value' => 'nullable|string|max:255',
            'chiffres.*.icon' => 'nullable|string',
            'chiffres.*.description' => 'nullable|string',
            'chiffres.*.icon_url' => 'nullable|url',
            // 'chiffres.*.section_key' => 'nullable|string|max:255',
            'chiffres.*.page_key' => 'nullable|string|max:255',

            // Témoignages
            'temoignages'               => 'nullable|array',
            'temoignages.*.id'          => 'nullable|exists:solution_temoignages,id',
            'temoignages.*.author'      => 'nullable|string|max:255',
            'temoignages.*.company'     => 'nullable|string|max:255',
            'temoignages.*.position'    => 'nullable|string|max:255',
            'temoignages.*.content'     => 'nullable|string',
            'temoignages.*.photo'       => 'nullable|file|mimes:jpeg,png,jpg,gif,webp|max:2048',
            'temoignages.*.photo_url'   => 'nullable|string|max:500',
            'temoignages.*.section_key' => 'nullable|string|max:255',
            'temoignages.*.page_key'    => 'nullable|string|max:255',
            'temoignages.*.author_location' => 'nullable|string|max:255',



            // Partenaires
            'partenaires' => 'nullable|array',
            'partenaires.*.id' => 'nullable|exists:solution_partenaires,id',
            'partenaires.*.name' => 'nullable|string|max:255',
            'partenaires.*.logo_url' => 'nullable|string|max:500',
            'partenaires.*.logo' => 'nullable',
            'partenaires.*.url' => 'nullable|string|max:500',
            'partenaires.*.section_key' => 'nullable|string|max:255',
            'partenaires.*.page_key' => 'nullable|string|max:255',

            // Personnalisation de sections
            'personnalisation_sections' => 'nullable|array',
            'personnalisation_sections.*.id' => 'nullable|exists:solution_sections,id',
            'personnalisation_sections.*.title' => 'nullable|string|max:255',
            'personnalisation_sections.*.content' => 'nullable|string',
            // 'personnalisation_sections.*.icon' => 'nullable|string',
            // 'personnalisation_sections.*.icon_url' => 'nullable|url',
            'personnalisation_sections.*.section_key' => 'nullable|string|max:255',
            'personnalisation_sections.*.page_key' => 'nullable|string|max:255',   

            // SEO
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string|max:255',
            'seo_page_key' => 'required|string|max:255',
            'og_title' => 'nullable|string|max:255',
            'og_description' => 'nullable|string',
            'og_image' => 'nullable|string',
            'og_image_url' => 'nullable|url',
            'twitter_title' => 'nullable|string|max:255',
            'twitter_description' => 'nullable|string',
            'twitter_image' => 'nullable|string',
            'twitter_image_url' => 'nullable|url',
            'seo_id' => 'nullable|exists:solution_seos,id',

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
 