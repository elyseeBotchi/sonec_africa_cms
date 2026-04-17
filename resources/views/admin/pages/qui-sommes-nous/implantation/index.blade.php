@extends('admin.layout.appLayout')

@section('content')
    <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
        <div class="flex items-center gap-4">
            <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Implantation</h2>
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
                <button onclick="showTab('bureaux')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Bureaux</button>
                <button onclick="showTab('seo')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">SEO & Méta</button>
            </div>

            <div class="space-y-8">
           

                {{-- Affichage des erreurs serveurs --}}
                <div id="form-errors" class="bg-red-100 text-red-700 p-4 rounded mb-6 hidden"></div>


                <div id="tab-content" class="tab-content p-8 rounded-3xl shadow-sm border border-slate-100">
                    <div id="tab-content-home-content" class="tab-pane active">
                        @include('admin.pages.qui-sommes-nous.implantation.partials.content')
                    </div>
                    <div id="tab-content-home-media" class="tab-pane hidden">
                        
                        @include('admin.pages.qui-sommes-nous.implantation.partials.media') 
                    </div>
                    <div id="tab-content-home-bureaux" class="tab-pane hidden">
                        @include('admin.pages.qui-sommes-nous.implantation.partials.bureaux')
                    </div>
                    <div id="tab-content-home-seo" class="tab-pane hidden">
                        @include('admin.pages.qui-sommes-nous.implantation.partials.seo')
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
                if (button.textContent.trim() === (tab === 'content' ? 'Contenu' : tab === 'media' ? 'Images & Médias' : tab === 'bureaux' ? 'Bureaux' : 'SEO & Méta')) {
                    button.classList.add('bg-white', 'shadow-sm', 'text-sonec-dark');
                    button.classList.remove('text-slate-500');
                } else {
                    button.classList.remove('bg-white', 'shadow-sm', 'text-sonec-dark');
                    button.classList.add('text-slate-500');
                }
            });            
        }

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
        
        document.getElementById('section_premiere_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Afficher l'aperçu de l'image
                    // const preview = document.querySelector('#preview-area-logo').parentElement.querySelector('i');
                    const preview = document.querySelector('.preview-area-section_premiere');
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

        document.getElementById('about_image').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    // Afficher l'aperçu de l'image
                    // const preview = document.querySelector('#preview-area-logo').parentElement.querySelector('i');
                    const preview = document.querySelector('.preview-area-aboutSection');
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

        // Ajouter bloc valeurs
        // function addValeur() {
        //     const container = document.getElementById('valeurs-container');
        //     const count = Date.now();

        //     const div = document.createElement('div');
        //     div.setAttribute('data-valeur', '');
        //     div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
        //     div.innerHTML = `
        //         <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
        //             <button type="button" onclick="removeValeur(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
        //                 <i class="fas fa-trash text-xs"></i>
        //             </button>
        //             <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
        //                 <i class="fas fa-star text-purple-500"></i> Valeur ${count}
        //             </h3>
        //             <input type="hidden" id="valeur_id-${count}" name="id[]" value="">
        //             <input type="hidden" id="valeur_section_key-${count}" name="section_key[]" value="valeurs">
        //             <label for="valeur_icon-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône (classe FontAwesome)</label>
        //             <input type="text" name="valeur_icon[]" id="valeur_icon-${count}"
        //                 class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-mono text-blue-500" 
        //                 placeholder="fas fa-cog"> 

        //             <label for="valeur_title-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Titre</label>
        //             <input type="text" name="valeur_title[]" id="valeur_title-${count}"
        //                 class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" >
                   
                   
        //             <label for="valeur_description-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Description</label>
        //             <textarea name="valeur_description[]" id="valeur_description-${count}"
        //                 class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none" 
        //                 rows="4"></textarea>
        //         </div>

        //     `;
        //     container.appendChild(div);

        // }

        // function removeValeur(button) {
        //     const valeurDiv = button.closest('[data-valeur]');
        //     if (valeurDiv) {
        //         valeurDiv.remove();
        //     }
        // }

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

        //    Bureaux
        function addBureau(){
            const container = document.getElementById('bureaux-container');
            const count = Date.now();

            const div = document.createElement('div');
            div.setAttribute('data-bureau', '');
            div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
            div.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button type="button" onclick="removeBureau(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                        <i class="fas fa-star text-purple-500"></i> Bureau ${count}
                    </h3>
                    <input type="hidden" id="bureau_page_key-${count}" name="bureau_page_key" value="implantation">
                    <input type="hidden" id="bureau_section_key-${count}" name="bureau_section_key[]" value="bureaux">
                    
                    <label for="libelle_bureau_pays-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                    <input type="text" id="libelle_bureau_pays-${count}" name="libelle_bureau_pays[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                    
                    <label for="bureau_code_pays-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Code Pays</label>
                    <input type="text" id="bureau_code_pays-${count}" name="bureau_code_pays[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                    
                    <label for="bureau_representant-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Représentant</label>
                    <input type="text" id="bureau_representant-${count}" name="bureau_representant[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                    <label for="bureau_adresse-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Adresse</label>
                    <textarea id="bureau_adresse-${count}" name="bureau_adresse[]" class="  w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500"></textarea>  
                    <label for="bureau_telephone-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Téléphone</label>
                    <input type="text" id="bureau_telephone-${count}" name="bureau_telephone[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" >
                    <label for="bureau_email-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Email</label>
                    <input type="text" id="bureau_email-${count}" name="bureau_email[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" >
                    <label for="bureau_ville-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Ville</label>
                    <input type="text" id="bureau_ville-${count}" name="bureau_ville[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" >
                    <label for="bureau_type-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Type de bureau</label>
                        <input type="text" id="bureau_type-${count}" name="bureau_type[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">  
                    <div class="grid md:grid-cols-2 gap-6">
                        <div>
                            <label for="bureau_latitude-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Latitude</label>
                            <input type="text" id="bureau_latitude-${count}" name="bureau_latitude[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                        </div>
                        <div>
                            <label for="bureau_longitude-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Longitude</label>
                            <input type="text" id="bureau_longitude-${count}" name="bureau_longitude[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                        </div>
                    </div>
                    <label for="bureau_image_url-${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
                    <input type="text" id="bureau_image_url-${count}" name="bureau_image_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500">
                
                </div>  
            `;
            container.appendChild(div);
            attachBureauPreview(div.querySelector('input[type="file"]'));
        }

         function removeBureau(button) {
            const bureauDiv = button.closest('[data-bureau]');
            if (bureauDiv) {
                bureauDiv.remove();
            }
        }

        

        function attachBureauPreview(input) {
            input.addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewDiv = input.closest('[data-bureau]').querySelector('.bureau_preview .text-center');
                    previewDiv.innerHTML = `
                        <img src="${e.target.result}" alt="Aperçu image" class="max-h-40 object-contain mb-2">
                        <input type="file" name="bureau_image[]" class="hidden" id="bureau_image-${input.id}">
                        <label for="bureau_image-${input.id}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                    `;
                    // Réattacher l'écouteur sur le nouvel input généré
                    attachBureauPreview(previewDiv.querySelector('input[type="file"]'));
                };
                reader.readAsDataURL(file);
            });
        }

        
        // Fonction de sauvegarde
        function saveAll() {
            const formData = new FormData(); 
            const val = (id) => document.getElementById(id)?.value ?? '';

            
            tinymce.triggerSave(); // Assurez-vous que les éditeurs TinyMCE mettent à jour les textarea



            formData.append(' page_key', '{{ $page_key }}' ?? 'implantation');


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
            const sectionPremiereImageInput = document.getElementById('section_premiere_image');
            if (sectionPremiereImageInput?.files[0]) formData.append('section_premiere_image', sectionPremiereImageInput.files[0]);


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

            // aboutSection
            formData.append('about_title', val('about_title'));
            formData.append('about_subtitle', val('about_subtitle'));
            formData.append('about_description', val('about_description'));
            formData.append('about_cta_label', val('about_cta_label'));
            formData.append('about_cta_url', val('about_cta_url'));
            formData.append('about_image_url', val('about_image_url'));
            formData.append('about_page_key', '{{ $page_key }}');
            formData.append('about_section_key', 'about');
            const aboutImageInput = document.getElementById('about_image');
            if (aboutImageInput?.files[0]) formData.append('about_image', aboutImageInput.files[0]);

            // bureaux
            document.querySelectorAll('#bureaux-container [data-bureau]').forEach((bureau, index) => {
                const idInput = bureau.querySelector('input[name="id[]"]');
                if (idInput) formData.append(`bureaux[${index}][id]`, idInput.value);
                formData.append(`bureaux[${index}][pays]`, bureau.querySelector('input[name="libelle_bureau_pays[]"]')?.value ?? '');
                formData.append(`bureaux[${index}][code_pays]`, bureau.querySelector('input[name="bureau_code_pays[]"]')?.value ?? '');
                formData.append(`bureaux[${index}][representant]`, bureau.querySelector('input[name="bureau_representant[]"]')?.value ?? '');
                formData.append(`bureaux[${index}][adresse]`, bureau.querySelector('textarea[name="bureau_adresse[]"]')?.value ?? '');
                formData.append(`bureaux[${index}][telephone]`, bureau.querySelector('input[name="bureau_telephone[]"]')?.value ?? '');
                formData.append(`bureaux[${index}][email]`, bureau.querySelector('input[name="bureau_email[]"]')?.value ?? '');
                formData.append(`bureaux[${index}][ville]`, bureau.querySelector('input[name="bureau_ville[]"]')?.value ?? '');
                formData.append(`bureaux[${index}][latitude]`, bureau.querySelector('input[name="bureau_latitude[]"]')?.value ?? '');
                formData.append(`bureaux[${index}][longitude]`, bureau.querySelector('input[name="bureau_longitude[]"]')?.value ?? '');
                formData.append(`bureaux[${index}][image_url]`, bureau.querySelector('input[name="bureau_image_url[]"]')?.value ?? '');
                const imageInput = bureau.querySelector('input[type="file"][name="bureau_image[]"]');
                if (imageInput?.files[0]) formData.append(`bureaux[${index}][image]`, imageInput.files[0]);
                formData.append(`bureaux[${index}][page_key]`, '{{ $page_key }}');
                formData.append(`bureaux[${index}][section_key]`, 'bureaux');
                formData.append(`bureaux[${index}][type_bureau]`, bureau.querySelector('input[name="bureau_type[]"]')?.value ?? '');
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
             fetch('{{ route("admin.implantation.save") }}', {
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


                        window.location.reload();
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
