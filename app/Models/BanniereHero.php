<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BanniereHero extends Model
{
    //
    protected $fillable = [
        'title',
        'subtitle',
        'description',
        'image_url',
        'cta_label',
        'cta_url',
        'page_key',
        'section_key',
    ];
}
