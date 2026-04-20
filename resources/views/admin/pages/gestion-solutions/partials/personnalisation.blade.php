{{-- Section personnalisation --}}
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
            <i class="fas fa-cogs text-green-500"></i> Section "Personnalisation de sections"
        </h3>
        <button onclick="addPersonnalisationSection()" class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter une section
        </button>
    </div>
    <div id="personnalisation-container" class="space-y-6">
        <div id="personnalisation-grid">
            {{-- Les sections seront ajoutées dynamiquement via le script js --}}
        </div>
    </div>
</div>
