{{-- Section personnalisation --}}
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
            <i class="fas fa-cogs text-green-500"></i> Section "Personnalisation de sections"
        </h3>
        <button onclick="addPersonnalisationSecteurExpertise()"
            class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter une section
        </button>
    </div>

    <div id="personnalisation-container" class="space-y-6">
        <div id="personnalisation-grid" class="space-y-4">

            @foreach ($secteurExpertise->sections as $index => $section)
                @php $i = $index + 1; @endphp

                <div data-personnalisation
                    class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden">

                    <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>

                    <button type="button" onclick="removePersonnalisationSecteurExpertise(this)"
                        class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>

                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                        <i class="fas fa-star text-purple-500"></i> Section personnalisée {{ $i }}
                    </h3>

                    {{-- Champs cachés --}}
                    <input type="text" name="personnalisation_id_{{ $i }}" value="{{ $section->id ?? '' }}">
                    <input type="hidden" name="personnalisation_page_key" value="{{ $page_key }}">

                    <div class="space-y-4">
                        <div>
                            <label for="personnalisation_title_{{ $i }}"
                                class="block text-xs font-bold text-slate-400 uppercase mb-1">
                                Identifiant (titre) de la section
                            </label>
                            <input type="text"
                                id="personnalisation_title_{{ $i }}"
                                name="personnalisation_title_{{ $i }}[]"
                                value="{{ $section->title ?? '' }}"
                                placeholder="Titre de la section"
                                class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                        </div>

                        <div>
                            <label for="personnalisation_content_{{ $i }}"
                                class="block text-xs font-bold text-slate-400 uppercase mb-1">
                                Contenu de la section (HTML autorisé)
                            </label>
                            <textarea
                                id="personnalisation_content_{{ $i }}"
                                name="personnalisation_content_{{ $i }}[]"
                                placeholder="ex: <h2>Mon contenu</h2><p>Avec du HTML</p>"
                                class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500"
                                rows="5">{{ $section->content ?? '' }}</textarea>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
</div>