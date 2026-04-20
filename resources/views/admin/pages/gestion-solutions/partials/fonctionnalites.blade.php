{{-- Section fonctionnalités --}}
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
            <i class="fas fa-cogs text-green-500"></i> Section "Fonctionnalités"
        </h3>
        <button onclick="addFonctionnalitesSolutionSection()" class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter une fonctionnalité
        </button>
    </div>
    <div id="fonctionnalites-container" class="space-y-6">
        <div id="fonctionnalites-grid" class="grid md:grid-cols-2 gap-6">
            {{-- Les fonctionnalités seront ajoutées dynamiquement via le script js --}}
        </div>
    </div>
</div>
