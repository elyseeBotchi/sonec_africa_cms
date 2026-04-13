<header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
    <div class="flex items-center gap-4">
        <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Vue d'ensemble</h2>
        <span id="status-badge" class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-md border border-green-200 hidden">Modifications en cours</span>
    </div>
    <div class="flex items-center gap-4">
        <a href="#" class="text-sm font-semibold text-slate-500 hover:text-sonec-green flex items-center gap-2">
            <i class="fas fa-external-link-alt"></i> Voir le site
        </a>
        <button onclick="saveAll()" class="bg-sonec-dark hover:bg-sonec-green text-white px-5 py-2 rounded-lg font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
            <i class="fas fa-save"></i> Enregistrer
        </button>
    </div>
</header>