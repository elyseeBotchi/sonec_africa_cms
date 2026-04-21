@extends('admin.layout.appLayout')

@section('content')

    <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
        <div class="flex items-center gap-4">
            <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Secteur d'Expertise</h2>
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
                {{-- <button onclick="showTab('fonctionnalites')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Fonctionnalités</button> --}}
                <button onclick="showTab('partenaires')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Partenaires</button>
                {{-- <button onclick="showTab('temoignages')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Témoignages</button> --}}
                <button onclick="showTab('personnalisation')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Personnalisation de sections</button>
                <button onclick="showTab('seo')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">SEO & Méta</button>
            </div>
            <div class="space-y-8">        

               {{-- Affichage des erreurs serveurs --}}
                <div id="form-errors" class="bg-red-100 text-red-700 p-4 rounded mb-6 hidden"></div>


                <div id="tab-content" class="tab-content p-8 rounded-3xl shadow-sm border border-slate-100">
                    <div id="tab-content-infos" class="tab-pane active">
                        @include('admin.pages.gestion-secteur-expertise.partials.edition.infos')
                    </div>
                    {{-- <div id="tab-content-fonctionnalites" class="tab-pane hidden">
                        @include('admin.pages.gestion-secteur-expertise.partials.edition.fonctionnalites')
                    </div> --}}
                    <div id="tab-content-partenaires" class="tab-pane hidden">
                        @include('admin.pages.gestion-secteur-expertise.partials.edition.partenaires')
                    </div>
                    {{-- <div id="tab-content-temoignages" class="tab-pane hidden">
                        @include('admin.pages.gestion-secteur-expertise.partials.edition.temoignages')
                    </div> --}}
                    <div id="tab-content-personnalisation" class="tab-pane hidden">
                        @include('admin.pages.gestion-secteur-expertise.partials.edition.personnalisation') 
                    </div>
                    <div id="tab-content-seo" class="tab-pane hidden">
                        @include('admin.pages.gestion-secteur-expertise.partials.edition.seo')
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

        document.getElementById('image_couverture_secteur_expertise').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Afficher l'aperçu de l'image
                    // const preview = document.querySelector('#preview-area-logo').parentElement.querySelector('i');
                    const preview = document.querySelector('.preview-area-image-couverture-secteur-expertise');
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

        // Ajouter chiffres clés du secteur d'expertise
        function addChiffreCleSecteurExpertise() {
            const container = document.getElementById('chiffres-cles-grid');
            // Compte tous les items présents (Blade + JS) pour éviter les doublons d'index
            const index = container.querySelectorAll('[data-chiffre]').length + 1;

            const item = document.createElement('div');
            item.setAttribute('data-chiffre', '');
            item.classList.add('chiffre-cle-item', 'bg-slate-50', 'p-4', 'rounded-xl', 'border', 'border-slate-200', 'relative');
            item.innerHTML = `
                <div class="flex justify-end mb-2">
                    <button type="button" onclick="removeChiffreCleSecteurExpertise(this)"
                        class="text-red-500 hover:text-red-700 text-sm font-bold">
                        <i class="fas fa-trash"></i>
                    </button>
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label for="label_chiffre_cle_${index}"
                            class="block text-xs font-bold text-slate-400 uppercase mb-1">
                            Libellé chiffre clé
                        </label>
                        <input type="text"
                            id="label_chiffre_cle_${index}"
                            name="label_chiffre_cle_${index}[]"
                            placeholder="ex: 500+"
                            class="w-full p-3 bg-white border border-slate-200 rounded-xl font-normal text-sm">
                    </div>

                    <div>
                        <label for="valeur_chiffre_cle_${index}"
                            class="block text-xs font-bold text-slate-400 uppercase mb-1">
                            Valeur chiffre clé
                        </label>
                        <input type="text"
                            id="valeur_chiffre_cle_${index}"
                            name="valeur_chiffre_cle_${index}[]"
                            placeholder="ex: 500+"
                            class="w-full p-3 bg-white border border-slate-200 rounded-xl font-normal text-sm">
                    </div>

                    <div>
                        <label for="icon_chiffre_cle_${index}"
                            class="block text-xs font-bold text-slate-400 uppercase mb-1">
                            Icône (optionnel)
                        </label>
                        <input type="text"
                            id="icon_chiffre_cle_${index}"
                            name="icon_chiffre_cle_${index}[]"
                            placeholder="ex: fas fa-users"
                            class="w-full p-3 bg-white border border-slate-200 rounded-xl font-normal text-sm">
                    </div>

                    <div class="col-span-2">
                        <label for="description_chiffre_cle_${index}"
                            class="block text-xs font-bold text-slate-400 uppercase mb-1">
                            Description
                        </label>
                        <textarea
                            id="description_chiffre_cle_${index}"
                            name="description_chiffre_cle_${index}[]"
                            placeholder="ex: Clients satisfaits"
                            class="w-full p-3 bg-white border border-slate-200 rounded-xl font-normal text-sm"
                        ></textarea>
                    </div>
                </div>
            `;
            container.appendChild(item);
        }

        function removeChiffreCleSecteurExpertise(button) {
            button.closest('[data-chiffre]')?.remove();
        }

        // Partenaires
        function addPartenaireSecteurExpertise() {
            const container = document.getElementById('partenaires-grid');
            const index = container.querySelectorAll('[data-partenaire]').length + 1;

            const partenaireItem = document.createElement('div');
            partenaireItem.setAttribute('data-partenaire', '');
            partenaireItem.classList.add('bg-white', 'p-8', 'rounded-3xl', 'shadow-sm', 'border', 'border-slate-100', 'relative', 'overflow-hidden');
            partenaireItem.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                <button onclick="removePartenaireSecteurExpertise(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
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
                        <div class="flex-1">
                            <label for="partenaire_website_${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url du site web</label>
                            <input type="text" id="partenaire_website_${index}" name="partenaire_website_${index}[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" >    
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

        function removePartenaireSecteurExpertise(button) {
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

        

        // Personnalisation de sections
        function addPersonnalisationSecteurExpertise() {
            const container = document.getElementById('personnalisation-grid');
            // Compte tous les items présents (Blade + JS ajoutés dynamiquement)
            const index = container.querySelectorAll('[data-personnalisation]').length + 1;

            const item = document.createElement('div');
            item.setAttribute('data-personnalisation', '');
            item.classList.add(
                'bg-white', 'p-8', 'rounded-3xl', 'shadow-sm',
                'border', 'border-slate-100', 'relative', 'overflow-hidden'
            );
            item.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                <button type="button" onclick="removePersonnalisationSection(this)"
                    class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash text-xs"></i>
                </button>
                <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                    <i class="fas fa-star text-purple-500"></i> Section personnalisée ${index}
                </h3>

                <input type="hidden" name="personnalisation_page_key" value="{{ $page_key }}">

                <div class="space-y-4">
                    <div>
                        <label for="personnalisation_title_${index}"
                            class="block text-xs text-slate-400 uppercase mb-1">
                            Identifiant (titre) de la section
                        </label>
                        <input type="text"
                            id="personnalisation_title_${index}"
                            name="personnalisation_title_${index}[]"
                            placeholder="Titre de la section"
                            class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                    </div>

                    <div>
                        <label for="personnalisation_content_${index}"
                            class="block text-xs font-bold text-slate-400 uppercase mb-1">
                            Contenu de la section (HTML autorisé)
                        </label>
                        <textarea
                            id="personnalisation_content_${index}"
                            name="personnalisation_content_${index}[]"
                            placeholder="ex: <h2>Mon contenu</h2><p>Avec du HTML</p>"
                            class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500"
                            rows="5"></textarea>
                    </div>
                </div>
            `;
            container.appendChild(item);

            // Réinitialiser TinyMCE sur le nouveau textarea si disponible
            if (typeof tinymce !== 'undefined') {
                tinymce.init({
                    selector: `#personnalisation_content_${index}`,
                    ...tinyMCEConfig
                });
            }
        }

        function removePersonnalisationSection(button) {
            button.closest('[data-personnalisation]')?.remove();
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
            formData.append('secteur_expertise_name', document.getElementById('secteur_expertise_name').value);
            formData.append('secteur_expertise_title_hero', document.getElementById('secteur_expertise_title_hero').value);
            formData.append('secteur_expertise_subtitle', document.getElementById('secteur_expertise_subtitle').value);
            // formData.append('secteur_expertise_description', document.getElementById('secteur_expertise_description').value);
            formData.append('secteur_expertise_resume', document.getElementById('secteur_expertise_resume').value);
            formData.append('secteur_expertise_slug', document.getElementById('secteur_expertise_slug').value);
            formData.append('secteur_expertise_contact_email', document.getElementById('secteur_expertise_contact_email').value);
            formData.append('secteur_expertise_contact_phone', document.getElementById('secteur_expertise_contact_phone').value);
            // formData.append('secteur_expertise_cible', document.getElementById('secteur_expertise_cible').value);
            formData.append('secteur_expertise_description', document.getElementById('secteur_expertise_description').value);
            // formData.append('secteur_expertise_disponibilite', document.getElementById('secteur_expertise_disponibilite').value);
          
            formData.append('secteur_expertise_mis_avant', document.getElementById('secteur_expertise_mis_avant').value);
            formData.append('secteur_expertise_image_couverture', document.getElementById('image_couverture_secteur_expertise').files[0]);
            formData.append('secteur_expertise_image_url', document.getElementById('secteur_expertise_image_couverture_url').value);
            formData.append('secteur_expertise_cta_label_1', document.getElementById('secteur_expertise_cta_1_label').value);
            formData.append('secteur_expertise_cta_label_2', document.getElementById('secteur_expertise_cta_2_label').value);
            formData.append('secteur_expertise_cta_url_1', document.getElementById('secteur_expertise_cta_1_url').value);
            formData.append('secteur_expertise_cta_url_2', document.getElementById('secteur_expertise_cta_2_url').value);
            formData.append('secteur_expertise_icon', document.getElementById('secteur_expertise_icon').value);


            document.querySelectorAll('[data-partenaire]').forEach((item, index) => {
                formData.append(`partenaires[${index}][name]`,
                    item.querySelector('[name^="partenaire_name_"]')?.value ?? '');

                formData.append(`partenaires[${index}][logo_url]`,
                    item.querySelector('[name^="partenaire_logo_url_"]')?.value ?? '');

                const logoFile = item.querySelector('[name^="partenaire_logo_"]')?.files?.[0];
                if (logoFile) formData.append(`partenaires[${index}][logo]`, logoFile);

                formData.append(`partenaires[${index}][url]`,
                    item.querySelector('[name^="partenaire_url_"]')?.value ?? '');

                formData.append(`partenaires[${index}][website]`,
                    item.querySelector('[name^="partenaire_website_"]')?.value ?? '');


                const idInput = item.querySelector('[name^="partenaire_id_"]');
                if (idInput?.value) {
                    formData.append(`partenaires[${index}][id]`, idInput.value);
                }
            });           

            // Personnalisation de sections
            // document.querySelectorAll('[data-personnalisation]').forEach((item, index) => {
            //     const i = index + 1;
            //     formData.append(`personnalisation_sections[${index}][title]`, item.querySelector(`[name="personnalisation_title_${i}[]"]`)?.value ?? '');
            //     formData.append(`personnalisation_sections[${index}][content]`, item.querySelector(`[name="personnalisation_content_${i}[]"]`)?.value ?? '');
            // });

            document.querySelectorAll('[data-personnalisation]').forEach((item, index) => {
                const i = index + 1;

                formData.append(`personnalisation_sections[${index}][title]`,
                    item.querySelector(`[name="personnalisation_title_${i}[]"]`)?.value ?? '');

                formData.append(`personnalisation_sections[${index}][content]`,
                    item.querySelector(`[name="personnalisation_content_${i}[]"]`)?.value ?? '');

                const idInput = item.querySelector(`[name="personnalisation_id_${i}"]`);
                if (idInput?.value) {
                    formData.append(`personnalisation_sections[${index}][id]`, idInput.value);
                }
            });

            // Accroche
            formData.append('accroche_title', document.querySelector(`[name="accroche_title"]`).value);
            formData.append('accroche_subtitle', document.querySelector(`[name="accroche_subtitle"]`).value);
            formData.append('accroche_description', document.querySelector(`[name="accroche_description"]`).value);
            formData.append('accroche_cta_label', document.querySelector(`[name="accroche_cta_label"]`).value);
            formData.append('accroche_cta_label', document.querySelector(`[name="accroche_cta_label"]`).value);
            formData.append('accroche_cta_url', document.querySelector(`[name="accroche_cta_url"]`).value);
            formData.append('accroche_page_key', '{{ $page_key ?? "secteur_expertise" }}');
            formData.append('accroche_id', document.querySelector(`[name="accroche_id"]`)?.value ?? null);

            // SEO
            formData.append('seo_title', document.querySelector(`[name="seo_title"]`).value);
            formData.append('seo_description', document.querySelector(`[name="seo_description"]`).value);
            formData.append('seo_keywords', document.querySelector(`[name="seo_keywords"]`).value);
            formData.append('seo_page_key', '{{ $page_key ?? "secteur_expertise" }}');
            formData.append('seo_id', document.querySelector(`[name="seo_id"]`)?.value ?? null);

            // Chiffres clés
            document.querySelectorAll('[data-chiffre]').forEach((item, index) => {
                const i = index + 1;

                formData.append(`chiffres[${index}][label]`,
                    item.querySelector(`[name="label_chiffre_cle_${i}[]"]`)?.value ?? '');

                formData.append(`chiffres[${index}][value]`,
                    item.querySelector(`[name="valeur_chiffre_cle_${i}[]"]`)?.value ?? '');

                formData.append(`chiffres[${index}][icon]`,
                    item.querySelector(`[name="icon_chiffre_cle_${i}[]"]`)?.value ?? '');

                formData.append(`chiffres[${index}][description]`,
                    item.querySelector(`[name="description_chiffre_cle_${i}[]"]`)?.value ?? '');

                // Nom aligné sur le Blade : chiffre_id_1, chiffre_id_2...
                const idInput = item.querySelector(`[name="chiffre_id_${i}"]`);
                if (idInput?.value) {
                    formData.append(`chiffres[${index}][id]`, idInput.value);
                }
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

            formData.append('_method', 'PUT');

            // Envoyer les données au serveur
            fetch('{{ route("secteur-expertise.update", $secteurExpertise->id) }}', {
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

                        // window.location.href = '{{ route("secteur-expertise.index") }}';
                        // window.location.reload();
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