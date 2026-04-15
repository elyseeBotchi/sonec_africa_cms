<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
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
            'title' => 'required|string',
            'slug' => 'required|string|max:255|unique:articles,slug', 
            'user_id' => 'required|exists:users,id',
            'content' => 'nullable',
            'image_url' => 'nullable|url',
            'image_article' => 'nullable|string',
            'page_key' => 'nullable|string|max:255',
            'category_id' => 'required|exists:categorie_articles,id',
            'temps_lecture' => 'required|string|max:255',
            'is_published' => 'required|boolean',
            'a_la_une' => 'nullable|boolean',
            'activer_partage_reseaux_sociaux' => 'required|boolean',
            'author' => 'required|string|max:255',
            'description_courte' => 'nullable',
            'notes' => 'nullable|string|max:255',
            'position_auteur' => 'nullable|string|max:255',
            'photo_auteur' => 'nullable|string',
            'photo_auteur_url' => 'nullable|string',
            'published_at' => 'nullable|date',
            'tags' => 'nullable', 'array',
            'tags.*' => 'integer', 'exists:tags,id',

            

        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Le titre est obligatoire.',
            // 'title.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            'slug.required' => 'Le slug est obligatoire.',
            'slug.unique' => 'Ce slug est déjà utilisé.',
            'user_id.required' => 'L\'utilisateur est obligatoire.',
            'user_id.exists' => 'L\'utilisateur sélectionné est invalide.',
            'category_id.required' => 'La catégorie est obligatoire.',
            'category_id.exists' => 'La catégorie sélectionnée est invalide.',
            'temps_lecture.required' => 'Le temps de lecture est obligatoire.',
            // 'temps_lecture.integer' => 'Le temps de lecture doit être un nombre.',
            // 'temps_lecture.min' => 'Le temps de lecture doit être supérieur à 0.',
            'is_published.required' => 'Le statut de publication est obligatoire.',
            'is_published.boolean' => 'Le statut de publication est invalide.',
            'a_la_une.boolean' => 'Le statut "à la une" est invalide.',
            'activer_partage_reseaux_sociaux.required' => 'Le partage sur les réseaux sociaux est obligatoire.',
            'activer_partage_reseaux_sociaux.boolean' => 'La valeur du partage est invalide.',
            'author.required' => 'L\'auteur est obligatoire.',
            'image_url.url' => 'Le lien de l\'image doit être une URL valide.',
            'published_at.date' => 'La date de publication est invalide.',
            'tags.array' => 'Les tags doivent être envoyés sous forme de liste.',
            'tags.*.integer' => 'Chaque tag doit être un identifiant valide.',
            'tags.*.exists' => 'Un ou plusieurs tags sélectionnés sont invalides.',
        ];
    }


}
