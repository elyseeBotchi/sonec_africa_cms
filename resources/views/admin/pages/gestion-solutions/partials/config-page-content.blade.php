
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="mt-8">
        <div class="flex items-center justify-between">
            <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-cogs text-green-500"></i> Section "Avantages Items"</h3>
            {{-- <h3 class="text-lg font-bold text-sonec-dark mb-6">Carousel d'images d'accueil</h3> --}}
            {{-- <h2 class="text-2xl font-bold text-sonec-dark">Gestion du contenu de la page d'accueil</h2> --}}
            <button onclick="addAvantageItem() " class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
                <i class="fas fa-plus"></i> Ajouter un avantage
            </button>
        </div>
        <div id="avantages-container" class="space-y-6">
            <div class="grid md:grid-cols-2 gap-6" id="avantages-grid">
                @foreach ($sectionItems as $index => $avantage)
                    <div data-avantage-item class="bg-white border border-slate-200 rounded-xl p-4 relative" data-id="{{ $avantage->id }}">
                        <button type="button" onclick="removeAvantageItem(this)" 
                            class="absolute top-5 right-3 text-red-500  p-1.5 rounded-full hover:text-red-600 transition-colors">
                            <i class="fa fa-trash text-xs"></i>
                        </button>
                        <input type="hidden" id="avantage_id-{{ $index }}" name="id[]" value="{{ $avantage->id }}">
                        {{-- <input type="hidden" id="avantage_section_key-{{ $index }}" name="section_key[]" value="avantage_items"> --}}
                        <input type="hidden" name="avantage_item_section_key[]" id="avantage_section_key-{{ $index }}" value="avantage_items">
                        <label for="avantage_item_icon-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône (classe FontAwesome)</label>
                        <input type="text" name="avantage_item_icon[]" id="avantage_item_icon-{{ $index }}"
                            class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-mono text-blue-500" 
                            value="{{ $avantage->icon }}"
                            placeholder="fas fa-cog"> 

                        <label for="avantage_item_title-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Titre</label>
                        <input type="text" name="avantage_item_title[]" id="avantage_item_title-{{ $index }}"
                            class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                            value="{{ $avantage->label }}">

                        <label for="avantage_item_description-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Description</label>
                        <textarea name="avantage_item_description[]" id="avantage_item_description-{{ $index }}"
                            class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none" 
                            rows="4">{{ $avantage->description }}</textarea>  
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

            <input type="hidden" name="page_key" value="solutions">
            <input type="hidden" name="accroche_section_key" value="accroche">
            <input type="hidden" name="accroche_id" value="{{ $accroche->id ?? '' }}">
        </div>
    </div>
</div>