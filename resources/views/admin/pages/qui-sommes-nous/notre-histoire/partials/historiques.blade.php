<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-cogs text-green-500"></i> Section "Historique"</h3>
        {{-- <h3 class="text-lg font-bold text-sonec-dark mb-6">Carousel d'images d'accueil</h3> --}}
        {{-- <h2 class="text-2xl font-bold text-sonec-dark">Gestion du contenu de la page d'accueil</h2> --}}
        <button onclick="addHistorique() " class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter une date
        </button>
    </div>
    <div id="historique-container" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6" id="historiques-grid">
            @foreach($historiques as $index => $historique)
                <div data-historique class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden" data-index="{{ $index }}" data-id="{{ $historique->id }}" >
                    <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button onclick="removeHistorique(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Historique {{ $index + 1 }}</h3>
                    <input type="hidden" id="historique_id-{{ $index }}" name="id[]" value="{{ $historique->id }}">
                    <input type="hidden" id="historique_page_key-{{ $index }}" name="historique_page_key" value="decouvrir-sonec-africa">
                    <input type="hidden" id="historique_section_key-{{ $index }}" name="historique_section_key[]" value="historiques">
                    {{-- <input type="hidden" name="existing_historique_logo[]" value="{{ $historique ->logo }}"> --}}
                    <div class="space-y-4">
                        <div>
                            <label for="historique_title-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                            <input type="text" id="historique_title-{{ $index }}" name="historique_title[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $historique->title }}">
                        </div>
                        <div>
                            <label for="historique_date-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Date</label>
                            <input type="text" id="historique_date-{{ $index }}" name="historique_date[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $historique->date }}">
                        </div>
                        <div class="flex-1">
                            <label for="historique_image_url-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
                            <input type="text" id="historique_image_url-{{ $index }}" name="historique_image_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $historique->image_url }}">
                        </div>
                    
                        <div class="flex gap-4"> 
                            <div class="flex-1">
                                <label for="historique_description-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description</label>
                                <textarea id="historique_description-{{ $index }}" name="historique_description[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500">{{ $historique->description }}</textarea>
                            </div>
                        </div>
                        <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                            <div class="text-center">
                                @if($historique->image)
                                    <img src="{{ asset('storage/' . $historique->image) }}" alt="Image du slide {{ $index + 1 }}" class="max-h-40 object-contain mb-2">
                                @elseif($historique->image_url)
                                    <img src="{{ $historique->image_url }}" alt="Image du slide {{ $index + 1 }}" class="max-h-40 object-contain mb-2">
                                @else
                                    <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                                    <p class="text-xs text-slate-400">Aperçu image</p>
                                @endif
                                <input id="historique_image-{{ $index }}" type="file" name="image[]" class="hidden">
                                <label for="historique_image-{{ $index }}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100">Changer</label>
                            </div>
                        </div>
                    </div>                    
                </div>
            @endforeach
        </div>
    </div>
</div>