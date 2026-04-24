<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    //
    protected $fillable = [
        'title',
        'resume',
        'description',
        'image',
        'slug',
        'mis_avant',
        'icon',
        'url',
        'image_url',
        'video_url',
        'video',
        'cible',
        'contact_email',
        'contact_phone',
        'nombre_demande_demo',
        'page_key',
        'disponibilite',
        'subtitle',
    ];


    public function sections()
    {
        return $this->hasMany(SolutionSection::class);
    }

    public function partenaires()
    {
        return $this->hasMany(SolutionPartenaire::class);
    }

    public function chiffres()
    {
        return $this->hasMany(SolutionChiffre::class);
    }

    public function fonctionnalites()
    {
        return $this->hasMany(SolutionFonctionnalite::class);
    }

    public function temoignages()
    {
        return $this->hasMany(SolutionTemoignage::class);
    }

    public function accroche()
    {
        return $this->hasOne(SolutionAccroche::class);
    }

    public function seo()
    {
        return $this->hasOne(SolutionSeo::class);
    }

}
