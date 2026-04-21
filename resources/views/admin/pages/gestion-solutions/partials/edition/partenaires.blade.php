{{-- Section partenaires --}}
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
            <i class="fas fa-cogs text-green-500"></i> Section "Partenaires"
        </h3>
        <button onclick="addPartenaireSolutionSection()" class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter un partenaire
        </button>
    </div>
    <div id="partenaire-container" class="space-y-6">
        <div id="partenaires-grid" class="grid md:grid-cols-2 gap-6">
            {{-- Les partenaires seront ajoutés dynamiquement via le script js --}}
            @foreach ($solution->partenaires as $index => $partenaire)
                <div data-partenaire class="bg-slate-50 p-4 rounded-xl border border-slate-200 relative">
                    <button onclick="removePartenaireSolutionSection(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Partenaire </h3>
                    <input type="hidden" name="partenaire_id[{{ $index }}]" value="{{ $partenaire->id ?? '' }}">
                    <input type="hidden" name="partenaire_page_key" value="{{ $page_key }}">
                    <input type="hidden" name="partenaire_section_key" value="partenaires">
                    <div class="space-y-4">
                        <div>
                            <label for="partenaire_name_{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                            <input type="text" id="partenaire_name_{{ $index }}" name="partenaire_name_{{ $index }}[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $partenaire->name ?? '' }}">
                        </div>
                        <div class="flex gap-4">
                            
                            <div class="flex-1">
                                <label for="partenaire_url_{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien Bouton</label>
                                <input type="text" id="partenaire_url_{{ $index }}" name="partenaire_url_{{ $index }}[]"  class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $partenaire->website ?? '' }}">
                            </div>  
                            <div class="flex-1">
                                <label for="partenaire_logo_url_{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
                                <input type="text" id="partenaire_logo_url_{{ $index }}" name="partenaire_logo_url_{{ $index }}[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $partenaire->logo_url ?? '' }}">    
                            </div>
                        </div>
                        <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                            <div class="text-center">
                                @if(isset($partenaire->logo))
                                        <img src="{{ asset('storage/' . $partenaire->logo) }}" alt="{{ $partenaire->name ?? '' }}" class="max-h-40 object-contain mb-2">  
                                @elseif(isset($partenaire->logo_url))
                                    <img src="{{ $partenaire->logo_url }}" alt="{{ $partenaire->name ?? '' }}" class="max-h-40 object-contain mb-2">  
                                @else
                                    <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                                    <p class="text-xs text-slate-400 mb-2">Aperçu image section</p>
                                @endif  
                               
                                <input id="partenaire_logo_{{ $index }}" type="file" name="partenaire_logo_{{ $index }}[]" class="hidden">
                                <label for="partenaire_logo_{{ $index }}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100">Changer</label>
                            </div>
                        </div>
                    </div>
                </div>
                
            @endforeach
        </div>
    </div>
</div>
