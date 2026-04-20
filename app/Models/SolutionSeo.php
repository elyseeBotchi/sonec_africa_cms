<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolutionSeo extends Model
{
    //
    protected $fillable = [
        'solution_id',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'og_image_url',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'twitter_image_url',
    ];

    public function solution()
    {
        return $this->belongsTo(Solution::class);
    }
}
