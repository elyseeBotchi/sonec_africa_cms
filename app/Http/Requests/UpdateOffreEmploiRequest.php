<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateOffreEmploiRequest extends FormRequest
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
        // recupérer l'id de l'offre d'emploi à partir de la route
        // $offreEmploiId = $this->route('offre_emploi')->id;
        return [
            //
            'title' => 'filled|string|max:255',
            'description' => 'filled|string',
            'lieu' => 'filled|string|max:255',
            'type_contrat' => 'filled|string|max:255',
            'departement' => 'nullable|string|max:255',
            'niveau_experience' => 'nullable|string|max:255',
            'salaire' => 'nullable|string|max:255',
            'email_contact' => 'filled|email|max:255',
            'date_expiration' => 'filled|date',
            'bureau_pays_id' => 'filled|exists:bureau_pays,id',
            'status' => 'nullable|in:ouvert,ferme',
            'page_key' => 'nullable|string|max:255',
            'section_key' => 'nullable|string|max:255',
            'missions' => 'nullable|string',
            'profil_recherche' => 'nullable|string',
            'avantages' => 'nullable|string',
            'domaine' => 'nullable|string|max:255',
            'slug' => 'sometimes|string|max:255|unique:offre_emplois,slug,' . $this->route('offres_emploi')->id,
        ];
    }

    public function messages()
    {
        return [
            'title.filled' => 'Le titre de l\'offre d\'emploi est requis.',
            'description.filled' => 'La description de l\'offre d\'emploi est requise.',
            'lieu.filled' => 'Le lieu de travail est requis.',
            'type_contrat.filled' => 'Le type de contrat est requis.',
            'email_contact.filled' => 'L\'email de contact est requis.',
            'email_contact.email' => 'L\'email de contact doit être une adresse email valide.',
            'date_expiration.filled' => 'La date d\'expiration est requise.',
            'date_expiration.date' => 'La date d\'expiration doit être une date valide.',
            'bureau_pays_id.filled' => 'Le bureau/pays associé à l\'offre d\'emploi est requis.',
            'bureau_pays_id.exists' => 'Le bureau/pays sélectionné n\'existe pas.',
        ];
    }
}
