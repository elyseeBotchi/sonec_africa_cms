<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    //
    protected $fillable = [
        'label', 'slug', 'url', 'icon', 'parent_id', 'position', 'is_active', 'is_external', 'image', 'type', 'description','img_src'
    ];

    // Menu parent (Menu principal si parent_id est null)
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    // Sous-menus (enfants) seront afficher dans le menu deroulant mega menu
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->orderBy('position');
    }

    // Fonction pour récuperer l'url de l'image du menu
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return null;
    }

    // espacement entre les sousmenus
    public function espacement()
    {
        return $this->hasOne(EspacementMenu::class, 'menu_id');
    }

    public function sidebar()
    {
        return $this->hasOne(SidebarMenu::class, 'menu_id');
    }
}


