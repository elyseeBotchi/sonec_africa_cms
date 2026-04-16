<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chiffre extends Model
{
    //
    protected $fillable = [
        'label', 'value', 'description', 'icon', 'icon_url', 'page_key', 'section_key'
    ];
}
