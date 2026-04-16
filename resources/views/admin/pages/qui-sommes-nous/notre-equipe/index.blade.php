  @extends('admin.layout.appLayout')

@section('content')
    <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
        <div class="flex items-center gap-4">
            <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Découvrir Sonec Africa</h2>
            <span id="status-badge" class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-md border border-green-200 hidden">Modifications en cours ...</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('web.home') }}" target="_blank" class="text-sm font-semibold text-slate-500 hover:text-sonec-green flex items-center gap-2">
                <i class="fas fa-external-link-alt"></i> Voir le site
            </a>
            <button onclick="saveAll()" class="bg-sonec-dark hover:bg-sonec-green text-white px-5 py-2 rounded-lg font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                <i class="fas fa-save"></i> Enregistrer
            </button>
        </div>
    </header>
    <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
        <div class=" max-w-5xl mx-auto">
            <div class="flex gap-1 bg-slate-200 p-1 rounded-xl mb-8 w-fit">
                <button onclick="showTab('content')" class="px-6 py-2 rounded-lg bg-white font-bold shadow-sm text-sm  text-sonec-dark">Contenu</button>
                <button onclick="showTab('media')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Images & Médias</button>
                <button onclick="showTab('equipes')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Membres d'équipes</button>
                <button onclick="showTab('seo')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">SEO & Méta</button>
            </div>

            <div class="space-y-8">
           

                {{-- Affichage des erreurs serveurs --}}
                <div id="form-errors" class="bg-red-100 text-red-700 p-4 rounded mb-6 hidden"></div>


                <div id="tab-content" class="tab-content p-8 rounded-3xl shadow-sm border border-slate-100">
                    <div id="tab-content-home-content" class="tab-pane active">
                        @include('admin.pages.qui-sommes-nous.notre-equipe.partials.content')
                    </div>
                    <div id="tab-content-home-media" class="tab-pane hidden">
                        
                        @include('admin.pages.qui-sommes-nous.notre-equipe.partials.media') 
                    </div>
                    <div id="tab-content-home-equipes" class="tab-pane hidden">
                        @include('admin.pages.qui-sommes-nous.notre-equipe.partials.equipes')
                    </div>
                    <div id="tab-content-home-seo" class="tab-pane hidden">
                        @include('admin.pages.qui-sommes-nous.notre-equipe.partials.seo')
                    </div>
                </div>
            </div>
        </div>
        
    </div>


    
    <script>
        function showTab(tab) {
            // Cacher tous les contenus de tab
            document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.add('hidden'));
            // Afficher le contenu de la tab sélectionnée
            document.getElementById(`tab-content-home-${tab}`).classList.remove('hidden');
                
            document.querySelectorAll('.tab-content button').forEach(button => {
                if (button.textContent.trim() === (tab === 'content' ? 'Contenu' : tab === 'media' ? 'Images & Médias' : tab === 'equipes' ? 'Membres d\'équipes' : 'SEO & Méta')) {
                    button.classList.add('bg-white', 'shadow-sm', 'text-sonec-dark');
                    button.classList.remove('text-slate-500');
                } else {
                    button.classList.remove('bg-white', 'shadow-sm', 'text-sonec-dark');
                    button.classList.add('text-slate-500');
                }
            });            
        }
        
        // Ajouter bloc valeurs
        function addValeur() {
            const container = document.getElementById('valeurs-container');
            const count = Date.now();

            const div = document.createElement('div');
            div.setAttribute('data-valeur', '');
            div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
            div.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button type="button" onclick="removeValeur(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                        <i class="fas fa-star text-purple-500"></i> Valeur ${count}
                    </h3>
                    <input type="hidden" id="valeur_id-${count}" name="id[]" value="">
                    <input type="hidden" id="valeur_section_key-${count}" name="section_key[]" value="valeurs">
                    <label for="valeur_icon-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône (classe FontAwesome)</label>
                    <input type="text" name="valeur_icon[]" id="valeur_icon-${count}"
                        class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-mono text-blue-500" 
                        placeholder="fas fa-cog"> 

                    <label for="valeur_title-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Titre</label>
                    <input type="text" name="valeur_title[]" id="valeur_title-${count}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" >
                   
                   
                    <label for="valeur_description-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Description</label>
                    <textarea name="valeur_description[]" id="valeur_description-${count}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none" 
                        rows="4"></textarea>
                </div>

            `;
            container.appendChild(div);

        }

        function removeValeur(button) {
            const valeurDiv = button.closest('[data-valeur]');
            if (valeurDiv) {
                valeurDiv.remove();
            }
        }

        function addChiffre() {
            const container = document.getElementById('chiffres-container');
            const count = Date.now(); 

            const index = Date.now(); 

            const div = document.createElement('div');
            div.setAttribute('data-chiffre', '');
            div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
            div.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button type="button" onclick="removeChiffre(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                        <i class="fas fa-star text-purple-500"></i> Chiffre ${count}
                    </h3>
                    <input type="hidden" id="chiffre_section_key-${index}" name="chiffre_section_key[]" value="chiffres">
                    
                    <label for="chiffre_label-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Libellé</label>
                    <input type="text" name="chiffre_label[]" id="chiffre_label-${index}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                            >
                    <label for="chiffre_value-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Valeur</label>
                    <input type="text" name="chiffre_value[]" id="chiffre_value-${index}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                            >
                    <label for="chiffre_icon-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône (classe FontAwesome)</label>
                    <input type="text" name="chiffre_icon[]" id="chiffre_icon-${index}"
                        class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-mono text-blue-500" 
                        
                        placeholder="fas fa-cog"> 
                    <label for="chiffre_description-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Description</label>
                    <textarea name="chiffre_description[]" id="chiffre_description-${index}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none" 
                        rows="4"></textarea>
                </div>

            `;
            container.appendChild(div);
        }

        function removeChiffre(button) {
            const chiffreDiv = button.closest('[data-chiffre]');
            if (chiffreDiv) {
                chiffreDiv.remove();
            }
        }

        function addChiffreVision() {
            const container = document.getElementById('chiffres-vision-container');
            const count = Date.now(); 

            const index = Date.now(); 

            const div = document.createElement('div');
            div.setAttribute('data-chiffre-vision', '');
            div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
            div.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button type="button" onclick="removeChiffreVision(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                        <i class="fas fa-star text-purple-500"></i> Chiffre ${count}
                    </h3>
                    <input type="hidden" id="chiffre_vision_section_key-${index}" name="chiffre_vision_section_key[]" value="vision">
                    
                    <label for="chiffre_vision_label-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Libellé</label>
                    <input type="text" name="chiffre_vision_label[]" id="chiffre_vision_label-${index}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                            >
                    <label for="chiffre_vision_value-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Valeur</label>
                    <input type="text" name="chiffre_vision_value[]" id="chiffre_vision_value-${index}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                            >
                    <label for="chiffre_vision_icon-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône (classe FontAwesome)</label>
                    <input type="text" name="chiffre_vision_icon[]" id="chiffre_vision_icon-${index}"
                        class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-mono text-blue-500" 
                        
                        placeholder="fas fa-cog"> 
                    <label for="chiffre_vision_description-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Description</label>
                    <textarea name="chiffre_vision_description[]" id="chiffre_vision_description-${index}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none" 
                        rows="4"></textarea>
                </div>

            `;
            container.appendChild(div);
        }

        function removeChiffreVision(button) {
            const chiffreDiv = button.closest('[data-chiffre-vision]');
            if (chiffreDiv) {
                chiffreDiv.remove();
            }
        }

        function addGouvernance() {
            const container = document.getElementById('gouvernances-container');
            const count = Date.now();

            const div = document.createElement('div');
            div.setAttribute('data-gouvernance', '');
            div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
            div.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button type="button" onclick="removeGouvernance(this)" 
                        class="absolute top-5 right-3 text-red-500  p-1.5 rounded-full hover:text-red-600 transition-colors">
                        <i class="fa fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                        <i class="fas fa-star text-purple-500"></i> Gouvernance ${count}
                    </h3>
                    <input type="hidden" id="gouvernance_section_key-${count}" name="gouvernance_section_key[]" value="gouvernance">
                    <label for="gouvernance_icon-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône (classe FontAwesome)</label>
                    <input type="text" name="gouvernance_icon[]" id="gouvernance_icon-${count}"
                        class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-mono text-blue-500" 
                        placeholder="fas fa-cog"> 
                    <label for="gouvernance_title-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Titre</label>
                    <input type="text" name="gouvernance_title[]" id="gouvernance_title-${count}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                        >
                    <label for="gouvernance_description-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Description</label>
                    <textarea name="gouvernance_description[]" id="gouvernance_description-${count}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none" 
                        rows="4"></textarea>
                </div>

            `;
            container.appendChild(div); 
        }

        function removeGouvernance(button) {
            const gouvernanceDiv = button.closest('[data-gouvernance]');
            if (gouvernanceDiv) {
                gouvernanceDiv.remove();
            }
        }

        // Engagements items
        

        function addEquipe(){
            const container = document.getElementById('equipe-container');
            const count = Date.now();

            const div = document.createElement('div');
            div.setAttribute('data-equipe', '');

            div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
            div.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button type="button" onclick="removeEquipe(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                        <i class="fas fa-star text-purple-500"></i> Équipe ${count}
                    </h3>
                    {{-- Pas d'input id hidden pour les nouveaux slides --}}
                    <input type="hidden" id="equipe_page_key-${count}" name="equipe_page_key" value="notre-equipe">
                    <input type="hidden" id="equipe_section_key-${count}" name="equipe_section_key[]" value="equipes">
                    <div class="space-y-4">
                        <div>
                            <label for="equipe_name-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                            <input type="text" id="equipe_name-${count}" name="equipe_name[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="">
                        </div>
                        <div>
                            <label for="equipe_role-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Rôle</label>
                            <input type="text" id="equipe_role-${count}" name="equipe_role[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="">
                        </div>
                        
                        <div class="flex-1">
                            <label for="equipe_facebook_url-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de Facebook</label>
                            <input type="text" id="equipe_facebook_url-${count}" name="equipe_facebook_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="">
                        </div>
                        <div class="flex-1">
                            <label for="equipe_twitter_url-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de Twitter</label>
                            <input type="text" id="equipe_twitter_url-${count}" name="equipe_twitter_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="">
                        </div>
                        <div class="flex-1">
                            <label for="equipe_linkedin_url-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de LinkedIn</label>
                            <input type="text" id="equipe_linkedin_url-${count}" name="equipe_linkedin_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="">
                        </div>

                        <div class="flex-1">
                            <label for="equipe_instagram_url-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de Instagram</label>
                            <input type="text" id="equipe_instagram_url-${count}" name="equipe_instagram_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="">
                        </div>

                        <div class="flex-1">
                            <label for="equipe_photo_url-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
                            <input type="text" id="equipe_photo_url-${count}" name="equipe_photo_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="">
                        </div>
                    
                        <div class="flex gap-4">
                            <div class="flex-1">
                                <label for="equipe_description-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description</label>
                                <textarea id="equipe_description-${count}" name="equipe_description[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500"></textarea>
                            </div>
                        </div>
                        <div class="equipe_preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                            <div class="text-center">
                                <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                                <p class="text-xs text-slate-400">Aperçu image</p>
                               
                                <input id="equipe_image-${count}" type="file" name="equipe_image[]" class="hidden">
                                <label for="equipe_image-${count}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100">Changer</label>
                            </div>
                        </div>

                    </div>  
                </div>

            `;
            container.appendChild(div);
            attachEquipePreview(div.querySelector('input[type="file"]'));

        }

        function removeEquipe(button) {
            const equipeDiv = button.closest('[data-equipe]');
            if (equipeDiv) {
                equipeDiv.remove();
            }
        }

        function attachEquipePreview(input) {
            input.addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewDiv = input.closest('[data-equipe]').querySelector('.equipe_preview .text-center');
                    previewDiv.innerHTML = `
                        <img src="${e.target.result}" alt="Aperçu image" class="max-h-40 object-contain mb-2">
                        <input type="file" name="equipe_image[]" class="hidden" id="equipe_image-${input.id}">
                        <label for="equipe_image-${input.id}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                    `;
                    // Réattacher l'écouteur sur le nouvel input généré
                    attachEquipePreview(previewDiv.querySelector('input[type="file"]'));
                };
                reader.readAsDataURL(file);
            });
        }

        
        // Fonction de sauvegarde
        function saveAll() {
            const formData = new FormData(); 
            const val = (id) => document.getElementById(id)?.value ?? '';

            
            tinymce.triggerSave(); // Assurez-vous que les éditeurs TinyMCE mettent à jour les textarea



            formData.append(' page_key', '{{ $page_key }}' ?? 'notre-equipe');


            formData.append('accroche_title', val('accroche_title'));
            formData.append('accroche_subtitle', val('accroche_subtitle'));
            formData.append('accroche_description', val('accroche_description'));
            formData.append('accroche_cta_label', val('accroche_cta_label'));
            formData.append('accroche_cta_url', val('accroche_cta_url'));
            formData.append('accroche_page_key', '{{ $page_key }}');
            formData.append('accroche_section_key', 'accroche');


            // section premiere
            formData.append('section_premiere_title', val('section_premiere_title'));
            formData.append('section_premiere_subtitle', val('section_premiere_subtitle'));
            formData.append('section_premiere_description', val('section_premiere_description'));
            formData.append('section_premiere_cta_label', val('section_premiere_cta_label'));
            formData.append('section_premiere_cta_url', val('section_premiere_cta_url'));
            formData.append('section_premiere_image_url', val('section_premiere_image_url'));
            formData.append('section_premiere_page_key', '{{ $page_key }}');
            formData.append('section_premiere_section_key', 'section_premiere');
            // const sectionPremiereImageInput = document.getElementById('vision_image');
            // if (sectionPremiereImageInput?.files[0]) formData.append('section_premiere_image', sectionPremiereImageInput.files[0]);


            // banniere
            formData.append('banniere_title', val('banniere_title'));
            formData.append('banniere_subtitle', val('banniere_subtitle'));
            formData.append('banniere_description', val('banniere_description'));
            formData.append('banniere_cta_label', val('banniere_cta_label'));
            formData.append('banniere_cta_url', val('banniere_cta_url'));
            formData.append('banniere_image_url', val('banniere_image_url'));
            formData.append('banniere_page_key', '{{ $page_key }}');
            formData.append('banniere_section_key', 'banniere');
            const banniereImageInput = document.getElementById('banniere_image');
            if (banniereImageInput?.files[0]) formData.append('banniere_image', banniereImageInput.files[0]);

             // valeurs
            document.querySelectorAll('#valeurs-container [data-valeur]').forEach((valeur, index) => {
                const idInput = valeur.querySelector('input[name="id[]"]');
                if (idInput && idInput.value.trim() !== '') {
                    formData.append(`valeurs[${index}][id]`, idInput.value);
                }
                formData.append(`valeurs[${index}][title]`, valeur.querySelector('input[name="valeur_title[]"]')?.value ?? '');
                formData.append(`valeurs[${index}][description]`, valeur.querySelector('textarea[name="valeur_description[]"]')?.value ?? '');
                formData.append(`valeurs[${index}][icon]`, valeur.querySelector('input[name="valeur_icon[]"]')?.value ?? '');
                formData.append(`valeurs[${index}][section_key]`, valeur.querySelector('input[name="valeur_section_key[]"]')?.value ?? '');
            });

            // chiffres
            document.querySelectorAll('#chiffres-container [data-chiffre]').forEach((chiffre, index) => {
                const idInput = chiffre.querySelector('input[name="id[]"]');
                // if (idInput) formData.append(`chiffres[${index}][id]`, idInput.value);
                if (idInput && idInput.value.trim() !== '') {
                    formData.append(`chiffres[${index}][id]`, idInput.value);
                }
                formData.append(`chiffres[${index}][label]`, chiffre.querySelector('input[name="chiffre_label[]"]')?.value ?? '');
                formData.append(`chiffres[${index}][value]`, chiffre.querySelector('input[name="chiffre_value[]"]')?.value ?? '');
                formData.append(`chiffres[${index}][icon]`, chiffre.querySelector('input[name="chiffre_icon[]"]')?.value ?? '');
                formData.append(`chiffres[${index}][description]`, chiffre.querySelector('textarea[name="chiffre_description[]"]')?.value ?? '');
                formData.append(`chiffres[${index}][section_key]`, chiffre.querySelector('input[name="chiffre_section_key[]"]')?.value ?? '');
            });  

            // section presentation
            formData.append('section_presentation_title', val('section_presentation_title'));
            formData.append('section_presentation_description', val('section_presentation_description'));
            formData.append('section_presentation_section_key', val('section_presentation_section_key'));
           
            // Vision - mot du président
            formData.append('vision_title', val('section_vision_title'));
            formData.append('vision_description', val('section_vision_description'));
            formData.append('vision_section_key', val('section_vision_section_key'));

            // Chiffres vision
            document.querySelectorAll('#chiffres_vision-container [data-chiffre]').forEach((chiffre, index) => {
                const idInput = chiffre.querySelector('input[name="id[]"]');
                // if (idInput) formData.append(`chiffres_vision[${index}][id]`, idInput.value);
                if (idInput && idInput.value.trim() !== '') {
                    formData.append(`chiffres_vision[${index}][id]`, idInput.value);
                }
                formData.append(`chiffres_vision[${index}][label]`, chiffre.querySelector('input[name="chiffre_label[]"]')?.value ?? '');
                formData.append(`chiffres_vision[${index}][value]`, chiffre.querySelector('input[name="chiffre_value[]"]')?.value ?? '');
                formData.append(`chiffres_vision[${index}][icon]`, chiffre.querySelector('input[name="chiffre_icon[]"]')?.value ?? '');
                formData.append(`chiffres_vision[${index}][description]`, chiffre.querySelector('textarea[name="chiffre_description[]"]')?.value ?? '');
                formData.append(`chiffres_vision[${index}][section_key]`, chiffre.querySelector('input[name="chiffre_section_key[]"]')?.value ?? '');
            }); 

            // gouvernances
            document.querySelectorAll('#gouvernances-container [data-gouvernance]').forEach((gouvernance, index) => {
                const idInput = gouvernance.querySelector('input[name="id[]"]');
                // if (idInput) formData.append(`gouvernances[${index}][id]`, idInput.value);
                if (idInput && idInput.value.trim() !== '') {
                    formData.append(`gouvernances[${index}][id]`, idInput.value);
                }
                formData.append(`gouvernances[${index}][title]`, gouvernance.querySelector('input[name="gouvernance_title[]"]')?.value ?? '');
                formData.append(`gouvernances[${index}][description]`, gouvernance.querySelector('textarea[name="gouvernance_description[]"]')?.value ?? '');
                formData.append(`gouvernances[${index}][icon]`, gouvernance.querySelector('input[name="gouvernance_icon[]"]')?.value ?? '');
                formData.append(`gouvernances[${index}][section_key]`, gouvernance.querySelector('input[name="gouvernance_section_key[]"]')?.value ?? '');
            });

            // equipes
            document.querySelectorAll('#equipe-container [data-equipe]').forEach((equipe, index) => {
                const idInput = equipe.querySelector('input[name="id[]"]');
                // if (idInput) formData.append(`equipes[${index}][id]`, idInput.value);
                if (idInput && idInput.value.trim() !== '') {
                    formData.append(`equipes[${index}][id]`, idInput.value);
                }
                formData.append(`equipes[${index}][name]`, equipe.querySelector('input[name="equipe_name[]"]')?.value ?? '');
                formData.append(`equipes[${index}][role]`, equipe.querySelector('input[name="equipe_role[]"]')?.value ?? '');
                formData.append(`equipes[${index}][photo_url]`, equipe.querySelector('input[name="equipe_photo_url[]"]')?.value ?? '');
                formData.append(`equipes[${index}][facebook_url]`, equipe.querySelector('input[name="equipe_facebook_url[]"]')?.value ?? '');
                formData.append(`equipes[${index}][twitter_url]`, equipe.querySelector('input[name="equipe_twitter_url[]"]')?.value ?? '');
                formData.append(`equipes[${index}][linkedin_url]`, equipe.querySelector('input[name="equipe_linkedin_url[]"]')?.value ?? '');
                formData.append(`equipes[${index}][instagram_url]`, equipe.querySelector('input[name="equipe_instagram_url[]"]')?.value ?? '');
                formData.append(`equipes[${index}][description]`, equipe.querySelector('textarea[name="equipe_description[]"]')?.value ?? '');
                formData.append(`equipes[${index}][section_key]`, equipe.querySelector('input[name="equipe_section_key[]"]')?.value ?? '');

                const imageInput = equipe.querySelector('input[type="file"][name="equipe_image[]"]');
                if (imageInput && imageInput.files[0]) {
                    formData.append(`equipes[${index}][image]`, imageInput.files[0]);
                }
            });
            

            // seo
            formData.append('seo_title', val('seo_title'));
            formData.append('seo_description', val('seo_description'));
            formData.append('seo_keywords', val('seo_keywords'));
            formData.append('seo_page_key', '{{ $page_key }}');


            const btn = document.querySelector('button[onclick="saveAll()"]');
            const originalContent = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');


            console.log('FormData entries:');
            for (let pair of formData.entries()) {
                console.log(pair[0]+ ': ' + pair[1]);
            }

            formData.append('_method', 'POST'); 
             fetch('{{ route("admin.notre-equipe.save") }}', {
                method: 'POST',
                headers: { 
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') ,
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                    console.log('Response from server:', data);
                    const statusBadge = document.getElementById('status-badge');
                    statusBadge.classList.remove('hidden');

                    const successMessage = document.querySelector('#toast .success-message');
                    const successDescription = document.querySelector('#toast .success-description');

                if (data.success === true) {
                    successMessage.textContent = data.message || 'Modifications enregistrées';
                    successDescription.textContent = 'Les modifications ont été enregistrées.';
                    showToast();
                    setTimeout(() => {
                        btn.innerHTML = originalContent;
                        btn.disabled = false;
                        btn.classList.remove('opacity-75', 'cursor-not-allowed');
                        statusBadge.classList.add('hidden');


                        // window.location.reload();
                    }, 1200);
                    

                } else {
                    showToastError();
                    btn.innerHTML = originalContent;
                    btn.disabled = false;
                    btn.classList.remove('opacity-75', 'cursor-not-allowed');

                    const errorsDiv = document.getElementById('form-errors');
                    const errorMsg = document.querySelector('#toastError .error-message')
                    if (errorsDiv) {
                        errorsDiv.innerHTML = '';
                        if (data.errors) {
                            Object.values(data.errors).forEach(error => {
                                const p = document.createElement('p');
                                p.textContent = error[0];
                                errorsDiv.appendChild(p);

                                errorMsg.textContent = error[0];
                            });
                            errorsDiv.classList.remove('hidden');

                        }
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);

                const errorMessage = document.querySelector('#toastError .error-message');
                const errorDescription = document.querySelector('#toastError .error-description');
                errorMessage.textContent = 'Erreur lors de l\'enregistrement';
                errorDescription.textContent = 'Une erreur est survenue lors de l\'enregistrement des données. Veuillez réessayer.';

                showToastError();

                btn.innerHTML = originalContent;
                btn.disabled = false;
                btn.classList.remove('opacity-75', 'cursor-not-allowed');
            });


        }

    </script>
@endsection
