<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BureauPays extends Model
{
    //
    protected $table = 'bureau_pays';

    protected $fillable = [
        'pays',
        'adresse',
        'ville',
        'code_pays',
        'telephone',
        'email',
        'latitude',
        'longitude',
        'image',
        'slug',
        'representant',
        'maps_url',
        'page_key',
        'section_key',
        'image_url',
        'type_bureau',
    ];

    public function offreEmplois()
    {
        return $this->hasMany(OffreEmploi::class, 'bureau_pays_id');
    }
}
