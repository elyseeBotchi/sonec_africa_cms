<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historique extends Model
{
    //
    protected $fillable = [
        'title',
        'annee',
        'description',
        'image',
        'image_url',
        'page_key',
        'section_key',
    ];
}
