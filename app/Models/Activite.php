<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activite extends Model
{
    //
    protected $fillable = [
        'user_id', 'action', 'description', 'title', 'data',
        'ip_address', 'user_agent', 'url',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
