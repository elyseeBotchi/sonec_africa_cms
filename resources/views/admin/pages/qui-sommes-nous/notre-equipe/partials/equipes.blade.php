<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-cogs text-green-500"></i> Section "Équipes"</h3>
        {{-- <h3 class="text-lg font-bold text-sonec-dark mb-6">Carousel d'images d'accueil</h3> --}}
        {{-- <h2 class="text-2xl font-bold text-sonec-dark">Gestion du contenu de la page d'accueil</h2> --}}
        <button onclick="addEquipe() " class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter une équipe
        </button>
    </div>
    <div id="equipe-container" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6" id="equipes-grid">
            @foreach($equipes as $index => $equipe)
                <div data-equipe class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden" data-index="{{ $index }}" data-id="{{ $equipe->id }}" >
                    <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button onclick="removeEquipe(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Équipe {{ $index + 1 }}</h3>
                    <input type="hidden" id="equipe_id-{{ $index }}" name="id[]" value="{{ $equipe->id }}">
                    <input type="hidden" id="equipe_page_key-{{ $index }}" name="equipe_page_key" value="notre-equipe">
                    <input type="hidden" id="equipe_section_key-{{ $index }}" name="equipe_section_key[]" value="equipes">
                    {{-- <input type="hidden" name="existing_equipe_logo[]" value="{{ $equipe ->logo }}"> --}}
                    <div class="space-y-4">
                        <div>
                            <label for="equipe_name-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                            <input type="text" id="equipe_name-{{ $index }}" name="equipe_name[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $equipe->name }}">
                        </div>
                        <div>
                            <label for="equipe_role-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Rôle</label>
                            <input type="text" id="equipe_role-{{ $index }}" name="equipe_role[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $equipe->role }}">
                        </div>

                       
                        <div class="flex-1">
                            <label for="equipe_facebook_url-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de Facebook</label>
                            <input type="text" id="equipe_facebook_url-{{ $index }}" name="equipe_facebook_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $equipe->facebook_url }}">
                        </div>
                        <div class="flex-1">
                            <label for="equipe_twitter_url-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de Twitter</label>
                            <input type="text" id="equipe_twitter_url-{{ $index }}" name="equipe_twitter_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $equipe->twitter_url }}">
                        </div>
                        <div class="flex-1">
                            <label for="equipe_linkedin_url-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de LinkedIn</label>
                            <input type="text" id="equipe_linkedin_url-{{ $index }}" name="equipe_linkedin_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $equipe->linkedin_url }}">
                        </div>

                        <div class="flex-1">
                            <label for="equipe_instagram_url-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de Instagram</label>
                            <input type="text" id="equipe_instagram_url-{{ $index }}" name="equipe_instagram_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $equipe->instagram_url }}">
                        </div>


                        <div class="flex-1">
                            <label for="equipe_photo_url-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
                            <input type="text" id="equipe_photo_url-{{ $index }}" name="equipe_photo_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $equipe->photo_url }}">
                        </div>
                    
                        <div class="flex gap-4"> 
                            <div class="flex-1">
                                <label for="equipe_description-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description</label>
                                <textarea id="equipe_description-{{ $index }}" name="equipe_description[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500">{{ $equipe->description }}</textarea>
                            </div>
                        </div>
                        <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                            <div class="text-center">
                                @if($equipe->image)
                                    <img src="{{ asset('storage/' . $equipe->image) }}" alt="Image du slide {{ $index + 1 }}" class="max-h-40 object-contain mb-2">
                                @elseif($equipe->image_url)
                                    <img src="{{ $equipe->image_url }}" alt="Image du slide {{ $index + 1 }}" class="max-h-40 object-contain mb-2">
                                @else
                                    <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                                    <p class="text-xs text-slate-400">Aperçu image</p>
                                @endif
                                <input id="equipe_image-{{ $index }}" type="file" name="image[]" class="hidden">
                                <label for="equipe_image-{{ $index }}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100">Changer</label>
                            </div>
                        </div>
                    </div>                    
                </div>
            @endforeach
        </div>
    </div>
</div>