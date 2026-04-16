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
                <button onclick="showTab('approche-certification')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Reconnaissances & Approches</button>
                <button onclick="showTab('seo')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">SEO & Méta</button>
            </div>

            <div class="space-y-8">
           

                {{-- Affichage des erreurs serveurs --}}
                <div id="form-errors" class="bg-red-100 text-red-700 p-4 rounded mb-6 hidden"></div>


                <div id="tab-content" class="tab-content p-8 rounded-3xl shadow-sm border border-slate-100">
                    <div id="tab-content-home-content" class="tab-pane active">
                        @include('admin.pages.qui-sommes-nous.decouvrir-sonec-africa.partials.content')
                    </div>
                    <div id="tab-content-home-media" class="tab-pane hidden">
                        
                        @include('admin.pages.qui-sommes-nous.decouvrir-sonec-africa.partials.media') 
                    </div>
                    <div id="tab-content-home-approche-certification" class="tab-pane hidden">
                        @include('admin.pages.qui-sommes-nous.decouvrir-sonec-africa.partials.approche-certification')
                    </div>
                    <div id="tab-content-home-seo" class="tab-pane hidden">
                        @include('admin.pages.qui-sommes-nous.decouvrir-sonec-africa.partials.seo')
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
                if (button.textContent.trim() === (tab === 'content' ? 'Contenu' : tab === 'media' ? 'Images & Médias' : tab === 'approche-certification' ? 'Approche & Certification' : 'SEO & Méta')) {
                    button.classList.add('bg-white', 'shadow-sm', 'text-sonec-dark');
                    button.classList.remove('text-slate-500');
                } else {
                    button.classList.remove('bg-white', 'shadow-sm', 'text-sonec-dark');
                    button.classList.add('text-slate-500');
                }
            });            
        }
        
        document.getElementById('vision_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Afficher l'aperçu de l'image
                    // const preview = document.querySelector('#preview-area-logo').parentElement.querySelector('i');
                    const preview = document.querySelector('.preview-area-vision');
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

        document.getElementById('banniere_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Afficher l'aperçu de l'image
                    // const preview = document.querySelector('#preview-area-logo').parentElement.querySelector('i');
                    const preview = document.querySelector('.preview-area-banniere');
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

        document.getElementById('engagement_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Afficher l'aperçu de l'image
                    // const preview = document.querySelector('#preview-area-logo').parentElement.querySelector('i');
                    const preview = document.querySelector('.preview-area-engagement');
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

        // Ajouter bloc piliers
        function addPilier() {
            const container = document.getElementById('pilier-container');
            const count = Date.now();

            const div = document.createElement('div');
            div.setAttribute('data-pilier', '');
            div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
            div.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button type="button" onclick="removePilier(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                        <i class="fas fa-star text-purple-500"></i> Pilier ${count}
                    </h3>
                    {{-- Pas d'input id hidden pour les nouveaux slides --}}
                    <input type="hidden" id="pilier_section_key-${count}" name="pilier_section_key[]" value="piliers">
                    <label for="pilier_icon_${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône (classe FontAwesome)</label>
                    <input type="text" name="pilier_icon[]" id="pilier_icon_${count}"
                        class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-mono text-blue-500" 
                        placeholder="fas fa-cog">
                    <label for="pilier_title_${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Titre</label>
                    <input type="text" name="pilier_title[]" id="pilier_title_${count}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                        placeholder="Titre du pilier">
                    <label for="pilier_description_${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Description</label>
                    <textarea name="pilier_description[]" id="pilier_description_${count}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none" 
                        rows="4" placeholder="Description du pilier">
                    </textarea>
                </div>

            `;
            container.appendChild(div);
        }

        function removePilier(button) {
            const pilierDiv = button.closest('[data-pilier]');
            if (pilierDiv) {
                pilierDiv.remove();
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

        // Engagements items
        function addEngagementItem() {
            const container = document.getElementById('engagements-container');
            const count = Date.now();


            const div = document.createElement('div');
            div.setAttribute('data-engagement-item', '');
            div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
            div.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button type="button" onclick="removeEngagementItem(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                        <i class="fas fa-star text-purple-500"></i> Engagement ${count}
                    </h3>
                    <input type="hidden" id="engagement_item_section_key-${count}" name="engagement_item_section_key[]" value="engagement_item">
                    <label for="engagement_item_title${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Titre</label>
                    <input type="text" name="engagement_item_title[]" id="engagement_item_title${count}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                        placeholder="Titre de l'engagement">

                    <label for="engagement_item_icon_${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône (classe FontAwesome)</label>
                    <input type="text" name="engagement_item_icon[]" id="engagement_item_icon_${count}"
                            class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-mono text-blue-500" 
                            placeholder="fas fa-cog"> 
                    
                    
                    <label for="engagement_item_description_${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Description</label>
                    <textarea name="engagement_item_description[]" id="engagement_item_description_${count}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none" 
                        rows="4" placeholder="Description de l'engagement"></textarea>
                </div>

            `;
            container.appendChild(div);
        }

        function removeEngagementItem(button) {
            const engagementDiv = button.closest('[data-engagement-item]');
            if (engagementDiv) {
                engagementDiv.remove();
            }
        }

        function addApproche(){
            const container = document.getElementById('approche-container');
            const count = Date.now();

            const div = document.createElement('div');
            div.setAttribute('data-approche', '');

            div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
            div.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button type="button" onclick="removeApproche(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                        <i class="fas fa-star text-purple-500"></i> Approche ${count}
                    </h3>
                    {{-- Pas d'input id hidden pour les nouveaux slides --}}
                    <input type="hidden" id="approche_page_key-${count}" name="approche_page_key[]" value="decouvrir-sonec-africa">
                    <input type="hidden" id="approche_section_key-${count}" name="approche_section_key[]" value="approche">
                    <div class="space-y-4">
                        <div>
                            <label for="approche_title-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                            <input type="text" id="approche_title-${count}" name="approche_title[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="">
                        </div>
                    
                        <div class="flex gap-4">                            
                            
                            <div class="flex-1">
                                <label for="approche_description-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Description</label>
                                <textarea id="approche_description-${count}" name="approche_description[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500"></textarea>
                                
                            </div>
                        </div>
                    </div>  
                </div>

            `;
            container.appendChild(div);
        }

        function removeApproche(button) {
            const approcheDiv = button.closest('[data-approche]');
            if (approcheDiv) {
                approcheDiv.remove();
            }
        }

        function addCertifications() {
            const container = document.getElementById('certifications-container');
            const count = Date.now();

            const div = document.createElement('div');
            div.setAttribute('data-certifications', '');
            div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
            div.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button type="button" onclick="removeCertifications(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                        <i class="fas fa-star text-purple-500"></i> Certification ${count}
                    </h3>
                    <input type="hidden" id="certification_page_key-${count}" name="certification_page_key[]" value="decouvrir-sonec-africa">
                    <input type="hidden" id="certification_section_key-${count}" name="certification_section_key[]" value="certifications">
                    
                    <label for="certification_label-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Libellé</label>
                    <input type="text" name="certification_label[]" id="certification_label-${count}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                        placeholder="Nom du partenaire">

                    <label for="certification_icon-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Icon</label>
                    <input type="text" name="certification_icon[]" id="certification_icon-${count}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                        placeholder="Icon">

                    <label for="certification_description-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Description</label>
                    <textarea name="certification_description[]" id="certification_description-${count}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none" 
                        ></textarea>
                </div>

            `;
            container.appendChild(div);
        }

        function removeCertifications(button) {
            const certificationDiv = button.closest('[data-certifications]');
            if (certificationDiv) {
                certificationDiv.remove();
            }
        }

        // Fonction de sauvegarde
        function saveAll() {
            const formData = new FormData(); 
            const val = (id) => document.getElementById(id)?.value ?? '';

            
            tinymce.triggerSave(); // Assurez-vous que les éditeurs TinyMCE mettent à jour les textarea


            // const content = tinymce.get('content').getContent();
            // formData.set('content', content);

            formData.append(' page_key', '{{ $page_key }}' ?? 'decouvrir-sonec-africa');


            formData.append('accroche_title', val('accroche_title'));
            formData.append('accroche_subtitle', val('accroche_subtitle'));
            formData.append('accroche_description', val('accroche_description'));
            formData.append('accroche_cta_label', val('accroche_cta_label'));
            formData.append('accroche_cta_url', val('accroche_cta_url'));
            formData.append('accroche_page_key', '{{ $page_key }}');
            formData.append('accroche_section_key', 'accroche');

            


            // vision
            formData.append('vision_title', val('vision_title'));
            formData.append('vision_subtitle', val('vision_subtitle'));
            formData.append('vision_description', val('vision_description'));
            formData.append('vision_cta_label', val('vision_cta_label'));
            formData.append('vision_cta_url', val('vision_cta_url'));
            formData.append('vision_image_url', val('vision_image_url'));
            formData.append('vision_page_key', '{{ $page_key }}');
            formData.append('vision_section_key', 'vision');
            const visionImageInput = document.getElementById('vision_image');
            if (visionImageInput?.files[0]) formData.append('vision_image', visionImageInput.files[0]);


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

            // engagement
            formData.append('engagement_title', val('engagement_title'));
            formData.append('engagement_subtitle', val('engagement_subtitle'));
            formData.append('engagement_description', val('engagement_description'));
            formData.append('engagement_cta_label', val('engagement_cta_label'));
            formData.append('engagement_cta_url', val('engagement_cta_url'));
            formData.append('engagement_image_url', val('engagement_image_url'));
            formData.append('engagement_page_key', '{{ $page_key }}');
            formData.append('engagement_section_key', 'engagement');
            const engagementImageInput = document.getElementById('engagement_image');
            if (engagementImageInput?.files[0]) formData.append('engagement_image', engagementImageInput.files[0]);

            // engagement items
            document.querySelectorAll('#engagements-container [data-engagement-item]').forEach((engagementItem, index) => {
                const idInput = engagementItem.querySelector('input[name="id[]"]');
                if (idInput) formData.append(`engagements[${index}][id]`, idInput.value);
                formData.append(`engagements[${index}][icon]`, engagementItem.querySelector('input[name="engagement_item_icon[]"]')?.value ?? '');
                formData.append(`engagements[${index}][title]`, engagementItem.querySelector('input[name="engagement_item_title[]"]')?.value ?? '');
                formData.append(`engagements[${index}][description]`, engagementItem.querySelector('textarea[name="engagement_item_description[]"]')?.value ?? '');
                formData.append(`engagements[${index}][section_key]`, engagementItem.querySelector('input[name="engagement_item_section_key[]"]')?.value ?? '');
            });

            // pilliers
            document.querySelectorAll('#pilier-container [data-pilier]').forEach((pilier, index) => {
                const idInput = pilier.querySelector('input[name="id[]"]');
                if (idInput) formData.append(`piliers[${index}][id]`, idInput.value);
                formData.append(`piliers[${index}][icon]`, pilier.querySelector('input[name="pilier_icon[]"]')?.value ?? '');
                formData.append(`piliers[${index}][title]`, pilier.querySelector('input[name="pilier_title[]"]')?.value ?? '');
                formData.append(`piliers[${index}][description]`, pilier.querySelector('textarea[name="pilier_description[]"]')?.value ?? '');
                formData.append(`piliers[${index}][section_key]`, pilier.querySelector('input[name="pilier_section_key[]"]')?.value ?? '');
            });

            // chiffres
            document.querySelectorAll('#chiffres-container [data-chiffre]').forEach((chiffre, index) => {
                const idInput = chiffre.querySelector('input[name="id[]"]');
                if (idInput) formData.append(`chiffres[${index}][id]`, idInput.value);
                formData.append(`chiffres[${index}][label]`, chiffre.querySelector('input[name="chiffre_label[]"]')?.value ?? '');
                formData.append(`chiffres[${index}][value]`, chiffre.querySelector('input[name="chiffre_value[]"]')?.value ?? '');
                formData.append(`chiffres[${index}][icon]`, chiffre.querySelector('input[name="chiffre_icon[]"]')?.value ?? '');
                formData.append(`chiffres[${index}][description]`, chiffre.querySelector('textarea[name="chiffre_description[]"]')?.value ?? '');
                formData.append(`chiffres[${index}][section_key]`, chiffre.querySelector('input[name="chiffre_section_key[]"]')?.value ?? '');
            });

            // Approches
            document.querySelectorAll('#approche-container [data-approche]').forEach((approche, index) => {
                const idInput = approche.querySelector('input[name="id[]"]');
                if (idInput) formData.append(`approches[${index}][id]`, idInput.value);
                formData.append(`approches[${index}][title]`, approche.querySelector('input[name="approche_title[]"]')?.value ?? '');
                formData.append(`approches[${index}][description]`, approche.querySelector('textarea[name="approche_description[]"]')?.value ?? '');
                formData.append(`approches[${index}][section_key]`, approche.querySelector('input[name="approche_section_key[]"]')?.value ?? '');
            });

            // Certifications
            document.querySelectorAll('#certifications-container [data-certifications]').forEach((certification, index) => {
                const idInput = certification.querySelector('input[name="id[]"]');
                if (idInput) formData.append(`certifications[${index}][id]`, idInput.value);
                formData.append(`certifications[${index}][label]`, certification.querySelector('input[name="certification_label[]"]')?.value ?? '');
                formData.append(`certifications[${index}][icon]`, certification.querySelector('input[name="certification_icon[]"]')?.value ?? '');
                formData.append(`certifications[${index}][description]`, certification.querySelector('textarea[name="certification_description[]"]')?.value ?? '');
                formData.append(`certifications[${index}][section_key]`, certification.querySelector('input[name="certification_section_key[]"]')?.value ?? '');
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
             fetch('{{ route("admin.decouvrir-sonec-africa.save") }}', {
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
