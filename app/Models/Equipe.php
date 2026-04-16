<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipe extends Model
{
    //
    protected $fillable = [
        'name',
        'role',
        'description',
        'photo_url',
        'photo',
        'linkedin_url',
        'twitter_url',
        'facebook_url',
        'instagram_url',
        'page_key',
        'section_key',
    ];
}
