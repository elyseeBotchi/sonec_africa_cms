{{-- Section témoignages --}}
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-cogs text-green-500"></i> Section "Témoignages"</h3>
        {{-- <h3 class="text-lg font-bold text-sonec-dark mb-6">Carousel d'images d'accueil</h3> --}}
        {{-- <h2 class="text-2xl font-bold text-sonec-dark">Gestion du contenu de la page d'accueil</h2> --}}
        <button onclick="addTemoignageSolutionSection() " class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter un témoignage
        </button>
    </div>
    <div id="temoignage-container" class="space-y-6">
        <div class="temoignages-grid md:grid-cols-2 gap-6" id="temoignages-grid">
            {{-- Les témoignages seront ajoutés dynamiquement via le script js --}}
           
        </div>
    </div>
</div>