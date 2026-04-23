<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreGeneralSettingRequest extends FormRequest
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
            'site_name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'contact_email' => 'nullable|email|max:255',
            'contact_phone' => 'nullable|string|max:20',
            'contact_address' => 'nullable|string|max:255',
            'meta_title' => 'nullable|string|max:255',
            'meta_keywords' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'site_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'site_favicon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,ico|max:1024',
            'logo_footer' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_text' => 'nullable|string|max:255',
            'facebook_url' => 'nullable|string|max:255',
            'twitter_url' => 'nullable|string|max:255',
            'linkedin_url' => 'nullable|string|max:255',
            'instagram_url' => 'nullable|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'site_name.required' => 'Le champ nom du site est obligatoire.',
            'site_name.string' => 'Le champ nom du site doit être une chaîne de caractères.',
            'site_name.max' => 'Le champ nom du site ne doit pas dépasser 255 caractères.',
            'description.string' => 'Le champ description doit être une chaîne de caractères.',
            'contact_email.email' => 'Le champ email de contact doit être une adresse email valide.',
            'contact_email.max' => 'Le champ email de contact ne doit pas dépasser 255 caractères.',
            'contact_phone.string' => 'Le champ téléphone de contact doit être une chaîne de caractères.',
            'contact_phone.max' => 'Le champ téléphone de contact ne doit pas dépasser 20 caractères.',
            'contact_address.string' => 'Le champ adresse de contact doit être une chaîne de caractères.',
            'contact_address.max' => 'Le champ adresse de contact ne doit pas dépasser 255 caractères.',
            'meta_title.string' => 'Le champ meta title doit être une chaîne de caractères.',
            'meta_title.max' => 'Le champ meta title ne doit pas dépasser 255 caractères.',
            'meta_keywords.string' => 'Le champ meta keywords doit être une chaîne de caractères.',
            'meta_keywords.max' => 'Le champ meta keywords ne doit pas dépasser 255 caractères.',
            'meta_description.string' => 'Le champ meta description doit être une chaîne de caractères.',
            'meta_description.max' => 'Le champ meta description ne doit pas dépasser 500 caractères.',
            'site_logo.image' => 'Le champ logo du site doit être une image valide.',
            'site_logo.mimes' => 'Le logo du site doit être au format jpeg, png, jpg, gif ou svg.',
            'site_logo.max' => 'La taille du logo du site ne doit pas dépasser 2048 Ko.',
            'site_favicon.image' => 'Le champ favicon du site doit être une image valide.',
            'site_favicon.mimes' => 'Le favicon du site doit être au format jpeg, png, jpg, gif, svg ou ico.',
            'site_favicon.max' => 'La taille du favicon du site ne doit pas dépasser 1024 Ko.',
            'logo_footer.image' => 'Le champ logo du footer doit être une image valide.',
            'logo_footer.mimes' => 'Le logo du footer doit être au format jpeg, png, jpg, gif ou svg.',
            'logo_footer.max' => 'La taille du logo du footer ne doit pas dépasser 2048 Ko.',
        ];
    }
}
