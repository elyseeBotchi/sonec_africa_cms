<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecteurExpertiseAccroche extends Model
{
    //
    protected $fillable = [
        'secteur_expertise_id',
        'title',
        'subtitle',
        'content',
        'cta_label_1',
        'cta_url_1',
        'cta_label_2',
        'cta_url_2',
        'section_key',
        'page_key',
    ];

    public function secteurExpertise()
    {
        return $this->belongsTo(SecteurExpertise::class);
    }
}