<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolutionSection extends Model
{
    //
    protected $fillable = [
        'title',
        'subtitle',
        'content',
        'image',
        'image_url',
        'cta_label',
        'cta_url',
        'icon',
        'icon_url',
        'solution_id',
        'section_key',
        'page_key',
    ];

    public function solution()
    {
        return $this->belongsTo(Solution::class);
    }
}
