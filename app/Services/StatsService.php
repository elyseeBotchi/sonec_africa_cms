<?php
    namespace App\Services;

    use App\Models\Visite;
    use Illuminate\Support\Facades\DB;

    class StatsService
    {
        // Total des visites
        public function total(): int
        {
            return Visite::count();
        }

        // Visites du jour
        public function today(): int
        {
            return Visite::today()->count();
        }

        // Visiteurs uniques du jour
        public function uniqueToday(): int
        {
            return Visite::today()->unique()->count();
        }

        // Visites des 30 derniers jours (pour graphique)
        public function last30Days(): array
        {
            return Visite::select(
                    DB::raw('DATE(created_at) as date'),
                    DB::raw('COUNT(*) as total'),
                    DB::raw('SUM(is_unique) as uniques')
                )
                ->where('created_at', '>=', now()->subDays(30))
                ->groupBy('date')
                ->orderBy('date')
                ->get()
                ->toArray();
        }

        // Pages les plus visitées
        public function topPages(int $limit = 5): array
        {
            return Visite::select('url', DB::raw('COUNT(*) as total'))
                ->groupBy('url')
                ->orderByDesc('total')
                ->limit($limit)
                ->get()
                ->toArray();
        }

        // Répartition par device
        public function byDevice(): array
        {
            return Visite::select('device', DB::raw('COUNT(*) as total'))
                ->groupBy('device')
                ->get()
                ->toArray();
        }

        // Répartition par navigateur
        public function byBrowser(): array
        {
            return Visite::select('browser', DB::raw('COUNT(*) as total'))
                ->groupBy('browser')
                ->orderByDesc('total')
                ->get()
                ->toArray();
        }

        // Total des candidatures
        public function totalCandidatures(): int
        {
            return \App\Models\Candidature::count() + \App\Models\CandidatureSpontanee::count();
        }

        // Total des articles récents
        public function recentArticles(): int
        {
            return \App\Models\Article::where('created_at', '>=', now()->subDays(7))->count();
        }

        // Total des candidatures récentes
        public function recentCandidatures(): int
        {
            return \App\Models\Candidature::where('created_at', '>=', now()->subDays(7))->count() + 
                \App\Models\CandidatureSpontanee::where('created_at', '>=', now()->subDays(7))->count();
        }
    }