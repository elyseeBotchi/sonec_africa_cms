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


// Fonction pour récuperer le contenu de la page d'accueil
if (!function_exists('get_accueil_content')) {
    function get_accueil_content()
    {
        // $accueilContent = \App\Models\AccueilContent::first();
        $presentationEntreprise = \App\Models\PresentationEntreprise::where('page_key', 'accueil')->first();
        $seo = \App\Models\Seo::where('page_key', 'accueil')->first();
        $carousels = \App\Models\Carousel::orderBy('created_at', 'desc')->get();
        $services = \App\Models\Service::orderBy('created_at', 'desc')->get();
        $accroche = \App\Models\Accroche::where('page_key', 'accueil')->first();
        $clients = \App\Models\Client::where('page_key', 'accueil')->orderBy('created_at', 'desc')->get();
        $temoignages = \App\Models\Temoignage::where('page_key', 'accueil')->orderBy('created_at', 'desc')->get();
        $partenaires = \App\Models\Partenaire::where('page_key', 'accueil')->orderBy('created_at', 'desc')->get();  

        return [
            // 'accueilContent' => $accueilContent,
            'presentationEntreprise' => $presentationEntreprise,
            'seo' => $seo,
            'carousels' => $carousels,
            'services' => $services,
            'accroche' => $accroche,
            'clients' => $clients,
            'temoignages' => $temoignages,
            'partenaires' => $partenaires,
        ];
    }
}
