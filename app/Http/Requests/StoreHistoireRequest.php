<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreHistoireRequest extends FormRequest
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
            'page_key' => 'required|string|max:255',
            //section premiere
            'section_premiere_title' => 'nullable|string',
            'section_premiere_subtitle' => 'nullable|string',
            'section_premiere_description' => 'nullable|string',
            'section_premiere_cta_label' => 'nullable|string',
            'section_premiere_cta_url' => 'nullable|string',
            'section_premiere_image_url' => 'nullable|string',
            'section_premiere_image' => 'nullable|image|max:2048',

            // accroche
            'accroche_title' => 'nullable|string',
            'accroche_subtitle' => 'nullable|string',
            'accroche_description' => 'nullable|string',
            'accroche_cta_label' => 'nullable|string',
            'accroche_cta_url' => 'nullable|string',
            'accroche_section_key' => 'nullable|string|max:255',
            // 'accroche_page_key' => 'nullable|string|max:255',

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

            // histoire
            'historiques' => 'nullable|array',
            'historiques.*.id' => 'nullable|exists:historiques,id',
            'historiques.*.title' => 'nullable|string',
            'historiques.*.annee' => 'nullable|string',
            'historiques.*.description' => 'nullable|string',
            'historiques.*.image_url' => 'nullable|string',
            'historiques.*.image' => 'nullable|image|max:2048',
            'historiques.*.section_key' => 'nullable|string|max:255',
            'historiques.*.page_key' => 'nullable|string|max:255',

            // banniere
            'banniere_title' => 'nullable|string|max:255',
            'banniere_subtitle' => 'nullable|string|max:255',
            // 'banniere_description' => 'nullable|string',
            'banniere_cta_label' => 'nullable|string|max:255',
            'banniere_cta_url' => 'nullable|string',
            'banniere_image_url' => 'nullable|string',
            'banniere_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banniere_section_key' => 'nullable|string|max:255',
            // 'banniere_page_key' => 'nullable|string|max:255',

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
        ];
    }
}
