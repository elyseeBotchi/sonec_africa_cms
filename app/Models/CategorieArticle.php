<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CategorieArticle extends Model
{
    protected $table = 'categorie_articles';
    protected $fillable = ['label','slug','page_key'];

    public function articles()
    {
        return $this->hasMany(Article::class,'category_id');
    }
}