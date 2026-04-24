<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //Methode affichant le dashboard de l'administration
    public function index()
    {
        // Nombre total d'articles recents
        $recentArticlesCount = \App\Models\Article::where('created_at', '>=', now()->subDays(7))->count();

        // Nombre total de candidatures recents
        $recentCandidaturesCount = \App\Models\Candidature::where('created_at', '>=', now()->subDays(7))->count();

        // Candidatures spontanées recents
        $recentSpontaneousCandidaturesCount = \App\Models\CandidatureSpontanee::where('created_at', '>=', now()->subDays(7))->count();

        $taotalCandidaturesCount = $recentCandidaturesCount + $recentSpontaneousCandidaturesCount;

        return view('admin.dashboard', compact('recentArticlesCount', 'recentCandidaturesCount', 'recentSpontaneousCandidaturesCount', 'totalCandidaturesCount'));
    }
}
