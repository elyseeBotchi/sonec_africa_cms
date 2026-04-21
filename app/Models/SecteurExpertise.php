<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SecteurExpertise extends Model
{
    protected $fillable = [
        'name',
        'title_hero',
        'subtitle_hero',
        'slug',
        'cta_label_1',
        'cta_url_1',
        'cta_label_2',
        'cta_url_2',
        'image',
        'image_url',
        'icon',
        'contact_email',
        'contact_phone',
        'resume',
        'description',
        'mis_avant',
        'demande_demo',
        'section_key',
        'page_key'
    ];

    public function accroche()
    {
        return $this->hasOne(SecteurExpertiseAccroche::class);
    }

    public function sections()
    {
        return $this->hasMany(SecteurExpertiseSection::class);
    }

    public function partenaires()
    {
        return $this->hasMany(SecteurExpertisePartenaire::class);
    }

    public function seo()
    {
        return $this->hasOne(SecteurExpertiseSeo::class);
    }

    public function chiffres()
    {
        return $this->hasMany(SecteurExpertiseChiffre::class);
    }
}
