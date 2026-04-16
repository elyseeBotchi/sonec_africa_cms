<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionPage extends Model
{
    //
    protected $fillable = [
        'page_key', 'section_key', 'title', 'subtitle', 'description', 'cta_label', 'cta_url', 'accroche_text', 'image', 'image_url', 'icon', 'icon_url'
    ];
}
