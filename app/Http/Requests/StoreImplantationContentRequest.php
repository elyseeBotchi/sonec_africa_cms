<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreImplantationContentRequest extends FormRequest
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
            // section bureaux
            'bureaux' => 'nullable|array',
            'bureaux.*.id' => 'nullable|exists:bureau_pays,id',
            'bureaux.*.pays' => 'nullable|string|max:255',
            'bureaux.*.adresse' => 'nullable|string|max:255',
            'bureaux.*.ville' => 'nullable|string|max:255',
            'bureaux.*.code_pays' => 'nullable|string|max:10',
            'bureaux.*.telephone' => 'nullable|string|max:20',
            'bureaux.*.email' => 'nullable|email|max:255',
            'bureaux.*.latitude' => 'nullable|numeric',
            'bureaux.*.longitude' => 'nullable|numeric',
            'bureaux.*.image' => 'nullable|image|max:2048',
            'bureaux.*.image_url' => 'nullable|string|max:255',
            'bureaux.*.representant' => 'nullable|string|max:255',
            'bureaux.*.maps_url' => 'nullable|string|max:255',
            'bureaux.*.section_key' => 'nullable|string|max:255',
            'bureaux.*.page_key' => 'nullable|string|max:255',
            'bureaux.*.type_bureau' => 'nullable|string|max:255',

            // accroche
            'accroche_title' => 'nullable|string',
            'accroche_subtitle' => 'nullable|string',
            'accroche_description' => 'nullable|string',
            'accroche_cta_label' => 'nullable|string',
            'accroche_cta_url' => 'nullable|string',
            'accroche_section_key' => 'nullable|string|max:255',

            // chiffres
            'chiffres' => 'nullable|array',
            'chiffres.*.id' => 'nullable|exists:chiffres,id',
            'chiffres.*.label' => 'nullable|string',
            'chiffres.*.value' => 'nullable|string',
            'chiffres.*.description' => 'nullable|string',
            'chiffres.*.icon' => 'nullable|string|max:255',
            'chiffres.*.section_key' => 'nullable|string|max:255',
            'chiffres.*.page_key' => 'nullable|string|max:255',

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

            // section premiere
            'section_premiere_title' => 'nullable|string|max:255',
            'section_premiere_subtitle' => 'nullable|string|max:255',
            'section_premiere_description' => 'nullable|string',
            'section_premiere_cta_label' => 'nullable|string|max:255',
            'section_premiere_cta_url' => 'nullable|string',
            'section_premiere_image_url' => 'nullable|string',
            'section_premiere_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'section_premiere_section_key' => 'nullable|string|max:255',    

            // section about
            'about_title' => 'nullable|string|max:255',
            'about_subtitle' => 'nullable|string|max:255',
            'about_description' => 'nullable|string',
            'about_cta_label' => 'nullable|string|max:255',
            'about_cta_url' => 'nullable|string',
            'about_image_url' => 'nullable|string',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about_section_key' => 'nullable|string|max:255',
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
