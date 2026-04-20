<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolutionChiffre extends Model
{
    //
    protected $fillable = [
        'label',
        'value',
        'description',
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
