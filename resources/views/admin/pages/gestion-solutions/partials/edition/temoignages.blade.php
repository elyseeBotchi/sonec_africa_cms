{{-- Section témoignages --}}
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
            <i class="fas fa-cogs text-green-500"></i> Section "Témoignages"
        </h3>
        <button onclick="addTemoignageSolutionSection()"
            class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter un témoignage
        </button>
    </div>

    <div id="temoignage-container" class="space-y-6">
        <div class="grid md:grid-cols-2 gap-6" id="temoignages-grid">

            @foreach ($solution->temoignages as $index => $temoignage)
                @php $i = $index + 1; @endphp

                <div data-temoignage
                    class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden">

                    <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>

                    <button onclick="removeTemoignageSolutionSection(this)"
                        class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>

                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                        <i class="fas fa-star text-purple-500"></i> Témoignage {{ $i }}
                    </h3>

                    <input type="hidden" name="temoignage_page_key" value="{{ $page_key }}">
                    <input type="hidden" name="temoignage_section_key_{{ $i }}" value="temoignages">
                    <input type="hidden" name="temoignage_id_{{ $i }}" value="{{ $temoignage->id ?? '' }}">

                    <div class="space-y-4">
                        <div>
                            <label for="temoignage_name_{{ $i }}"
                                class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                            <input type="text"
                                id="temoignage_name_{{ $i }}"
                                name="temoignage_name_{{ $i }}[]"
                                value="{{ $temoignage->author_name ?? '' }}"
                                class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label for="temoignage_company_{{ $i }}"
                                    class="block text-xs font-bold text-slate-400 uppercase mb-1">Entreprise</label>
                                <input type="text"
                                    id="temoignage_company_{{ $i }}"
                                    name="temoignage_company_{{ $i }}[]"
                                    value="{{ $temoignage->author_company ?? '' }}"
                                    class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500">
                            </div>
                            <div class="flex-1">
                                <label for="temoignage_position_{{ $i }}"
                                    class="block text-xs font-bold text-slate-400 uppercase mb-1">Position/Fonction</label>
                                <input type="text"
                                    id="temoignage_position_{{ $i }}"
                                    name="temoignage_position_{{ $i }}[]"
                                    value="{{ $temoignage->author_position ?? '' }}"
                                    class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500">
                            </div>
                            <div class="flex-1">
                                <label for="temoignage_location_{{ $i }}"
                                    class="block text-xs font-bold text-slate-400 uppercase mb-1">Localisation</label>
                                <input type="text"
                                    id="temoignage_location_{{ $i }}"
                                    name="temoignage_location_{{ $i }}[]"
                                    value="{{ $temoignage->author_location ?? '' }}"
                                    class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500">
                            </div>
                            <div class="flex-1">
                                <label for="temoignage_photo_url_{{ $i }}"
                                    class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de la photo</label>
                                <input type="text"
                                    id="temoignage_photo_url_{{ $i }}"
                                    name="temoignage_photo_url_{{ $i }}[]"
                                    value="{{ $temoignage->author_photo_url ?? '' }}"
                                    class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500">
                            </div>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label for="temoignage_message_{{ $i }}"
                            class="block text-xs font-bold text-slate-400 uppercase mb-1">Description Longue</label>
                        <textarea
                            id="temoignage_message_{{ $i }}"
                            name="temoignage_message_{{ $i }}[]"
                            class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm h-32"
                            placeholder="ex: Description du témoignage">{{ $temoignage->content ?? '' }}</textarea>
                    </div>

                    <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                        <div class="text-center">
                            @if (!empty($temoignage->author_photo))
                                <img src="{{ asset('storage/' . $temoignage->author_photo) }}"
                                    alt="{{ $temoignage->author_name ?? '' }}"
                                    class="max-h-40 object-contain mb-2">
                            @elseif (!empty($temoignage->author_photo_url))
                                <img src="{{ $temoignage->author_photo_url }}"
                                    alt="{{ $temoignage->author_name ?? '' }}"
                                    class="max-h-40 object-contain mb-2">
                            @else
                                <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                                <p class="text-xs text-slate-400 mb-2">Aperçu photo</p>
                            @endif

                            <input id="temoignage_photo_{{ $i }}"
                                type="file"
                                name="temoignage_photo_{{ $i }}[]"
                                class="hidden">
                            <label for="temoignage_photo_{{ $i }}"
                                class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">
                                Ajouter une photo
                            </label>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </div>
</div>