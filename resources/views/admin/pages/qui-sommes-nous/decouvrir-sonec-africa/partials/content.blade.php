{{-- Section vision --}}
<div class="bg-white  mb-8 p-8 rounded-3xl shadow-sm border border-slate-100">
    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
        <i class="fas fa-info-circle text-blue-500"></i> Section "Notre Vision"
    </h3>
    <div class="grid md:grid-cols-2 gap-6">
        <input type="hidden" name="section_key" value="vision">
        <div>
            <label for="vision_title" class="block text-xs font-bold text-slate-400 uppercase mb-1">Titre</label>
            <input type="text" id="vision_title" name="vision_title" value="{{ $vision->title ?? '' }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" >
        </div>
        <div>
            <label for="vision_subtitle" class="block text-xs font-bold text-slate-400 uppercase mb-1">Sous-titre</label>
            <input type="text" id="vision_subtitle" name="vision_subtitle" value="{{ $vision->subtitle ?? '' }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" >
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div>
                <label for="vision_cta_label" class="block text-xs font-bold text-slate-400 uppercase mb-1">Libellé du bouton</label>
                <input type="text" id="vision_cta_label" name="vision_cta_label" value="{{ $vision->cta_label ?? '' }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" >  
            </div>
            <div>
                <label for="vision_cta_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien du bouton</label>
                <input type="text" id="vision_cta_url" name="vision_cta_url" value="{{ $vision->cta_url ?? '' }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" >  
            </div>           
        </div>   
        
        <div>
            <label for="vision_image_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
            <input type="text" id="vision_image_url" name="vision_image_url" value="{{ $vision->image_url ?? '' }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" > 
            
        </div>
    </div>
    <div class="mt-4 mb-8">
        <label for="vision_description" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description Longue</label>
        <textarea id="vision_description" name="vision_description" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm h-32" rows="4">{{ $vision->description ?? '' }}</textarea>
    </div>

    <div class="preview-area-vision bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed">       
        <div class="text-center ">
            <input id="vision_image" name="vision_image" type="file" class=" hidden w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" accept="image/*">
            @if(isset($vision->image))
                <img src="{{ asset('storage/' . $vision->image) }}" alt="{{ $vision->title ?? '' }}" class="max-h-40 object-contain mb-2">  
            @elseif(isset($vision->image_url))
                <img src="{{ $vision->image_url }}" alt="{{ $vision->title ?? '' }}" class="max-h-40 object-contain mb-2">  
            @else
                <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                <p class="text-xs text-slate-400 mb-2">Aperçu image section</p>
            @endif
            <label for="vision_image" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
        </div>        
    </div>
    <div id="preview-image" class="mt-4">
        {{-- @if((isset($presentation->image_url) && filter_var($presentation->image_url, FILTER_VALIDATE_URL)) || (isset($presentation->image) && file_exists(public_path('storage/' . $presentation->image))))
            <img src="{{ $presentation->image_url }}" alt="Aperçu de l'image" class="w-full h-auto rounded-xl border border-slate-200">
        @elseif(isset($presentation->image) && file_exists(public_path('storage/' . $presentation->image)))
            <img src="{{ asset('storage/' . $presentation->image) }}" alt="Aperçu de l'image" class="w-full h-auto rounded-xl border border-slate-200">
        @else
            <p class="text-center text-slate-400">Aucun aperçu disponible</p>
        @endif --}}
    </div>
</div>

{{-- Section piliers --}}
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-cogs text-green-500"></i> Section "Piliers"</h3>
        <button onclick="addPilier() " class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter un pilier
        </button>
    </div>
    <div id="pilier-container" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6" id="piliers-grid">
            @foreach ($piliers as $index => $pilier)
                <div data-pilier class="bg-white border border-slate-200 rounded-xl p-4 relative" data-id="{{ $pilier->id }}">
                    <button type="button" onclick="removePilier(this)" 
                        class="absolute top-5 right-3 text-red-500  p-1.5 rounded-full hover:text-red-600 transition-colors">
                        <i class="fa fa-trash text-xs"></i>
                    </button>
                    <input type="hidden" id="pilier_id-{{ $index }}" name="id[]" value="{{ $pilier->id }}">
                    <input type="hidden" id="pilier_section_key-{{ $index }}" name="section_key[]" value="piliers">
                    <label for="pilier_icon-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône (classe FontAwesome)</label>
                    <input type="text" name="pilier_icon[]" id="pilier_icon-{{ $index }}"
                        class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-mono text-blue-500" 
                        value="{{ $pilier->icon }}"
                        placeholder="fas fa-cog"> 
                    <label for="pilier_title-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Titre</label>
                    <input type="text" name="pilier_title[]" id="pilier_title-{{ $index }}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                        value="{{ $pilier->title }}">
                    <label for="pilier_description-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Description</label>
                    <textarea name="pilier_description[]" id="pilier_description-{{ $index }}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none" 
                        rows="4">{{ $pilier->description }}</textarea>
                </div>
            @endforeach
            
        </div>
    </div>
</div>

{{-- Section chiffres --}}
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-cogs text-green-500"></i> Section "Chiffres"</h3>
        {{-- <h3 class="text-lg font-bold text-sonec-dark mb-6">Carousel d'images d'accueil</h3> --}}
        {{-- <h2 class="text-2xl font-bold text-sonec-dark">Gestion du contenu de la page d'accueil</h2> --}}
        <button onclick="addChiffre() " class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter un chiffre
        </button>
    </div>
    <div id="chiffres-container" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6" id="chiffres-grid">
            @foreach ($chiffres as $index => $chiffre)
                <div data-chiffre class="bg-white border border-slate-200 rounded-xl p-4 relative" data-id="{{ $chiffre->id }}">
                    <button type="button" onclick="removeChiffre(this)" 
                        class="absolute top-5 right-3 text-red-500  p-1.5 rounded-full hover:text-red-600 transition-colors">
                        <i class="fa fa-trash text-xs"></i>
                    </button>
                    <input type="hidden" id="chiffre_id-{{ $index }}" name="id[]" value="{{ $chiffre->id }}">
                    <input type="hidden" id="chiffre_section_key-{{ $index }}" name="chiffre_section_key[]" value="chiffres">
                    
                    <label for="chiffre_label-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Libellé</label>
                    <input type="text" name="chiffre_label[]" id="chiffre_label-{{ $index }}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                        value="{{ $chiffre->label }}">

                    <label for="chiffre_value-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Valeur</label>
                    <input type="text" name="chiffre_value[]" id="chiffre_value-{{ $index }}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                        value="{{ $chiffre->value }}">
                    
                    <label for="chiffre_icon-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône (classe FontAwesome)</label>
                    <input type="text" name="chiffre_icon[]" id="chiffre_icon-{{ $index }}"
                        class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-mono text-blue-500" 
                        value="{{ $chiffre->icon }}"
                        placeholder="fas fa-cog"> 
                    
                    <label for="chiffre_description-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Description</label>
                    <textarea name="chiffre_description[]" id="chiffre_description-{{ $index }}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none" 
                        rows="4">{{ $chiffre->description }}</textarea>
                </div>
            @endforeach
           
        </div>
    </div>
</div>

{{-- Section engagement --}}
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-handshake text-yellow-500"></i> Section "Engagements"</h3>
    <div class="space-y-4">
        
        <input type="hidden" id="engagement_section_key" name="engagement_section_key" value="engagement">
        <div>
            <label for="engagement_title" class="block text-xs font-bold text-slate-400 uppercase mb-1">Titre</label>
            <input type="text" id="engagement_title" name="engagement_title" value="{{ $engagement->title ?? '' }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-yellow-500 outline-none">
        </div>
        <div>
            <label for="engagement_description" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description</label>
            <textarea id="engagement_description" name="engagement_description" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-yellow-500 outline-none" rows="4">{{ $engagement->description ?? '' }}</textarea>
        </div>
    </div>
    <div class="mb-8 mt-4">
        <label for="engagement_image_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
        <input type="text" id="engagement_image_url" name="engagement_image_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $engagement->image_url ?? '' }}"> 
        
    </div>
    <div class="preview-area-engagement bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed">       
        <div class="text-center ">
            <input id="engagement_image" name="engagement_image" type="file" class=" hidden w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" accept="image/*">
            @if(isset($engagement->image))
                <img src="{{ asset('storage/' . $engagement->image) }}" alt="{{ $engagement->title ?? '' }}" class="max-h-40 object-contain mb-2">
            @elseif(isset($engagement->image_url))
                <img src="{{ $engagement->image_url }}" alt="{{ $engagement->title ?? '' }}" class="max-h-40 object-contain mb-2">
            @else
                <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                <p class="text-xs text-slate-400 mb-2">Aperçu image section</p>
            @endif
            <label for="engagement_image" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
        </div>        
    </div>

    {{-- Engagement items --}}
    <div class="mt-8">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-cogs text-green-500"></i> Section "Engagement Items"</h3>
            {{-- <h3 class="text-lg font-bold text-sonec-dark mb-6">Carousel d'images d'accueil</h3> --}}
            {{-- <h2 class="text-2xl font-bold text-sonec-dark">Gestion du contenu de la page d'accueil</h2> --}}
            <button onclick="addEngagementItem() " class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
                <i class="fas fa-plus"></i> Ajouter un engagement
            </button>
        </div>
        <div id="engagements-container" class="space-y-6">
            <div class="grid md:grid-cols-2 gap-6" id="engagements-grid">
                @foreach ($engagements as $index => $engagement)
                    <div data-engagement-item class="bg-white border border-slate-200 rounded-xl p-4 relative" data-id="{{ $engagement->id }}">
                        <button type="button" onclick="removeEngagementItem(this)" 
                            class="absolute top-5 right-3 text-red-500  p-1.5 rounded-full hover:text-red-600 transition-colors">
                            <i class="fa fa-trash text-xs"></i>
                        </button>
                        <input type="hidden" id="engagement_id-{{ $index }}" name="id[]" value="{{ $engagement->id }}">
                        {{-- <input type="hidden" id="engagement_section_key-{{ $index }}" name="section_key[]" value="engagement_items"> --}}
                        <input type="hidden" name="engagement_item_section_key[]" id="engagement_section_key-{{ $index }}" value="engagement_items">
                        <label for="engagement_item_icon-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône (classe FontAwesome)</label>
                        <input type="text" name="engagement_item_icon[]" id="engagement_item_icon-{{ $index }}"
                            class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-mono text-blue-500" 
                            value="{{ $engagement->icon }}"
                            placeholder="fas fa-cog"> 

                        <label for="engagement_item_title-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Titre</label>
                        <input type="text" name="engagement_item_title[]" id="engagement_item_title-{{ $index }}"
                            class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                            value="{{ $engagement->label }}">

                        <label for="engagement_item_description-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Description</label>
                        <textarea name="engagement_item_description[]" id="engagement_item_description-{{ $index }}"
                            class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none" 
                            rows="4">{{ $engagement->description }}</textarea>  
                    </div>                    
                @endforeach
                
            </div>
        </div>
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

            <input type="hidden" name="page_key" value="decouvrir-sonec-africa">
            <input type="hidden" name="accroche_section_key" value="accroche">
        </div>
    </div>
</div>
