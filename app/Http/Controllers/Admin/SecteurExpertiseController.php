<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSecteurExpertiseRequest;
use App\Http\Requests\UpdateSecteurExpertiseRequest;
use App\Models\SecteurExpertise;
use App\Models\SecteurExpertiseAccroche;
use App\Models\SecteurExpertiseChiffre;
use App\Models\SecteurExpertiseSection;
use App\Models\SecteurExpertiseSeo;
use Illuminate\Http\Request;

class SecteurExpertiseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $secteurExpertises = SecteurExpertise::all();
        return view('admin.pages.gestion-secteur-expertise.index', compact('secteurExpertises'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_key = 'secteur_expertise';
        return view('admin.pages.gestion-secteur-expertise.create-secteur-expertise', compact('page_key'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSecteurExpertiseRequest $request)
    {
        //
        try {
            $validatedData = $request->validated();
            $imageCouverturePath = null;
            $temoignageImagePath = null;

            if ( isset($validatedData['secteur_expertise_name']) && isset($validatedData['secteur_expertise_title_hero']) || isset($validatedData['secteur_expertise_resume']) || isset($validatedData['secteur_expertise_contact_phone']) || isset($validatedData['secteur_expertise_description'])) {
                
                if ($request->hasFile('secteur_expertise_image_couverture') && $request->file('secteur_expertise_image_couverture')->isValid()) {
                    $existing = \App\Models\BanniereHero::where('page_key', $validatedData['page_key'])->first();
                    if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                        \Storage::delete('public/' . $existing->image);
                    }

                    $imagePath = $request->file('secteur_expertise_image_couverture')->store('hero_images', 'public');
                }

                $slug = \Str::slug($validatedData['secteur_expertise_slug'] ?? $validatedData['secteur_expertise_title_hero'], '-');
                $slugCount = SecteurExpertise::where('slug', 'LIKE', $slug . '%')->count();
                if ($slugCount > 0) {
                    $slug .= '-' . ($slugCount + 1);
                }

                $infosData = [
                    'page_key' => $validatedData['page_key'] ?? 'secteur_expertise',
                    'name' => $validatedData['secteur_expertise_name'],
                    'title_hero' => $validatedData['secteur_expertise_title_hero'] ?? null,
                    'subtitle' => $validatedData['secteur_expertise_subtitle'] ?? null,
                    'slug' => $slug,
                    'contact_email' => $validatedData['secteur_expertise_contact_email'] ?? null,
                    'contact_phone' => $validatedData['secteur_expertise_contact_phone'] ?? null,
                    'cible' => $validatedData['secteur_expertise_cible'] ?? null,
                    'resume' => $validatedData['secteur_expertise_resume'] ?? null,
                    'description' => $validatedData['secteur_expertise_description'] ?? null,
                    'image' => $imagePath ?? null,
                    'image_url' => $validatedData['secteur_expertise_image_url'] ?? null,
                    'cta_label_1' => $validatedData['secteur_expertise_cta_label_1'] ?? null,
                    'cta_label_2' => $validatedData['secteur_expertise_cta_label_2'] ?? null,
                    'cta_url_1' => $validatedData['secteur_expertise_cta_url_1'] ?? null,
                    'cta_url_2' => $validatedData['secteur_expertise_cta_url_2'] ?? null,
                    'icon' => $validatedData['secteur_expertise_icon'] ?? null,
                    'icon_url' => $validatedData['secteur_expertise_icon_url'] ?? null,
                    'disponibilite' => $validatedData['secteur_expertise_disponibilite'] ?? null,
                    'mis_avant' => $validatedData['secteur_expertise_mis_avant'] == 1 ? true : false,
                    'section_key' => $validatedData['secteur_expertise_section_key'] ?? 'hero',
                    'image_url' => $validatedData['secteur_expertise_image_url'] ?? null,
                    'image' => $imageCouverturePath ?? null,
                
                ];

                $secteurExpertise = SecteurExpertise::create($infosData);
            }

            // Chiffres de la solution
            if (isset($validatedData['chiffres']) && is_array($validatedData['chiffres'])) {
                foreach ($validatedData['chiffres'] as $chiffreData) {
                    SecteurExpertiseChiffre::create([
                        'secteur_expertise_id' => $secteurExpertise->id,
                        'label' => $chiffreData['label'] ?? null,
                        'value' => $chiffreData['value'] ?? null,
                        'description' => $chiffreData['description'] ?? null,
                        'icon' => $chiffreData['icon'] ?? null,
                        'icon_url' => $chiffreData['icon_url'] ?? null,
                        'section_key' => $chiffreData['section_key'] ?? null,
                        'page_key' => $validatedData['page_key'] ?? 'solutions',
                    ]);
                }
            }

            

            // Partenaires de la solution
            if (isset($validatedData['partenaires']) && is_array($validatedData['partenaires'])) {
                foreach ($validatedData['partenaires'] as $partenaireData) {
                    $logoPath = null;
                    if (isset($partenaireData['logo']) && $partenaireData['logo']->isValid()) {
                        $logoPath = $partenaireData['logo']->store('partenaire_logos', 'public');
                    }
                    \App\Models\SecteurExpertisePartenaire::create([
                        'secteur_expertise_id' => $secteurExpertise->id,
                        'name' => $partenaireData['name'] ?? null,
                        'logo' => $logoPath ?? null,
                        'logo_url' => $partenaireData['logo_url'] ?? null,
                        'section_key' => $partenaireData['section_key'] ?? 'partenaires',
                        'page_key' => $validatedData['page_key'] ?? 'secteur_expertise',
                    ]);
                }
            }

            // Accroche de la solution
            if (isset($validatedData['accroche_title']) || isset($validatedData['accroche_description']) || isset($validatedData['accroche_cta_label'])) {
                $accrocheData = [
                    'secteur_expertise_id' => $secteurExpertise->id,
                    'page_key' => $validatedData['accroche_page_key'] ?? 'secteur_expertise',
                    'section_key' => $validatedData['accroche_section_key'] ?? 'accroche',
                    'title' => $validatedData['accroche_title'] ?? null,
                    'subtitle' => $validatedData['accroche_subtitle'] ?? null,
                    'description' => $validatedData['accroche_description'] ?? null,
                    'cta_label' => $validatedData['accroche_cta_label'] ?? null,
                    'cta_url' => $validatedData['accroche_cta_url'] ?? null,
                ];
                SecteurExpertiseAccroche::create($accrocheData);
            }

            // Sections de personnalisation de la solution
            if (isset($validatedData['personnalisation_sections']) && is_array($validatedData['personnalisation_sections'])) {
                foreach ($validatedData['personnalisation_sections'] as $sectionData) {
                    $sectionImagePath = null;
                    if (isset($sectionData['image']) && $sectionData['image']->isValid()) {
                        $sectionImagePath = $sectionData['image']->store('solution_section_images', 'public');
                    }
                    $sectionKey = \Str::slug($sectionData['title'] ?? 'personnalisation_' . uniqid());
                    SecteurExpertiseSection::create([
                        'secteur_expertise_id' => $secteurExpertise->id,
                        'title' => $sectionData['title'] ?? null,
                        // 'subtitle' => $sectionData['subtitle'] ?? null,
                        'content' => $sectionData['content'] ?? null,
                        // 'image' => $sectionImagePath ?? null,
                        // 'image_url' => $sectionData['image_url'] ?? null,
                        // 'cta_label' => $sectionData['cta_label'] ?? null,
                        // 'cta_url' => $sectionData['cta_url'] ?? null,
                        // 'icon' => $sectionData['icon'] ?? null,
                        // 'icon_url' => $sectionData['icon_url'] ?? null,
                        'section_key' => $sectionKey,
                        'page_key' => $validatedData['page_key'] ?? 'solutions',
                    ]);
                }
            }


            // SEO de la solution
            if (isset($validatedData['seo_title']) || isset($validatedData['seo_description']) || isset($validatedData['seo_keywords'])) {
                \App\Models\SecteurExpertiseSeo::create([
                    'secteur_expertise_id' => $secteurExpertise->id,
                    'meta_title' => $validatedData['seo_title'] ?? null,
                    'meta_description' => $validatedData['seo_description'] ?? null,
                    'meta_keywords' => $validatedData['seo_keywords'] ?? null,
                    'og_title' => $validatedData['seo_title'] ?? null,
                    'og_description' => $validatedData['seo_description'] ?? null,
                    'og_image_url' => $validatedData['seo_og_image_url'] ?? null,
                    'twitter_title' => $validatedData['seo_title'] ?? null,
                    'twitter_description' => $validatedData['seo_description'] ?? null,
                    'twitter_image_url' => $validatedData['seo_twitter_image_url'] ?? null,
                    'page_key' => $validatedData['seo_page_key'] ?? 'secteur_expertise',
                    'section_key' => 'seo',
                ]);
            }
            
            return response()->json([
                'success' => true, 
                'data' => $secteurExpertise->load('chiffres', 'partenaires', 'accroche', 'sections', 'seo'),
                'message' => 'Secteur d\'expertise créé avec succès.'
            ]);            

        } catch (\Throwable $th) {
            //throw $th;
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la sauvegarde du secteur d\'expertise.',
                'error' => $th->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(SecteurExpertise $secteurExpertise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SecteurExpertise $secteurExpertise)
    {
        $page_key = 'secteur_expertise';
        $secteurExpertise->load('chiffres', 'partenaires', 'accroche', 'sections', 'seo');
        
        // dd($secteurExpertise);
        return view('admin.pages.gestion-secteur-expertise.edit-secteur-expertise', compact('secteurExpertise', 'page_key'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSecteurExpertiseRequest $request, SecteurExpertise $secteurExpertise)
    {
        //
        try {
            $validatedData = $request->validated();
            $imageCouverturePath = null;
            $temoignageImagePath = null;

            if (isset($validatedData['secteur_expertise_name']) || isset($validatedData['secteur_expertise_resume']) || isset($validatedData['secteur_expertise_contact_phone']) || isset($validatedData['secteur_expertise_description'])) {
                
                if ($request->hasFile('secteur_expertise_image_couverture')) {
                    $existing = \App\Models\BanniereHero::where('page_key', $validatedData['page_key'])->first();
                    if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                        \Storage::delete('public/' . $existing->image);
                    }

                    $imagePath = $request->file('secteur_expertise_image_couverture')->store('hero_images', 'public');
                }

                $slug = \Str::slug($validatedData['secteur_expertise_slug'] ?? $validatedData['secteur_expertise_name'], '-');

                 // Vérifier l'unicité du slug
                $slugCount = SecteurExpertise::where('slug', $slug)->count();
                if ($slugCount > 0) {
                    $slug .= '-' . ($slugCount + 1);
                }

                $infosData = [
                    'page_key' => $validatedData['page_key'] ?? 'secteur_expertise',
                    'name' => $validatedData['secteur_expertise_name'],
                    'title_hero' => $validatedData['secteur_expertise_title_hero'] ?? null,
                    'subtitle' => $validatedData['secteur_expertise_subtitle'] ?? null,
                    'slug' => $slug,
                    'contact_email' => $validatedData['secteur_expertise_contact_email'] ?? null,
                    'contact_phone' => $validatedData['secteur_expertise_contact_phone'] ?? null,
                    'cible' => $validatedData['secteur_expertise_cible'] ?? null,
                    'resume' => $validatedData['secteur_expertise_resume'] ?? null,
                    'description' => $validatedData['secteur_expertise_description'] ?? null,
                    'image' => $imagePath ?? null,
                    'image_url' => $validatedData['secteur_expertise_image_url'] ?? null,
                    'cta_label_1' => $validatedData['secteur_expertise_cta_label_1'] ?? null,
                    'cta_label_2' => $validatedData['secteur_expertise_cta_label_2'] ?? null,
                    'cta_url_1' => $validatedData['secteur_expertise_cta_url_1'] ?? null,
                    'cta_url_2' => $validatedData['secteur_expertise_cta_url_2'] ?? null,
                    'icon' => $validatedData['secteur_expertise_icon'] ?? null,
                    'icon_url' => $validatedData['secteur_expertise_icon_url'] ?? null,
                    'disponibilite' => $validatedData['secteur_expertise_disponibilite'] ?? null,
                    'mis_avant' => $validatedData['secteur_expertise_mis_avant'] == 1 ? true : false,
                    'section_key' => $validatedData['secteur_expertise_section_key'] ?? 'hero',
                    'image_url' => $validatedData['secteur_expertise_image_url'] ?? null,
                    'image' => $imageCouverturePath ?? null,                
                ];

                $secteurExpertise->update($infosData);
            }

            // Chiffres de la solution
            if (isset($validatedData['chiffres']) && is_array($validatedData['chiffres'])) {

                $submittedIds = collect($validatedData['chiffres'])
                    ->pluck('id')
                    ->filter()
                    ->values();

                SecteurExpertiseChiffre::where('secteur_expertise_id', $secteurExpertise->id)
                    ->whereNotIn('id', $submittedIds)
                    ->delete();

                foreach ($validatedData['chiffres'] as $chiffre) {
                    $chiffreData = [
                        'secteur_expertise_id' => $secteurExpertise->id, // manquait dans le create()
                        'page_key'    => $validatedData['page_key'] ?? 'secteur_expertise',
                        'section_key' => 'chiffres',
                        'label'       => $chiffre['label']       ?? null,
                        'value'       => $chiffre['value']       ?? null,
                        'description' => $chiffre['description'] ?? null,
                        'icon'        => $chiffre['icon']        ?? null,
                    ];

                    if (!empty($chiffre['id'])) {
                        SecteurExpertiseChiffre::updateOrCreate(
                            ['id' => $chiffre['id'], 'secteur_expertise_id' => $secteurExpertise->id],
                            $chiffreData
                        );
                    } else {
                        SecteurExpertiseChiffre::create($chiffreData);
                    }
                }
            }

                     

            // Partenaires de la solution
            if (isset($validatedData['partenaires']) && is_array($validatedData['partenaires'])) {
                $submittedIds = collect($validatedData['partenaires'])
                                ->pluck('id')
                                ->filter() 
                                ->values();

                \App\Models\SecteurExpertisePartenaire::where('secteur_expertise_id', $secteurExpertise->id)
                                              ->whereNotIn('id', $submittedIds)
                                              ->delete();

                foreach ($validatedData['partenaires'] as $partenaireData) {
                    $logoPath = null;
                    if (isset($partenaireData['logo']) && $partenaireData['logo']->isValid()) {
                            $logoPath = $partenaireData['logo']->store('partenaire_logos', 'public');
                    }

                    $partenaireRecord = [
                        'secteur_expertise_id' => $secteurExpertise->id,
                        'name'        => $partenaireData['name'] ?? null,
                        'logo_url'    => $partenaireData['logo_url'] ?? null,
                        'section_key' => $partenaireData['section_key'] ?? 'partenaires',
                        'page_key'    => $validatedData['page_key'] ?? 'secteur_expertise',
                        'website'     => $partenaireData['url'] ?? null,
                    ];
                    if ($logoPath) {
                        $partenaireRecord['logo'] = $logoPath;
                    }

                    if (isset($partenaireData['id'])) {
                        \App\Models\SecteurExpertisePartenaire::updateOrCreate(
                            ['id' => $partenaireData['id'], 'secteur_expertise_id' => $secteurExpertise->id],
                            $partenaireRecord
                        );
                    } else {
                        \App\Models\SecteurExpertisePartenaire::create($partenaireRecord);
                    }
                }
            }

            // Accroche de la solution
            if (isset($validatedData['accroche_title']) || isset($validatedData['accroche_description']) || isset($validatedData['accroche_cta_label'])) {
                $accrocheData = [
                    'secteur_expertise_id' => $secteurExpertise->id,
                    'page_key' => $validatedData['accroche_page_key'] ?? 'secteur_expertise',
                    'section_key' => $validatedData['accroche_section_key'] ?? 'accroche',
                    'title' => $validatedData['accroche_title'] ?? null,
                    'subtitle' => $validatedData['accroche_subtitle'] ?? null,
                    'content' => $validatedData['accroche_description'] ?? null,
                    'cta_label_1' => $validatedData['accroche_cta_label'] ?? null,
                    // 'cta_label_2' => $validatedData['accroche_cta_label_2'] ?? null,
                    'cta_url_1' => $validatedData['accroche_cta_url'] ?? null,
                    // 'cta_url_2' => $validatedData['accroche_cta_url_2'] ?? null,
                ];
                SecteurExpertiseAccroche::updateOrCreate(
                    ['id' => $validatedData['accroche_id'] ?? null, 'secteur_expertise_id' => $secteurExpertise->id],
                    $accrocheData
                );
            }

            
            if (isset($validatedData['personnalisation_sections']) && is_array($validatedData['personnalisation_sections'])) {

                $submittedIds = collect($validatedData['personnalisation_sections'])
                    ->pluck('id')
                    ->filter()
                    ->values();

                SecteurExpertiseSection::where('secteur_expertise_id', $secteurExpertise->id)
                    ->whereNotIn('id', $submittedIds)
                    ->delete();

                foreach ($validatedData['personnalisation_sections'] as $sectionData) {

                    // Génère un section_key stable depuis le titre, ou un identifiant unique
                    $sectionKey = \Str::slug($sectionData['title'] ?? '')
                        ?: 'section_' . uniqid();

                    $record = [
                        'secteur_expertise_id' => $secteurExpertise->id,
                        'title'       => $sectionData['title']   ?? null,
                        'content'     => $sectionData['content'] ?? null,
                        'section_key' => $sectionKey ?? 'section_' . uniqid(),
                        'page_key'    => $validatedData['page_key'] ?? 'secteur_expertise',
                    ];

                    if (!empty($sectionData['id'])) {
                        SecteurExpertiseSection::updateOrCreate(
                            ['id' => $sectionData['id'], 'secteur_expertise_id' => $secteurExpertise->id],
                            $record
                        );
                    } else {
                        SecteurExpertiseSection::create($record);
                    }
                }
            }

            

            // SEO de la solution
            if (isset($validatedData['seo_title']) || isset($validatedData['seo_description']) || isset($validatedData['seo_keywords'])) {
                $seoData = [
                    'secteur_expertise_id' => $secteurExpertise->id,
                    'meta_title' => $validatedData['seo_title'] ?? null,
                    'meta_description' => $validatedData['seo_description'] ?? null,
                    'meta_keywords' => $validatedData['seo_keywords'] ?? null,
                    'og_title' => $validatedData['seo_title'] ?? null,
                    'og_description' => $validatedData['seo_description'] ?? null,
                    'og_image_url' => $validatedData['seo_og_image_url'] ?? null,
                    'twitter_title' => $validatedData['seo_title'] ?? null,
                    'twitter_description' => $validatedData['seo_description'] ?? null,
                    'twitter_image_url' => $validatedData['seo_twitter_image_url'] ?? null,
                ];

                SecteurExpertiseSeo::updateOrCreate(
                    ['id' => $validatedData['seo_id'] ?? null , 'secteur_expertise_id' => $secteurExpertise->id],
                    $seoData
                );
            }
            
            return response()->json([
                'success' => true, 
                'data' => $secteurExpertise->load('chiffres', 'partenaires', 'accroche', 'sections', 'seo'),
                'message' => 'Secteur d\'expertise modifié avec succès.'
            ]);            

        } catch (\Throwable $th) {
            //throw $th;
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la sauvegarde du secteur d\'expertise.',
                'error' => $th->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SecteurExpertise $secteurExpertise)
    {
        //
        try {
            $secteurExpertise->delete();
            return response()->json([
                    'success' => true, 
                    'message' => 'Secteur d\'expertise supprimé avec succès.',   
                ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Une erreur est survenue lors de la suppression du secteur d\'expertise.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
