@extends('admin.layout.appLayout')

@section('content')
    <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
        <div class="flex items-center gap-4">
            <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Page d'accueil</h2>
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
                <button onclick="showTab('seo')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">SEO & Méta</button>
            </div>

            <div class="space-y-8">
            <!-- Hero Section -->
            {{-- <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden">
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Hero Carousel (Slide 1)</h3>
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Titre Principal</label>
                        <input type="text" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="Innovation Technologique en Afrique">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Sous-titre</label>
                        <textarea class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500 outline-none" rows="2">Des solutions digitales qui transforment les entreprises et les institutions</textarea>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Texte Bouton</label>
                            <input type="text" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm" value="Découvrir nos solutions">
                        </div>
                        <div class="flex-1">
                            <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien Bouton</label>
                            <input type="text" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="#solutions">
                        </div>
                    </div>
                </div>
            </div> --}}

            {{-- Affichage des erreurs serveurs --}}
            <div id="form-errors" class="bg-red-100 text-red-700 p-4 rounded mb-6 hidden"></div>


            <div id="tab-content" class="tab-content p-8 rounded-3xl shadow-sm border border-slate-100">
                <div id="tab-content-home-content" class="tab-pane active">
                    @include('admin.pages.gestion-page-accueil.partials.content')
                </div>
                <div id="tab-content-home-media" class="tab-pane hidden">
                    
                    @include('admin.pages.gestion-page-accueil.partials.media') 
                </div>
                <div id="tab-content-home-seo" class="tab-pane hidden">
                    @include('admin.pages.gestion-page-accueil.partials.seo')
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
                // Mettre à jour le style des boutons. le bouton actif aura un fond blanc et une ombre, les autres seront gris
            document.querySelectorAll('.tab-content button').forEach(button => {
                if (button.textContent.trim() === (tab === 'content' ? 'Contenu' : tab === 'media' ? 'Images & Médias' : 'SEO & Méta')) {
                    button.classList.add('bg-white', 'shadow-sm', 'text-sonec-dark');
                    button.classList.remove('text-slate-500');
                } else {
                    button.classList.remove('bg-white', 'shadow-sm', 'text-sonec-dark');
                    button.classList.add('text-slate-500');
                }
            });            
        }

        // Previsualisation des images dans le formulaire
         document.addEventListener('change', function(e) {
            if (e.target && e.target.type === 'file' && e.target.name === 'image[]') {
                const fileInput = e.target;
                const file = fileInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(event) {
                        const previewContainer = fileInput.closest('.preview');
                        if (previewContainer) {
                            let img = previewContainer.querySelector('img');
                            if (!img) {
                                img = document.createElement('img');
                                img.className = 'max-h-40 object-contain mb-2';
                                previewContainer.insertBefore(img, previewContainer.firstChild);
                            }
                            img.src = event.target.result;
                        }
                    }
                    reader.readAsDataURL(file);
                }
            }
        });

        function addSlide() {
            const container = document.getElementById('carousel-container');
            const count = container.querySelectorAll('[data-slide]').length + 1;

            const div = document.createElement('div');
            div.setAttribute('data-slide', '');
            div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
            div.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                <button type="button" onclick="removeSlide(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash text-xs"></i>
                </button>
                <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                    <i class="fas fa-star text-purple-500"></i> Slide ${count}
                </h3>
                {{-- Pas d'input id hidden pour les nouveaux slides --}}
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Titre Principal</label>
                        <input type="text" name="title[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" placeholder="Titre du slide">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Sous-titre</label>
                        <textarea name="subtitle[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500 outline-none" rows="2" placeholder="Sous-titre"></textarea>
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Texte Bouton</label>
                            <input type="text" name="cta_text[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm" placeholder="En savoir plus">
                        </div>
                        <div class="flex-1">
                            <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien Bouton</label>
                            <input type="text" name="cta_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" placeholder="https://...">
                        </div>
                        <div class="flex-1">
                            <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
                            <input type="text" name="image_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" placeholder="https://...">
                        </div>
                    </div>
                </div>
                <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                    <div class="text-center">
                        <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                        <p class="text-xs text-slate-400">Aperçu image</p>
                        <input type="file" name="image[]" class="hidden" id="image-new-${Date.now()}">
                        <label class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                    </div>
                </div>
            `;
            container.appendChild(div);
        }


        // function addSlide() {
        //     const container = document.getElementById('carousel-container');
        //     const index = container.children.length;
        //     const newSlide = document.createElement('div');

        //     newSlide.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
        //     newSlide.innerHTML = `
        //         <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
        //         <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Slide ${index + 1}</h3>
        //         <div class="space-y-4">
        //             <div>
        //                 <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Titre Principal</label>
        //                 <input id="title-${index}" type="text" name="title[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="">
        //             </div>
        //             <div>
        //                 <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Sous-titre</label>
        //                 <textarea id="subtitle-${index}" name="subtitle[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500 outline-none" rows="2"></textarea>
        //             </div>
        //             <div class="flex gap-4">
        //                 <div class="flex-1">
        //                     <label for="cta-text-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Texte Bouton</label>
        //                     <input id="cta-text-${index}" type="text" name="cta_text[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm" value="">
        //                 </div>
        //                 <div class="flex-1">
        //                     <label for="cta-url-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien Bouton</label>
        //                     <input id="cta-url-${index}" type="text" name="cta_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="">
        //                 </div>
        //                 <div class="flex-1">
        //                     <label for="image-url-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
        //                     <input id="image-url-${index}" type="text" name="image_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="">   
        //                 </div>
        //             </div>
        //             <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
        //                 <div class="text-center">
        //                     <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
        //                     <p class="text-xs text-slate-400">Aperçu image</p>
        //                     <input id="image-${index}" type="file" name="image[]" class="hidden">
        //                     <label for="image-${index}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100">Ajouter une image</label>
        //                 </div>
        //             </div>
        //         </div>
        //     `;
        //     container.appendChild(newSlide);
        // }

        
        function addSlideService() {
            const grid = document.getElementById('services-grid');
            const index = Date.now();

            const div = document.createElement('div');
            div.setAttribute('data-service', '');
            div.className = 'bg-white border border-slate-200 rounded-xl p-4 relative';
            div.innerHTML = `
                <button type="button" onclick="removeService(this)" 
                    class="absolute top-5 right-3 text-red-500  p-1.5 rounded-full hover:text-red-600 transition-colors">
                    <i class="fa fa-trash text-xs"></i>
                </button>
                <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône (classe FontAwesome)</label>
                <input type="text" name="icon[]" 
                    class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-mono text-blue-500" 
                    placeholder="fas fa-cog">
                <label class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Titre</label>
                <input type="text" name="title[]" 
                    class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none"
                    placeholder="Titre du service">
                <label class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Description</label>
                <textarea name="description[]" 
                    class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none" 
                    rows="4" placeholder="Description du service"></textarea>
            `;
            grid.appendChild(div);
        }

        function removeService(btn) {
            btn.closest('[data-service]').remove();
        }

        // Supprimer un slide du carousel
        function removeSlide(btn) {
            btn.closest('[data-slide]').remove();
        }

        // Supprimer un service
        function removeService(index) {
            const container = document.getElementById('services-container');
            const service = container.children[index];
            if (service) {
                container.removeChild(service);
            }
        }

        // Preview d'image de la section a propos
        document.getElementById('about_image').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const previewContainer = document.querySelector('.preview-area-favicon');
                    let img = previewContainer.querySelector('img');
                    if (!img) {
                        img = document.createElement('img');
                        img.className = 'max-h-40 object-contain mb-2';
                        previewContainer.insertBefore(img, previewContainer.firstChild);
                    }
                    img.src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // Enregistrer toutes les modifications des différentes sections (contenu, médias, SEO)
        function saveAll() {
            const formData = new FormData();

            
            const val = (id) => document.getElementById(id)?.value ?? '';

            formData.append('accroche_title', val('accroche_title'));
            formData.append('accroche_subtitle', val('accroche_subtitle'));
            formData.append('accroche_description', val('accroche_description'));
            formData.append('accroche_cta_label', val('accroche_cta_label'));
            formData.append('accroche_cta_url', val('accroche_cta_url'));
            formData.append('accroche_page_key', 'accueil');

            document.querySelectorAll('#services-container [data-service]').forEach((service, index) => {
                const idInput = service.querySelector('input[name="id[]"]');
                if (idInput) formData.append(`services[${index}][id]`, idInput.value);
                formData.append(`services[${index}][icon]`, service.querySelector('input[name="icon[]"]')?.value ?? '');
                formData.append(`services[${index}][title]`, service.querySelector('input[name="title[]"]')?.value ?? '');
                formData.append(`services[${index}][description]`, service.querySelector('textarea[name="description[]"]')?.value ?? '');
            });

            document.querySelectorAll('#carousel-container [data-slide]').forEach((slide, index) => {
                const idInput = slide.querySelector('input[name="id[]"]');
                if (idInput?.value) formData.append(`carousels[${index}][id]`, idInput.value);
                formData.append(`carousels[${index}][title]`, slide.querySelector('input[name="title[]"]')?.value ?? '');
                formData.append(`carousels[${index}][subtitle]`, slide.querySelector('textarea[name="subtitle[]"]')?.value ?? '');
                formData.append(`carousels[${index}][cta_label]`, slide.querySelector('input[name="cta_text[]"]')?.value ?? '');
                formData.append(`carousels[${index}][cta_url]`, slide.querySelector('input[name="cta_url[]"]')?.value ?? '');
                formData.append(`carousels[${index}][image_url]`, slide.querySelector('input[name="image_url[]"]')?.value ?? '');
                const imageInput = slide.querySelector('input[name="image[]"]');
                if (imageInput?.files[0]) formData.append(`carousels[${index}][image]`, imageInput.files[0]);
            });


            formData.append('seo_title', val('seo_title'));
            formData.append('seo_description', val('seo_description'));
            formData.append('seo_keywords', val('seo_keywords'));
            formData.append('seo_page_key', 'accueil');

            formData.append('about_title', val('about_title'));
            formData.append('about_subtitle', val('about_subtitle'));
            formData.append('about_annees_experience', val('about_annees_experience'));
            formData.append('about_clients', val('about_clients'));
            formData.append('about_pays', val('about_pays'));
            formData.append('about_description', val('about_description'));
            formData.append('about_page_key', 'accueil');
            formData.append('about_cta_label', val('about_cta_label'));
            formData.append('about_cta_url', val('about_cta_url'));
            formData.append('about_image_url', val('about_image_url'));


            const aboutImageInput = document.getElementById('about_image');
            if (aboutImageInput?.files[0]) formData.append('about_image', aboutImageInput.files[0]);

            const btn = document.querySelector('button[onclick="saveAll()"]');
            const originalContent = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            console.log('FormData entries:');
            for (let pair of formData.entries()) {
                console.log(pair[0]+ ': ' + pair[1]);
            }

            formData.append('_method', 'POST'); // Si votre route attend une méthode POST

            fetch('{{ route("admin.accueil.save") }}', {
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
        //    function saveAll()
    //    {
    //         // Enregistrer les données des sections
    //         const formData = new FormData();
    //         // Récupérer les données du contenu
    //         formData.append('accroche_title', document.getElementById('accroche_title').value);
    //         formData.append('accroche_subtitle', document.getElementById('accroche_subtitle').value);
    //         formData.append('accroche_description', document.getElementById('accroche_description').value);
    //         formData.append('accroche_cta_label', document.getElementById('accroche_cta_label').value);
    //         formData.append('accroche_cta_url', document.getElementById('accroche_cta_url').value);
    //         formData.append('accroche_page_key', 'accueil');
    //             // Récupérer les données des services
    //         document.querySelectorAll('#services-container .border').forEach((service, index) => {
    //             // Si le service a un id, l'ajouter au formData pour la mise à jour, sinon c'est un nouveau service, on n'ajoute pas d'id
    //             const idInput = service.querySelector('input[name="id[]"]');
    //             if (idInput) {
    //                 formData.append(`services[${index}][id]`, idInput.value);
    //             }
    //             formData.append(`services[${index}][icon]`, service.querySelector(`input[name="icon[]"]`).value);
    //             formData.append(`services[${index}][title]`, service.querySelector(`input[name="title[]"]`).value);
    //             formData.append(`services[${index}][description]`, service.querySelector(`textarea[name="description[]"]`).value);
    //         });
    //             // Récupérer les données des slides du carousel
    //         document.querySelectorAll('#carousel-container .relative').forEach((slide, index) => {
    //             // Si le slide a un id, l'ajouter au formData pour la mise à jour, sinon c'est un nouveau slide, on n'ajoute pas d'id
    //             const idInput = slide.querySelector('input[name="id[]"]');
    //             if (idInput) {
    //                 formData.append(`carousels[${index}][id]`, idInput.value);
    //             }
    //             formData.append(`carousels[${index}][title]`, slide.querySelector(`input[name="title[]"]`).value);
    //             formData.append(`carousels[${index}][subtitle]`, slide.querySelector(`textarea[name="subtitle[]"]`).value);
    //             formData.append(`carousels[${index}][cta_label]`, slide.querySelector(`input[name="cta_text[]"]`).value);
    //             formData.append(`carousels[${index}][cta_url]`, slide.querySelector(`input[name="cta_url[]"]`).value);
    //             formData.append(`carousels[${index}][image_url]`, slide.querySelector(`input[name="image_url[]"]`).value);
    //             const imageInput = slide.querySelector(`input[name="image[]"]`);
    //             if (imageInput && imageInput.files[0]) {
    //                 formData.append(`carousels[${index}][image]`, imageInput.files[0]);
    //             }
    //         });
    //             // Récupérer les données SEO
    //         formData.append('seo_title', document.getElementById('seo_title').value);   
    //         formData.append('seo_description', document.getElementById('seo_description').value);
    //         formData.append('seo_keywords', document.getElementById('seo_keywords').value); 
    //         formData.append('seo_page_key', 'accueil');

    //         // Récuperer les données de la section à propos
    //              formData.append('about_title', document.getElementById('about_title').value);   
    //         formData.append('about_subtitle', document.getElementById('about_subtitle').value);
    //         formData.append('about_experience', document.getElementById('about_annees_experience').value);
    //         formData.append('about_clients', document.getElementById('about_clients').value); 
         //         formData.append('about_description', document.getElementById('about_description').value); 
    //         formData.append('about_page_key', 'accueil');
    //         formData.append('about_cta_label', document.getElementById('about_cta_label').value);
    //         formData.append('about_cta_url', document.getElementById('about_cta_url').value); 
    //         formData.append('about_image_url', document.getElementById('about_image_url').value);
    //         const aboutImageInput = document.getElementById('about_image');
    //         if (aboutImageInput && aboutImageInput.files[0]) {
    //             formData.append('about_image', aboutImageInput.files[0]);
    //         }


    //         console.log(...formData);

    //         // Envoyer les données au serveur via AJAX
    //         fetch('{{ route("admin.accueil.save") }}', {
    //             method: 'POST',
    //             headers: {
    //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //             },
    //             body: formData
    //         })
    //         .then(response => response.json())
    //         .then(data => {
    //             // Gérer la réponse du serveur
    //             console.log(data);

    //             const statusBadge = document.getElementById('status-badge');
    //             statusBadge.classList.remove('hidden');

    //             const successMessage = document.querySelector('#toast .success-message');
    //             const successDescription = document.querySelector('#toast .success-description');
                
    //             if(data.success === true) {
    //                 showToast();
    //                 setTimeout(() => {
    //                         btn.innerHTML = originalContent;
    //                         btn.disabled = false;
    //                         btn.classList.remove('opacity-75', 'cursor-not-allowed');
    //                     }, 1200);
    //                 successMessage.textContent = 'Paramètres mis à jour avec succès !';
    //                 successDescription.textContent = 'Les modifications ont été enregistrées.';
                    
    //                 statusBadge.classList.add('hidden');
    //                 window.location.reload();
    //             } else {
    //                 showToastError();
    //                 btn.innerHTML = originalContent;
    //                 btn.disabled = false;
    //                 btn.classList.remove('opacity-75', 'cursor-not-allowed');

    //                 // Afficher les erreurs de validation
    //                 const errorsDiv = document.getElementById('form-errors');
    //                 errorsDiv.innerHTML = '';
    //                 if (data.errors) {
    //                     Object.values(data.errors).forEach(error => {
    //                         const errorP = document.createElement('p');
    //                         errorP.textContent = error[0];
    //                         errorsDiv.appendChild(errorP);
    //                     });
    //                     errorsDiv.classList.remove('hidden');
    //                 }

    //                 statusBadge.classList.add('hidden');
    //             }
            
    //         })
    //         .catch(error => {
    //             // Gérer les erreurs
    //             console.error('Error:', error);

    //             const errorMessage = document.querySelector('#toastError .error-message');
    //             const errorDescription = document.querySelector('#toastError .error-description');
    //             errorMessage.textContent = 'Erreur lors de l\'enregistrement du menu';
    //             errorDescription.textContent = 'Une erreur est survenue lors de l\'enregistrement du menu. Veuillez réessayer.';

    //             showToastError();

    //             btn.innerHTML = originalContent;
    //             btn.disabled = false;
    //             btn.classList.remove('opacity-75', 'cursor-not-allowed');


    //         });

    //     }
    </script>       

@endsection