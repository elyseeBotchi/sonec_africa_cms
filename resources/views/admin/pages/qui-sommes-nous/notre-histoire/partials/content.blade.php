{{-- Section vision --}}
<div class="bg-white  mb-8 p-8 rounded-3xl shadow-sm border border-slate-100">
    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
        <i class="fas fa-info-circle text-blue-500"></i> Section "Aventure"
    </h3>
    <div class="grid md:grid-cols-2 gap-6">
        <input type="hidden" name="section_key" value="section_premiere">
        <div>
            <label for="section_premiere_title" class="block text-xs font-bold text-slate-400 uppercase mb-1">Titre</label>
            <input type="text" id="section_premiere_title" name="section_premiere_title" value="{{ $section_premiere->title ?? '' }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" >
        </div>
        <div>
            <label for="section_premiere_subtitle" class="block text-xs font-bold text-slate-400 uppercase mb-1">Sous-titre</label>
            <input type="text" id="section_premiere_subtitle" name="section_premiere_subtitle" value="{{ $section_premiere->subtitle ?? '' }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" >
        </div>
        <div class="grid grid-cols-2 gap-2">
            <div>
                <label for="section_premiere_cta_label" class="block text-xs font-bold text-slate-400 uppercase mb-1">Libellé du bouton</label>
                <input type="text" id="section_premiere_cta_label" name="section_premiere_cta_label" value="{{ $section_premiere->cta_label ?? '' }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" >  
            </div>
            <div>
                <label for="section_premiere_cta_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien du bouton</label>
                <input type="text" id="section_premiere_cta_url" name="section_premiere_cta_url" value="{{ $section_premiere->cta_url ?? '' }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" >  
            </div>           
        </div>   
        
        <div>
            <label for="section_premiere_image_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
            <input type="text" id="section_premiere_image_url" name="section_premiere_image_url" value="{{ $section_premiere->image_url ?? '' }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" > 
            
        </div>
    </div>
    <div class="mt-4 mb-8">
        <label for="section_premiere_description" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description Longue</label>
        <textarea id="section_premiere_description" name="section_premiere_description" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm h-32" rows="4">{{ $section_premiere->description ?? '' }}</textarea>
    </div>

   
</div>

{{-- Section valeurs --}}
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-cogs text-green-500"></i> Section "Valeurs"</h3>
        <button onclick="addValeur() " class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter une valeur
        </button>
    </div>
    <div id="valeurs-container" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6" id="valeurs-grid">
            @foreach ($valeurs as $index => $valeur)
                <div data-valeur class="bg-white border border-slate-200 rounded-xl p-4 relative" data-id="{{ $valeur->id }}">
                    <button type="button" onclick="removeValeur(this)" 
                        class="absolute top-5 right-3 text-red-500  p-1.5 rounded-full hover:text-red-600 transition-colors">
                        <i class="fa fa-trash text-xs"></i>
                    </button>
                    <input type="hidden" id="valeur_id-{{ $index }}" name="id[]" value="{{ $valeur->id }}">
                    <input type="hidden" id="valeur_section_key-{{ $index }}" name="section_key[]" value="valeurs">
                    <label for="valeur_icon-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône (classe FontAwesome)</label>
                    <input type="text" name="valeur_icon[]" id="valeur_icon-{{ $index }}"
                        class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-mono text-blue-500" 
                        value="{{ $valeur->icon }}"
                        placeholder="fas fa-cog"> 
                    <label for="valeur_title-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Titre</label>
                    <input type="text" name="valeur_title[]" id="valeur_title-{{ $index }}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                        value="{{ $valeur->title }}">
                    <label for="valeur_description-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Description</label>
                    <textarea name="valeur_description[]" id="valeur_description-{{ $index }}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none" 
                        rows="4">{{ $valeur->description }}</textarea>
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
