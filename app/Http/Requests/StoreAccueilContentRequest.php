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
