{{-- Sections de la page d'acceuil --}}

{{-- Section services --}}
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-cogs text-green-500"></i> Section "Nos Services"</h3>
        {{-- <h3 class="text-lg font-bold text-sonec-dark mb-6">Carousel d'images d'accueil</h3> --}}
        {{-- <h2 class="text-2xl font-bold text-sonec-dark">Gestion du contenu de la page d'accueil</h2> --}}
        <button onclick="addSlideService() " class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter un service
        </button>
    </div>
    <div id="services-container" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6" id="services-grid">
            @foreach($services as $index => $service)
            <div data-service class="bg-white border border-slate-200 rounded-xl p-4 relative">
                <button type="button" onclick="removeService(this)" 
                    class="absolute top-5 right-3 text-red-500  p-1.5 rounded-full hover:text-red-600 transition-colors">
                    <i class="fa fa-trash text-xs"></i>
                </button>
                <input type="hidden" name="id[]" value="{{ $service->id }}">
                <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône (classe FontAwesome)</label>
                <input type="text" name="icon[]" 
                    class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-mono text-blue-500" 
                    value="{{ $service->icon }}"
                    placeholder="fas fa-cog"> 
                <label class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Titre</label>
                <input type="text" name="title[]" 
                    class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                    value="{{ $service->title }}">
                <label class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Description</label>
                <textarea name="description[]" 
                    class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none" 
                    rows="4">{{ $service->description }}</textarea>
            </div>
            @endforeach
        </div>
    </div>
</div>



{{-- Section présentation de l'entreprise --}}
<div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-info-circle text-blue-500"></i> Section "À Propos"</h3>
    <div class="grid md:grid-cols-2 gap-6">
        <div>
            <label for="about_title" class="block text-xs font-bold text-slate-400 uppercase mb-1">Titre</label>
            <input type="text" id="about_title" name="about_title" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" value="{{ $presentation->title ?? '' }}">
        </div>
        <div>
            <label for="about_subtitle" class="block text-xs font-bold text-slate-400 uppercase mb-1">Sous-titre</label>
            <input type="text" id="about_subtitle" name="about_subtitle" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" value="{{ $presentation->subtitle ?? '' }}">
        </div>
        <div class="grid grid-cols-3 gap-2">
            <div>
                <label for="about_annees_experience" class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Années</label>
                <input type="text" id="about_annees_experience" name="about_annees_experience" class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-center font-bold" value="{{ $presentation->annees_experience ?? '' }}">
            </div>
            <div>
                <label for="about_clients" class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Clients</label>
                <input type="text" id="about_clients" name="about_clients" class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-center font-bold" value="{{ $presentation->clients ?? '' }}">
            </div>
            <div>
                <label for="about_pays" class="block text-[10px] font-bold text-slate-400 uppercase mb-1">Pays</label>
                <input type="text" id="about_pays" name="about_pays" class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-center font-bold" value="{{ $presentation->pays ?? '' }}">
            </div>
            {{-- CTA --}}
            <div>
                <label for="about_cta_label" class="block text-xs font-bold text-slate-400 uppercase mb-1">Texte du bouton</label>
                <input type="text" id="about_cta_label" name="about_cta_label" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm" value="{{ $presentation->cta_label ?? '' }}">    

            </div>
            <div>
                <label for="about_cta_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien du bouton</label>
                <input type="text" id="about_cta_url" name="about_cta_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $presentation->cta_url ?? '' }}">  
            </div>
           
        </div>   
        
        <div>
            <label for="about_image_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
            <input type="text" id="about_image_url" name="about_image_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $presentation->image_url ?? '' }}"> 
            
        </div>
    </div>
    <div class="mt-4">
        <label for="about_description" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description Longue</label>
        <textarea id="about_description" name="about_description" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm h-32" rows="4">{!! $presentation->description ?? '' !!}</textarea>
    </div>

    <div class="preview-area-favicon bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed">       
        <div class="text-center ">
            <input id="about_image" name="about_image" type="file" class=" hidden w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" accept="image/*">
            <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
            <p class="text-xs text-slate-400 mb-2">Aperçu image Favicon</p>
            <label for="about_image" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
        </div>        
    </div>
    <div id="preview-image" class="mt-4">
        @if((isset($presentation->image_url) && filter_var($presentation->image_url, FILTER_VALIDATE_URL)) || (isset($presentation->image) && file_exists(public_path('storage/' . $presentation->image))))
            <img src="{{ $presentation->image_url }}" alt="Aperçu de l'image" class="w-full h-auto rounded-xl border border-slate-200">
        @elseif(isset($presentation->image) && file_exists(public_path('storage/' . $presentation->image)))
            <img src="{{ asset('storage/' . $presentation->image) }}" alt="Aperçu de l'image" class="w-full h-auto rounded-xl border border-slate-200">
        @else
            <p class="text-center text-slate-400">Aucun aperçu disponible</p>
        @endif
    </div>
</div>

{{-- Section Accroche --}}
<div class="bg-white p-8 mt-8 rounded-3xl shadow-sm border border-slate-100">
    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-bullhorn text-red-500"></i> Section "Accroche"</h3>
    <div class="space-y-4">
        <div>
            <label for="accroche_title" class="block text-xs font-bold text-slate-400 uppercase mb-1">Titre</label>
            <input type="text" id="accroche_title" name="accroche_title" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-red-500 outline-none" value="{{ $accroche->title ?? '' }}">
        </div>
        <div>
            <label for="accroche_subtitle" class="block text-xs font-bold text-slate-400 uppercase mb-1">Sous-titre</label>
            <textarea id="accroche_subtitle" name="accroche_subtitle" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-500 outline-none" rows="4">{{ $accroche->subtitle ?? '' }}</textarea>
        </div>
        <div>
            <label for="accroche_description" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description</label>
            <textarea id="accroche_description" name="accroche_description" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-500 outline-none" rows="4">{{ $accroche->description ?? '' }}</textarea>
        </div>
        <div class="flex gap-4">
            <div class="flex-1">
                <label for="accroche_cta_label" class="block text-xs font-bold text-slate-400 uppercase mb-1">Texte du bouton</label>
                <input type="text" id="accroche_cta_label" name="accroche_cta_label" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm" value="{{ $accroche->cta_label ?? '' }}">
            </div>
            <div class="flex-1">
                <label for="accroche_cta_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien du bouton</label>
                <input type="text" id="accroche_cta_url" name="accroche_cta_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $accroche->cta_url ?? '' }}">  
            </div>

            <input type="hidden" name="accroche_page_key" value="accueil">
        </div>
    </div>
</div>
