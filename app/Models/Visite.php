<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    //
    protected $fillable = [
        'ip_address', 'url', 'page_title', 'user_agent',
        'country', 'city', 'device', 'browser', 'os',
        'referer', 'user_id', 'is_unique',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Visites du jour
    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    // Visites uniques
    public function scopeUnique($query)
    {
        return $query->where('is_unique', true);
    }
}
