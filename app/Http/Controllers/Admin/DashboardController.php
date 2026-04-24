<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $statsService;

    public function __construct(\App\Services\StatsService $statsService)
    {
        $this->statsService = $statsService;
    }

    //Methode affichant le dashboard de l'administration
    public function index()
    {
        $recentArticlesCount = $this->statsService->recentArticles();
        $recentCandidaturesCount = $this->statsService->recentCandidatures();
        // $recentSpontaneousCandidaturesCount = $this->statsService->recentSpontaneousCandidatures();
        $totalCandidaturesCount = $this->statsService->totalCandidatures();
        $totalVisites = $this->statsService->total();
        $todayVisites = $this->statsService->today();
        $uniqueTodayVisites = $this->statsService->uniqueToday();
        // Visite les 30 derniers jours pour graphique
        $last30DaysVisites = count($this->statsService->last30Days()) ? $this->statsService->last30Days()[count($this->statsService->last30Days()) - 1]['total'] : 0;

        // Pourcentage de croissance des visites par rapport au mois précédent
        $growthPercentage = $this->statsService->growthPercentage();

        $demandeDemo = 0;

        return view('admin.dashboard', compact('recentArticlesCount', 'recentCandidaturesCount', 'totalCandidaturesCount', 'totalVisites', 'todayVisites', 'uniqueTodayVisites', 'demandeDemo', 'last30DaysVisites', 'growthPercentage' ));
    }
}
