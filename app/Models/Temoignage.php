<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Temoignage extends Model
{
    //
    protected $fillable = [
        'name',
        'position',
        'company',
        'photo_url',
        'photo',
        'message',
        'page_key',
    ];
}
