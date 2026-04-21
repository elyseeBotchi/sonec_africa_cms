<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecteurExpertiseSeo extends Model
{
    protected $fillable = [
        'secteur_expertise_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'section_key',
        'page_key',
    ];

    public function secteurExpertise()
    {
        return $this->belongsTo(SecteurExpertise::class);
    }
}
