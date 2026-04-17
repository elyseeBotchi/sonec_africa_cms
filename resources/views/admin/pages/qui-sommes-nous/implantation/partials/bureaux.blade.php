<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-cogs text-green-500"></i> Section "Bureaux pays"</h3>
        {{-- <h3 class="text-lg font-bold text-sonec-dark mb-6">Carousel d'images d'accueil</h3> --}}
        {{-- <h2 class="text-2xl font-bold text-sonec-dark">Gestion du contenu de la page d'accueil</h2> --}}
        <button onclick="addBureau() " class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter un bureau 
        </button>
    </div>
    <div id="bureaux-container" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6" id="bureaux-grid">
            @foreach($bureaux as $index => $bureau)
                <div data-bureau class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden" data-index="{{ $index }}" data-id="{{ $bureau->id }}" >
                    <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button onclick="removeBureau(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Bureau {{ $index + 1 }}</h3>
                    <input type="hidden" id="bureau_id-{{ $index }}" name="id[]" value="{{ $bureau->id }}">
                    <input type="hidden" id="bureau_page_key-{{ $index }}" name="bureau_page_key" value="implantation">
                    <input type="hidden" id="bureau_section_key-{{ $index }}" name="bureau_section_key[]" value="bureaux">
                    {{-- <input type="hidden" name="existing_bureau_logo[]" value="{{ $bureau ->logo }}"> --}}
                    <div class="space-y-4">
                        <div>
                            <label for="libelle_bureau_pays-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                            <input type="text" id="libelle_bureau_pays-{{ $index }}" name="libelle_bureau_pays[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $bureau->pays }}">
                        </div>
                        <div>
                            <label for="bureau_code_pays-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Code Pays</label>
                            <input type="text" id="bureau_code_pays-{{ $index }}" name="bureau_code_pays[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $bureau->code_pays }}">
                        </div>
                        <div>
                            <label for="bureau_representant-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Représentant</label>
                            <input type="text" id="bureau_representant-{{ $index }}" name="bureau_representant[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $bureau->representant }}">
                        </div>
                        <div>
                            <label for="bureau_telephone-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Téléphone</label>
                            <input type="text" id="bureau_telephone-{{ $index }}" name="bureau_telephone[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $bureau->telephone }}">
                        </div>
                        <div>
                            <label for="bureau_email-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Email</label>
                            <input type="text" id="bureau_email-{{ $index }}" name="bureau_email[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $bureau->email }}">
                        </div>
                        <div>
                            <label for="bureau_adresse-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Adresse</label>
                            <input type="text" id="bureau_adresse-{{ $index }}" name="bureau_adresse[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $bureau->adresse }}"> 
                        </div>
                        <div>
                            <label for="bureau_ville-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Ville</label>
                            <input type="text" id="bureau_ville-{{ $index }}" name="bureau_ville[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $bureau->ville }}">   
                        </div>
                        {{-- type bureau --}}
                        <div>
                            <label for="bureau_type-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Type de bureau</label>
                            <input type="text" id="bureau_type-{{ $index }}" name="bureau_type[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $bureau->type_bureau }}">   
                        </div>
                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label for="bureau_latitude-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Latitude</label>
                                <input type="text" id="bureau_latitude-{{ $index }}" name="bureau_latitude[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $bureau->latitude }}">
                            </div>
                            <div>
                                <label for="bureau_longitude-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Longitude</label>
                                <input type="text" id="bureau_longitude-{{ $index }}" name="bureau_longitude[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $bureau->longitude }}">
                            </div>
                        </div>
                        <div class="flex-1">
                            <label for="bureau_image_url-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
                            <input type="text" id="bureau_image_url-{{ $index }}" name="bureau_image_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $bureau->image_url }}">
                        </div>
                    

                        <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                            <div class="text-center">
                                @if($bureau->image)
                                    <img src="{{ asset('storage/' . $bureau->image) }}" alt="Image du slide {{ $index + 1 }}" class="max-h-40 object-contain mb-2">
                                @elseif($bureau->image_url)
                                    <img src="{{ $bureau->image_url }}" alt="Image du slide {{ $index + 1 }}" class="max-h-40 object-contain mb-2">
                                @else
                                    <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                                    <p class="text-xs text-slate-400">Aperçu image</p>
                                @endif
                                <input id="bureau_image-{{ $index }}" type="file" name="image[]" class="hidden">
                                <label for="bureau_image-{{ $index }}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100">Changer</label>
                            </div>
                        </div>
                    </div>                    
                </div>
            @endforeach
        </div>
    </div>
</div>