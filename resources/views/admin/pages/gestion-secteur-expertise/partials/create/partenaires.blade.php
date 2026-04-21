{{-- Section partenaires --}}
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
            <i class="fas fa-cogs text-green-500"></i> Section "Partenaires"
        </h3>
        <button onclick="addPartenaireSecteurExpertise()" class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter un partenaire
        </button>
    </div>
    <div id="partenaire-container" class="space-y-6">
        <div id="partenaires-grid" class="grid md:grid-cols-2 gap-6">
            {{-- Les partenaires seront ajoutés dynamiquement via le script js --}}
        </div>
    </div>
</div>
