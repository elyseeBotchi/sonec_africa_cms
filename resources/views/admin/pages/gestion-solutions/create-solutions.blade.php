@extends('admin.layout.appLayout')

@section('content')

    <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
        <div class="flex items-center gap-4">
            <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Solutions</h2>
            <span id="status-badge" class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-md border border-green-200 hidden">Modifications en cours</span>
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
                <button onclick="showTab('infos')" class="px-6 py-2 rounded-lg bg-white font-bold shadow-sm text-sm  text-sonec-dark">Informations générales</button>
                <button onclick="showTab('fonctionnalites')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Fonctionnalités</button>
                <button onclick="showTab('partenaires')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Partenaires</button>
                <button onclick="showTab('temoignages')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Témoignages</button>
                <button onclick="showTab('personnalisation')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Personnalisation de sections</button>
                <button onclick="showTab('seo')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">SEO & Méta</button>
            </div>
            <div class="space-y-8">        

               {{-- Affichage des erreurs serveurs --}}
                <div id="form-errors" class="bg-red-100 text-red-700 p-4 rounded mb-6 hidden"></div>


                <div id="tab-content" class="tab-content p-8 rounded-3xl shadow-sm border border-slate-100">
                    <div id="tab-content-infos" class="tab-pane active">
                        @include('admin.pages.gestion-solutions.partials.infos')
                    </div>
                    <div id="tab-content-fonctionnalites" class="tab-pane hidden">
                        @include('admin.pages.gestion-solutions.partials.fonctionnalites')
                    </div>
                    <div id="tab-content-partenaires" class="tab-pane hidden">
                        @include('admin.pages.gestion-solutions.partials.partenaires')
                    </div>
                    <div id="tab-content-temoignages" class="tab-pane hidden">
                        @include('admin.pages.gestion-solutions.partials.temoignages')
                    </div>
                    <div id="tab-content-personnalisation" class="tab-pane hidden">
                        @include('admin.pages.gestion-solutions.partials.personnalisation') 
                    </div>
                    <div id="tab-content-seo" class="tab-pane hidden">
                        @include('admin.pages.gestion-solutions.partials.seo')
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
            document.getElementById('tab-content-' + tab).classList.remove('hidden');
        }

        document.getElementById('infos_title').addEventListener('input', function() {
            // Doire pourvoir gérer les accents et les caractères spéciaux comme "é" ou "ç" et les convertir en "e" et "c"
            const slug = this.value.toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '') 
                .replace(/[^a-z0-9]+/g, '-') 
                .replace(/^-+|-+$/g, '');
            document.getElementById('infos_slug_solution').value = slug;
            // document.getElementById('url').value = '/' + slug;
        });

        document.getElementById('image_couverture_solution').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Afficher l'aperçu de l'image
                    // const preview = document.querySelector('#preview-area-logo').parentElement.querySelector('i');
                    const preview = document.querySelector('.preview-area-image-couverture-solution');
                    const icon = preview.querySelector('i');
                    if (icon) {
                        icon.remove(); 
                    }
                    preview.style.backgroundImage = `url(${e.target.result})`;
                    preview.style.backgroundSize = 'cover';
                    preview.style.backgroundPosition = 'center';
                    icon.textContent = ''; 
                }
                reader.readAsDataURL(file);
            }
        });

        // Ajouter chiffres clés de la solution
        function addChiffreCleSolution() {
            const container = document.getElementById('chiffres-cles-container');
            const index = container.querySelectorAll('.chiffre-cle-item').length + 1;

            const chiffreCleItem = document.createElement('div');
            chiffreCleItem.classList.add('chiffre-cle-item', 'bg-slate-50', 'p-4', 'rounded-xl', 'border', 'border-slate-200');
            chiffreCleItem.innerHTML = `          
                
                <div class="grid grid-cols-2 gap-6">
                    <div class="col-span-2 flex justify-end">
                        <button type="button" onclick="removeChiffreCleSolution(this)" class="text-red-500 hover:text-red-700 text-sm font-bold">
                            <i class="fas fa-trash"></i>
                        </button>
                    </div>
                    <div>
                        <label for="label_chiffre_cle_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Libellé chiffre clé</label>
                        <input type="text" id="label_chiffre_cle_${index}" name="label_chiffre_cle_${index}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="ex: 500+">
                    </div>
                    <div>
                        <label for="valeur_chiffre_cle_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Valeur chiffre clé</label>
                        <input type="text" id="valeur_chiffre_cle_${index}" name="valeur_chiffre_cle_${index}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="ex: 500+">
                    </div>  
                    <div>
                        <label for="icon_chiffre_cle_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icone du chiffre clé (optionnel, si pas d'image)</label>
                        <input type="text" id="icon_chiffre_cle_${index}" name="icon_chiffre_cle_${index}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="ex: fas fa-users">  
                    </div>
                    <div>
                        <label for="description_chiffre_cle_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description du chiffre clé</label>
                        <textarea id="description_chiffre_cle_${index}" name="description_chiffre_cle_${index}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="ex: Clients satisfaits"></textarea>
                    </div>
                </div>
            `;
            container.appendChild(chiffreCleItem);
        }

        function removeChiffreCleSolution(button) {
            const chiffreDiv = button.closest('.chiffre-cle-item');
            if (chiffreDiv) {
                chiffreDiv.remove();
            }
        }

        // Partenaires
        function addPartenaireSolutionSection() {
            const container = document.getElementById('partenaires-grid');
            const index = container.querySelectorAll('[data-partenaire]').length + 1;

            const partenaireItem = document.createElement('div');
            partenaireItem.setAttribute('data-partenaire', '');
            partenaireItem.classList.add('bg-white', 'p-8', 'rounded-3xl', 'shadow-sm', 'border', 'border-slate-100', 'relative', 'overflow-hidden');
            partenaireItem.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                <button onclick="removePartenaireSolutionSection(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash text-xs"></i>
                </button>
                <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Partenaire </h3>
                
                <input type="hidden" name="partenaire_page_key" value="{{ $page_key }}">
                <input type="hidden" name="partenaire_section_key" value="partenaires">
                <div class="space-y-4">
                    <div>
                        <label for="partenaire_name_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                        <input type="text" id="partenaire_name_${index}" name="partenaire_name_${index}[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" >
                    </div>
                    <div class="flex gap-4">
                        
                        <div class="flex-1">
                            <label for="partenaire_url_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien Bouton</label>
                            <input type="text" id="partenaire_url_${index}" name="partenaire_url_${index}[]"  class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" >
                        </div>  
                        <div class="flex-1">
                            <label for="partenaire_logo_url_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
                            <input type="text" id="partenaire_logo_url_${index}" name="partenaire_logo_url_${index}[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" >    
                        </div>
                    </div>
                    <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                        <div class="text-center">
                           <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                            <p class="text-xs text-slate-400">Aperçu image</p>
                            
                            <input id="partenaire_logo_${index}" type="file" name="partenaire_logo_${index}[]" class="hidden">
                            <label for="partenaire_logo_${index}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100">Changer</label>
                        </div>
                </div>
            `;
            container.appendChild(partenaireItem);
            attachPartenaireLogoPreview(partenaireItem.querySelector('input[type="file"]'));    
        }

        function removePartenaireSolutionSection(button) {
            const partenaireDiv = button.closest('[data-partenaire]');
            if (partenaireDiv) {
                partenaireDiv.remove();
            }
        }

        function attachPartenaireLogoPreview(input) {
            input.addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;

                const inputId = input.id; // ✅ Capturer l'id dans le scope correct

                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewDiv = input.closest('[data-partenaire]').querySelector('.preview .text-center');
                    // const newInputId = inputId + '-new';
                    previewDiv.innerHTML = `
                        <img src="${e.target.result}" alt="Aperçu image" class="max-h-40 object-contain mb-2">
                        <input type="file" name="partenaire_logo_${inputId}[]" class="hidden" id="partenaire_logo_${inputId}">
                        <label for="partenaire_logo_${inputId}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                    `;
                    // Réattacher l'écouteur sur le nouvel input généré
                    attachPartenaireLogoPreview(previewDiv.querySelector('input[type="file"]'));
            };
                reader.readAsDataURL(file);
    
            });
        }

        // Fonctionnalités
        function addFonctionnalitesSolutionSection() {
            const container = document.getElementById('fonctionnalites-grid');
            const index = container.querySelectorAll('[data-fonctionnalite]').length + 1;

            const fonctionnaliteItem = document.createElement('div');
            fonctionnaliteItem.setAttribute('data-fonctionnalite', '');
            fonctionnaliteItem.classList.add('bg-white', 'p-8', 'rounded-3xl', 'shadow-sm', 'border', 'border-slate-100', 'relative', 'overflow-hidden');
            fonctionnaliteItem.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                <button onclick="removeFonctionnaliteSolutionSection(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash text-xs"></i>
                </button>
                <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Fonctionnalité ${index} </h3>
                
                <input type="hidden" name="fonctionnalite_page_key" value="{{ $page_key }}">
                <input type="hidden" name="fonctionnalite_section_key" value="fonctionnalites">
                <div class="space-y-4">
                    <div>
                        <label for="fonctionnalite_name_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom de la fonctionnalité</label>
                        <input type="text" id="fonctionnalite_name_${index}" name="fonctionnalite_name_${index}[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" >
                    </div>
                    <div class="flex-1">
                            <label for="fonctionnalite_icon_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Classe Icône</label>
                            <input type="text" id="fonctionnalite_icon_${index}" name="fonctionnalite_icon_${index}[]"  class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500"  placeholder="ex: fas fa-star">
                        </div>  
                        
                    <div class="flex-1">
                            <label for="fonctionnalite_description_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description</label>
                            <textarea id="fonctionnalite_description_${index}" name="fonctionnalite_description_${index}[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" placeholder="ex: Description de la fonctionnalité"></textarea>
                        </div>
                    
                </div>
            `;
            container.appendChild(fonctionnaliteItem);

        }
        function removeFonctionnaliteSolutionSection(button) {
            const fonctionnaliteDiv = button.closest('[data-fonctionnalite]');
            if (fonctionnaliteDiv) {
                fonctionnaliteDiv.remove();
            }
        }

        // Témoignages
        function addTemoignageSolutionSection() {
            const container = document.getElementById('temoignages-grid');
            const index = container.querySelectorAll('[data-temoignage]').length + 1;

            const temoignageItem = document.createElement('div');
            temoignageItem.setAttribute('data-temoignage', '');
            temoignageItem.classList.add('bg-white', 'p-8', 'rounded-3xl', 'shadow-sm', 'border', 'border-slate-100', 'relative', 'overflow-hidden');
            temoignageItem.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                <button onclick="removeTemoignageSolutionSection(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash text-xs"></i>
                </button>
                <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Témoignage ${index} </h3>
                
                <input type="hidden" name="temoignage_page_key" value="{{ $page_key }}">
                <input type="hidden" name="temoignage_section_key" value="temoignages">
                <div class="space-y-4">
                    <div>
                        <label for="temoignage_name_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                        <input type="text" id="temoignage_name_${index}" name="temoignage_name_${index}[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" >
                    </div>
                
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label for="temoignage_company_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Entreprise</label>
                            <input type="text" id="temoignage_company_${index}" name="temoignage_company_${index}[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" >
                        </div>  
                        <div class="flex-1">
                            <label for="temoignage_position_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Position/Fonction</label>
                            <input type="text" id="temoignage_position_${index}" name="temoignage_position_${index}[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" >
                        </div>
                        <div class="flex-1">
                            <label for="temoignage_location_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Localisation</label>
                            <input type="text" id="temoignage_location_${index}" name="temoignage_location_${index}[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" >
                        </div>
                        <div class="flex-1">
                            <label for="temoignage_photo_url_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de la photo</label>
                            <input type="text" id="temoignage_photo_url_${index}" name="temoignage_photo_url_${index}[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" >    
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <label for="temoignage_message_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description Longue</label>
                    <textarea id="temoignage_message_${index}" name="temoignage_message_${index}[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm h-32" placeholder="ex: Description du témoignage"></textarea>
                </div>
                <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                    <div class="text-center">
                        <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                        <p class="text-xs text-slate-400">Aperçu image</p>
                        <input id="temoignage_photo_${index}" type="file" name="temoignage_photo_${index}[]" class="hidden">
                        <label for="temoignage_photo_${index}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Ajouter une photo</label>
                    </div>
                </div>
            `;
            container.appendChild(temoignageItem);
            attachTemoignagePhotoPreview(temoignageItem.querySelector('input[type="file"]'));

            const newTextarea = temoignageItem.querySelector('textarea');
            if (newTextarea) {
                tinymce.init({
                    selector: 'textarea',
                    valid_elements: '*[*]',
                    extended_valid_elements: 'i[class]',
                    ...tinyMCEConfig
                });
            }
        }

        function attachTemoignagePhotoPreview(input) {
            input.addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;

                const inputId = input.id; // ✅ Capturer l'id dans le scope correct

                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewDiv = input.closest('[data-temoignage]').querySelector('.preview .text-center');
                    // const newInputId = inputId + '-new';
                    previewDiv.innerHTML = `
                        <img src="${e.target.result}" alt="Aperçu image" class="max-h-40 object-contain mb-2">
                        <input type="file" name="temoignage_photo_${inputId}[]" class="hidden" id="temoignage_photo_${inputId}">
                        <label for="temoignage_photo_${inputId}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                    `;
                    // Réattacher l'écouteur sur le nouvel input généré
                    attachTemoignagePhotoPreview(previewDiv.querySelector('input[type="file"]'));
            };
                reader.readAsDataURL(file);
    
            });
        }

        function removeTemoignageSolutionSection(button) {
            const temoignageDiv = button.closest('[data-temoignage]');
            if (temoignageDiv) {
                temoignageDiv.remove();
            }
        }

        // Personnalisation de sections
        function addPersonnalisationSection() {
            const container = document.getElementById('personnalisation-grid');
            const index = container.querySelectorAll('[data-personnalisation]').length + 1;

            const personnalisationItem = document.createElement('div');
            personnalisationItem.setAttribute('data-personnalisation', '');
            personnalisationItem.classList.add('bg-white', 'p-8', 'rounded-3xl', 'shadow-sm', 'border', 'border-slate-100', 'relative', 'overflow-hidden');
            personnalisationItem.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                <button onclick="removePersonnalisationSection(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash text-xs"></i>
                </button>
                <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Section Personnalisée ${index} </h3>
                
                <input type="hidden" name="personnalisation_page_key" value="{{ $page_key }}">
                <input type="hidden" name="personnalisation_section_key_${index}">
                <div class="space-y-4">
                    
                    <div>
                        <label for="personnalisation_title_${index}" class="block text-xs text-slate-400 uppercase mb-1">Identifiant (titre) de la section</label>
                        <input type="text" id="personnalisation_title_${index}" name="personnalisation_title_${index}[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" >
                    </div>                    
                    
                    <div>

                        <label for="personnalisation_content_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Contenu de la section (HTML autorisé)</label>
                        <textarea id="personnalisation_content_${index}" name="personnalisation_content_${index}[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" placeholder="ex: <h2>Mon contenu personnalisé</h2><p>Avec du HTML</p>"></textarea>
                    </div>
                </div>
            `;
            container.appendChild(personnalisationItem);
            // attachPersonnalisationPreview(personnalisationItem.querySelector('input[type="file"]'));
            
            const newTextarea = personnalisationItem.querySelector('textarea');
            if (newTextarea) {
                tinymce.init({
                    selector: 'textarea',
                    valid_elements: '*[*]',
                    extended_valid_elements: 'i[class]',
                    ...tinyMCEConfig
                });
            }
        }

        function removePersonnalisationSection(button) {
            const personnalisationDiv = button.closest('[data-personnalisation]');
            if (personnalisationDiv) {
                personnalisationDiv.remove();
            }
        }

        

        // Enregistrement de toutes les données
        function saveAll() {
            const formData = new FormData();

            // Enregistrer le content de l'éditeur TinyMCE avant de récupérer les données
            if (typeof tinymce !== 'undefined') {
                tinymce.triggerSave();
            }
            // Récupérer les données des différentes sections
            // Infos générales
            formData.append('page_key', '{{ $page_key }}');
            formData.append('infos_title', document.getElementById('infos_title').value);
            formData.append('infos_subtitle', document.getElementById('infos_subtitle').value);
            // formData.append('infos_description', document.getElementById('infos_description').value);
            formData.append('infos_resume_solution', document.getElementById('infos_resume_solution').value);
            formData.append('infos_slug_solution', document.getElementById('infos_slug_solution').value);
            formData.append('infos_contact_email_solution', document.getElementById('infos_contact_email_solution').value);
            formData.append('infos_contact_phone_solution', document.getElementById('infos_contact_phone_solution').value);
            formData.append('infos_cible_solution', document.getElementById('infos_cible_solution').value);
            formData.append('infos_description_solution', document.getElementById('infos_description_solution').value);
            // formData.append('infos_disponibilite_solution', document.getElementById('infos_disponibilite_solution').value);
            // on peut selectionner disponibilite dans le select multiple, donc on va recuperer les valeurs selectionnées et les convertir en JSON avant de les envoyer
            const disponibiliteSelect = document.getElementById('infos_disponibilite_solution');
            const disponibiliteValues = Array.from(disponibiliteSelect.selectedOptions).map(option => option.value);
            formData.append('infos_disponibilite_solution', JSON.stringify(disponibiliteValues));


            formData.append('infos_mis_avant_solution', document.getElementById('infos_mis_avant_solution').value);
            formData.append('infos_image_couverture_solution', document.getElementById('image_couverture_solution').files[0]);
            formData.append('infos_image_url_solution', document.getElementById('infos_image_couverture_solution_url').value);
            formData.append('infos_cta_label', document.getElementById('infos_cta_label').value);
            formData.append('infos_cta_url', document.getElementById('infos_cta_url').value);
            formData.append('infos_icon', document.getElementById('infos_icon_solution').value);

            // Fonctionnalités
            // const fonctionnalites = [];
            document.querySelectorAll('[data-fonctionnalite]').forEach((item, index) => {
                const i = index + 1;
                formData.append(`fonctionnalites[${index}][title]`, item.querySelector(`[name="fonctionnalite_name_${i}[]"]`)?.value ?? '');
                formData.append(`fonctionnalites[${index}][icon]`, item.querySelector(`[name="fonctionnalite_icon_${i}[]"]`)?.value ?? '');
                formData.append(`fonctionnalites[${index}][description]`, item.querySelector(`[name="fonctionnalite_description_${i}[]"]`)?.value ?? '');
                formData.append(`fonctionnalites[${index}][section_key]`, item.querySelector(`[name="fonctionnalite_section_key_${i}[]"]`)?.value ?? '');
                // formData.append(`fonctionnalites[${index}][description]`, item.querySelector('textarea[name="certification_description[]"]')?.value ?? '');
                
            });          


            // Partenaires
            document.querySelectorAll('[data-partenaire]').forEach((item, index) => {
                const i = index + 1;
                formData.append(`partenaires[${index}][name]`,     item.querySelector(`[name="partenaire_name_${i}[]"]`)?.value ?? '');
                formData.append(`partenaires[${index}][logo_url]`, item.querySelector(`[name="partenaire_logo_url_${i}[]"]`)?.value ?? '');
                const logoFile = item.querySelector(`[name="partenaire_logo_${i}[]"]`)?.files[0];
                if (logoFile) formData.append(`partenaires[${index}][logo]`, logoFile);
            });

            // Témoignages
            document.querySelectorAll('[data-temoignage]').forEach((item, index) => {
                const i = index + 1;
                formData.append(`temoignages[${index}][author]`,     item.querySelector(`[name="temoignage_name_${i}[]"]`)?.value ?? '');
                formData.append(`temoignages[${index}][company]`,    item.querySelector(`[name="temoignage_company_${i}[]"]`)?.value ?? '');
                formData.append(`temoignages[${index}][position]`,   item.querySelector(`[name="temoignage_position_${i}[]"]`)?.value ?? '');
                formData.append(`temoignages[${index}][location]`,   item.querySelector(`[name="temoignage_location_${i}[]"]`)?.value ?? '');
                formData.append(`temoignages[${index}][content]`,    item.querySelector(`[name="temoignage_message_${i}[]"]`)?.value ?? '');
                formData.append(`temoignages[${index}][photo_url]`,  item.querySelector(`[name="temoignage_photo_url_${i}[]"]`)?.value ?? '');
                const photoFile = item.querySelector(`[name="temoignage_photo_${i}[]"]`)?.files[0];
                if (photoFile) formData.append(`temoignages[${index}][photo]`, photoFile);
            });

            // Personnalisation de sections
            
            document.querySelectorAll('[data-personnalisation]').forEach((item, index) => {
                const i = index + 1;
                formData.append(`personnalisation_sections[${index}][title]`, item.querySelector(`[name="personnalisation_title_${i}[]"]`)?.value ?? '');
                formData.append(`personnalisation_sections[${index}][content]`, item.querySelector(`[name="personnalisation_content_${i}[]"]`)?.value ?? '');
            });




            // Accroche
            formData.append('accroche_title', document.querySelector(`[name="accroche_title"]`).value);
            formData.append('accroche_subtitle', document.querySelector(`[name="accroche_subtitle"]`).value);
            formData.append('accroche_description', document.querySelector(`[name="accroche_description"]`).value);
            formData.append('accroche_cta_label', document.querySelector(`[name="accroche_cta_label"]`).value);
            formData.append('accroche_cta_url', document.querySelector(`[name="accroche_cta_url"]`).value);
            formData.append('accroche_page_key', '{{ $page_key ?? "solutions" }}');

            // SEO
            formData.append('seo_title', document.querySelector(`[name="seo_title"]`).value);
            formData.append('seo_description', document.querySelector(`[name="seo_description"]`).value);
            formData.append('seo_keywords', document.querySelector(`[name="seo_keywords"]`).value);
            formData.append('seo_page_key', '{{ $page_key ?? "solutions" }}');

            
            // Chiffres clés
            document.querySelectorAll('#chiffres-cles-container .chiffre-cle-item').forEach((chiffre, index) => {
                const i = index + 1;
                formData.append(`chiffres[${index}][label]`,       chiffre.querySelector(`[name="label_chiffre_cle_${i}"]`)?.value ?? '');
                formData.append(`chiffres[${index}][value]`,       chiffre.querySelector(`[name="valeur_chiffre_cle_${i}"]`)?.value ?? '');
                formData.append(`chiffres[${index}][icon]`,        chiffre.querySelector(`[name="icon_chiffre_cle_${i}"]`)?.value ?? '');
                formData.append(`chiffres[${index}][description]`, chiffre.querySelector(`[name="description_chiffre_cle_${i}"]`)?.value ?? '');
            });




            const btn = document.querySelector('button[onclick="saveAll()"]');
            const originalContent = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            console.log('FormData entries:');
            for (let pair of formData.entries()) {
                console.log(pair[0]+ ': ' + pair[1]);
            }

            // Envoyer les données au serveur
            fetch('{{ route("solutions.store") }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                const statusBadge = document.getElementById('status-badge');
                statusBadge.classList.remove('hidden');
                
                const successMessage = document.querySelector('#toast .success-message');
                const successDescription = document.querySelector('#toast .success-description');

                if (data.success === true) {
                    successMessage.textContent = 'Succès';
                    successDescription.textContent = 'Les données ont été enregistrées avec succès.';
                     showToast();
                    setTimeout(() => {
                        btn.innerHTML = originalContent;
                        btn.disabled = false;
                        btn.classList.remove('opacity-75', 'cursor-not-allowed');
                        statusBadge.classList.add('hidden');

                        // window.location.href = '{{ route("solutions.index") }}';
                        window.location.reload();
                    }, 1200);
                } else {
                    // showToastError();
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
                    showToastError();
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