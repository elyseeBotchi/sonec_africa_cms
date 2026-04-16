<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDecouvrirSonecRequest;
use App\Models\Accroche;
use App\Models\BanniereHero;
use App\Models\Certfication;
use App\Models\Chiffre;
use App\Models\SectionItem;
use App\Models\SectionPage;
use App\Models\Seo;
use Illuminate\Http\Request;

class QuiSommesNousController extends Controller
{
    //
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
                    foreach ($validatedData['chiffres'] as $index => $chiffre) {
                        $chiffreData = [
                            'page_key' => $validatedData['page_key'],
                            'section_key' => 'chiffres',
                            'label' => $chiffre['label'] ?? null,
                            'value' => $chiffre['value'] ?? null,
                            'description' => $chiffre['description'] ?? null,
                            'icon' => $chiffre['icon'] ?? null,
                        ];

                        if (isset($chiffre['id'])) {
                            // Mise à jour
                            Chiffre::updateOrCreate(
                                ['id' => $chiffre['id']],
                                $chiffreData
                            );
                        } else {
                            // Création
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
}
