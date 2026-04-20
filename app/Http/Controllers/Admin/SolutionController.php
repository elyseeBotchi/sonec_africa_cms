<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSolutionRequest;
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
                $slugCount = Solution::where('slug', $slug)->count();
                if ($slugCount > 0) {
                    $slug .= '-' . ($slugCount + 1);
                }

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
                    'section_key' => $validatedData['infos_section_key'] ?? null,
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
                        'section_key' => $chiffreData['section_key'] ?? null,
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
                        'section_key' => $fonctionnaliteData['section_key'] ?? null,
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
                        'section_key' => $partenaireData['section_key'] ?? null,
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
                        'section_key' => $temoignageData['section_key'] ?? null,
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
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Solution $solution)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Solution $solution)
    {
        //
        try {
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
}
