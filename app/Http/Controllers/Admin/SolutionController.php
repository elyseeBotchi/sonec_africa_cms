<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSolutionPageRequest;
use App\Http\Requests\StoreSolutionRequest;
use App\Http\Requests\UpdateSolutionRequest;
use App\Models\Accroche;
use App\Models\Solution;
use App\Models\SolutionAccroche;
use App\Models\SolutionChiffre;
use App\Models\SolutionFonctionnalite;
use App\Models\SolutionSection;
use App\Models\SolutionSeo;
use Illuminate\Http\Request;

class SolutionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $solutions = Solution::orderBy('created_at', 'desc')->get();
        return view('admin.pages.gestion-solutions.index', compact('solutions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $page_key = 'solutions';

        //chiffres de la solution
        // $solutions_chiffres = SolutionChiffre::orderBy('created_at', 'desc')->get();
        // $accroche = Accroche::where('page_', 'solution')->first();
        // $accroche = Accroche::where('page_key', $page_key)->first();
        // $fonctionnalites = SolutionFonctionnalite::orderBy('created_at', 'desc')->get();
        // $solution = Solution::orderBy('created_at', 'desc')->first();
        // $partenaires = 



        return view('admin.pages.gestion-solutions.create-solutions', compact('page_key'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSolutionRequest $request)
    {
        //
        try {
            $validatedData = $request->validated();
            $imageCouverturePath = null;
            $temoignageImagePath = null;

            if (isset($validatedData['infos_title']) || isset($validatedData['infos_resume_solution']) || isset($validatedData['infos_contact_phone_solution']) || isset($validatedData['infos_description_solution'])) {
                
                if ($request->hasFile('infos_image_couverture_solution')) {
                    $existing = \App\Models\BanniereHero::where('page_key', $validatedData['page_key'])->first();
                    if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                        \Storage::delete('public/' . $existing->image);
                    }

                    $imagePath = $request->file('infos_image_couverture_solution')->store('hero_images', 'public');
                }

                $slug = \Str::slug($validatedData['infos_slug_solution'] ?? $validatedData['infos_title'], '-');

                 // Vérifier l'unicité du slug
                // $slugCount = Solution::where('slug', $slug)->count();
                // if ($slugCount > 0) {
                //     $slug .= '-' . ($slugCount + 1);
                // }

                $infosData = [
                    'page_key' => $validatedData['page_key'] ?? 'solutions',
                    'title' => $validatedData['infos_title'] ?? null,
                    'subtitle' => $validatedData['infos_subtitle'] ?? null,
                    'slug' => $slug,
                    'contact_email' => $validatedData['infos_contact_email_solution'] ?? null,
                    'contact_phone' => $validatedData['infos_contact_phone_solution'] ?? null,
                    'cible' => $validatedData['infos_cible_solution'] ?? null,
                    'resume' => $validatedData['infos_resume_solution'] ?? null,
                    'description' => $validatedData['infos_description_solution'] ?? null,
                    'image' => $imagePath ?? null,
                    'image_url' => $validatedData['infos_image_url_solution'] ?? null,
                    'cta_label' => $validatedData['infos_cta_label'] ?? null,
                    'cta_url' => $validatedData['infos_cta_url'] ?? null,
                    'icon' => $validatedData['infos_icon'] ?? null,
                    'icon_url' => $validatedData['infos_icon_url'] ?? null,
                    'disponibilite' => $validatedData['infos_disponibilite_solution'] ?? null,
                    'mis_avant' => $validatedData['infos_mis_avant_solution'] == 1 ? true : false,
                    'section_key' => $validatedData['infos_section_key'] ?? 'infos',
                    'image_url' => $validatedData['infos_image_url_solution'] ?? null,
                    'image' => $imageCouverturePath ?? null,
                
                ];

                $solution = Solution::create($infosData);
            }

            // Chiffres de la solution
            if (isset($validatedData['chiffres']) && is_array($validatedData['chiffres'])) {
                foreach ($validatedData['chiffres'] as $chiffreData) {
                    SolutionChiffre::create([
                        'solution_id' => $solution->id,
                        'label' => $chiffreData['label'] ?? null,
                        'value' => $chiffreData['value'] ?? null,
                        'description' => $chiffreData['description'] ?? null,
                        'icon' => $chiffreData['icon'] ?? null,
                        'icon_url' => $chiffreData['icon_url'] ?? null,
                        'section_key' => $chiffreData['section_key'] ?? 'chiffres',
                        'page_key' => $validatedData['page_key'] ?? 'solutions',
                    ]);
                }
            }

            // Fonctionnalités de la solution
            if (isset($validatedData['fonctionnalites']) && is_array($validatedData['fonctionnalites'])) {
                foreach ($validatedData['fonctionnalites'] as $fonctionnaliteData) {
                    SolutionFonctionnalite::create([
                        'solution_id' => $solution->id,
                        'title' => $fonctionnaliteData['title'] ?? null,
                        'description' => $fonctionnaliteData['description'] ?? null,
                        'icon' => $fonctionnaliteData['icon'] ?? null,
                        'icon_url' => $fonctionnaliteData['icon_url'] ?? null,
                        'section_key' => $fonctionnaliteData['section_key'] ?? 'fonctionnalites',
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
                    \App\Models\SolutionPartenaire::create([
                        'solution_id' => $solution->id,
                        'name' => $partenaireData['name'] ?? null,
                        'logo' => $logoPath ?? null,
                        'logo_url' => $partenaireData['logo_url'] ?? null,
                        'section_key' => $partenaireData['section_key'] ?? 'partenaires',
                        'page_key' => $validatedData['page_key'] ?? 'solutions',
                    ]);
                }
            }

            // Accroche de la solution
            if (isset($validatedData['accroche_title']) || isset($validatedData['accroche_description']) || isset($validatedData['accroche_cta_label'])) {
                $accrocheData = [
                    'solution_id' => $solution->id,
                    'page_key' => $validatedData['accroche_page_key'] ?? 'solutions',
                    'section_key' => $validatedData['accroche_section_key'] ?? 'accroche',
                    'title' => $validatedData['accroche_title'] ?? null,
                    'subtitle' => $validatedData['accroche_subtitle'] ?? null,
                    'description' => $validatedData['accroche_description'] ?? null,
                    'cta_label' => $validatedData['accroche_cta_label'] ?? null,
                    'cta_url' => $validatedData['accroche_cta_url'] ?? null,
                ];
                SolutionAccroche::create($accrocheData);
            }

            // Sections de personnalisation de la solution
            if (isset($validatedData['personnalisation_sections']) && is_array($validatedData['personnalisation_sections'])) {
                foreach ($validatedData['personnalisation_sections'] as $sectionData) {
                    $sectionImagePath = null;
                    if (isset($sectionData['image']) && $sectionData['image']->isValid()) {
                        $sectionImagePath = $sectionData['image']->store('solution_section_images', 'public');
                    }
                    $sectionKey = \Str::slug($sectionData['title'] ?? 'personnalisation_' . uniqid());
                    SolutionSection::create([
                        'solution_id' => $solution->id,
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

            // Témoignages de la solution
            if (isset($validatedData['temoignages']) && is_array($validatedData['temoignages'])) {
                foreach ($validatedData['temoignages'] as $temoignageData) {
                    $temoignageImagePath = null;
                    if (isset($temoignageData['image']) && $temoignageData['image']->isValid()) {
                        $temoignageImagePath = $temoignageData['image']->store('temoignage_images', 'public');
                    }
                    \App\Models\SolutionTemoignage::create([
                        'solution_id' => $solution->id,
                        'author_name' => $temoignageData['author'] ?? null,
                        'author_position' => $temoignageData['author_position'] ?? null,
                        'content' => $temoignageData['content'] ?? null,
                        'author_photo' => $temoignageImagePath ?? null,
                        'author_photo_url' => $temoignageData['image_url'] ?? null,
                        'section_key' => $temoignageData['section_key'] ?? 'temoignages',
                        'page_key' => $validatedData['page_key'] ?? 'solutions',
                    ]);
                }
            }

            // SEO de la solution
            if (isset($validatedData['seo_title']) || isset($validatedData['seo_description']) || isset($validatedData['seo_keywords'])) {
                SolutionSeo::create([
                    'solution_id' => $solution->id,
                    'meta_title' => $validatedData['seo_title'] ?? null,
                    'meta_description' => $validatedData['seo_description'] ?? null,
                    'meta_keywords' => $validatedData['seo_keywords'] ?? null,
                    'og_title' => $validatedData['seo_title'] ?? null,
                    'og_description' => $validatedData['seo_description'] ?? null,
                    'og_image_url' => $validatedData['seo_og_image_url'] ?? null,
                    'twitter_title' => $validatedData['seo_title'] ?? null,
                    'twitter_description' => $validatedData['seo_description'] ?? null,
                    'twitter_image_url' => $validatedData['seo_twitter_image_url'] ?? null,
                    'page_key' => $validatedData['seo_page_key'] ?? 'solutions',
                    'section_key' => 'seo',
                ]);
            }
            
            return response()->json([
                'success' => true, 
                'data' => $solution->load('chiffres', 'fonctionnalites', 'partenaires', 'accroche', 'sections', 'temoignages', 'seo'),
                'message' => 'Solution créée avec succès.'
            ]);            

        } catch (\Throwable $th) {
            //throw $th;
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la sauvegarde de la solution.',
                'error' => $th->getMessage(),
            ];
            return response()->json($data, 500);
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Solution $solution)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Solution $solution)
    {
        //
        $page_key = 'solutions';
        $solution->load('chiffres', 'fonctionnalites', 'partenaires', 'accroche', 'sections', 'temoignages', 'seo');
        return view('admin.pages.gestion-solutions.edit-solutions', compact('solution', 'page_key'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSolutionRequest $request, Solution $solution)
    {
        try {
            $validatedData = $request->validated();
            $imageCouverturePath = null;
            $temoignageImagePath = null;

            if (isset($validatedData['infos_title']) || isset($validatedData['infos_resume_solution']) || isset($validatedData['infos_contact_phone_solution']) || isset($validatedData['infos_description_solution'])) {
                
                if ($request->hasFile('infos_image_couverture_solution')) {
                    $existing = \App\Models\BanniereHero::where('page_key', $validatedData['page_key'])->first();
                    if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                        \Storage::delete('public/' . $existing->image);
                    }

                    $imagePath = $request->file('infos_image_couverture_solution')->store('hero_images', 'public');
                }

                // $slug = \Str::slug($validatedData['infos_slug_solution'] ?? $validatedData['infos_title'], '-');

                 // Vérifier l'unicité du slug
                // $slugCount = Solution::where('slug', $slug)->count();
                // if ($slugCount > 0) {
                //     $slug .= '-' . ($slugCount + 1);
                // }

                $infosData = [
                    'page_key' => $validatedData['page_key'] ?? 'solutions',
                    'title' => $validatedData['infos_title'] ?? null,
                    'subtitle' => $validatedData['infos_subtitle'] ?? null,
                    // 'slug' => $slug,
                    'contact_email' => $validatedData['infos_contact_email_solution'] ?? null,
                    'contact_phone' => $validatedData['infos_contact_phone_solution'] ?? null,
                    'cible' => $validatedData['infos_cible_solution'] ?? null,
                    'resume' => $validatedData['infos_resume_solution'] ?? null,
                    'description' => $validatedData['infos_description_solution'] ?? null,
                    'image' => $imagePath ?? null,
                    'image_url' => $validatedData['infos_image_url_solution'] ?? null,
                    'cta_label' => $validatedData['infos_cta_label'] ?? null,
                    'cta_url' => $validatedData['infos_cta_url'] ?? null,
                    'icon' => $validatedData['infos_icon'] ?? null,
                    'icon_url' => $validatedData['infos_icon_url'] ?? null,
                    'disponibilite' => $validatedData['infos_disponibilite_solution'] ?? null,
                    'mis_avant' => $validatedData['infos_mis_avant_solution'] == 1 ? true : false,
                    'section_key' => $validatedData['infos_section_key'] ?? 'hero',
                    'image_url' => $validatedData['infos_image_url_solution'] ?? null,
                    'image' => $imageCouverturePath ?? null,
                
                ];

                $solution->update($infosData);
            }

            // Chiffres de la solution
            if (isset($validatedData['chiffres']) && is_array($validatedData['chiffres'])) {

                $submittedIds = collect($validatedData['chiffres'])
                    ->pluck('id')
                    ->filter()
                    ->values();

                SolutionChiffre::where('solution_id', $solution->id)
                    ->whereNotIn('id', $submittedIds)
                    ->delete();

                foreach ($validatedData['chiffres'] as $chiffre) {
                    $chiffreData = [
                        'solution_id' => $solution->id, // manquait dans le create()
                        'page_key'    => $validatedData['page_key'] ?? 'solutions',
                        'section_key' => 'chiffres',
                        'label'       => $chiffre['label']       ?? null,
                        'value'       => $chiffre['value']       ?? null,
                        'description' => $chiffre['description'] ?? null,
                        'icon'        => $chiffre['icon']        ?? null,
                    ];

                    if (!empty($chiffre['id'])) {
                        SolutionChiffre::updateOrCreate(
                            ['id' => $chiffre['id'], 'solution_id' => $solution->id],
                            $chiffreData
                        );
                    } else {
                        SolutionChiffre::create($chiffreData);
                    }
                }
            }

            // Fonctionnalités de la solution
            if (isset($validatedData['fonctionnalites']) && is_array($validatedData['fonctionnalites'])) {
                    $submittedIds = collect($validatedData['fonctionnalites'])
                                    ->pluck('id')
                                    ->filter() 
                                    ->values();
                SolutionFonctionnalite::where('solution_id', $solution->id)
                                      ->whereNotIn('id', $submittedIds)
                                      ->delete();

                foreach ($validatedData['fonctionnalites'] as $fonctionnaliteData) {
                    $fonctionnaliteRecord = [
                        'solution_id' => $solution->id,
                        'title' => $fonctionnaliteData['title'] ?? null,
                        'description' => $fonctionnaliteData['description'] ?? null,
                        'icon' => $fonctionnaliteData['icon'] ?? null,
                        'icon_url' => $fonctionnaliteData['icon_url'] ?? null,
                        'section_key' => $fonctionnaliteData['section_key'] ?? 'fonctionnalites',
                        'page_key' => $validatedData['page_key'] ?? 'solutions',
                    ];

                    if (isset($fonctionnaliteData['id'])) {
                        SolutionFonctionnalite::updateOrCreate(
                            ['id' => $fonctionnaliteData['id'], 'solution_id' => $solution->id],
                            $fonctionnaliteRecord
                        );
                    } else {
                        SolutionFonctionnalite::create($fonctionnaliteRecord);
                    }
                }
            }            

            // Partenaires de la solution
            if (isset($validatedData['partenaires']) && is_array($validatedData['partenaires'])) {
                $submittedIds = collect($validatedData['partenaires'])
                                ->pluck('id')
                                ->filter() 
                                ->values();

                \App\Models\SolutionPartenaire::where('solution_id', $solution->id)
                                              ->whereNotIn('id', $submittedIds)
                                              ->delete();

                foreach ($validatedData['partenaires'] as $partenaireData) {
                    $logoPath = null;
                    if (isset($partenaireData['logo']) && $partenaireData['logo']->isValid()) {
                            $logoPath = $partenaireData['logo']->store('partenaire_logos', 'public');
                    }

                    $partenaireRecord = [
                        'solution_id' => $solution->id,
                        'name'        => $partenaireData['name'] ?? null,
                        'logo_url'    => $partenaireData['logo_url'] ?? null,
                        'section_key' => $partenaireData['section_key'] ?? 'partenaires',
                        'page_key'    => $validatedData['page_key'] ?? 'solutions',
                        'website'     => $partenaireData['url'] ?? null,
                    ];
                    if ($logoPath) {
                        $partenaireRecord['logo'] = $logoPath;
                    }

                    if (isset($partenaireData['id'])) {
                        \App\Models\SolutionPartenaire::updateOrCreate(
                            ['id' => $partenaireData['id'], 'solution_id' => $solution->id],
                            $partenaireRecord
                        );
                    } else {
                        \App\Models\SolutionPartenaire::create($partenaireRecord);
                    }
                }
            }

            // Accroche de la solution
            if (isset($validatedData['accroche_title']) || isset($validatedData['accroche_description']) || isset($validatedData['accroche_cta_label'])) {
                $accrocheData = [
                    'solution_id' => $solution->id,
                    'page_key' => $validatedData['accroche_page_key'] ?? 'solutions',
                    'section_key' => $validatedData['accroche_section_key'] ?? 'accroche',
                    'title' => $validatedData['accroche_title'] ?? null,
                    'subtitle' => $validatedData['accroche_subtitle'] ?? null,
                    'description' => $validatedData['accroche_description'] ?? null,
                    'cta_label' => $validatedData['accroche_cta_label'] ?? null,
                    'cta_url' => $validatedData['accroche_cta_url'] ?? null,
                ];
                SolutionAccroche::updateOrCreate(
                    ['id' => $validatedData['accroche_id'] ?? null, 'solution_id' => $solution->id],
                    $accrocheData
                );
            }

            // Sections de personnalisation de la solution
            // if (isset($validatedData['personnalisation_sections']) && is_array($validatedData['personnalisation_sections'])) {
            //     $submittedIds = collect($validatedData['personnalisation_sections'])
            //                     ->pluck('id')
            //                     ->filter() 
            //                     ->values();

            //     SolutionSection::where('solution_id', $solution->id)
            //                    ->whereNotIn('id', $submittedIds)
            //                    ->delete();

            //     foreach ($validatedData['personnalisation_sections'] as $sectionData) {
            //         $sectionImagePath = null;
            //         if (isset($sectionData['image']) && $sectionData['image']->isValid()) {
            //             $sectionImagePath = $sectionData['image']->store('solution_section_images', 'public');
            //         }
            //         $sectionKey = \Str::slug($sectionData['title'] ?? 'personnalisation_' . uniqid());
                    
            //         $sectionRecord = [
            //             'solution_id' => $solution->id,
            //             'title' => $sectionData['title'] ?? null,
            //             // 'subtitle' => $sectionData['subtitle'] ?? null,
            //             'content' => $sectionData['content'] ?? null,
            //             'section_key' => $sectionKey,
            //             'page_key' => $validatedData['page_key'] ?? 'solutions',
            //         ];

            //         if (isset($sectionData['id'])) {
            //             SolutionSection::updateOrCreate(
            //                 ['id' => $sectionData['id'], 'solution_id' => $solution->id],
            //                 $sectionRecord
            //             );
            //         } else {
            //             SolutionSection::create($sectionRecord);
            //         }
            //     }
            // }
            if (isset($validatedData['personnalisation_sections']) && is_array($validatedData['personnalisation_sections'])) {

                $submittedIds = collect($validatedData['personnalisation_sections'])
                    ->pluck('id')
                    ->filter()
                    ->values();

                SolutionSection::where('solution_id', $solution->id)
                    ->whereNotIn('id', $submittedIds)
                    ->delete();

                foreach ($validatedData['personnalisation_sections'] as $sectionData) {

                    // Génère un section_key stable depuis le titre, ou un identifiant unique
                    $sectionKey = \Str::slug($sectionData['title'] ?? '')
                        ?: 'section_' . uniqid();

                    $record = [
                        'solution_id' => $solution->id,
                        'title'       => $sectionData['title']   ?? null,
                        'content'     => $sectionData['content'] ?? null,
                        'section_key' => $sectionKey ?? 'section_' . uniqid(),
                        'page_key'    => $validatedData['page_key'] ?? 'solutions',
                    ];

                    if (!empty($sectionData['id'])) {
                        SolutionSection::updateOrCreate(
                            ['id' => $sectionData['id'], 'solution_id' => $solution->id],
                            $record
                        );
                    } else {
                        SolutionSection::create($record);
                    }
                }
            }

            // Témoignages de la solution
            if (isset($validatedData['temoignages']) && is_array($validatedData['temoignages'])) {

                $submittedIds = collect($validatedData['temoignages'])
                    ->pluck('id')
                    ->filter()
                    ->values();

                \App\Models\SolutionTemoignage::where('solution_id', $solution->id)
                    ->whereNotIn('id', $submittedIds)
                    ->delete();

                foreach ($validatedData['temoignages'] as $temoignageData) {

                    // Upload fichier photo si présent
                    $authorPhotoPath = null;
                    if (!empty($temoignageData['photo']) && $temoignageData['photo']->isValid()) {
                        $authorPhotoPath = $temoignageData['photo']->store('temoignage_photos', 'public');
                    }

                    $record = [
                        'solution_id'      => $solution->id,
                        'author_name'      => $temoignageData['author']      ?? null,
                        'author_company'   => $temoignageData['company']     ?? null,
                        'author_position'  => $temoignageData['position']    ?? null,
                        'content'          => $temoignageData['content']     ?? null,
                        'author_photo_url' => $temoignageData['photo_url']   ?? null,
                        'section_key'      => $temoignageData['section_key'] ?? 'temoignages',
                        'page_key'         => $validatedData['page_key']     ?? 'solutions',
                    ];

                    // N'écrase la photo existante que si un nouveau fichier a été uploadé
                    if ($authorPhotoPath) {
                        $record['author_photo'] = $authorPhotoPath;
                    }

                    if (!empty($temoignageData['id'])) {
                        \App\Models\SolutionTemoignage::updateOrCreate(
                            ['id' => $temoignageData['id'], 'solution_id' => $solution->id],
                            $record
                        );
                    } else {
                        \App\Models\SolutionTemoignage::create($record);
                    }
                }
            }
            

            // SEO de la solution
            if (isset($validatedData['seo_title']) || isset($validatedData['seo_description']) || isset($validatedData['seo_keywords'])) {
                $seoData = [
                    'solution_id' => $solution->id,
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

                SolutionSeo::updateOrCreate(
                    ['id' => $validatedData['seo_id'] ?? null , 'solution_id' => $solution->id],
                    $seoData
                );
            }
            
            return response()->json([
                'success' => true, 
                'data' => $solution->load('chiffres', 'fonctionnalites', 'partenaires', 'accroche', 'sections', 'temoignages', 'seo'),
                'message' => 'Solution modifiée avec succès.'
            ]);            

        } catch (\Throwable $th) {
            //throw $th;
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la sauvegarde de la solution.',
                'error' => $th->getMessage(),
            ];
            return response()->json($data, 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solution $solution)
    {
        //
        try {
            // Supprimer les données associées
            $solution->chiffres()->delete();
            $solution->fonctionnalites()->delete();
            $solution->partenaires()->delete();
            $solution->accroche()->delete();
            $solution->sections()->delete();
            $solution->temoignages()->delete();
            $solution->seo()->delete();
            $solution->delete();
            return response()->json([
                    'success' => true, 
                    'message' => 'Solution supprimée avec succès.',   
                ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Une erreur est survenue lors de la suppression de la solution.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    // Configuration de la page solution
    public function configuration()
    {
        $page_key = 'solutions';
        $accroche = \App\Models\Accroche::where('page_key', $page_key)->first();
        $seo = \App\Models\Seo::where('page_key', $page_key)->first();
        $banniere = \App\Models\BanniereHero::where('page_key', $page_key)->first();
        $sectionItems = \App\Models\SectionItem::where('page_key', $page_key)->get();
        
        return view('admin.pages.gestion-solutions.config-page', compact('accroche', 'seo', 'banniere', 'sectionItems', 'page_key'));
    }

    public function saveConfiguration(StoreSolutionPageRequest $request)
    {
        $page_key = 'solutions';

        try {
            $validatedData = $request->validated();
            // Sauvegarde de l'accroche
            if (isset($validatedData['accroche_title']) || isset($validatedData['accroche_description']) || isset($validatedData['accroche_cta_label'])) {
                $accrocheData = [
                    'page_key' => $page_key,
                    'section_key' => 'accroche',
                    'title' => $validatedData['accroche_title'] ?? null,
                    'subtitle' => $validatedData['accroche_subtitle'] ?? null,
                    'description' => $validatedData['accroche_description'] ?? null,
                    'cta_label' => $validatedData['accroche_cta_label'] ?? null,
                    'cta_url' => $validatedData['accroche_cta_url'] ?? null,
                ];
                if (isset($accrocheData['accroche_id'])) {
                    \App\Models\Accroche::updateOrCreate(
                        ['id' => $request->accroche_id, 'page_key' => $page_key, 'section_key' => 'accroche'],
                        $accrocheData
                    );
                } else {

                    \App\Models\Accroche::updateOrCreate(
                        ['page_key' => $page_key],
                        $accrocheData
                    );
                }
            }

            // Sauvegarde du SEO
            if (isset($validatedData['seo_title']) || isset($validatedData['seo_description']) || isset($validatedData['seo_keywords'])) {
                $seoData = [
                    'page_key' => $page_key,
                    // 'section_key' => 'seo',
                    'title' => $validatedData['seo_title'] ?? null,
                    'description' => $validatedData['seo_description'] ?? null,
                    'keywords' => $validatedData['seo_keywords'] ?? null,
                ];
                if (isset($validatedData['seo_id'])) {
                    \App\Models\Seo::updateOrCreate(
                        ['id' => $validatedData['seo_id'], 'page_key' => $page_key],
                        $seoData
                    );
                } else {
                    \App\Models\Seo::updateOrCreate(
                        ['page_key' => $page_key],
                        $seoData
                    );
                }
            }

            // Sauvegarde de la bannière hero
            if ($request->hasFile('banniere_image') && $request->file('banniere_image')->isValid()) {
                $existing = \App\Models\BanniereHero::where('page_key', $page_key)->first();
                if ($existing && $existing->image && \Storage::exists('public/' . $existing->image)) {
                    \Storage::delete('public/' . $existing->image);
                }   
                     
                $imagePath = $request->file('banniere_image')->store('hero_images', 'public');  
            }
            $banniereData = [
                'page_key' => $page_key,
                'section_key' => 'hero',
                'title' => $validatedData['banniere_title'] ?? null,
                'subtitle' => $validatedData['banniere_subtitle'] ?? null,
                'description' => $validatedData['banniere_description'] ?? null,    
                'cta_label' => $validatedData['banniere_cta_label'] ?? null,
                'cta_url' => $validatedData['banniere_cta_url'] ?? null,
                'image' => $imagePath ?? null,
                'image_url' => $validatedData['banniere_image_url'] ?? null,
                'icon' => $validatedData['banniere_icon'] ?? null,
                'icon_url' => $validatedData['banniere_icon_url'] ?? null,
            ];

            if (isset($validatedData['banniere_id'])) {
                \App\Models\BanniereHero::updateOrCreate(
                    ['id' => $validatedData['banniere_id'], 'page_key' => $page_key, 'section_key' => 'hero'],
                    $banniereData
                );
            } else {
                \App\Models\BanniereHero::create(
                    $banniereData
                );
            } 

            // Avantages
            if (isset($validatedData['avantages']) && is_array($validatedData['avantages'])) {
                $submittedIds = collect($validatedData['avantages'])
                                ->pluck('id')
                                ->filter() 
                                ->values();

                \App\Models\SectionItem::where('page_key', $page_key)
                                        ->where('section_key', 'avantages')
                                        ->whereNotIn('id', $submittedIds)
                                        ->delete();

                foreach ($validatedData['avantages'] as $avantageData) {
                    $record = [
                        'page_key' => $page_key,
                        'section_key' => 'avantages',
                        'label' => $avantageData['title'] ?? null,
                        'description' => $avantageData['description'] ?? null,
                        'icon' => $avantageData['icon'] ?? null,
                        'icon_url' => $avantageData['icon_url'] ?? null,
                    ];

                    if (isset($avantageData['id'])) {
                        \App\Models\SectionItem::updateOrCreate(
                            ['id' => $avantageData['id'], 'page_key' => $page_key, 'section_key' => 'avantages'],
                            $record
                        );
                    } else {
                        \App\Models\SectionItem::create($record);
                    }
                }
            }


             return response()->json([
                'success' => true, 
                'data' => [
                    'accroche' => \App\Models\Accroche::where('page_key', $page_key)->first(),
                    'seo' => \App\Models\Seo::where('page_key', $page_key)->first(),
                    'banniere' => \App\Models\BanniereHero::where('page_key', $page_key)->first(),
                    'avantages' => \App\Models\SectionItem::where('page_key', $page_key)->where('section_key', 'avantages')->get(),
                ],
                'message' => 'Page solutions configurée avec succès.'
            ]); 
        } catch (\Throwable $th) {
            //throw $th;
            $data = [
                'success' => false,
                'message' => 'Une erreur est survenue lors de la sauvegarde de la configuration.',
                'error' => $th->getMessage(),
            ];
            return response()->json($data, 500);
        }

    }

}
