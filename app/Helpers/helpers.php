<?php

// Fonction globale pour récuperer les menus et sous-menus actifs pour le site web
if (!function_exists('get_menu')) {
    function get_menu($position = null)
    {
        $query = \App\Models\Menu::with('children','sidebar')->where('is_active', true)
        ->where('slug', '!=', 'accueil')                            
        ->whereNull('parent_id');

        if ($position) {            
            $query->where('position', $position);
        }

        return $query->orderBy('position')->get();
    }
    
}

// Fonction globale pour récuperer les paramètres généraux du site
if (!function_exists('get_general_settings')) {
    function get_general_settings()
    {
        return \App\Models\GeneralSetting::first();
    }
}

