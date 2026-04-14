<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAccueilContentRequest extends FormRequest
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
            'accroche_title' => 'nullable|string|max:255',
            'accroche_subtitle' => 'nullable|string|max:255',
            'accroche_description' => 'nullable|string',
            'accroche_cta_label' => 'nullable|string|max:255',
            'accroche_cta_url' => 'nullable|string|max:255',
            'accroche_page_key' => 'required|string|max:255',
            // 'about_title' => 'nullable|string|max:255',
            // 'about_subtitle' => 'nullable|string|max:255',
            // 'about_description' => 'nullable|string',
            // 'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',

            // SEO
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string|max:255',
            'seo_page_key' => 'required|string|max:255',

            // Carousel
            'carousels' => 'nullable|array',
            'carousels.*.id' => 'nullable|exists:carousels,id',
            'carousels.*.title' => 'nullable|string|max:255',
            'carousels.*.subtitle' => 'nullable|string|max:255',
            'carousels.*.description' => 'nullable|string',
            'carousels.*.cta_label' => 'nullable|string|max:255',
            'carousels.*.cta_url' => 'nullable|string|max:255',
            'carousels.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'carousels.*.image_url' => 'nullable|string|max:255',

            // Services
            'services' => 'nullable|array',
            'services.*.id' => 'nullable|exists:services,id',
            'services.*.title' => 'nullable|string|max:255',
            'services.*.description' => 'nullable|string',
            'services.*.icon' => 'nullable|string|max:255',

            // Presentation entreprise
            'about_title' => 'nullable|string|max:255',
            'about_subtitle' => 'nullable|string|max:255',
            'about_description' => 'nullable|string',
            'about_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'about_page_key' => 'required|string|max:255',
            'about_annees_experience' => 'nullable|string|max:255',
            'about_clients' => 'nullable|string|max:255',
            'about_pays' => 'nullable|string|max:255',
            'about_image_url' => 'nullable|string|max:255',
            'about_cta_label' => 'nullable|string|max:255',
            'about_cta_url' => 'nullable|string|max:255',

            // Partenaires
            'partenaires' => 'nullable|array',
            'partenaires.*.id' => 'nullable|exists:partenaires,id',
            'partenaires.*.name' => 'nullable|string|max:255',
            'partenaires.*.logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'partenaires.*.logo_url' => 'nullable|string|max:255',
            'partenaires.*.url' => 'nullable|url|max:255',
            'partenaires.*.page_key' => 'nullable|string|max:255',

            // Témoignages
            'temoignages' => 'nullable|array',
            'temoignages.*.id' => 'nullable|exists:temoignages,id',
            'temoignages.*.name' => 'nullable|string|max:255',
            'temoignages.*.position' => 'nullable|string|max:255',
            'temoignages.*.message' => 'nullable|string',
            'temoignages.*.photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'temoignages.*.photo_url' => 'nullable|string|max:255',
            // 'temoignages.*.note' => 'nullable|integer|min:1|max:5',
            'temoignages.*.page_key' => 'nullable|string|max:255',
            'temoignages.*.company' => 'nullable|string|max:255',

            // Clients
            'clients' => 'nullable|array',
            'clients.*.id' => 'nullable|exists:clients,id',
            'clients.*.name' => 'nullable|string|max:255',
            'clients.*.logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'clients.*.logo_url' => 'nullable|string|max:255',
            'clients.*.url' => 'nullable|url|max:255',
            'clients.*.page_key' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Le champ :attribute est obligatoire.',
            'string' => 'Le champ :attribute doit être une chaîne de caractères.',
            'max' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
            'url' => 'Le champ :attribute doit être une URL valide.',
            'image' => 'Le champ :attribute doit être une image.',
            'mimes' => 'Le champ :attribute doit être un fichier de type: :values.',
        ];
    }
}
