<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDecouvrirSonecRequest;
use App\Http\Requests\StoreEquipeContentRequest;
use App\Http\Requests\StoreHistoireRequest;
use App\Http\Requests\StoreImplantationContentRequest;
use App\Models\Accroche;
use App\Models\BanniereHero;
use App\Models\BureauPays;
use App\Models\Certfication;
use App\Models\Chiffre;
use App\Models\Equipe;
use App\Models\SectionItem;
use App\Models\SectionPage;
use App\Models\Seo;
use App\Models\Historique;
use Illuminate\Http\Request;

class QuiSommesNousController extends Controller
{
    //page découvrir Sonec Africa
    public function index()
    {
        $page_key = 'decouvrir-sonec-africa';
        // $section = $page_key;
        $banniere = BanniereHero::where('page_key', $page_key)->first();

        $seo = Seo::where('page_key', $page_key)->first();

        // $section_page=SectionPage::where('page_key', $page_key)->first();
        $accroche = Accroche::where('page_key', $page_key)->first();

        $certifications =Certfication::where('page_key', $page_key)->where('section_key', 'certifications')->get();

        $approches =SectionPage::where('page_key', $page_key)->where('section_key', 'approches')->get();

        // Piliers
        $piliers =SectionPage::where('page_key', $page_key)->where('section_key', 'piliers')->get();

        // chiffres
        $chiffres = Chiffre::where('page_key', $page_key)->get();

        // Section items
        $engagements = SectionItem::where('page_key', $page_key)->where('section_key', 'engagement_item')->get();
        $vision = SectionPage::where('page_key', $page_key)->where('section_key', 'vision')->first();

        $engagement = SectionPage::where('page_key', $page_key)->where('section_key', 'engagement')->first();

        return view('admin.pages.qui-sommes-nous.decouvrir-sonec-africa.index', compact('banniere', 'page_key', 'seo', 'accroche', 'certifications', 'approches', 'piliers', 'chiffres', 'engagements', 'vision', 'engagement'));
    }

    //Sauvegarder ou mettre à jour les contenus de la page Découvrir Sonec Africa
    public function save(StoreDecouvrirSonecRequest $request)
    {
        try {
                $validatedData = $request->validated();

                $imagePath = null;
                $visionImagePath = null;

                // Sauvegarder la bannière
                if (isset($validatedData['banniere_title']) || isset($validatedData['banniere_subtitle']) || isset($validatedData['banniere_image']) || isset($validatedData['banniere_image_url'])) {
                    
                    if ($request->hasFile('banniere_image')) {
                        $existing = \App\Models\BanniereHero::where('page_key', $validatedData['page_key'])->first();
                        if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                            \Storage::delete('public/' . $existing->image);
                        }

                        $imagePath = $request->file('banniere_image')->store('hero_images', 'public');
                    }

                    $banniereData = [
                        'page_key' => $validatedData['page_key'],
                        'section_key' => $validatedData['banniere_section_key'],
                        'title' => $validatedData['banniere_title'] ?? null,
                        'subtitle' => $validatedData['banniere_subtitle'] ?? null,
                        'image_url' => $validatedData['banniere_image_url'] ?? null,
                        ...($imagePath ? ['image' => $imagePath] : []),
                    ];

                    BanniereHero::updateOrCreate(
                        ['page_key' => $validatedData['page_key'], 'section_key' => $validatedData['banniere_section_key']],
                        $banniereData
                    );
                }

                // Sauvegarder la section Vision
                if ($request->hasFile('vision_image')) {
                    // Supprimer l'ancienne image si elle existe
                    $existing = \App\Models\SectionPage::where('page_key', $validatedData['page_key'])->where('section_key', 'vision')->first();
                    if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                        \Storage::delete('public/' . $existing->image);
                    }

                    $visionImagePath = $request->file('vision_image')->store('section_images', 'public');
                }

                if (isset($validatedData['vision_title']) || isset($validatedData['vision_description']) || isset($validatedData['vision_image']) || isset($validatedData['vision_image_url']) || isset($validatedData['vision_subtitle']) || isset($validatedData['vision_cta_label']) || isset($validatedData['vision_cta_url'])) {
                    $visionData = [
                        'page_key' => $validatedData['page_key'],
                        'section_key' => 'vision',
                        'title' => $validatedData['vision_title'] ?? null,
                        'description' => $validatedData['vision_description'] ?? null,
                        'image_url' => $validatedData['vision_image_url'] ?? null,
                        'subtitle' => $validatedData['vision_subtitle'] ?? null,
                        'cta_label' => $validatedData['vision_cta_label'] ?? null,
                        'cta_url' => $validatedData['vision_cta_url'] ?? null,
                        ...($visionImagePath ? ['image' => $visionImagePath] : []),
                    ];

                    SectionPage::updateOrCreate(
                        ['page_key' => $validatedData['page_key'], 'section_key' => 'vision'],
                        $visionData
                    );
                }

                // Sauvegarder les piliers
                if (isset($validatedData['piliers']) && is_array($validatedData['piliers'])) {
                    $submittedIds = collect($validatedData['piliers'])
                                    ->pluck('id')
                                    ->filter()
                                    ->values();

                    SectionPage::where('page_key', $validatedData['page_key'])->where('section_key', 'piliers')
                                    ->whereNotIn('id', $submittedIds)
                                    ->delete();    

                    foreach ($validatedData['piliers'] as $index => $pilier) {
                        $pilierData = [
                            'page_key' => $validatedData['page_key'],
                            'section_key' => 'piliers',
                            'title' => $pilier['title'] ?? null,
                            'description' => $pilier['description'] ?? null,
                            'subtitle' => $pilier['subtitle'] ?? null,
                            'icon' => $pilier['icon'] ?? null,
                        ];

                        if (isset($pilier['id'])) {
                            // Mise à jour
                            SectionPage::updateOrCreate(
                                ['id' => $pilier['id']],
                                $pilierData
                            );
                        } else {
                            // Création
                            SectionPage::create($pilierData);
                        }


                    }
                }

                // Sauvegarder les chiffres
                if (isset($validatedData['chiffres']) && is_array($validatedData['chiffres'])) {
                    $submittedIds = collect($validatedData['chiffres'])
                                    ->pluck('id')
                                    ->filter()
                                    ->values();

                    SectionPage::where('page_key', $validatedData['page_key'])->where('section_key', 'chiffres')
                                    ->whereNotIn('id', $submittedIds)
                                    ->delete();  
                    foreach ($validatedData['chiffres'] as $chiffre) {
                        $chiffreData = [
                            'page_key'    => $validatedData['page_key'],
                            'section_key' => 'chiffres',
                            'label'       => $chiffre['label']       ?? null,
                            'value'       => $chiffre['value']       ?? null,
                            'description' => $chiffre['description'] ?? null,
                            'icon'        => $chiffre['icon']        ?? null,
                        ];

                        if (!empty($chiffre['id'])) {
                            Chiffre::updateOrCreate(
                                ['id' => $chiffre['id']],
                                $chiffreData
                            );
                        } else {
                            Chiffre::create($chiffreData);
                        }
                    }
                }
                // Sauvegarder la section engagement
                if (isset($validatedData['engagement_title']) || isset($validatedData['engagement_description']) || isset($validatedData['engagement_image']) || isset($validatedData['engagement_image_url'])) {
                    if ($request->hasFile('engagement_image')) {
                        // Supprimer l'ancienne image si elle existe
                        $existing = \App\Models\SectionPage::where('page_key', $validatedData['page_key'])->where('section_key', 'engagement')->first();
                        if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                            \Storage::delete('public/' . $existing->image);
                        }
                    }
                }

                if (!empty($validatedData['engagement_title']) || !empty($validatedData['engagement_description']) || $request->hasFile('engagement_image') || !empty($validatedData['engagement_image_url'])) {
                    $engagementData = [
                        'page_key' => $validatedData['page_key'],
                        'section_key' => $validatedData['engagement_section_key'],
                        'title' => $validatedData['engagement_title'] ?? null,
                        'description' => $validatedData['engagement_description'] ?? null,
                        'image_url' => $validatedData['engagement_image_url'] ?? null,
                        ...($request->hasFile('engagement_image') ? ['image' => $request->file('engagement_image')->store('section_images', 'public')] : []),
                    ];
                    SectionPage::updateOrCreate(
                        ['page_key' => $validatedData['page_key'], 'section_key' => $validatedData['engagement_section_key']],
                        $engagementData
                    ); 
                }               

                // Sauvegarder les engagements
                if (isset($validatedData['engagements']) && is_array($validatedData['engagements'])) {
                    
                    $submittedIds = collect($validatedData['engagements'])
                                    ->pluck('id')
                                    ->filter()
                                    ->values();

                    SectionItem::where('page_key', $validatedData['page_key'])->where('section_key', 'engagement_item')
                                    ->whereNotIn('id', $submittedIds)
                                    ->delete();

                    foreach ($validatedData['engagements'] as $index => $engagement) {
                        $engagementData = [
                            'page_key' => $validatedData['page_key'],
                            'section_key' => 'engagement_item',
                            'label' => $engagement['title'] ?? null,
                            'description' => $engagement['description'] ?? null,
                            'icon' => $engagement['icon'] ?? null,
                        ];

                        if (isset($engagement['id'])) {
                            // Mise à jour
                            SectionItem::updateOrCreate(
                                ['id' => $engagement['id']],
                                $engagementData
                            );
                        } else {
                            // Création
                            SectionItem::create($engagementData);
                        }
                    }
                }

                // Sauvegarde de l'accroche
                if (isset($validatedData['accroche_title']) || isset($validatedData['accroche_subtitle']) || isset($validatedData['accroche_description']) || isset($validatedData['accroche_cta_label']) || isset($validatedData['accroche_cta_url'])) {
                    \App\Models\Accroche::updateOrCreate(
                        ['page_key' => $validatedData['accroche_page_key']],
                        [
                            'title' => $validatedData['accroche_title'],
                            'subtitle' => $validatedData['accroche_subtitle'],
                            'description' => $validatedData['accroche_description'],
                            'cta_label' => $validatedData['accroche_cta_label'],
                            'cta_url' => $validatedData['accroche_cta_url'],
                        ]
                    );
                }

                // Sauvegarde du SEO
                if (isset($validatedData['seo_title']) || isset($validatedData['seo_description']) || isset($validatedData['seo_keywords'])) {
                    \App\Models\Seo::updateOrCreate(
                        ['page_key' => $validatedData['seo_page_key']],
                        [
                            'title' => $validatedData['seo_title'],
                            'description' => $validatedData['seo_description'],
                            'keywords' => $validatedData['seo_keywords'],
                        ]
                    );
                }

                // Sauvegarder les certifications
                if (isset($validatedData['certifications']) && is_array($validatedData['certifications'])) {
                    $submittedIds = collect($validatedData['certifications'])
                                    ->pluck('id')
                                    ->filter()
                                    ->values();

                    SectionItem::where('page_key', $validatedData['page_key'])->where('section_key', 'certifications')
                                    ->whereNotIn('id', $submittedIds)
                                    ->delete();

                    foreach ($validatedData['certifications'] as $index => $certification) {
                        $certificationData = [
                            'page_key' => $validatedData['page_key'],
                            'section_key' => 'certifications',
                            'label' => $certification['label'] ?? null,
                            'description' => $certification['description'] ?? null,
                            'icon' => $certification['icon'] ?? null,
                        ];
                        if (isset($certification['id'])) {
                            // Mise à jour
                            Certfication::updateOrCreate(
                                ['id' => $certification['id']],
                                $certificationData
                            );
                        } else {
                            // Création
                            Certfication::create($certificationData);
                        }
                    }
                }

                // Sauvegarder les approches
                if (isset($validatedData['approches']) && is_array($validatedData['approches'])) {
                    $submittedIds = collect($validatedData['approches'])
                                    ->pluck('id')
                                    ->filter()
                                    ->values();

                    SectionPage::where('page_key', $validatedData['page_key'])->where('section_key', 'approches')
                                    ->whereNotIn('id', $submittedIds)
                                    ->delete();

                    foreach ($validatedData['approches'] as $index => $approche) {
                        $approcheData = [
                            'page_key' => $validatedData['page_key'],
                            'section_key' => 'approches',
                            'title' => $approche['title'] ?? null,
                            'description' => $approche['description'] ?? null,
                            // 'icon' => $approche['icon'] ?? null,
                        ];
                        if (isset($approche['id'])) {
                            // Mise à jour
                            SectionPage::updateOrCreate(
                                ['id' => $approche['id']],
                                $approcheData
                            );
                        } else {
                            // Création
                            SectionPage::create($approcheData);
                        }
                    }
                }

                $data = [
                    'success' => true,
                    'message' => 'Contenu de la page découvrir Sonec Africa sauvegardé avec succès.',
                ];
                return response()->json($data, 200);

                // return redirect()->back()->with('success', 'Contenu mis à jour avec succès.');
            } catch (\Throwable $th) {
                $data = [
                    'success' => false,
                    'message' => 'Une erreur est survenue lors de la sauvegarde du contenu de la page découvrir Sonec Africa.',
                    'error' => $th->getMessage(),
                ];
                return response()->json($data, 500);
            }
    }

    // Page Notre histoire
    public function histoire()
    {
        $page_key = 'notre-histoire';
        $historiques = \App\Models\Historique::where('page_key', $page_key)->where('section_key', 'historiques')->get();
        $accroche = Accroche::where('page_key', $page_key)->first();
        $banniere = BanniereHero::where('page_key', $page_key)->first();
        $seo = Seo::where('page_key', $page_key)->first();
        $valeurs = SectionPage::where('page_key', $page_key)->where('section_key', 'valeurs')->get();
        $section_premiere = SectionPage::where('page_key', $page_key)->where('section_key', 'section_premiere')->first();
        
        $chiffres = Chiffre::where('page_key', $page_key)->get();

        return view('admin.pages.qui-sommes-nous.notre-histoire.index', compact('historiques', 'accroche', 'banniere', 'seo', 'valeurs', 'section_premiere', 'page_key','chiffres'));
    }

    // Sauvegarder ou mettre à jour les contenus de la page Notre histoire
    public function saveHistoire(StoreHistoireRequest $request)
    {
        try {
                $validatedData = $request->validated();

                $imagePath = null;
                // Sauvegarder la bannière
                if (isset($validatedData['banniere_title']) || isset($validatedData['banniere_subtitle']) || isset($validatedData['banniere_image']) || isset($validatedData['banniere_image_url'])) {
                    
                    if ($request->hasFile('banniere_image')) {
                        $existing = \App\Models\BanniereHero::where('page_key', $validatedData['page_key'])->first();
                        if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                            \Storage::delete('public/' . $existing->image);
                        }

                        $imagePath = $request->file('banniere_image')->store('hero_images', 'public');
                    }

                    $banniereData = [
                        'page_key' => $validatedData['page_key'],
                        'section_key' => $validatedData['banniere_section_key'],
                        'title' => $validatedData['banniere_title'] ?? null,
                        'subtitle' => $validatedData['banniere_subtitle'] ?? null,
                        'image_url' => $validatedData['banniere_image_url'] ?? null,
                        ...($imagePath ? ['image' => $imagePath] : []),
                    ];

                    BanniereHero::updateOrCreate(
                        ['page_key' => $validatedData['page_key'], 'section_key' => $validatedData['banniere_section_key']],
                        $banniereData
                    );
                }

                // Sauvegarder les chiffres
                if (isset($validatedData['chiffres']) && is_array($validatedData['chiffres'])) {
                    
                    $submittedIds = collect($validatedData['chiffres'])
                                    ->pluck('id')
                                    ->filter() // retire null et ""
                                    ->values();

                    Chiffre::where('page_key', $validatedData['page_key'])
                                    ->whereNotIn('id', $submittedIds)
                                    ->delete();

                
                    foreach ($validatedData['chiffres'] as $chiffre) {
                        $chiffreData = [
                            'page_key'    => $validatedData['page_key'],
                            'section_key' => 'chiffres',
                            'label'       => $chiffre['label']       ?? null,
                            'value'       => $chiffre['value']       ?? null,
                            'description' => $chiffre['description'] ?? null,
                            'icon'        => $chiffre['icon']        ?? null,
                        ];

                        if (!empty($chiffre['id'])) {
                            Chiffre::updateOrCreate(
                                ['id' => $chiffre['id']],
                                $chiffreData
                            );
                        } else {
                            Chiffre::create($chiffreData);
                        }
                    }
                }
                
                // Sauvegarder l'histoire
                if (isset($validatedData['historiques']) && is_array($validatedData['historiques'])) {
                    
                    $submittedIds = collect($validatedData['historiques'])
                                    ->pluck('id')
                                    ->filter()
                                    ->values();

                    Historique::where('page_key', $validatedData['page_key'])
                                    ->whereNotIn('id', $submittedIds)
                                    ->delete();

                    foreach ($validatedData['historiques'] as $index => $histoire) {
                        // stocker l'image si elle est présente
                        $histoireImagePath = null;
                        if (isset($histoire['image']) && $request->hasFile("historiques.$index.image")) {
                            $existing = \App\Models\Historique::where('id', $histoire['id'] ?? 0)->first();
                            if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                                \Storage::delete('public/' . $existing->image);
                            }
                            $histoireImagePath = $request->file("historiques.$index.image")->store('historique_images', 'public');
                        }
                        
                        $histoireData = [
                            'page_key' => $validatedData['page_key'],
                            'section_key' => 'historiques',
                            'title' => $histoire['title'] ?? null,
                            'annee' => $histoire['annee'] ?? null,
                            'description' => $histoire['description'] ?? null,
                            'image_url' => $histoire['image_url'] ?? null,
                            ...($histoireImagePath ? ['image' => $histoireImagePath] : []),
                        ];

                        if (!empty($histoire['id'])) {
                            // Mise à jour
                            \App\Models\Historique::updateOrCreate(
                                ['id' => $histoire['id']],
                                $histoireData
                            );
                        } else {
                            // Création
                            \App\Models\Historique::create($histoireData);
                        }
                    }
                }

                // Sauvegarde de l'accroche
                if (isset($validatedData['accroche_title']) || isset($validatedData['accroche_subtitle']) || isset($validatedData['accroche_description']) || isset($validatedData['accroche_cta_label']) || isset($validatedData['accroche_cta_url'])) {
                    \App\Models\Accroche::updateOrCreate(
                        ['page_key' => $validatedData['page_key']],
                        [
                            'title' => $validatedData['accroche_title'],
                            'subtitle' => $validatedData['accroche_subtitle'],
                            'description' => $validatedData['accroche_description'],
                            'cta_label' => $validatedData['accroche_cta_label'],
                            'cta_url' => $validatedData['accroche_cta_url'],
                            'section_key' => 'accroche',
                            'page_key' => $validatedData['page_key'],
                        ]
                    );
                }

                // Sauvegarde du SEO
                if (isset($validatedData['seo_title']) || isset($validatedData['seo_description']) || isset($validatedData['seo_keywords'])) {
                    \App\Models\Seo::updateOrCreate(
                        ['page_key' => $validatedData['seo_page_key']],
                        [
                            'title' => $validatedData['seo_title'],
                            'description' => $validatedData['seo_description'],
                            'keywords' => $validatedData['seo_keywords'],
                        ]
                    );
                }

                // Valeurs
                if (isset($validatedData['valeurs']) && is_array($validatedData['valeurs'])) {
                    $submittedIds = collect($validatedData['valeurs'])
                                    ->pluck('id')
                                    ->filter()
                                    ->values();

                    SectionPage::where('page_key', $validatedData['page_key'])->where('section_key', 'valeurs')
                                    ->whereNotIn('id', $submittedIds)
                                    ->delete();    
                    foreach ($validatedData['valeurs'] as $index => $pilier) {
                        $pilierData = [
                            'page_key' => $validatedData['page_key'],
                            'section_key' => 'valeurs',
                            'title' => $pilier['title'] ?? null,
                            'description' => $pilier['description'] ?? null,
                            'subtitle' => $pilier['subtitle'] ?? null,
                            'icon' => $pilier['icon'] ?? null,
                        ];

                        if (!empty($pilier['id'])) {
                            // Mise à jour
                            SectionPage::updateOrCreate(
                                ['id' => $pilier['id']],
                                $pilierData
                            );
                        } else {
                            // Création
                            SectionPage::create($pilierData);
                        }


                    }
                }

                // Sauvegarder la section premiere
                // stocker l'image si elle est présente
                if ($request->hasFile('section_premiere_image')) {
                    // Supprimer l'ancienne image si elle existe
                    $existing = \App\Models\SectionPage::where('page_key', $validatedData['page_key'])->where('section_key', 'section_premiere')->first();
                    if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                        \Storage::delete('public/' . $existing->image);
                    }

                    $sectionPremiereImagePath = $request->file('section_premiere_image')->store('section_images', 'public');
                }

                if (isset($validatedData['section_premiere_title']) || isset($validatedData['section_premiere_subtitle']) || isset($validatedData['section_premiere_description']) || isset($validatedData['section_premiere_cta_label']) || isset($validatedData['section_premiere_cta_url']) || isset($validatedData['section_premiere_image']) || isset($validatedData['section_premiere_image_url'])) {
                    $sectionPremiereData = [
                        'page_key' => $validatedData['page_key'],
                        'section_key' => 'section_premiere',
                        'title' => $validatedData['section_premiere_title'] ?? null,
                        'subtitle' => $validatedData['section_premiere_subtitle'] ?? null,
                        'description' => $validatedData['section_premiere_description'] ?? null,
                        'cta_label' => $validatedData['section_premiere_cta_label'] ?? null,
                        'cta_url' => $validatedData['section_premiere_cta_url'] ?? null,
                        'image_url' => $validatedData['section_premiere_image_url'] ?? null,
                        ...($request->hasFile('section_premiere_image') ? ['image' => $sectionPremiereImagePath] : []),
                    ];
                    SectionPage::updateOrCreate(
                        ['page_key' => $validatedData['page_key'], 'section_key' => 'section_premiere'],
                        $sectionPremiereData
                    );
                }

                $data = [
                    'success' => true,
                    'message' => 'Contenu de la page Notre histoire sauvegardé avec succès.',
                ];
                return response()->json($data, 200);
            

        
            } catch (\Throwable $th) {
            
            
                $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la sauvegarde du contenu de la page Notre histoire.',
                'error' => $th->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }

    // Page Notre équipe
    public function equipe()
    {
        $page_key = 'notre-equipe';
        $banniere = BanniereHero::where('page_key', $page_key)->first();
        $seo = Seo::where('page_key', $page_key)->first();
        $accroche = Accroche::where('page_key', $page_key)->first();
        $equipes = Equipe::where('page_key', $page_key)->where('section_key', 'equipe')->get();
        $valeurs = SectionPage::where('page_key', $page_key)->where('section_key', 'valeurs')->get();
        $section_presentation = SectionPage::where('page_key', $page_key)->where('section_key', 'presentation')->first();
        $chiffres_presentation = Chiffre::where('page_key', $page_key)->where('section_key', 'chiffres')->get();
        $chiffres_vision = Chiffre::where('page_key', $page_key)->where('section_key', 'vision')->get();
        $section_vision = SectionPage::where('page_key', $page_key)->where('section_key', 'vision')->first();
        $section_gouvernances = SectionPage::where('page_key', $page_key)->where('section_key', 'gouvernance')->get();    
        $section_premiere = SectionPage::where('page_key', $page_key)->where('section_key', 'section_premiere')->first();    
        
        return view('admin.pages.qui-sommes-nous.notre-equipe.index', compact('banniere', 'seo', 'accroche', 'equipes', 'valeurs', 'section_presentation', 'chiffres_presentation', 'chiffres_vision', 'section_vision', 'section_gouvernances', 'section_premiere', 'page_key'));  
    }

    // Sauvegarder ou mettre à jour les contenus de la page Notre équipe
    public function saveEquipeContent(StoreEquipeContentRequest $request)
    {        
        try {
            $validatedData = $request->validated();
            $imagePath = null;

            // Sauvegarder la bannière
            if (isset($validatedData['banniere_title']) || isset($validatedData['banniere_subtitle']) || isset($validatedData['banniere_image']) || isset($validatedData['banniere_image_url'])) {
                
                if ($request->hasFile('banniere_image')) {
                    $existing = \App\Models\BanniereHero::where('page_key', $validatedData['page_key'])->first();
                    if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                        \Storage::delete('public/' . $existing->image);
                    }

                    $imagePath = $request->file('banniere_image')->store('hero_images', 'public');
                }

                $banniereData = [
                    'page_key' => $validatedData['page_key'],
                    'section_key' => $validatedData['banniere_section_key'],
                    'title' => $validatedData['banniere_title'] ?? null,
                    'subtitle' => $validatedData['banniere_subtitle'] ?? null,
                    'image_url' => $validatedData['banniere_image_url'] ?? null,
                    'cta_label' => $validatedData['banniere_cta_label'] ?? null,
                    'cta_url' => $validatedData['banniere_cta_url'] ?? null,
                    ...($imagePath ? ['image' => $imagePath] : []),
                ];

                BanniereHero::updateOrCreate(
                    ['page_key' => $validatedData['page_key'], 'section_key' => $validatedData['banniere_section_key']],
                    $banniereData
                );
            }

            // Sauvegarder les chiffres
            if (isset($validatedData['chiffres']) && is_array($validatedData['chiffres'])) {
                
                $submittedIds = collect($validatedData['chiffres'])
                                ->pluck('id')
                                ->filter() // retire null et ""
                                ->values();

                Chiffre::where('page_key', $validatedData['page_key'])
                                ->whereNotIn('id', $submittedIds)
                                ->delete();

            
                foreach ($validatedData['chiffres'] as $chiffre) {
                    $chiffreData = [
                        'page_key'    => $validatedData['page_key'],
                        'section_key' => 'chiffres',
                        'label'       => $chiffre['label']       ?? null,
                        'value'       => $chiffre['value']       ?? null,
                        'description' => $chiffre['description'] ?? null,
                        'icon'        => $chiffre['icon']        ?? null,
                    ];

                    if (!empty($chiffre['id'])) {
                        Chiffre::updateOrCreate(
                            ['id' => $chiffre['id']],
                            $chiffreData
                        );
                    } else {
                        Chiffre::create($chiffreData);
                    }
                }
            }

            // Sauvegarder les membres de l'équipe
            if (isset($validatedData['equipes']) && is_array($validatedData['equipes'])) {
                $submittedIds = collect($validatedData['equipes'])
                                ->pluck('id')
                                ->filter()
                                ->values();
                Equipe::where('page_key', $validatedData['page_key'])
                                ->where('section_key', 'equipe')
                                ->whereNotIn('id', $submittedIds)
                                ->delete();
                foreach ($validatedData['equipes'] as $index => $equipe) {
                    // stocker l'image si elle est présente
                    $equipeImagePath = null;
                    if (isset($equipe['photo']) && $request->hasFile("equipes.$index.photo")) {
                        $existing = \App\Models\Equipe::where('id', $equipe['id'] ?? 0)->first();
                        if ($existing && $existing->photo && \Storage::exists('public/' . $existing->photo)) {
                            \Storage::delete('public/' . $existing->photo);
                        }
                        $equipeImagePath = $request->file("equipes.$index.photo")->store('equipe_images', 'public');
                    }
                    $equipeData = [
                        'page_key' => $validatedData['page_key'],
                        'section_key' => 'equipe',
                        'name' => $equipe['name'] ?? null,
                        'role' => $equipe['role'] ?? null,
                        'description' => $equipe['description'] ?? null,
                        'linkedin_url' => $equipe['linkedin_url'] ?? null,
                        'twitter_url' => $equipe['twitter_url'] ?? null,
                        'facebook_url' => $equipe['facebook_url'] ?? null,
                        'instagram_url' => $equipe['instagram_url'] ?? null,
                        'photo_url' => $equipe['photo_url'] ?? null,
                        ...($equipeImagePath ? ['photo' => $equipeImagePath] : []),
                    ];
                    if (!empty($equipe['id'])) {
                        Equipe::updateOrCreate(
                            ['id' => $equipe['id']],
                            $equipeData
                        );
                    } else {
                        Equipe::create($equipeData);
                    }
                }
            }

            // Sauvegarde de l'accroche
            if(!empty($validatedData['accroche_title']) || !empty($validatedData['accroche_subtitle']) || !empty($validatedData['accroche_description']) || !empty($validatedData['accroche_cta_label']) || !empty($validatedData['accroche_cta_url'])) {

                \App\Models\Accroche::updateOrCreate(
                    ['page_key' => $validatedData['page_key']],
                    [
                        'title' => $validatedData['accroche_title'],
                        'subtitle' => $validatedData['accroche_subtitle'],
                        'description' => $validatedData['accroche_description'],
                        'cta_label' => $validatedData['accroche_cta_label'],
                        'cta_url' => $validatedData['accroche_cta_url'],
                        'section_key' => 'accroche',
                        'page_key' => $validatedData['page_key'],
                    ]
                );
            }

            // Sauvegarde du SEO
            if(!empty($validatedData['seo_title']) || !empty($validatedData['seo_description']) || !empty($validatedData['seo_keywords'])) {
                \App\Models\Seo::updateOrCreate(
                    ['page_key' => $validatedData['seo_page_key']],
                    [
                        'title' => $validatedData['seo_title'],
                        'description' => $validatedData['seo_description'],
                        'keywords' => $validatedData['seo_keywords'],
                    ]
                );
            }
            
            // Sauvegarder les valeurs
            if (isset($validatedData['valeurs']) && is_array($validatedData['valeurs'])) {
                $submittedIds = collect($validatedData['valeurs'])
                                ->pluck('id')
                                ->filter()
                                ->values();

                SectionPage::where('page_key', $validatedData['page_key'])->where('section_key', 'valeurs')
                                ->whereNotIn('id', $submittedIds)
                                ->delete();    
                foreach ($validatedData['valeurs'] as $index => $pilier) {
                    $pilierData = [
                        'page_key' => $validatedData['page_key'],
                        'section_key' => 'valeurs',
                        'title' => $pilier['title'] ?? null,
                        'description' => $pilier['description'] ?? null,
                        'subtitle' => $pilier['subtitle'] ?? null,
                        'icon' => $pilier['icon'] ?? null,
                    ];

                    if (isset($pilier['id'])) {
                        // Mise à jour
                        SectionPage::updateOrCreate(
                            ['id' => $pilier['id']],
                            $pilierData
                        );
                    } else {
                        // Création
                        SectionPage::create($pilierData);
                    }
                }
            }

            // Sauvegarder la section premiere
            if ($request->hasFile('section_premiere_image')) {
                    // Supprimer l'ancienne image si elle existe
                    $existing = \App\Models\SectionPage::where('page_key', $validatedData['page_key'])->where('section_key', 'section_premiere')->first();
                    if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                        \Storage::delete('public/' . $existing->image);
                    }

                    $sectionPremiereImagePath = $request->file('section_premiere_image')->store('section_images', 'public');
            }

            if(isset($validatedData['section_premiere_title']) || isset($validatedData['section_premiere_subtitle']) || isset($validatedData['section_premiere_description']) || isset($validatedData['section_premiere_cta_label']) || isset($validatedData['section_premiere_cta_url']) || isset($validatedData['section_premiere_image']) || isset($validatedData['section_premiere_image_url'])) {
                $sectionPremiereData = [
                    'page_key' => $validatedData['page_key'],
                    'section_key' => 'section_premiere',
                    'title' => $validatedData['section_premiere_title'] ?? null,
                    'subtitle' => $validatedData['section_premiere_subtitle'] ?? null,
                    'description' => $validatedData['section_premiere_description'] ?? null,
                    'cta_label' => $validatedData['section_premiere_cta_label'] ?? null,
                    'cta_url' => $validatedData['section_premiere_cta_url'] ?? null,
                    'image_url' => $validatedData['section_premiere_image_url'] ?? null,
                    ...($request->hasFile('section_premiere_image') ? ['image' => $sectionPremiereImagePath] : []),
                ];
                SectionPage::updateOrCreate(
                    ['page_key' => $validatedData['page_key'], 'section_key' => 'section_premiere'],
                    $sectionPremiereData
                );
            }
            
            // Sauvegarder la section vision
            // if ($request->hasFile('section_vision_image')) {
            //     // Supprimer l'ancienne image si elle existe
            //     $existing = \App\Models\SectionPage::where('page_key', $validatedData['page_key'])->where('section_key', 'section_vision')->first();
            //     if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
            //         \Storage::delete('public/' . $existing->image);
            //     }

            //     $sectionVisionImagePath = $request->file('section_vision_image')->store('section_images', 'public');
            // }
            if(isset($validatedData['vision_title']) || isset($validatedData['vision_description']) /*|| isset($validatedData['section_vision_image']) || isset($validatedData['section_vision_image_url'])*/) {
                $sectionVisionData = [
                    'page_key' => $validatedData['page_key'],
                    'section_key' => 'vision',
                    'title' => $validatedData['vision_title'] ?? null,
                    // 'subtitle' => $validatedData['vision_subtitle'] ?? null,
                    'description' => $validatedData['vision_description'] ?? null,
                    ];
                SectionPage::updateOrCreate(
                    ['page_key' => $validatedData['page_key'], 'section_key' => 'vision'],
                    $sectionVisionData
                );
            }

            // Sauvegarder la section gouvernance
            if (isset($validatedData['gouvernances']) && is_array($validatedData['gouvernances'])) {
                $submittedIds = collect($validatedData['gouvernances'])
                                ->pluck('id')
                                ->filter()
                                ->values();
                SectionPage::where('page_key', $validatedData['page_key'])->where('section_key', 'gouvernance')
                                ->whereNotIn('id', $submittedIds)
                                ->delete();
                foreach ($validatedData['gouvernances'] as $index => $gouvernance) {
                    $gouvernanceData = [
                        'page_key' => $validatedData['page_key'],
                        'section_key' => 'gouvernance',
                        'title' => $gouvernance['title'] ?? null,
                        'description' => $gouvernance['description'] ?? null,
                        'subtitle' => $gouvernance['subtitle'] ?? null, 
                        'icon' => $gouvernance['icon'] ?? null,
                    ];
                    if (!empty($gouvernance['id'])) {
                        // Mise à jour
                        SectionPage::updateOrCreate(
                            ['id' => $gouvernance['id']],
                            $gouvernanceData
                        );
                    } else {
                        // Création
                        SectionPage::create(
                            $gouvernanceData
                        );
                    }
                }
            }

            // Sauvegarder la section presentation
            // if ($request->hasFile('section_presentation_image')) {
            //     // Supprimer l'ancienne image si elle existe
            //     $existing = \App\Models\SectionPage::where('page_key', $validatedData['page_key'])->where('section_key', 'presentation')->first();
            //     if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
            //         \Storage::delete('public/' . $existing->image);
            //     }   
            //     $sectionPresentationImagePath = $request->file('section_presentation_image')->store('section_images', 'public');
            // }

            if(isset($validatedData['section_presentation_title']) || isset($validatedData['section_presentation_description']) /*|| isset($validatedData['section_presentation_image']) || isset($validatedData['section_presentation_image_url'])*/) {
                $sectionPresentationData = [
                    'page_key' => $validatedData['page_key'],
                    'section_key' => 'presentation',
                    'title' => $validatedData['section_presentation_title'] ?? null,
                    // 'subtitle' => $validatedData['section_presentation_subtitle'] ?? null,
                    'description' => $validatedData['section_presentation_description'] ?? null,
                    // 'cta_label' => $validatedData['section_presentation_cta_label'] ?? null,
                    // 'cta_url' => $validatedData['section_presentation_cta_url'] ?? null,
                    // 'image_url' => $validatedData['section_presentation_image_url'] ?? null,
                    // ...($request->hasFile('section_presentation_image') ? ['image' => $sectionPresentationImagePath] : []),
                ];
                SectionPage::updateOrCreate(
                    ['page_key' => $validatedData['page_key'], 'section_key' => 'presentation'],
                    $sectionPresentationData
                );
            }

            // Sauvegarder les chiffres vision de la section vision
            if (isset($validatedData['chiffres_vision']) && is_array($validatedData['chiffres_vision'])) {
                $submittedIds = collect($validatedData['chiffres_vision'])
                                ->pluck('id')
                                ->filter()
                                ->values();
                Chiffre::where('page_key', $validatedData['page_key'])->where('section_key', 'vision')
                                ->whereNotIn('id', $submittedIds)
                                ->delete();
                foreach ($validatedData['chiffres_vision'] as $chiffre) {
                    $chiffreData = [
                        'page_key' => $validatedData['page_key'],
                        'section_key' => 'vision',
                        'label' => $chiffre['label'] ?? null,
                        'value' => $chiffre['value'] ?? null,
                        'description' => $chiffre['description'] ?? null,
                        'icon' => $chiffre['icon'] ?? null,
                    ];
                    if (!empty($chiffre['id'])) {
                        Chiffre::updateOrCreate(
                            ['id' => $chiffre['id']],
                            $chiffreData
                        );
                    } else {
                        Chiffre::create($chiffreData);
                    }
                }
            }

        
            $data = [
                'success' => true,
                'message' => 'Contenu de la page Notre équipe sauvegardé avec succès.',
            ];
            return response()->json($data, 200);

        } catch (\Throwable $th) {
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la sauvegarde du contenu de la page Notre équipe.',
                'error' => $th->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }

    // Page Implantation
    public function implantation()
    {
        $page_key = 'implantation';
        $bureaux = BureauPays::where('page_key', $page_key)->get();
        $banniere = BanniereHero::where('page_key', $page_key)->first();
        $seo = Seo::where('page_key', $page_key)->first();
        $accroche = Accroche::where('page_key', $page_key)->first();
        $chiffres = Chiffre::where('page_key', $page_key)->where('section_key', 'chiffres')->get();
        $about = SectionPage::where('page_key', $page_key)->where('section_key', 'about')->first();
        $section_premiere = SectionPage::where('page_key', $page_key)->where('section_key', 'section_premiere')->first();
        return view('admin.pages.qui-sommes-nous.implantation.index', compact('bureaux', 'banniere', 'seo', 'accroche', 'page_key', 'chiffres', 'about', 'section_premiere'));
    }

    // sauvegarder ou mettre à jour les contenus de la page Implantation
    public function saveImplantationContent(StoreImplantationContentRequest $request){
        try {
            $validatedData = $request->validated();
            $imagePath = null;
            $imagePathAbout = null;
            $sectionPremiereImagePath= null;

             // Sauvegarder la bannière
            if (isset($validatedData['banniere_title']) || isset($validatedData['banniere_subtitle']) || isset($validatedData['banniere_image']) || isset($validatedData['banniere_image_url'])) {
                
                if ($request->hasFile('banniere_image')) {
                    $existing = \App\Models\BanniereHero::where('page_key', $validatedData['page_key'])->first();
                    if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                        \Storage::delete('public/' . $existing->image);
                    }

                    $imagePath = $request->file('banniere_image')->store('hero_images', 'public');
                }

                $banniereData = [
                    'page_key' => $validatedData['page_key'],
                    'section_key' => $validatedData['banniere_section_key'],
                    'title' => $validatedData['banniere_title'] ?? null,
                    'subtitle' => $validatedData['banniere_subtitle'] ?? null,
                    'image_url' => $validatedData['banniere_image_url'] ?? null,
                    'cta_label' => $validatedData['banniere_cta_label'] ?? null,
                    'cta_url' => $validatedData['banniere_cta_url'] ?? null,
                    ...($imagePath ? ['image' => $imagePath] : []),
                ];

                BanniereHero::updateOrCreate(
                    ['page_key' => $validatedData['page_key'], 'section_key' => $validatedData['banniere_section_key']],
                    $banniereData
                );
            }

            // Sauvegarder les chiffres
            if (isset($validatedData['chiffres']) && is_array($validatedData['chiffres'])) {
                
                $submittedIds = collect($validatedData['chiffres'])
                                ->pluck('id')
                                ->filter() // retire null et ""
                                ->values();

                Chiffre::where('page_key', $validatedData['page_key'])
                                ->whereNotIn('id', $submittedIds)
                                ->delete();

            
                foreach ($validatedData['chiffres'] as $chiffre) {
                    $chiffreData = [
                        'page_key'    => $validatedData['page_key'],
                        'section_key' => 'chiffres',
                        'label'       => $chiffre['label']       ?? null,
                        'value'       => $chiffre['value']       ?? null,
                        'description' => $chiffre['description'] ?? null,
                        'icon'        => $chiffre['icon']        ?? null,
                    ];

                    if (!empty($chiffre['id'])) {
                        Chiffre::updateOrCreate(
                            ['id' => $chiffre['id']],
                            $chiffreData
                        );
                    } else {
                        Chiffre::create($chiffreData);
                    }
                }
            }

            // Sauvegarde de l'accroche
            if(!empty($validatedData['accroche_title']) || !empty($validatedData['accroche_subtitle']) || !empty($validatedData['accroche_description']) || !empty($validatedData['accroche_cta_label']) || !empty($validatedData['accroche_cta_url'])) {

                \App\Models\Accroche::updateOrCreate(
                    ['page_key' => $validatedData['page_key']],
                    [
                        'title' => $validatedData['accroche_title'],
                        'subtitle' => $validatedData['accroche_subtitle'],
                        'description' => $validatedData['accroche_description'],
                        'cta_label' => $validatedData['accroche_cta_label'],
                        'cta_url' => $validatedData['accroche_cta_url'],
                        'section_key' => 'accroche',
                        'page_key' => $validatedData['page_key'],
                    ]
                );
            }

            // Sauvegarde du SEO
            if(!empty($validatedData['seo_title']) || !empty($validatedData['seo_description']) || !empty($validatedData['seo_keywords'])) {
                \App\Models\Seo::updateOrCreate(
                    ['page_key' => $validatedData['seo_page_key']],
                    [
                        'title' => $validatedData['seo_title'],
                        'description' => $validatedData['seo_description'],
                        'keywords' => $validatedData['seo_keywords'],
                    ]
                );
            }

            // Sauvegarder la section premiere
            if ($request->hasFile('section_premiere_image')) {
                    // Supprimer l'ancienne image si elle existe
                    $existing = \App\Models\SectionPage::where('page_key', $validatedData['page_key'])->where('section_key', 'section_premiere')->first();
                    if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                        \Storage::delete('public/' . $existing->image);
                    }

                    $sectionPremiereImagePath = $request->file('section_premiere_image')->store('section_images', 'public');
            }

            if(isset($validatedData['section_premiere_title']) || isset($validatedData['section_premiere_subtitle']) || isset($validatedData['section_premiere_description']) || isset($validatedData['section_premiere_cta_label']) || isset($validatedData['section_premiere_cta_url']) || isset($validatedData['section_premiere_image']) || isset($validatedData['section_premiere_image_url'])) {
                $sectionPremiereData = [
                    'page_key' => $validatedData['page_key'],
                    'section_key' => 'section_premiere',
                    'title' => $validatedData['section_premiere_title'] ?? null,
                    'subtitle' => $validatedData['section_premiere_subtitle'] ?? null,
                    'description' => $validatedData['section_premiere_description'] ?? null,
                    'cta_label' => $validatedData['section_premiere_cta_label'] ?? null,
                    'cta_url' => $validatedData['section_premiere_cta_url'] ?? null,
                    'image_url' => $validatedData['section_premiere_image_url'] ?? null,
                    ...($request->hasFile('section_premiere_image') ? ['image' => $sectionPremiereImagePath] : []),
                ];
                SectionPage::updateOrCreate(
                    ['page_key' => $validatedData['page_key'], 'section_key' => 'section_premiere'],
                    $sectionPremiereData
                );
            }

            // Sauvegarder les bureaux
            if (isset($validatedData['bureaux']) && is_array($validatedData['bureaux'])) {
                $submittedIds = collect($validatedData['bureaux'])
                                ->pluck('id')
                                ->filter()
                                ->values();
                BureauPays::where('page_key', $validatedData['page_key'])
                                ->whereNotIn('id', $submittedIds)
                                ->delete();
                foreach ($validatedData['bureaux'] as $index => $bureau) {
                    // stocker l'image si elle est présente
                    $bureauImagePath = null;
                    if (isset($bureau['image']) && $request->hasFile("bureaux.$index.image")) {
                        $existing = \App\Models\BureauPays::where('id', $bureau['id'] ?? 0)->first();
                        if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                            \Storage::delete('public/' . $existing->image);
                        }
                        $bureauImagePath = $request->file("bureaux.$index.image")->store('bureau_images', 'public');
                    }
                    $bureauData = [
                        'page_key' => $validatedData['page_key'],
                        'section_key' => $validatedData['section_key'] ?? 'bureaux',
                        'pays' => $bureau['pays'] ?? null,
                        'code_pays' => $bureau['code_pays'] ?? null,
                        'adresse' => $bureau['adresse'] ?? null,
                        'telephone' => $bureau['telephone'] ?? null,
                        'ville' => $bureau['ville'] ?? null,
                        'email' => $bureau['email'] ?? null,
                        'image_url' => $bureau['image_url'] ?? null,
                        'latitude' => $bureau['latitude'] ?? null,
                        'longitude' => $bureau['longitude'] ?? null,
                        'representant' => $bureau['representant'] ?? null,
                        'maps_url' => $bureau['maps_url'] ?? null,
                        'type_bureau' => $bureau['type_bureau'] ?? null,
                        ...($bureauImagePath ? ['image_url' => $bureauImagePath] : []),
                    ];
                    if (!empty($bureau['id'])) {
                        BureauPays::updateOrCreate(
                            ['id' => $bureau['id']],
                            $bureauData
                        );
                    } else {
                        BureauPays::create($bureauData);
                    }
                }
            }

            // section about
             if ($request->hasFile('about_image')) {
                    // Supprimer l'ancienne image si elle existe
                    $existing = \App\Models\SectionPage::where('page_key', $validatedData['page_key'])->where('section_key', 'section_premiere')->first();
                    if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                        \Storage::delete('public/' . $existing->image);
                    }

                $imagePathAbout = $request->file('about_image')->store('section_images', 'public');
            }
            if(isset($validatedData['about_title']) || isset($validatedData['about_description'])   
            /*|| isset($validatedData['about_image']) || isset($validatedData['about_image_url'])*/) {
                $aboutData = [
                    'page_key' => $validatedData['page_key'],
                    'section_key' => $validatedData['about_section_key'] ?? 'about',
                    'title' => $validatedData['about_title'] ?? null,
                    'subtitle' => $validatedData['about_subtitle'] ?? null,
                    'description' => $validatedData['about_description'] ?? null,
                    'cta_label' => $validatedData['about_cta_label'] ?? null,
                    'cta_url' => $validatedData['about_cta_url'] ?? null,
                    'image_url' => $validatedData['about_image_url'] ?? null,
                    ...($imagePathAbout ? ['image' => $imagePathAbout] : []),
                    // ...($request->hasFile('about_image') ? ['image' => $aboutImagePath] : []),
                ];
                SectionPage::updateOrCreate(
                    ['page_key' => $validatedData['page_key'], 'section_key' => $validatedData['about_section_key'] ?? 'about'],
                    $aboutData
                );
            }

            $data = [
                'success' => true,
                'message' => 'Contenu de la page Implantation sauvegardé avec succès.',
            ];
            return response()->json($data, 200);

        } catch (\Throwable $th) {
            //throw $th;
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la sauvegarde du contenu de la page Implantation.',
                'error' => $th->getMessage(),
            ];
            return response()->json($data, 500);
        }
            
    }
}
