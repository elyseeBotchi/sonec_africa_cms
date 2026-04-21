<div class="bg-white  mb-8 p-8 rounded-3xl shadow-sm border border-slate-100">
    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
        <i class="fas fa-info-circle text-blue-500"></i> Section "Informations générales"
    </h3>

    <div>
        <input type="hidden" name="infos_section_key" value="about">
        <input type="hidden" name="page_key" value="{{ $page_key }}">
        <input type="hidden" name="solution_id" value="{{ $solution->id ?? '' }}">
        <label for="image_couverture_solution" class="block text-xs font-bold text-slate-400 uppercase mb-1">Image de couverture de la solution</label>
        <div class="preview-area-image-couverture-solution bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed">
            <div class="text-center">
                <input id="image_couverture_solution" type="file" class=" hidden w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" accept="image/*" name="image_couverture_solution">
                <label for="image_couverture_solution" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                @if(isset($solution->image))
                    <img src="{{ asset('storage/' . $solution->image) }}" alt="{{ $solution->title ?? '' }}" class="max-h-40 object-contain mb-2">  
                @elseif(isset($solution->image_url))
                    <img src="{{ $solution->image_url }}" alt="{{ $solution->title ?? '' }}" class="max-h-40 object-contain mb-2">  
                @else
                    <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                    <p class="text-xs text-slate-400 mb-2">Aperçu image section</p>
                @endif
            </div>                        
        </div>
        <div class="mt-6">
            <label for="infos_image_couverture_solution_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url image de couverture (Si l'image existe en ligne)</label>
            <input type="text" id="infos_image_couverture_solution_url" name="infos_image_couverture_solution_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="https://storage.googleapis.com/uxpilot-auth.appspot.com/avatars/avatar-5.jpg"
            value="{{ $solution->image_url ?? '' }}" >
        </div>

        <div class="bg-blue-200 text-blue-700  mt-3 rounded-md px-5">
            <i class="fas fa-info-circle"></i>
            <small >
                Si vous ne disposez pas d'image en sur votre machine locale, vous avez la possibilté de renseigner l'url de l'image. <br> Veuillez que l'image est obligatoire.
            </small>
        </div>
    </div>
    <div class="mt-8">
        <label for="infos_title" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom de la solution</label>
        <input type="text" id="infos_title" name="infos_title" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" placeholder="Titre de la solution"
        value="{{ $solution->title ?? '' }}" >
    </div>
    {{-- subtitle --}}
    <div class="mt-6">
        <label for="infos_subtitle" class="block text-xs font-bold text-slate-400 uppercase mb-1">Sous-titre de la solution</label>
        <input type="text" id="infos_subtitle" name="infos_subtitle" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="Sous-titre de la solution"
        value="{{ $solution->subtitle ?? '' }}" >
    </div>
    <div class="mt-6">
        <label for="infos_resume_solution" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description courte de la solution</label>
        <textarea id="infos_resume_solution" name="infos_resume_solution" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" rows="3" placeholder="Description de la solution">{{ $solution->resume ?? '' }}</textarea>   
    </div>  
    <div class="mt-6">
        <label for="infos_slug_solution" class="block text-xs font-bold text-slate-400 uppercase mb-1">Slug de la solution (doit être unique)</label>
        <input type="text" id="infos_slug_solution" name="infos_slug_solution" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="slug-de-la-solution" value="{{ $solution->slug ?? '' }}">   
    </div>
    <div class="grid grid-cols-2 gap-6 mt-6">
            
        <div>
            <label for="infos_contact_email_solution" class="block text-xs font-bold text-slate-400 uppercase mb-1">Email de contact pour la solution</label>
            <input type="email" id="infos_contact_email_solution" name="infos_contact_email_solution" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="Email de contact" value="{{ $solution->contact_email ?? '' }}">
        </div>
        <div>
            <label for="infos_contact_phone_solution" class="block text-xs font-bold text-slate-400 uppercase mb-1">Numéro de téléphone de contact pour la solution</label>
            <input type="text" id="infos_contact_phone_solution" name="infos_contact_phone_solution" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="Numéro de téléphone de contact" value="{{ $solution->contact_phone ?? '' }}">  
        </div>
    </div>
    <div class="bg-blue-200 text-blue-700  mt-3 rounded-md px-5">
        <i class="fas fa-info-circle"></i>
        <small >
            Les champs "Email de contact" et "Numéro de téléphone de contact" sont optionnels, mais ils permettent aux visiteurs intéressés par la solution de contacter directement l'entreprise pour plus d'informations ou pour exprimer leur intérêt.
        </small>
    </div>
    <div class="grid grid-cols-2 gap-6 mt-6">
        <div>
            <label for="infos_disponibilite_solution" class="block text-xs font-bold text-slate-400 uppercase mb-1">Disponibilité de la solution</label>
            <select id="infos_disponibilite_solution" name="infos_disponibilite_solution[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" multiple>
                <option value="web" {{ in_array('web', json_decode($solution->disponibilite ?? '[]', true)) ? 'selected' : '' }}>Web</option>
                <option value="android" {{ in_array('android', json_decode($solution->disponibilite ?? '[]', true)) ? 'selected' : '' }}>Android</option>
                <option value="ios" {{ in_array('ios', json_decode($solution->disponibilite ?? '[]', true)) ? 'selected' : '' }}>iOS</option>
                <option value="desktop" {{ in_array('desktop', json_decode($solution->disponibilite ?? '[]', true)) ? 'selected' : '' }}>Desktop</option>
            </select>
        </div>
        
        <div>
            <label for="infos_mis_avant_solution" class="block text-xs font-bold text-slate-400 uppercase mb-1">Mettre en avant cette solution ?</label>
            <select id="infos_mis_avant_solution" name="infos_mis_avant_solution" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm">
                <option value="0" {{ ($solution->mis_avant ?? 0) == 0 ? 'selected' : '' }}>Non</option>
                <option value="1" {{ ($solution->mis_avant ?? 0) == 1 ? 'selected' : '' }}>Oui</option>
            </select>
        </div>
    </div>
    {{-- cible --}}
    <div class="mt-6">
        <label for="infos_cible_solution" class="block text-xs font-bold text-slate-400 uppercase mb-1">Cible de la solution</label>
        <input type="text" id="infos_cible_solution" name="infos_cible_solution" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="Cible de la solution  
        (ex: PME, Startups, Grandes entreprises, etc.)" value="{{ $solution->cible ?? '' }}">
    </div> 
    <div class="bg-blue-200 text-blue-700  mt-3 rounded-md px-5">
        <i class="fas fa-info-circle"></i>
        <small >
            Le champ "Cible de la solution" permet de préciser le type d'entreprises ou d'utilisateurs pour lesquels la solution est conçue, ce qui aide les visiteurs à comprendre rapidement si la solution est adaptée à leurs besoins.
        </small>
    </div>
    {{-- Label button --}}

    <div class="grid grid-cols-2 gap-6 mt-6">
        <div>
            <label for="infos_cta_label" class="block text-xs font-bold text-slate-400 uppercase mb-1">Label du bouton d'appel à l'action</label>
            <input type="text" id="infos_cta_label" name="infos_cta_label" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="Label du bouton d'appel à l'action (ex: En savoir plus, Contactez-nous, etc.)" value="{{ $solution->cta_label ?? '' }}">
        </div>
        <div>
            <label for="infos_cta_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">URL du bouton d'appel à l'action</label>
            <input type="text" id="infos_cta_url" name="infos_cta_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm font-mono text-blue-500" placeholder="URL du bouton d'appel à l'action (ex: https://www.exemple.com/contact)" value="{{ $solution->cta_url ?? '' }}">
        </div>
        <div>
            <label for="infos_icon_solution" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône representant la solution</label>
            <input type="text" id="infos_icon_solution" name="infos_icon_solution" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm font-mono text-blue-500" placeholder="ex: https://www.exemple.com/icon.png ou fa-solid fa-cog" value="{{ $solution->icon ?? '' }}">
        </div>
    </div>

     {{--description  --}}
    <div class="mt-6">
        <label for="infos_description_solution" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description détaillée de la solution</label>
        <textarea id="infos_description_solution" name="infos_description_solution" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" rows="6" placeholder="Description détaillée de la solution">{{ $solution->description ?? '' }}</textarea> 
    </div>
   
</div>

{{-- Chiffres clés --}}
<div class="bg-white  mb-8 p-8 rounded-3xl shadow-sm border border-slate-100">
    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
        <i class="fas fa-chart-bar text-green-500"></i> Section "Chiffres clés"

    </h3>

    <div id="chiffres-cles-container" class="space-y-6">
        <div id="chiffres-cles-grid" class="grid md:grid-cols-2 gap-6">
            {{-- Afficher les chiffres clés depuis la bd --}}
            @foreach($solution->chiffres as $index => $chiffre)
                <div data-chiffre class="bg-slate-50 p-4 rounded-xl border border-slate-200 relative">    
                    <div class="col-span-2 flex justify-end">
                        <button type="button" onclick="removeChiffreCleSolution(this)" class="text-red-500 hover:text-red-700 text-sm font-bold">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <input type="hidden" name="chiffre_cle[{{ $index }}][id]" value="{{ $chiffre->id }}">
                    <div>
                        <label for="label_chiffre_cle_{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Libellé chiffre clé</label>
                        <input type="text" id="label_chiffre_cle_{{ $index }}" name="label_chiffre_cle_{{ $index }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="ex: 500+" value="{{ $chiffre->label ?? '' }}">
                    </div>
                    <div>
                        <label for="valeur_chiffre_cle_{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Valeur chiffre clé</label>
                        <input type="text" id="valeur_chiffre_cle_{{ $index }}" name="valeur_chiffre_cle_{{ $index }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="ex: 500+" value="{{ $chiffre->value ?? '' }}">
                    </div>  
                    <div>
                        <label for="icon_chiffre_cle_{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icone du chiffre clé (optionnel, si pas d'image)</label>
                        <input type="text" id="icon_chiffre_cle_{{ $index }}" name="icon_chiffre_cle_{{ $index }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="ex: fas fa-users" value="{{ $chiffre->icon ?? '' }}">  
                    </div>
                    <div>
                        <label for="description_chiffre_cle_{{ $index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description du chiffre clé</label>
                        <textarea id="description_chiffre_cle_{{ $index }}" name="description_chiffre_cle_{{ $index }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="ex: Clients satisfaits">{{ $chiffre->description ?? '' }}</textarea>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <button type="button" onclick="addChiffreCleSolution()" class="mt-4 bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg text-sm flex items-center gap-2">
        <i class="fas fa-plus"></i> Ajouter un chiffre clé
    </button>
</div>

{{-- Section Accroche --}}
<div class="bg-white p-8 mt-8 rounded-3xl shadow-sm border border-slate-100">
    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-bullhorn text-red-500"></i> Section "Accroche"</h3>
    <div class="space-y-4">
        {{-- <input type="hidden" name="accroche_section_key" value="accroche"> --}}
        <input type="hidden" name="page_key" value="{{ $page_key }}">
        <input type="hidden" name="accroche_section_key" value="accroche">
        <input type="hidden" name="accroche_id" value="{{ $solution->accroche->id ?? '' }}">
        <div>
            <label for="accroche_title" class="block text-xs font-bold text-slate-400 uppercase mb-1">Titre</label>
            <input type="text" id="accroche_title" name="accroche_title" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-red-500 outline-none" value="{{ $solution->accroche->title ?? '' }}">
        </div>
        <div>
            <label for="accroche_subtitle" class="block text-xs font-bold text-slate-400 uppercase mb-1">Sous-titre</label>
            <textarea id="accroche_subtitle" name="accroche_subtitle" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-500 outline-none" rows="4">{{ $solution->accroche->subtitle ?? '' }}</textarea>
        </div>
        <div>
            <label for="accroche_description" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description</label>
            <textarea id="accroche_description" name="accroche_description" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-red-500 outline-none" rows="4">{{ $solution->accroche->content ?? '' }}</textarea>
        </div>
        <div class="flex gap-4">
            <div class="flex-1">
                <label for="accroche_cta_label" class="block text-xs font-bold text-slate-400 uppercase mb-1">Texte du bouton</label>
                <input type="text" id="accroche_cta_label" name="accroche_cta_label" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm" value="{{ $solution->accroche->cta_label ?? '' }}">
            </div>
            <div class="flex-1">
                <label for="accroche_cta_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien du bouton</label>
                <input type="text" id="accroche_cta_url" name="accroche_cta_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $solution->accroche->cta_url ?? '' }}">  
            </div>

            <input type="hidden" name="page_key" value="{{ $page_key }}">
            <input type="hidden" name="accroche_section_key" value="accroche">
        </div>
    </div>
</div>