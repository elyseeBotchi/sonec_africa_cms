<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accroche extends Model
{
    protected $fillable = [
        'title', 'subtitle', 'description', 'cta_label', 'cta_url','page_key'
    ];
}
