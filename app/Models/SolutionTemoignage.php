<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolutionTemoignage extends Model
{
    //
    protected $fillable = [
        'author_name',
        'author_position',
        'content',
        'author_photo',
        'author_photo_url',
        'solution_id',
        'section_key',
        'page_key',
        'author_location',
    ];

    public function solution()
    {
        return $this->belongsTo(Solution::class);
    }
}
