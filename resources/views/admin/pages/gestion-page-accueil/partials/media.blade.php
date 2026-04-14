<div class="space-y-8">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6">Carousel d'images d'accueil</h3>
        {{-- <h2 class="text-2xl font-bold text-sonec-dark">Gestion du contenu de la page d'accueil</h2> --}}
        <button onclick="addSlide() " class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter un slide
        </button>
    </div>
    <div id="carousel-container" class="space-y-6">
        @foreach($carousels as $index => $carousel)
            <div data-slide class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden" data-index="{{ $index }}" data-id="{{ $carousel->id }}" >
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                <button onclick="removeSlide({{ $index }})" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash text-xs"></i>
                </button>
                <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Slide {{ $index + 1 }}</h3>
                 <input type="hidden" name="id[]" value="{{ $carousel->id }}">
                <div class="space-y-4">
                    <div>
                        <label for="title-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Titre Principal</label>
                        <input type="text" id="title-{{ $index }}" name="title[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $carousel->title }}">
                    </div>
                    <div>
                        <label for="subtitle-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Sous-titre</label>
                        <textarea name="subtitle[]" id="subtitle-{{ $index }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500 outline-none" rows="2">{{ $carousel->subtitle }}</textarea>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label for="cta_text-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Texte Bouton</label>
                            <input type="text" id="cta_text-{{ $index }}" name="cta_text[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm" value="{{ $carousel->cta_label }}">
                        </div>
                        <div class="flex-1">
                            <label for="cta_url-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien Bouton</label>
                            <input type="text" id="cta_url-{{ $index }}" name="cta_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $carousel->cta_url }}">
                        </div>
                        {{-- Url de l'image  --}}
                        <div class="flex-1">
                            <label for="image_url-{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
                            <input type="text" id="image_url-{{ $index }}" name="image_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $carousel->image_url }}">
                        </div>

                    </div>
                </div>
                <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                    <div class="text-center">
                        @if($carousel->image)
                            <img src="{{ asset('storage/' . $carousel->image) }}" alt="Image du slide {{ $index + 1 }}" class="max-h-40 object-contain mb-2">
                        @elseif($carousel->image_url)
                            <img src="{{ $carousel->image_url }}" alt="Image du slide {{ $index + 1 }}" class="max-h-40 object-contain mb-2">
                        @else
                            <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                            <p class="text-xs text-slate-400">Aperçu image</p>
                        @endif
                        <input id="image-{{ $index }}" type="file" name="image[]" class="hidden">
                        <label for="image-{{ $index }}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100">Changer</label>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

          