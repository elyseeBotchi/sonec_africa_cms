<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-cogs text-green-500"></i> Section "Nos approches"</h3>
        {{-- <h3 class="text-lg font-bold text-sonec-dark mb-6">Carousel d'images d'accueil</h3> --}}
        {{-- <h2 class="text-2xl font-bold text-sonec-dark">Gestion du contenu de la page d'accueil</h2> --}}
        <button onclick="addApproche() " class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter une approche
        </button>
    </div>
    <div id="approche-container" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6" id="approches-grid">
            @foreach($approches as $index => $approche)
                <div data-approche class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden" data-index="{{ $index }}" data-id="{{ $approche->id }}" >
                    <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button onclick="removeApproche({{ $index }})" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Approche {{ $index + 1 }}</h3>
                    <input type="hidden" id="approche_id-{{ $index }}" name="id[]" value="{{ $approche->id }}">
                    <input type="hidden" id="approche_page_key-{{ $index }}" name="approche_page_key" value="decouvrir-sonec-africa">
                    <input type="hidden" id="approche_section_key-{{ $index }}" name="approche_section_key[]" value="approches">
                    {{-- <input type="hidden" name="existing_approche_logo[]" value="{{ $approche->logo }}"> --}}
                    <div class="space-y-4">
                        <div>
                            <label for="approche_title-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                            <input type="text" id="approche_title-{{ $index }}" name="approche_title[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $approche->title }}">
                        </div>
                    
                        <div class="flex gap-4">                            
                            {{-- <div class="flex-1">
                                <label for="approche_url-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien Bouton</label>
                                <input type="text" id="approche_url-{{ $index }}" name="approche_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $approche->url }}">
                            </div> --}}
                            <div class="flex-1">
                                <label for="approche_description-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description</label>
                                <textarea id="approche_description-{{ $index }}" name="approche_description[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500">{{ $approche->description }}</textarea>
                            </div>
                        </div>
                    </div>                    
                </div>
            @endforeach
        </div>
    </div>
</div>

{{-- Section certificationss --}}
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-cogs text-green-500"></i> Section "certifications"</h3>
        {{-- <h3 class="text-lg font-bold text-slate-400 mb-6">Carousel d'images d'accueil</h3> --}}
        {{-- <h2 class="text-2xl font-bold text-sonec-dark">Gestion du contenu de la page d'accueil</h2> --}}
        <button onclick="addCertifications() " class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter un certification
        </button>
    </div>
    <div id="certifications-container" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6" id="certifications-grid">
            @foreach($certifications as $index => $certification)
                <div data-certifications class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden" data-index="{{ $index }}" data-id="{{ $certification->id }}" >
                    <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button onclick="removeCertifications({{ $index }})" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Certification {{ $index + 1 }}</h3>
                    {{-- <input type="hidden" name="id[]" value="{{ $certification->id }}"> --}}
                    <input type="hidden" name="certification_page_key" value="decouvrir-sonec-africa">
                    <input type="hidden" name="certification_section_key[]" value="certifications">
                    {{-- <input type="hidden" name="existing_certifications_logo[]" value="{{ $certification->logo }}"> --}}
                    <input type="hidden" name="certification_id[]" value="{{ $certification->id }}">
                    <div class="space-y-4">
                        <div>
                            <label for="certifications_label-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Titre</label>
                            <input type="text" id="certifications_label-{{ $index }}" name="certification_label[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $certification->label }}">
                        </div>
                        <div class="flex gap-4">                            
                            <div class="flex-1">
                                <label for="certifications_icon-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icon</label>
                                <input type="text" id="certifications_icon-{{ $index }}" name="certification_icon[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $certification->icon }}">
                            </div>                            
                        </div>
                        <div>
                            <label for="certifications_description-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description</label>
                            <textarea id="certifications_description-{{ $index }}" name="certification_description[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">{{ $certification->description }}</textarea>
                        </div>
                    
                        
                    </div>                    
                </div>
            @endforeach
        </div>
    </div>
</div>