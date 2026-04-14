<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Carousel extends Model
{
    //
    protected $fillable = [
        'title', 'subtitle', 'description', 'cta_label', 'cta_url', 'image', 'position','image_url'
    ];
}
