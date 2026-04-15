<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    //
    protected $fillable = [
        'title',
        'content',
        'image_url',
        'image_article',
        'slug',
        'page_key',
        'user_id',
        'category_id',
        'views',
        'temps_lecture',
        'published_at',
        'is_published',
        'activer_partage_reseaux_sociaux',
        'notes',
        'author',
        'description_courte',
        'position_auteur',
        'photo_auteur',
        'photo_auteur_url',
        'a_la_une',
        'position_auteur',
        'photo_auteur',
        'photo_auteur_url',

    ];

    protected $casts = [
        'is_published' => 'boolean',
        'activer_partage_reseaux_sociaux' => 'boolean',
        'a_la_une' => 'boolean',
        'published_at' => 'datetime',
    ];

    

    public function category()
    {
        return $this->belongsTo(CategorieArticle::class, 'category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'article_tags', 'article_id', 'tag_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
