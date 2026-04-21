{{-- Section fonctionnalités --}}
<div class="bg-white p-8 mb-8 rounded-3xl shadow-sm border border-slate-100">
    <div class="flex items-center justify-between">
        <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
            <i class="fas fa-cogs text-green-500"></i> Section "Fonctionnalités"
        </h3>
        <button onclick="addFonctionnalitesSolutionSection()" class="flex items-center gap-2 bg-sonec-green text-white px-4 py-2 rounded-lg hover:bg-green-600 transition-colors">
            <i class="fas fa-plus"></i> Ajouter une fonctionnalité
        </button>
    </div>
    <div id="fonctionnalites-container" class="space-y-6">
    <div id="fonctionnalites-grid" class="grid md:grid-cols-2 gap-6">

        @foreach ($solution->fonctionnalites as $index => $fonctionnalite)
            @php $i = $index + 1; @endphp
            <div data-fonctionnalite
                class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden">

                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>

                <button onclick="removeFonctionnaliteSolutionSection(this)"
                    class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash text-xs"></i>
                </button>

                <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                    <i class="fas fa-star text-purple-500"></i> Fonctionnalité {{ $i }}
                </h3>

                <input type="hidden" name="fonctionnalite_id_{{ $i }}" value="{{ $fonctionnalite->id ?? '' }}">
                <input type="hidden" name="fonctionnalite_page_key" value="{{ $page_key }}">
                <input type="hidden" name="fonctionnalite_section_key" value="fonctionnalites">

                <div class="space-y-4">
                    <div>
                        <label for="fonctionnalite_name_{{ $i }}"
                            class="block text-xs font-bold text-slate-400 uppercase mb-1">
                            Nom de la fonctionnalité
                        </label>
                        <input type="text"
                            id="fonctionnalite_name_{{ $i }}"
                            name="fonctionnalite_name_{{ $i }}[]"
                            value="{{ $fonctionnalite->title ?? '' }}"
                            class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                    </div>

                    <div>
                        <label for="fonctionnalite_icon_{{ $i }}"
                            class="block text-xs font-bold text-slate-400 uppercase mb-1">
                            Classe Icône
                        </label>
                        <input type="text"
                            id="fonctionnalite_icon_{{ $i }}"
                            name="fonctionnalite_icon_{{ $i }}[]"
                            value="{{ $fonctionnalite->icon ?? '' }}"
                            placeholder="ex: fas fa-star"
                            class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500">
                    </div>

                    <div>
                        <label for="fonctionnalite_description_{{ $i }}"
                            class="block text-xs font-bold text-slate-400 uppercase mb-1">
                            Description
                        </label>
                        <textarea
                            id="fonctionnalite_description_{{ $i }}"
                            name="fonctionnalite_description_{{ $i }}[]"
                            placeholder="ex: Description de la fonctionnalité"
                            class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500"
                        >{{ $fonctionnalite->description ?? '' }}</textarea>
                    </div>
                </div>
            </div>
        @endforeach

    </div>
</div>
</div>
