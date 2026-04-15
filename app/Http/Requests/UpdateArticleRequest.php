<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'title' => 'filled|string',
            'slug' => 'sometimes|string|max:255', 
            'user_id' => 'filled|exists:users,id',
            'content' => 'nullable',
            'image_url' => 'nullable|url',
            'image_article' => 'nullable|string',
            'page_key' => 'nullable|string|max:255',
            'category_id' => 'filled|exists:categorie_articles,id',
            'temps_lecture' => 'filled|string|max:255',
            'is_published' => 'sometimes|boolean',
            'activer_partage_reseaux_sociaux' => 'sometimes|boolean',
            'author' => 'filled|string|max:255',
            'description_courte' => 'nullable',
            'notes' => 'nullable|string|max:255',
            'position_auteur' => 'nullable|string|max:255',
            'photo_auteur' => 'nullable|string',
            'photo_auteur_url' => 'nullable|string',
            'published_at' => 'nullable|date',
            'tags' => 'nullable', 'array',
            'tags.*' => 'integer', 'exists:tags,id',
            'a_la_une' => 'nullable|boolean',

        ];
    }

    public function messages(): array
    {
        return [
            'title.filled' => 'Le titre est obligatoire.',
            // 'title.max' => 'Le titre ne doit pas dépasser 255 caractères.',
            // 'slug.filled' => 'Le slug est obligatoire.',
            // 'slug.unique' => 'Ce slug est déjà utilisé.',
            'user_id.filled' => 'L\'utilisateur est obligatoire.',
            'user_id.exists' => 'L\'utilisateur sélectionné est invalide.',
            'category_id.filled' => 'La catégorie est obligatoire.',
            'category_id.exists' => 'La catégorie sélectionnée est invalide.',
            'temps_lecture.filled' => 'Le temps de lecture est obligatoire.',
            // 'temps_lecture.integer' => 'Le temps de lecture doit être un nombre.',
            // 'temps_lecture.min' => 'Le temps de lecture doit être supérieur à 0.',
            // 'is_published.filled' => 'Le statut de publication est obligatoire.',
            'is_published.boolean' => 'Le statut de publication est invalide.',
            'activer_partage_reseaux_sociaux.filled' => 'Le partage sur les réseaux sociaux est obligatoire.',
            'activer_partage_reseaux_sociaux.boolean' => 'La valeur du partage est invalide.',
            'author.filled' => 'L\'auteur est obligatoire.',
            'image_url.url' => 'Le lien de l\'image doit être une URL valide.',
            'published_at.date' => 'La date de publication est invalide.',
            'tags.array' => 'Les tags doivent être envoyés sous forme de liste.',
            'tags.*.integer' => 'Chaque tag doit être un identifiant valide.',
            'tags.*.exists' => 'Un ou plusieurs tags sélectionnés sont invalides.',
        ];
    }
}
