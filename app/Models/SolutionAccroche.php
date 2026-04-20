<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolutionAccroche extends Model
{
    //
    protected $fillable = [
        'title',
        'content',
        'solution_id',
        'image',
        'image_url',
        'cta_label',
        'cta_url',
        'icon',
        'icon_url',
        'section_key',
        'page_key',
    ];

    public function solution()
    {
        return $this->belongsTo(Solution::class);
    }
}
