
<div class="space-y-8">
    
    <div id="carousel-container" class="space-y-6">
         <div data-slide class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden" data-index=""  >
            <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
            
                {{-- <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Slide {{ $index + 1 }}</h3> --}}
                <input type="hidden" id="banniere_id" name="id" value="{{ $banniere->id ?? '' }}">
                <input type="hidden" id="banniere_page_key" name="page_key" value="decouvrir-sonec-africa">
                <input type="hidden" id="banniere_section_key" name="banniere_section_key" value="banniere">
                <div class="space-y-4">
                <div>
                    <label for="banniere_title" class="block text-xs font-bold text-slate-400 uppercase mb-1">Titre Principal</label>
                    <input type="text" id="banniere_title" name="banniere_title" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $banniere->title ?? '' }}">
                </div>
                <div>
                    <label for="banniere_subtitle" class="block text-xs font-bold text-slate-400 uppercase mb-1">Sous-titre</label>
                    <textarea name="banniere_subtitle" id="banniere_subtitle" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500 outline-none" rows="2">{{ $banniere->subtitle ?? '' }}</textarea>
                </div>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label for="banniere_cta_label" class="block text-xs font-bold text-slate-400 uppercase mb-1">Texte Bouton</label>
                        <input type="text" id="banniere_cta_label" name="banniere_cta_label" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm" value="{{ $banniere->cta_label ?? '' }}">
                    </div>
                    <div class="flex-1">
                        <label for="banniere_cta_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien Bouton</label>
                        <input type="text" id="banniere_cta_url" name="banniere_cta_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $banniere->cta_url ?? '' }}">
                    </div>
                    {{-- Url de l'image  --}}
                    <div class="flex-1">
                        <label for="banniere_image_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
                        <input type="text" id="banniere_image_url" name="banniere_image_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $banniere->image_url ?? '' }}">
                    </div>

                </div>
            </div>
            <div class="preview-area-banniere bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                <div class="text-center">
                    @if(isset($banniere->image))
                        <img src="{{ asset('storage/' . $banniere->image) }}" alt="{{ $banniere->title ?? '' }}" class="max-h-40 object-contain mb-2">
                    @elseif(isset($banniere->image_url))
                        <img src="{{ $banniere->image_url }}" alt="{{ $banniere->title ?? '' }}" class="max-h-40 object-contain mb-2">
                    @else
                        <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                        <p class="text-xs text-slate-400">Aperçu image</p>
                    @endif
                    <input id="banniere_image" type="file" name="image" class="hidden">
                    <label for="banniere_image" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100">Changer</label>
                </div>
            </div>
        </div>
    </div>
</div>

          