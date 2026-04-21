<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreSolutionPageRequest extends FormRequest
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

            'avantages' => 'nullable|array',
            'avantages.*.id' => 'nullable|exists:section_items,id',
            'avantages.*.title' => 'nullable|string',
            'avantages.*.description' => 'nullable|string',
            // 'avantages.*.image_url' => 'nullable|string',
            // 'avantages.*.image' => 'nullable|image|max:2048',
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
            'accroche_id'=> 'nullable|exists:accroches,id',

            // Banniere
            'banniere_title' => 'nullable|string|max:255',
            'banniere_subtitle' => 'nullable|string',
            // 'banniere_description' => 'nullable|string',
            'banniere_cta_label' => 'nullable|string|max:255',
            'banniere_cta_url' => 'nullable|string|max:255',
            'banniere_image_url' => 'nullable|string|max:255',
            'banniere_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'banniere_section_key' => 'nullable|string|max:255',
            'banniere_id' => 'nullable|exists:banniere_heroes,id',

            // SEO
            'seo_title' => 'nullable|string|max:255',
            'seo_description' => 'nullable|string',
            'seo_keywords' => 'nullable|string|max:255',
            'seo_page_key' => 'required|string|max:255',
            'seo_id' => 'nullable|exists:seos,id',
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
