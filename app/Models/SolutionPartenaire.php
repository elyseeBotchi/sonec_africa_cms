<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SolutionPartenaire extends Model
{
    //
    protected $fillable = [
        'name',
        'logo',
        'website',
        'solution_id',
        'section_key',
        'page_key',
    ];

    public function solution()
    {
        return $this->belongsTo(Solution::class);
    }
}
