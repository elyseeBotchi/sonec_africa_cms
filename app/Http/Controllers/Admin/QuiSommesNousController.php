<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDecouvrirSonecRequest;
use App\Http\Requests\StoreHistoireRequest;
use App\Models\Accroche;
use App\Models\BanniereHero;
use App\Models\Certfication;
use App\Models\Chiffre;
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

                // Sauvegarde du SEO
                \App\Models\Seo::updateOrCreate(
                    ['page_key' => $validatedData['seo_page_key']],
                    [
                        'title' => $validatedData['seo_title'],
                        'description' => $validatedData['seo_description'],
                        'keywords' => $validatedData['seo_keywords'],
                    ]
                );

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

                        // ✅ isset() ne suffit pas, il faut aussi vérifier que la valeur est non vide
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

                // Sauvegarde du SEO
                \App\Models\Seo::updateOrCreate(
                    ['page_key' => $validatedData['seo_page_key']],
                    [
                        'title' => $validatedData['seo_title'],
                        'description' => $validatedData['seo_description'],
                        'keywords' => $validatedData['seo_keywords'],
                    ]
                );

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
                // stocker l'image si elle est présente
                if ($request->hasFile('section_premiere_image')) {
                    // Supprimer l'ancienne image si elle existe
                    $existing = \App\Models\SectionPage::where('page_key', $validatedData['page_key'])->where('section_key', 'section_premiere')->first();
                    if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                        \Storage::delete('public/' . $existing->image);
                    }

                    $sectionPremiereImagePath = $request->file('section_premiere_image')->store('section_images', 'public');
                }
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
        return view('admin.pages.qui-sommes-nous.notre-equipe.index', compact('banniere', 'seo', 'accroche', 'page_key'));  

    }
}
