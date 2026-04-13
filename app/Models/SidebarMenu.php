<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SidebarMenu extends Model
{
    //
    protected $fillable = [
        'menu_id', 'title', 'description', 'cta_label', 'cta_url', 'image','img_url'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
