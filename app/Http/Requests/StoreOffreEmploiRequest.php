<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreOffreEmploiRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'lieu' => 'required|string|max:255',
            'type_contrat' => 'required|string|max:255',
            'departement' => 'nullable|string|max:255',
            'niveau_experience' => 'nullable|string|max:255',
            'salaire' => 'nullable|string|max:255',
            'email_contact' => 'required|email|max:255',
            'date_expiration' => 'required|date',
            'bureau_pays_id' => 'required|exists:bureau_pays,id',
            'status' => 'nullable|in:ouvert,ferme',
            'page_key' => 'nullable|string|max:255',
            'section_key' => 'nullable|string|max:255',
            'missions' => 'nullable|string',
            'profil_recherche' => 'nullable|string',
            'avantages' => 'nullable|string',
            'domaine' => 'nullable|string|max:255',
            'slug' => 'nullable|string|max:255|unique:offre_emplois,slug',
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Le titre de l\'offre d\'emploi est requis.',
            'description.required' => 'La description de l\'offre d\'emploi est requise.',
            'lieu.required' => 'Le lieu de travail est requis.',
            'type_contrat.required' => 'Le type de contrat est requis.',
            'email_contact.required' => 'L\'email de contact est requis.',
            'email_contact.email' => 'L\'email de contact doit être une adresse email valide.',
            'date_expiration.required' => 'La date d\'expiration est requise.',
            'date_expiration.date' => 'La date d\'expiration doit être une date valide.',
            'bureau_pays_id.required' => 'Le bureau/pays associé à l\'offre d\'emploi est requis.',
            'bureau_pays_id.exists' => 'Le bureau/pays sélectionné n\'existe pas.',
            'status.in' => 'Le statut doit être soit "ouvert" soit "fermé".',
            'slug.unique' => 'Le slug doit être unique. Un autre offre d\'emploi utilise déjà ce slug.',
        ];
    }
}
