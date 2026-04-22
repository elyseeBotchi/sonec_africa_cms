<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\SecteurExpertise;
use Illuminate\Http\Request;

class SecteurExpertiseController extends Controller
{
    public function index()
    {
        $secteurs = SecteurExpertise::where('mis_avant', true)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('web.pages.industries.index', compact('secteurs'));
    }

    public function show(string $slug)
    {
        // slug correspond exactement : banques-et-assurances, telecoms, etc.
        $secteur = SecteurExpertise::with('accroche','sections','seo','chiffres','partenaires')->where('slug', $slug)->firstOrFail();
        
        $autresSecteurs = SecteurExpertise::where('mis_avant', true)
            ->where('id', '!=', $secteur->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $section_enjeux = $secteur->sections()->where('section_key', 'challenge-section')->first();
        $section_avantages = $secteur->sections()->where('section_key', 'avantage-section')->first();
        // $section_solutions = $secteur->sections()->where('section_key', 'solutions')->first();

        return view('web.pages.industries.secteur', compact('secteur', 'autresSecteurs', 'section_enjeux', 'section_avantages'));
    }
}
