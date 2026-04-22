<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreDecouvrirSonecRequest extends FormRequest
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
            // 'section_key' => ['required', 'string', 'max:255'],
            'page_key' => 'required|string|max:255',
            'vision_title' => 'nullable|string',
            'vision_description' => 'nullable|string',
            'vision_image_url' => 'nullable|string',
            'vision_image' => 'nullable|image|max:2048',
            'vision_subtitle' => 'nullable|string',
            'vision_cta_label' => 'nullable|string',
            'vision_cta_url' => 'nullable|string',

            // Piliers
            'piliers' => 'nullable|array',
            'piliers.*.id' => 'nullable|exists:section_pages,id',
            'piliers.*.title' => 'nullable|string',
            'piliers.*.description' => 'nullable|string',
            // 'piliers.*.image_url' => 'nullable|string',
            // 'piliers.*.image' => 'nullable|image|max:2048',
            'piliers.*.subtitle' => 'nullable|string',
            // 'piliers.*.cta_label' => 'nullable|string',
            // 'piliers.*.cta_url' => 'nullable|string',
            'piliers.*.section_key' => 'nullable|string|max:255',
            'piliers.*.icon' => 'nullable|string|max:255',

            // Chiffres
            'chiffres'=> 'nullable|array',
            'chiffres.*.id' => 'nullable|exists:chiffres,id',
            'chiffres.*.label' => 'nullable|string',
            'chiffres.*.value' => 'nullable|string',
            'chiffres.*.description' => 'nullable|string',
            'chiffres.*.section_key' => 'nullable|string|max:255',
            'chiffres.*.icon' => 'nullable|string|max:255', 

            // Engagements
            'engagement_title' => 'nullable|string',
            'engagement_description' => 'nullable|string',
            'engagement_image_url' => 'nullable|string',
            'engagement_image' => 'nullable|image|max:2048',
            'engagement_section_key' => 'nullable|string|max:255',

            // Engagements items
            'engagements' => 'nullable|array',
            'engagements.*.id' => 'nullable|exists:section_items,id',
            'engagements.*.label' => 'nullable|string',
            'engagements.*.description' => 'nullable|string',
            // 'engagements.*.image_url' => 'nullable|string',
            // 'engagements.*.image' => 'nullable|image|max:2048',
            'engagements.*.section_key' => 'nullable|string|max:255',
            'engagements.*.icon' => 'nullable|string|max:255',

            // Accroche
            'accroche_title' => 'nullable|string|max:255',
            'accroche_subtitle' => 'nullable|string|max:255',
            'accroche_description' => 'nullable|string',
            'accroche_cta_label' => 'nullable|string|max:255',
            'accroche_cta_url' => 'nullable|string|max:255',
            'accroche_section_key' => 'nullable|string|max:255',
            'accroche_page_key' => 'nullable|string|max:255',

            // Banniere
            'banniere_title' => 'nullable|string|max:255',
            'banniere_subtitle' => 'nullable|string|max:255',
            // 'banniere_description' => 'nullable|string',
            'banniere_cta_label' => 'nullable|string|max:255',
            'banniere_cta_url' => 'nullable|string|max:255',
            'banniere_image_url' => 'nullable|string|max:255',
            'banniere_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banniere_section_key' => 'nullable|string|max:255',

            // SEO
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string|max:255',
            'seo_page_key' => 'required|string|max:255',

            // Approches et certifications
            'approches' => 'nullable|array',
            'approches.*.id' => 'nullable|exists:section_pages,id',
            'approches.*.title' => 'nullable|string|max:255',
            'approches.*.description' => 'nullable|string',
            // 'approches.*.image_url' => 'nullable|string|max:255',
            // 'approches.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'approches.*.section_key' => 'required|string|max:255',
            // 'approches.*.icon' => 'nullable|string|max:255',

            'certifications' => 'nullable|array',
            'certifications.*.id' => 'nullable|exists:certfications,id',
            'certifications.*.label' => 'nullable|string|max:255',
            'certifications.*.description' => 'nullable|string',
            // 'certifications.*.image_url' => 'nullable|string|max:255',
            // 'certifications.*.image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'certifications.*.section_key' => 'nullable|string|max:255',
            'certifications.*.icon' => 'nullable|string|max:255',
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
