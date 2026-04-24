@extends('admin.layout.appLayout')


@section('content')
    <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
        <div class="flex items-center gap-4">
            <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Vue d'ensemble</h2>
            <span id="status-badge" class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-md border border-green-200 hidden">Modifications en cours</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ url('/') }}" class="text-sm font-semibold text-slate-500 hover:text-sonec-green flex items-center gap-2">
                <i class="fas fa-external-link-alt"></i> Voir le site
            </a>
            {{-- <button onclick="saveAll()" class="bg-sonec-dark hover:bg-sonec-green text-white px-5 py-2 rounded-lg font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                <i class="fas fa-save"></i> Enregistrer
            </button> --}}
        </div>
    </header>
    <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
         <!-- DASHBOARD HOME -->
        <div id="view-dashboard" class="editor-section active max-w-6xl mx-auto">
            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-slate-400 text-xs font-bold uppercase tracking-wider">Visiteurs (30j)</span>
                        <span class="text-green-500 text-xs font-bold bg-green-50 px-2 py-1 rounded">+12%</span>
                    </div>
                    <h3 class="text-3xl font-bold text-sonec-dark">{{ $totalVisites ?? 0 }}</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-slate-400 text-xs font-bold uppercase tracking-wider">Candidatures</span>
                        <span class="text-blue-500 text-xs font-bold bg-blue-50 px-2 py-1 rounded">+{{ $recentCandidaturesCount ?? 0 }}</span>
                    </div>
                    <h3 class="text-3xl font-bold text-sonec-dark">{{ $totalCandidaturesCount ?? 0 }}</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-slate-400 text-xs font-bold uppercase tracking-wider">Articles</span>
                        <span class="text-purple-500 text-xs font-bold bg-purple-50 px-2 py-1 rounded">Nouveau</span>
                    </div>
                    <h3 class="text-3xl font-bold text-sonec-dark">{{ $recentArticlesCount ?? 0 }}</h3>
                </div>
                <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100 hover:shadow-md transition-shadow">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-slate-400 text-xs font-bold uppercase tracking-wider">Demandes Démo</span>
                        <span class="text-orange-500 text-xs font-bold bg-orange-50 px-2 py-1 rounded">Urgent</span>
                    </div>
                    <h3 class="text-3xl font-bold text-sonec-dark">{{ $demandeDemo ?? 0 }}</h3>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                    <h3 class="font-bold text-sonec-dark">Activité Récente</h3>
                    <button class="text-sonec-green text-sm font-bold">Tout voir</button>
                </div>
                <div class="divide-y divide-slate-50">
                    <div class="p-4 flex items-center gap-4 hover:bg-slate-50 transition-colors cursor-pointer" onclick="switchPage('home')">
                        <div class="w-10 h-10 rounded-full bg-purple-100 text-purple-600 flex items-center justify-center"><i class="fas fa-pen"></i></div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-slate-700">Modification Page Accueil</p>
                            <p class="text-xs text-slate-400">Section Hero mise à jour par Admin</p>
                        </div>
                        <span class="text-xs text-slate-400 font-mono">10:42</span>
                    </div>
                    <div class="p-4 flex items-center gap-4 hover:bg-slate-50 transition-colors cursor-pointer" onclick="switchPage('careers')">
                        <div class="w-10 h-10 rounded-full bg-orange-100 text-orange-600 flex items-center justify-center"><i class="fas fa-briefcase"></i></div>
                        <div class="flex-1">
                            <p class="text-sm font-bold text-slate-700">Nouvelle Offre d'emploi</p>
                            <p class="text-xs text-slate-400">Dev Fullstack ajouté</p>
                        </div>
                        <span class="text-xs text-slate-400 font-mono">Hier</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection