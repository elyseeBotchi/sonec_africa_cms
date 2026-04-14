<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PresentationEntreprise extends Model
{
    //
    protected $fillable = [
        'title', 'description', 'image_url', 'cta_label', 'cta_url','icon','annees_experience','clients','pays','page_key','image','subtitle'
    ];
}
