<div class="bg-white  mb-8 p-8 rounded-3xl shadow-sm border border-slate-100">
    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
        <i class="fas fa-info-circle text-blue-500"></i> Section "Informations générales"

    </h3>

    <div>
        <input type="hidden" name="secteur_expertise_section_key" value="hero">
        <input type="hidden" name="page_key" value="{{ $page_key }}">

        <label for="image_couverture_secteur_expertise" class="block text-xs font-bold text-slate-400 uppercase mb-1">Image de couverture du secteur d'expertise</label>
        <div class="preview-area-image-couverture-secteur-expertise bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed">
            <div class="text-center">
                <input id="image_couverture_secteur_expertise" type="file" class=" hidden w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" accept="image/*" name="image_couverture_secteur_expertise">
                <label for="image_couverture_secteur_expertise" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                @if(isset($secteurExpertise->image))
                    <img src="{{ asset('storage/' . $secteurExpertise->image) }}" alt="{{ $secteurExpertise->title ?? '' }}" class="max-h-40 object-contain mb-2">  
                @elseif(isset($secteurExpertise->image_url))
                    <img src="{{ $secteurExpertise->image_url }}" alt="{{ $secteurExpertise->title ?? '' }}" class="max-h-40 object-contain mb-2">  
                @else
                    <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                    <p class="text-xs text-slate-400 mb-2">Aperçu image section</p>
                @endif
            </div>                        
        </div>
        <div class="mt-6">
            <label for="secteur_expertise_image_couverture_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url image de couverture (Si l'image existe en ligne)</label>
            <input type="text" id="secteur_expertise_image_couverture_url" name="secteur_expertise_image_couverture_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="https://storage.googleapis.com/uxpilot-auth.appspot.com/avatars/avatar-5.jpg" value="{{ $secteurExpertise->image_url ?? '' }}">
        </div>

        <div class="bg-blue-200 text-blue-700  mt-3 rounded-md px-5">
            <i class="fas fa-info-circle"></i>
            <small >
                Si vous ne disposez pas d'image en sur votre machine locale, vous avez la possibilté de renseigner l'url de l'image. <br> Veuillez noter que l'image est obligatoire.
            </small>
        </div>
    </div>
    <div class="mt-8">
        <label for="secteur_expertise_name" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom du secteur d'expertise</label>
        <input type="text" id="secteur_expertise_name" name="secteur_expertise_name" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" placeholder="Nom du secteur d'expertise" value="{{ $secteurExpertise->name ?? '' }}">
    </div>
    {{-- subtitle --}}
    <div class="mt-6">
        <label for="secteur_expertise_subtitle" class="block text-xs font-bold text-slate-400 uppercase mb-1">Sous-titre du secteur d'expertise</label>
        <input type="text" id="secteur_expertise_subtitle" name="secteur_expertise_subtitle" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="Sous-titre du secteur d'expertise" value="{{ $secteurExpertise->subtitle_hero ?? '' }}">
    </div>
    <div class="mt-6">
        <label for="secteur_expertise_title_hero" class="block text-xs font-bold text-slate-400 uppercase mb-1">Titre de la section hero</label>
        <input type="text" id="secteur_expertise_title_hero" name="secteur_expertise_title_hero" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="Titre de la section hero" value="{{ $secteurExpertise->title_hero ?? '' }}"> 
    </div>
    <div class="mt-6">
        <label for="secteur_expertise_resume" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description courte du secteur d'expertise</label>
        <textarea id="secteur_expertise_resume" name="secteur_expertise_resume" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" rows="3" placeholder="Description du secteur d'expertise">{{ $secteurExpertise->resume ?? '' }}</textarea>   
    </div>  
    <div class="mt-6">
        <label for="secteur_expertise_slug" class="block text-xs font-bold text-slate-400 uppercase mb-1">Slug du secteur d'expertise (doit être unique)</label>
        <input type="text" id="secteur_expertise_slug" name="secteur_expertise_slug" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="slug-du-secteur-d-expertise" value="{{ $secteurExpertise->slug ?? '' }}">   
    </div>
    <div class="grid grid-cols-2 gap-6 mt-6">
            
        <div>
            <label for="secteur_expertise_contact_email" class="block text-xs font-bold text-slate-400 uppercase mb-1">Email de contact </label>
            <input type="email" id="secteur_expertise_contact_email" name="secteur_expertise_contact_email" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="Email de contact" value="{{ $secteurExpertise->contact_email ?? '' }}">
        </div>
        <div>
            <label for="secteur_expertise_contact_phone" class="block text-xs font-bold text-slate-400 uppercase mb-1">Numéro de téléphone de contact </label>
            <input type="text" id="secteur_expertise_contact_phone" name="secteur_expertise_contact_phone" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="Numéro de téléphone de contact" value="{{ $secteurExpertise->contact_phone ?? '' }}">  
        </div>
    </div>
    <div class="bg-blue-200 text-blue-700  mt-3 rounded-md px-5">
        <i class="fas fa-info-circle"></i>
        <small >
            Les champs "Email de contact" et "Numéro de téléphone de contact" sont optionnels, mais ils permettent aux visiteurs intéressés par le secteur d'expertise de contacter directement l'entreprise pour plus d'informations ou pour exprimer leur intérêt.
        </small>
    </div>
    <div class="grid grid-cols-2 gap-6 mt-6">
        {{-- CTA 1 et 2 --}}
        <div>
            <label for="secteur_expertise_cta_1_label" class="block text-xs font-bold text-slate-400 uppercase mb-1">Label du premier bouton d'appel à l'action</label>
            <input type="text" id="secteur_expertise_cta_1_label" name="secteur_expertise_cta_1_label" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="Label du premier bouton d'appel à l'action (ex: En savoir plus, Contactez-nous, etc.)" value="{{ $secteurExpertise->cta_label_1 ?? '' }}">
        </div>

        {{-- CTA URL --}}
        <div>
            <label for="secteur_expertise_cta_1_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">URL du premier bouton d'appel à l'action</label>
            <input type="text" id="secteur_expertise_cta_1_url" name="secteur_expertise_cta_1_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm font-mono text-blue-500" placeholder="URL du premier bouton d'appel à l'action (ex: https://www.exemple.com/contact)" value="{{ $secteurExpertise->cta_url_1 ?? '' }}">
        </div>
        <div>
            <label for="secteur_expertise_cta_2_label" class="block text-xs font-bold text-slate-400 uppercase mb-1">Label du deuxième bouton d'appel à l'action</label>
            <input type="text" id="secteur_expertise_cta_2_label" name="secteur_expertise_cta_2_label" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="Label du deuxième bouton d'appel à l'action (ex: En savoir plus, Contactez-nous, etc.)" value="{{ $secteurExpertise->cta_label_2 ?? '' }}">   
        </div>
        {{-- CTA URL --}}
        <div>
            <label for="secteur_expertise_cta_2_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">URL du deuxième bouton d'appel à l'action</label>
            <input type="text" id="secteur_expertise_cta_2_url" name="secteur_expertise_cta_2_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm font-mono text-blue-500" placeholder="URL du deuxième bouton d'appel à l'action (ex: https://www.exemple.com/contact)" value="{{ $secteurExpertise->cta_url_2 ?? '' }}">  
        </div>


        <div>
            <label for="secteur_expertise_mis_avant" class="block text-xs font-bold text-slate-400 uppercase mb-1">Mettre en avant ce secteur d'expertise ?</label>
            <select id="secteur_expertise_mis_avant" name="secteur_expertise_mis_avant" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm">
                <option value="0" {{ $secteurExpertise->mis_avant ?? '' == 0 ? 'selected' : '' }}>Non</option>
                <option value="1" {{ $secteurExpertise->mis_avant ?? '' == 1 ? 'selected' : '' }}>Oui</option>
            </select>
        </div>

        <div>
            <label for="secteur_expertise_icon" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône representant le secteur d'expertise</label>
            <input type="text" id="secteur_expertise_icon" name="secteur_expertise_icon" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm font-mono text-blue-500" placeholder="ex: https://www.exemple.com/icon.png ou fa-solid fa-cog" value="{{ $secteurExpertise->icon ?? '' }}">
        </div>
    </div>
    
    

     {{--description  --}}
    <div class="mt-6">
        <label for="secteur_expertise_description" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description détaillée de la solution</label>
        <textarea id="secteur_expertise_description" name="secteur_expertise_description" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" rows="6" placeholder="Description détaillée de la solution">{{ $secteurExpertise->description ?? '' }}</textarea> 
    </div>
   
</div>

{{-- Chiffres clés --}}
<div class="bg-white  mb-8 p-8 rounded-3xl shadow-sm border border-slate-100">
    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
        <i class="fas fa-chart-bar text-green-500"></i> Section "Chiffres clés"

    </h3>

    <div id="chiffres-cles-container" class="space-y-6">
        <div id="chiffres-cles-grid" class="grid md:grid-cols-2 gap-6">

            @foreach($secteurExpertise->chiffres as $index => $chiffre)
                @php $i = $index + 1; @endphp

                <div data-chiffre class="chiffre-cle-item bg-slate-50 p-4 rounded-xl border border-slate-200 relative">

                    <div class="flex justify-end mb-2">
                        <button type="button" onclick="removeChiffreCleSecteurExpertise(this)"
                            class="text-red-500 hover:text-red-700 text-sm font-bold">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>

                    <input type="hidden"
                        name="chiffre_id_{{ $i }}"
                        value="{{ $chiffre->id }}">

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label for="label_chiffre_cle_{{ $i }}"
                                class="block text-xs font-bold text-slate-400 uppercase mb-1">
                                Libellé chiffre clé
                            </label>
                            <input type="text"
                                id="label_chiffre_cle_{{ $i }}"
                                name="label_chiffre_cle_{{ $i }}[]"
                                value="{{ $chiffre->label ?? '' }}"
                                placeholder="ex: 500+"
                                class="w-full p-3 bg-white border border-slate-200 rounded-xl font-normal text-sm">
                        </div>

                        <div>
                            <label for="valeur_chiffre_cle_{{ $i }}"
                                class="block text-xs font-bold text-slate-400 uppercase mb-1">
                                Valeur chiffre clé
                            </label>
                            <input type="text"
                                id="valeur_chiffre_cle_{{ $i }}"
                                name="valeur_chiffre_cle_{{ $i }}[]"
                                value="{{ $chiffre->value ?? '' }}"
                                placeholder="ex: 500+"
                                class="w-full p-3 bg-white border border-slate-200 rounded-xl font-normal text-sm">
                        </div>

                        <div>
                            <label for="icon_chiffre_cle_{{ $i }}"
                                class="block text-xs font-bold text-slate-400 uppercase mb-1">
                                Icône (optionnel)
                            </label>
                            <input type="text"
                                id="icon_chiffre_cle_{{ $i }}"
                                name="icon_chiffre_cle_{{ $i }}[]"
                                value="{{ $chiffre->icon ?? '' }}"
                                placeholder="ex: fas fa-users"
                                class="w-full p-3 bg-white border border-slate-200 rounded-xl font-normal text-sm">
                        </div>

                        <div class="col-span-2">
                            <label for="description_chiffre_cle_{{ $i }}"
                                class="block text-xs font-bold text-slate-400 uppercase mb-1">
                                Description
                            </label>
                            <textarea
                                id="description_chiffre_cle_{{ $i }}"
                                name="description_chiffre_cle_{{ $i }}[]"
                                placeholder="ex: Clients satisfaits"
                                class="w-full p-3 bg-white border border-slate-200 rounded-xl font-normal text-sm"
                            >{{ $chiffre->description ?? '' }}</textarea>
                        </div>
                    </div>

                </div>
            @endforeach

        </div>
    </div>

    <button type="button" onclick="addChiffreCleSecteurExpertise()" class="mt-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2">
        <i class="fas fa-plus"></i> Ajouter un chiffre clé
    </button>
</div>

{{-- note temoignage a implementer --}}

{{-- Section transfomation reussite à implementer --}}


{{-- Section Accroche --}}
<div class="bg-white p-8 mt-8 rounded-3xl shadow-sm border border-slate-100">
    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-bullhorn text-red-500"></i> Section "Accroche"</h3>
    <div class="space-y-4">
        {{-- <input type="hidden" name="accroche_section_key" value="accroche"> --}}
        <input type="hidden" name="page_key" value="{{ $page_key }}">
        <input type="hidden" name="accroche_section_key" value="accroche">
        <input type="hidden" name="accroche_id" value="{{ $secteurExpertise->accroche->id ?? '' }}">
        <div>
            <label for="accroche_title" class="block text-xs font-bold text-slate-400 uppercase mb-1">Titre</label>
            <input type="text" id="accroche_title" name="accroche_title" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-red-500 outline-none" value="{{ $secteurExpertise->accroche->title ?? '' }}">
        </div>
        <div>
            <label for="accroche_subtitle" class="block text-xs font-bold text-slate-400 uppercase mb-1">Sous-titre</label>
            <textarea id="accroche_subtitle" name="accroche_subtitle" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-500 outline-none" rows="4">{{ $secteurExpertise->accroche->subtitle ?? '' }}</textarea>
        </div>
        <div>
            <label for="accroche_description" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description</label>
            <textarea id="accroche_description" name="accroche_description" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-500 outline-none" rows="4">{{ $secteurExpertise->accroche->content ?? '' }}</textarea>
        </div>
        <div class="flex gap-4">
            <div class="flex-1">
                <label for="accroche_cta_label" class="block text-xs font-bold text-slate-400 uppercase mb-1">Texte du bouton</label>
                <input type="text" id="accroche_cta_label" name="accroche_cta_label" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm" value="{{ $secteurExpertise->accroche->cta_label ?? '' }}">
            </div>
            <div class="flex-1">
                <label for="accroche_cta_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien du bouton</label>
                <input type="text" id="accroche_cta_url" name="accroche_cta_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $secteurExpertise->accroche->cta_url ?? '' }}">  
            </div>

            <input type="hidden" name="page_key" value="{{ $page_key }}">
            <input type="hidden" name="accroche_section_key" value="accroche">
        </div>
    </div>
</div>