<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-cogs text-green-500"></i> Section "Nos Clients"</h3>
        {{-- <h3 class="text-lg font-bold text-sonec-dark mb-6">Carousel d'images d'accueil</h3> --}}
        {{-- <h2 class="text-2xl font-bold text-sonec-dark">Gestion du contenu de la page d'accueil</h2> --}}
        <button onclick="addClientSection() " class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter un client
        </button>
    </div>
    <div id="client-container" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6" id="clients-grid">
            @foreach($clients as $index => $client)
                <div data-client class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden" data-index="{{ $index }}" data-id="{{ $client->id }}" >
                    <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button onclick="removeClientSection({{ $index }})" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Client {{ $index + 1 }}</h3>
                    <input type="hidden" name="id[]" value="{{ $client->id }}">
                    <input type="hidden" name="client_page_key" value="accueil">
                    <input type="hidden" name="existing_client_logo[]" value="{{ $client->logo }}">
                    <div class="space-y-4">
                        <div>
                            <label for="client_name-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                            <input type="text" id="client_name-{{ $index }}" name="client_name[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $client->name }}">
                        </div>
                    
                        <div class="flex gap-4">
                            
                            <div class="flex-1">
                                <label for="client_url-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien Bouton</label>
                                <input type="text" id="client_url-{{ $index }}" name="client_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $client->url }}">
                            </div>
                            {{-- Url de l'image  --}}
                            <div class="flex-1">
                                <label for="client_logo_url-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
                                <input type="text" id="client_logo_url-{{ $index }}" name="client_logo_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $client->logo_url }}">
                            </div>

                        </div>
                    </div>
                    <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                        <div class="text-center">
                            @if($client->logo_url)
                                <img src="{{ $client->logo_url }}" alt="Logo du client {{ $client->name }}" class="max-h-40 object-contain mb-2">
                            @elseif($client->logo)
                            <img src="{{ asset('storage/' . $client->logo) }}" alt="Logo du client {{ $client->name }}" class="max-h-40 object-contain mb-2">
                            
                            @else
                                <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                                <p class="text-xs text-slate-400">Aperçu image</p>
                            @endif
                            <input id="client_logo-{{ $index }}" type="file" name="client_logo[]" class="hidden">
                            <label for="client_logo-{{ $index }}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100">Changer</label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Section partenaires --}}
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-cogs text-green-500"></i> Section "Partenaires"</h3>
        {{-- <h3 class="text-lg font-bold text-sonec-dark mb-6">Carousel d'images d'accueil</h3> --}}
        {{-- <h2 class="text-2xl font-bold text-sonec-dark">Gestion du contenu de la page d'accueil</h2> --}}
        <button onclick="addPartenaireSection() " class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter un partenaire
        </button>
    </div>
    <div id="partenaire-container" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6" id="partenaires-grid">
            @foreach($partenaires as $index => $partenaire)
                <div data-partenaire class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden" data-index="{{ $index }}" data-id="{{ $partenaire->id }}" >
                    <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button onclick="removePartenaireSection({{ $index }})" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Parténaire {{ $index + 1 }}</h3>
                    <input type="hidden" name="id[]" value="{{ $partenaire->id }}">
                    <input type="hidden" name="partenaire_page_key" value="accueil">
                    <input type="hidden" name="existing_partenaire_logo[]" value="{{ $partenaire->logo }}">
                    <div class="space-y-4">
                        <div>
                            <label for="partenaire_name-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                            <input type="text" id="partenaire_name-{{ $index }}" name="partenaire_name[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $partenaire->name }}">
                        </div>
                    
                        <div class="flex gap-4">
                            
                            <div class="flex-1">
                                <label for="partenaire_url-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien Bouton</label>
                                <input type="text" id="partenaire_url-{{ $index }}" name="partenaire_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $partenaire->url }}">
                            </div>
                            {{-- Url de l'image  --}}
                            <div class="flex-1">
                                <label for="partenaire_logo_url-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
                                <input type="text" id="partenaire_logo_url-{{ $index }}" name="partenaire_logo_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $partenaire->logo_url }}">
                            </div>

                        </div>
                    </div>
                    <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                        <div class="text-center">
                            @if($partenaire->logo_url)
                                <img src="{{ $partenaire->logo_url }}" alt="Logo du partenaire {{ $partenaire->name }}" class="max-h-40 object-contain mb-2">
                            @elseif($partenaire->logo)
                            <img src="{{ asset('storage/' . $partenaire->logo) }}" alt="Logo du partenaire {{ $partenaire->name }}" class="max-h-40 object-contain mb-2">
                            
                            @else
                                <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                                <p class="text-xs text-slate-400">Aperçu image</p>
                            @endif
                            <input id="partenaire_logo-{{ $index }}" type="file" name="partenaire_logo[]" class="hidden">
                            <label for="partenaire_logo-{{ $index }}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100">Changer</label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Section témoignages --}}
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-cogs text-green-500"></i> Section "Témoignages"</h3>
        {{-- <h3 class="text-lg font-bold text-sonec-dark mb-6">Carousel d'images d'accueil</h3> --}}
        {{-- <h2 class="text-2xl font-bold text-sonec-dark">Gestion du contenu de la page d'accueil</h2> --}}
        <button onclick="addTemoignageSection() " class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter un témoignage
        </button>
    </div>
    <div id="temoignage-container" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6" id="temoignages-grid">
            @foreach($temoignages as $index => $temoignage)
                <div data-temoignage class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden" data-index="{{ $index }}" data-id="{{ $temoignage->id }}" >
                    <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button onclick="removeTemoignageSection({{ $index }})" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Témoignage {{ $index + 1 }}</h3>
                    <input type="hidden" name="id[]" value="{{ $temoignage->id }}">
                    <input type="hidden" name="temoignage_page_key" value="accueil">
                    <input type="hidden" name="existing_temoignage_logo[]" value="{{ $temoignage->logo }}">
                    <div class="space-y-4">
                        <div>
                            <label for="temoignage_name-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                            <input type="text" id="temoignage_name-{{ $index }}" name="temoignage_name[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $temoignage->name ?? '' }}">
                        </div>
                    
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label for="temoignage_company-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Entreprise</label>
                                <input type="text" id="temoignage_company-{{ $index }}" name="temoignage_company[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $temoignage->company ?? '' }}">
                            </div>
                            
                            <div class="flex-1">
                                <label for="temoignage_position-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Position/Fonction</label>
                                <input type="text" id="temoignage_position-{{ $index }}" name="temoignage_position[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $temoignage->position ?? '' }}">
                            </div>
                            {{-- Url de l'image  --}}
                            <div class="flex-1">
                                <label for="temoignage_photo_url-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de la photo</label>
                                <input type="text" id="temoignage_photo_url-{{ $index }}" name="temoignage_photo_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $temoignage->photo_url ?? '' }}">
                            </div>

                        </div>
                    </div>
                    <div class="mt-4">
                        <label for="temoignage_message-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description Longue</label>
                        <textarea id="temoignage_message-{{ $index }}" name="temoignage_message-{{ $index }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm h-32" rows="4">{!! $temoignage->message ?? '' !!}</textarea>
                    </div>
                    <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                        <div class="text-center">
                            @if($temoignage->photo_url)
                                <img src="{{ $temoignage->photo_url }}" alt="Photo du temoignage {{ $temoignage->name }}" class="max-h-40 object-contain mb-2">
                            @elseif($temoignage->photo)

                            <img src="{{ asset('storage/' . $temoignage->logo) }}" alt="Logo du temoignage {{ $temoignage->name }}" class="max-h-40 object-contain mb-2">
                            
                            @else
                                <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                                <p class="text-xs text-slate-400">Aperçu image</p>
                            @endif
                            <input id="temoignage_photo-{{ $index }}" type="file" name="temoignage_photo[]" class="hidden">
                            <label for="temoignage_photo-{{ $index }}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100">Changer</label>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>