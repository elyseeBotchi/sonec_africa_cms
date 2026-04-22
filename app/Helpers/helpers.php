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
        $secteurs_expertise = \App\Models\SecteurExpertise::where('page_key', 'secteurs_expertise')->where('mis_avant', true)->orderBy('created_at', 'desc')->limit(6)->get();
        $solutions = \App\Models\Solution::with('fonctionnalites')->where('page_key', 'solutions')->where('mis_avant', true)->orderBy('created_at', 'desc')->limit(6)->get();
        $articles = \App\Models\Article::where('page_key', 'actualites')->where('a_la_une', true)->orderBy('created_at', 'desc')->limit(6)->get();

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
            'secteurs_expertise' => $secteurs_expertise,
            'solutions' => $solutions,
            'articles' => $articles,
        ];
    }
}

// Fonction pour recuperer les solutions
if (!function_exists('get_solutions')) {
    function get_solutions()
    {
        return \App\Models\Solution::where('mis_avant', true)->orderBy('created_at', 'desc')->get();
    }
}

// Fonction pour récuperer les secteurs d'expertise
if (!function_exists('get_secteurs_expertise')) {
    function get_secteurs_expertise()
    {
        return \App\Models\SecteurExpertise::where('mis_avant', true)->orderBy('created_at', 'desc')->get();
    }
}

// Fonction pour recuperer le contenu de la page solutions
if (!function_exists('get_solutions_page_content')) {
    function get_solutions_page_content()
    {
        $bannerSolutions = \App\Models\BanniereHero::where('page_key', 'solutions')->first();
        $section_avantages = \App\Models\SectionItem::where('page_key', 'solutions')->where('section_key', 'avantages')->first();

        $seo = \App\Models\Seo::where('page_key', 'solutions')->first();
        $accroche = \App\Models\Accroche::where('page_key', 'solutions')->first();
        $secteurs_expertise = \App\Models\SecteurExpertise::where('page_key', 'secteurs_expertise')->where('mis_avant', true)->orderBy('created_at', 'desc')->get();
        $solutions = \App\Models\Solution::with('fonctionnalites')->where('page_key', 'solutions')->where('mis_avant', true)->orderBy('created_at', 'desc')->get();

        return [
            'bannerSolutions' => $bannerSolutions,
            'section_avantages' => $section_avantages,
            'seo' => $seo,
            'accroche' => $accroche,
            'secteurs_expertise' => $secteurs_expertise,
            'solutions' => $solutions,
        ];
    }
}

// Fonction pour recuperer le contenu de la page découvrir sonec africa
if (!function_exists('get_decouvrir_sonec_africa_content')) {
    function get_decouvrir_sonec_africa_content()
    {
        // $presentationEntreprise = \App\Models\PresentationEntreprise::where('page_key', 'decouvrir-sonec-africa')->first();
        $page_key = 'decouvrir-sonec-africa';
        // $section = $page_key;
        $banniere = \App\Models\BanniereHero::where('page_key', $page_key)->first();

        $seo = \App\Models\Seo::where('page_key', $page_key)->first();

        // $section_page=SectionPage::where('page_key', $page_key)->first();
        $accroche = \App\Models\Accroche::where('page_key', $page_key)->first();

        $certifications =\App\Models\Certfication::where('page_key', $page_key)->where('section_key', 'certifications')->get();

        $approches =\App\Models\SectionPage::where('page_key', $page_key)->where('section_key', 'approches')->get();

        // Piliers
        $piliers =\App\Models\SectionPage::where('page_key', $page_key)->where('section_key', 'piliers')->get();

        // chiffres
        $chiffres = \App\Models\Chiffre::where('page_key', $page_key)->get();

        // Section items
        $engagements = \App\Models\SectionItem::where('page_key', $page_key)->where('section_key', 'engagement_item')->get();
        $vision = \App\Models\SectionPage::where('page_key', $page_key)->where('section_key', 'vision')->first();

        $engagement = \App\Models\SectionPage::where('page_key', $page_key)->where('section_key', 'engagement')->first();
        return [
            // 'presentationEntreprise' => $presentationEntreprise,
            'seo' => $seo,
            'accroche' => $accroche,
            'chiffres' => $chiffres,
            // 'partenaires' => $partenaires,
            'banniere' => $banniere,
            'certifications' => $certifications,
            'approches' => $approches,  
            'piliers' => $piliers,
            'engagements' => $engagements,
            'vision' => $vision,
            'engagement' => $engagement,
        ];
    }
}

// Fonction pour faire corresponde les slugs des menus avec les slugs des pages et articles
if (!function_exists('resolve_menu_child_url')) {
    function resolve_menu_child_url(\App\Models\Menu $child): string
    {
        $slug = $child->slug ?? '';

        if (empty($slug)) {
            return '#';
        }

        // Pages statiques — slug du menu → route nommée
        $staticRoutes = [
            'qui-sommes-nous'        => 'web.qui-sommes-nous',
            'decouvrir-sonec-africa' => 'web.decouvrir-sonec-africa',
            'notre-histoire'         => 'web.notre-histoire',
            'equipe-de-direction'    => 'web.equipe-de-direction',
            'actualites'             => 'web.actualites',
            'carrieres'              => 'web.carrieres',
            'solutions'              => 'web.solutions.index',
            'industries'             => 'web.secteurs.index',
        ];

        if (isset($staticRoutes[$slug])) {
            return route($staticRoutes[$slug]);
        }

        // Cherche dans les solutions (slug exact : ecoleweb, gdec, sonecpay...)
        $solution = \App\Models\Solution::where('slug', $slug)->first();
        if ($solution) {
            return route('web.solutions.show', $solution->slug);
        }

        // Cherche dans les secteurs (slug exact : banques-et-assurances, telecoms...)
        $secteur = \App\Models\SecteurExpertise::where('slug', $slug)->first();
        if ($secteur) {
            return route('web.secteurs.show', $secteur->slug);
        }

        // Fallback — URL brute de la BD
        if (!empty($child->url) && $child->url !== '#') {
            return url($child->url);
        }

        return '#';
    }
}


