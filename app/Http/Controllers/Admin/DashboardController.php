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

        $demandeDemo = 0;

        return view('admin.dashboard', compact('recentArticlesCount', 'recentCandidaturesCount', 'totalCandidaturesCount', 'totalVisites', 'todayVisites', 'uniqueTodayVisites', 'demandeDemo'));
    }
}
