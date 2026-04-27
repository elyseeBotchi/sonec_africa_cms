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
        $secteurs_expertise = \App\Models\SecteurExpertise::where('page_key', 'secteur_expertise')->where('mis_avant', true)->orderBy('created_at', 'asc')->limit(6)->get();
        $solutions = \App\Models\Solution::with('fonctionnalites')->where('page_key', 'solutions')->where('mis_avant', true)->orderBy('created_at', 'asc')->limit(6)->get();
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

// Fonction pour recuperer le contenu de la page notre histoire
if (!function_exists('get_histoire_content')) {
    function get_histoire_content()
    {
        $page_key = 'notre-histoire';
        $historiques = \App\Models\Historique::where('page_key', $page_key)->where('section_key', 'historiques')->get();
        $accroche = \App\Models\Accroche::where('page_key', $page_key)->first();
        $banniere = \App\Models\BanniereHero::where('page_key', 'notre-histoire')->first();
        $seo = \App\Models\Seo::where('page_key', $page_key)->first();
        $valeurs = \App\Models\SectionPage::where('page_key', $page_key)->where('section_key', 'valeurs')->get();
        $section_premiere = \App\Models\SectionPage::where('page_key', $page_key)->where('section_key', 'section_premiere')->first();
        
        $chiffres = \App\Models\Chiffre::where('page_key', $page_key)->get();

        return [
            'banniere' => $banniere,
            'seo' => $seo,
            'accroche' => $accroche,
            // 'sections' => $sections,
            'historiques' => $historiques,
            'valeurs' => $valeurs,
            'section_premiere' => $section_premiere,
            'chiffres' => $chiffres,
        ];
    }
}

// Fonction pour recuperer le contenu de la page notre équipe
if (!function_exists('get_equipe_content')) {
    function get_equipe_content()
    {
        $page_key = 'notre-equipe';
        $banniere = \App\Models\BanniereHero::where('page_key', $page_key)->first();
        $seo = \App\Models\Seo::where('page_key', $page_key)->first();
        $accroche = \App\Models\Accroche::where('page_key', $page_key)->first();
        $equipes = \App\Models\Equipe::where('page_key', $page_key)->where('section_key', 'equipe')->get();
        $valeurs = \App\Models\SectionPage::where('page_key', $page_key)->where('section_key', 'valeurs')->get();
        $section_presentation = \App\Models\SectionPage::where('page_key', $page_key)->where('section_key', 'presentation')->first();
        $chiffres_presentation = \App\Models\Chiffre::where('page_key', $page_key)->where('section_key', 'chiffres')->get();
        $chiffres_vision = \App\Models\Chiffre::where('page_key', $page_key)->where('section_key', 'vision')->get();
        $section_vision = \App\Models\SectionPage::where('page_key', $page_key)->where('section_key', 'vision')->first();
        $section_gouvernances = \App\Models\SectionPage::where('page_key', $page_key)->where('section_key', 'gouvernance')->get();    
        $section_premiere = \App\Models\SectionPage::where('page_key', $page_key)->where('section_key', 'section_premiere')->first(); 
        
        // dd($chiffres_vision);


        return [
            'seo' => $seo,
            'banniere' => $banniere,
            'accroche' => $accroche,
            'equipes' => $equipes,
            'valeurs' => $valeurs,
            'section_presentation' => $section_presentation,
            'chiffres_presentation' => $chiffres_presentation,
            'chiffres_vision' => $chiffres_vision,
            'section_vision' => $section_vision,
            'section_gouvernances' => $section_gouvernances,
            'section_premiere' => $section_premiere,
        ];
    }
}

// Function pour recuperer le contenu de la page implantation
if (!function_exists('get_implantation_content')) {
    function get_implantation_content()
    {
        $page_key = 'implantation';
        $bureaux = \App\Models\BureauPays::where('page_key', $page_key)->get();
        $banniere = \App\Models\BanniereHero::where('page_key', $page_key)->first();
        $seo = \App\Models\Seo::where('page_key', $page_key)->first();
        $accroche = \App\Models\Accroche::where('page_key', $page_key)->first();
        $chiffres = \App\Models\Chiffre::where('page_key', $page_key)->where('section_key', 'chiffres')->get();
        $about = \App\Models\SectionPage::where('page_key', $page_key)->where('section_key', 'about')->first();
        $section_premiere = \App\Models\SectionPage::where('page_key', $page_key)->where('section_key', 'section_premiere')->first();
        
        return [
            'banniere' => $banniere,
            'seo' => $seo,
            'accroche' => $accroche,
            'section_premiere' => $section_premiere,
            'chiffres' => $chiffres,
            'about' => $about,  
            'bureaux' => $bureaux,
        ];
    }
    
}

// Fonction pour avoir le code iso pays à partir du nom du pays
if (!function_exists('get_country_flag')) {
    function get_country_flag(string $countryOrCode): array
    {
        $countries = [
            'CI' => [
                'name'     => "Côte d'Ivoire",
                'iso'      => 'CI',
                'emoji'    => '🇨🇮',
                'gradient' => 'bg-gradient-to-r from-orange-500 via-white to-green-600',
                'colors'   => ['bg-orange-500', 'bg-white', 'bg-green-600'],
                'text'     => 'text-orange-500',
                'border'   => 'border-orange-500',
            ],
            'SN' => [
                'name'     => 'Sénégal',
                'iso'      => 'SN',
                'emoji'    => '🇸🇳',
                'gradient' => 'bg-gradient-to-r from-green-600 via-yellow-400 to-red-600',
                'colors'   => ['bg-green-600', 'bg-yellow-400', 'bg-red-600'],
                'text'     => 'text-green-600',
                'border'   => 'border-green-600',
            ],
            'ML' => [
                'name'     => 'Mali',
                'iso'      => 'ML',
                'emoji'    => '🇲🇱',
                'gradient' => 'bg-gradient-to-r from-green-600 via-yellow-400 to-red-600',
                'colors'   => ['bg-green-600', 'bg-yellow-400', 'bg-red-600'],
                'text'     => 'text-green-700',
                'border'   => 'border-green-700',
            ],
            'BF' => [
                'name'     => 'Burkina Faso',
                'iso'      => 'BF',
                'emoji'    => '🇧🇫',
                'gradient' => 'bg-gradient-to-b from-red-600 to-green-600',
                'colors'   => ['bg-red-600', 'bg-green-600'],
                'text'     => 'text-red-600',
                'border'   => 'border-red-600',
            ],
            'GN' => [
                'name'     => 'Guinée',
                'iso'      => 'GN',
                'emoji'    => '🇬🇳',
                'gradient' => 'bg-gradient-to-r from-red-600 via-yellow-400 to-green-600',
                'colors'   => ['bg-red-600', 'bg-yellow-400', 'bg-green-600'],
                'text'     => 'text-red-600',
                'border'   => 'border-red-600',
            ],
            'TG' => [
                'name'     => 'Togo',
                'iso'      => 'TG',
                'emoji'    => '🇹🇬',
                'gradient' => 'bg-gradient-to-b from-green-600 via-yellow-400 to-red-500',
                'colors'   => ['bg-green-600', 'bg-yellow-400', 'bg-red-500'],
                'text'     => 'text-green-600',
                'border'   => 'border-green-600',
            ],
            'BJ' => [
                'name'     => 'Bénin',
                'iso'      => 'BJ',
                'emoji'    => '🇧🇯',
                'gradient' => 'bg-gradient-to-b from-green-600 via-yellow-400 to-red-500',
                'colors'   => ['bg-green-600', 'bg-yellow-400', 'bg-red-500'],
                'text'     => 'text-green-700',
                'border'   => 'border-green-700',
            ],
            'GH' => [
                'name'     => 'Ghana',
                'iso'      => 'GH',
                'emoji'    => '🇬🇭',
                'gradient' => 'bg-gradient-to-b from-red-600 via-yellow-400 to-green-700',
                'colors'   => ['bg-red-600', 'bg-yellow-400', 'bg-green-700'],
                'text'     => 'text-red-600',
                'border'   => 'border-red-600',
            ],
            'CM' => [
                'name'     => 'Cameroun',
                'iso'      => 'CM',
                'emoji'    => '🇨🇲',
                'gradient' => 'bg-gradient-to-r from-green-600 via-red-600 to-yellow-400',
                'colors'   => ['bg-green-600', 'bg-red-600', 'bg-yellow-400'],
                'text'     => 'text-green-600',
                'border'   => 'border-green-600',
            ],
            'GA' => [
                'name'     => 'Gabon',
                'iso'      => 'GA',
                'emoji'    => '🇬🇦',
                'gradient' => 'bg-gradient-to-b from-green-600 via-yellow-400 to-blue-600',
                'colors'   => ['bg-green-600', 'bg-yellow-400', 'bg-blue-600'],
                'text'     => 'text-green-600',
                'border'   => 'border-green-600',
            ],
            'CG' => [
                'name'     => 'Congo',
                'iso'      => 'CG',
                'emoji'    => '🇨🇬',
                'gradient' => 'bg-gradient-to-r from-green-600 via-yellow-400 to-red-600',
                'colors'   => ['bg-green-600', 'bg-yellow-400', 'bg-red-600'],
                'text'     => 'text-green-600',
                'border'   => 'border-green-600',
            ],
            'FR' => [
                'name'     => 'France',
                'iso'      => 'FR',
                'emoji'    => '🇫🇷',
                'gradient' => 'bg-gradient-to-r from-blue-700 via-white to-red-600',
                'colors'   => ['bg-blue-700', 'bg-white', 'bg-red-600'],
                'text'     => 'text-blue-700',
                'border'   => 'border-blue-700',
            ],
            'MA' => [
                'name'     => 'Maroc',
                'iso'      => 'MA',
                'emoji'    => '🇲🇦',
                'gradient' => 'bg-gradient-to-b from-red-600 to-red-700',
                'colors'   => ['bg-red-600', 'bg-red-700'],
                'text'     => 'text-red-600',
                'border'   => 'border-red-600',
            ],
            'MR' => [
                'name'     => 'Mauritanie',
                'iso'      => 'MR',
                'emoji'    => '🇲🇷',
                'gradient' => 'bg-gradient-to-b from-green-700 via-yellow-400 to-green-700',
                'colors'   => ['bg-green-700', 'bg-yellow-400', 'bg-green-700'],
                'text'     => 'text-green-700',
                'border'   => 'border-green-700',
            ],
            'NE' => [
                'name'     => 'Niger',
                'iso'      => 'NE',
                'emoji'    => '🇳🇪',
                'gradient' => 'bg-gradient-to-b from-orange-500 via-white to-green-600',
                'colors'   => ['bg-orange-500', 'bg-white', 'bg-green-600'],
                'text'     => 'text-orange-500',
                'border'   => 'border-orange-500',
            ],
            'NG' => [
                'name'     => 'Nigéria',
                'iso'      => 'NG',
                'emoji'    => '🇳🇬',
                'gradient' => 'bg-gradient-to-r from-green-600 via-white to-green-600',
                'colors'   => ['bg-green-600', 'bg-white', 'bg-green-600'],
                'text'     => 'text-green-600',
                'border'   => 'border-green-600',
            ],
            // Tchad
            'TD' => [
                'name'     => 'Tchad',
                'iso'      => 'TD',
                'emoji'    => '🇹🇩',
                'gradient' => 'bg-gradient-to-r from-blue-600 via-yellow-400 to-red-600',
                'colors'   => ['bg-blue-600', 'bg-yellow-400', 'bg-red-600'],
                'text'     => 'text-blue-600',
                'border'   => 'border-blue-600',
            ],
            // congo RDC
            'CD' => [
                'name'     => 'Congo RDC',
                'iso'      => 'CD',
                'emoji'    => '🇨🇩',
                'gradient' => 'bg-gradient-to-r from-blue-600 via-yellow-400 to-red-600',
                'colors'   => ['bg-blue-600', 'bg-yellow-400', 'bg-red-600'],
                'text'     => 'text-blue-600',
                'border'   => 'border-blue-600',
            ],
        ];

        $code = strtoupper(trim($countryOrCode));
        if (isset($countries[$code])) {
            return $countries[$code];
        }

        foreach ($countries as $iso => $data) {
            if (mb_strtolower($data['name']) === mb_strtolower(trim($countryOrCode))) {
                return $data;
            }
        }

        // Fallback
        return [
            'name'     => $countryOrCode,
            'iso'      => '??',
            'emoji'    => '🌍',
            'gradient' => 'bg-gradient-to-b from-gray-400 via-gray-200 to-gray-400',
            'colors'   => ['bg-gray-400', 'bg-gray-200', 'bg-gray-400'],
            'text'     => 'text-gray-500',
            'border'   => 'border-gray-300',
        ];
    }
}


// Fonction pour recuperer le contenu de la page solutions
if (!function_exists('get_solution_content')) {
    function get_solution_content()
    {
        $page_key = 'solutions';

        $solutions_mis_en_avant = \App\Models\Solution::where('mis_avant', true)->get();
        $autres_solutions = \App\Models\Solution::where('mis_avant', false)->get();
        $sections = \App\Models\SectionPage::where('page_key', $page_key)->get();
        $accroche = \App\Models\Accroche::where('page_key', $page_key)->first();
        $seo = \App\Models\Seo::where('page_key', $page_key)->first();
        $banniere = \App\Models\BanniereHero::where('page_key', $page_key)->first();
        $sectionItems = \App\Models\SectionItem::where('page_key', $page_key)->get();
        $temoignages = \App\Models\SolutionTemoignage::limit(2)->get();
        return [
            'solutions_mis_en_avant' => $solutions_mis_en_avant,
            'autres_solutions' => $autres_solutions,
            'sections' => $sections,
            'accroche' => $accroche,
            'seo' => $seo,
            'banniere' => $banniere,
            'sectionItems' => $sectionItems,
            'temoignages' => $temoignages,

        ];
    }
}

