<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certfication extends Model
{
    //
    protected $fillable = [
        'label', 'description', 'icon', 'icon_url', 'page_key', 'section_key'
    ];
}
