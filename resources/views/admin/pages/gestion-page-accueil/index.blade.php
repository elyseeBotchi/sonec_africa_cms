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
                <button onclick="showTab('collaboration')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Collaborations & témoignages</button>
                <button onclick="showTab('seo')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">SEO & Méta</button>
            </div>

            <div class="space-y-8">
           

                {{-- Affichage des erreurs serveurs --}}
                <div id="form-errors" class="bg-red-100 text-red-700 p-4 rounded mb-6 hidden"></div>


                <div id="tab-content" class="tab-content p-8 rounded-3xl shadow-sm border border-slate-100">
                    <div id="tab-content-home-content" class="tab-pane active">
                        @include('admin.pages.gestion-page-accueil.partials.content')
                    </div>
                    <div id="tab-content-home-media" class="tab-pane hidden">
                        
                        @include('admin.pages.gestion-page-accueil.partials.media') 
                    </div>
                    <div id="tab-content-home-collaboration" class="tab-pane hidden">
                        @include('admin.pages.gestion-page-accueil.partials.collaboration')
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
                
            document.querySelectorAll('.tab-content button').forEach(button => {
                if (button.textContent.trim() === (tab === 'content' ? 'Contenu' : tab === 'media' ? 'Images & Médias' : tab === 'collaboration' ? 'Collaborations & témoignages' :  'SEO & Méta')) {
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


        
        function addSlideService() {
            const grid = document.getElementById('services-grid');
            const index = grid.querySelectorAll('[data-service]').length + 1;

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

        // function addClientSection(){
        //     const container = document.getElementById('client-container');
        //     const index = container.querySelectorAll('[data-client]').length + 1;

        //     const div = document.createElement('div');
        //     div.setAttribute('data-client', '');
        //     div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
        //     div.innerHTML = `
        //         <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
        //         <button onclick="removeClientSection(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
        //             <i class="fas fa-trash text-xs"></i>
        //         </button>
        //         <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Client ${index + 1}</h3>
        //         <input type="hidden" name="client_page_key" value="accueil">
        //         <div class="space-y-4">
        //             <div>
        //                 <label for="client_name-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
        //                 <input type="text" id="client_name-${index}" name="client_name[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" placeholder="Nom du client">
        //             </div>
                
        //             <div class="flex gap-4">
                        
        //                 <div class="flex-1">
        //                     <label for="client_url-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien Bouton</label>
        //                     <input type="text" id="client_url-${index}" name="client_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" placeholder="https://...">
        //                 </div>
        //                  <div class="flex-1">
        //                         <label for="client_logo_url-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
        //                         <input type="text" id="client_logo_url-${index}" name="client_logo_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" >
        //                     </div>

        //                 </div>
        //             </div>
        //             <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
        //                 <div class="text-center">
        //                     <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
        //                     <p class="text-xs text-slate-400">Aperçu image</p>
        //                     <input type="file" name="client_logo[]" class="hidden" id="client_logo-${index}">
        //                     <label for="client_logo-${index}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
        //                 </div>
        //             </div>
        //         </div>
                    
        //             `;
        //     container.appendChild(div);
        // }
        // Attacher la prévisualisation sur un input file donné
        function attachClientLogoPreview(input) {
            input.addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewDiv = input.closest('[data-client]').querySelector('.preview .text-center');
                    previewDiv.innerHTML = `
                        <img src="${e.target.result}" alt="Aperçu logo" class="max-h-40 object-contain mb-2">
                        <input type="file" name="client_logo[]" class="hidden" id="client_logo-${input.id}">
                        <label for="client_logo-${input.id}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                    `;
                    // Réattacher l'écouteur sur le nouvel input généré
                    attachClientLogoPreview(previewDiv.querySelector('input[type="file"]'));
                };
                reader.readAsDataURL(file);
            });
        }

        // Attacher la previsualisation pour les inputs partenaire existants
        function attachPartenaireLogoPreview(input) {
            input.addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewDiv = input.closest('[data-partenaire]').querySelector('.preview .text-center');
                    previewDiv.innerHTML = `
                        <img src="${e.target.result}" alt="Aperçu logo" class="max-h-40 object-contain mb-2">
                        <input type="file" name="partenaire_logo[]" class="hidden" id="partenaire_logo-${input.id}">
                        <label for="partenaire_logo-${input.id}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                    `;
                    // Réattacher l'écouteur sur le nouvel input généré
                    attachPartenaireLogoPreview(previewDiv.querySelector('input[type="file"]'));
                };
                reader.readAsDataURL(file);
            });
        }

        // Attacher la previsualisation pour les inputs temoignages existants
        function attachTemoignageLogoPreview(input) {
            input.addEventListener('change', function () {
                const file = this.files[0];
                if (!file) return;

                const reader = new FileReader();
                reader.onload = function (e) {
                    const previewDiv = input.closest('[data-temoignage]').querySelector('.preview .text-center');
                    previewDiv.innerHTML = `
                        <img src="${e.target.result}" alt="Aperçu logo" class="max-h-40 object-contain mb-2">
                        <input type="file" name="temoignage_photo[]" class="hidden" id="temoignage_photo-${input.id}">
                        <label for="temoignage_photo-${input.id}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                    `;
                    // Réattacher l'écouteur sur le nouvel input généré
                    attachTemoignageLogoPreview(previewDiv.querySelector('input[type="file"]'));
                };
                reader.readAsDataURL(file);
            });
        }
       

        function addClientSection() {
            const container = document.getElementById('client-container');
            const grid = document.getElementById('clients-grid');
            const index = Date.now(); 

            const div = document.createElement('div');
            div.setAttribute('data-client', '');
            div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
            div.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                <button type="button" onclick="removeClientSection(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash text-xs"></i>
                </button>
                <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                    <i class="fas fa-star text-purple-500"></i> Nouveau client
                </h3>
                <input type="hidden" name="client_page_key" value="accueil">
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                        <input type="text" name="client_name[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" placeholder="Nom du client">
                    </div>
                    <div class="flex gap-4">
                        <div class="flex-1">
                            <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien</label>
                            <input type="text" name="client_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" placeholder="https://...">
                        </div>
                        <div class="flex-1">
                            <label class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
                            <input type="text" name="client_logo_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" placeholder="https://...">
                        </div>
                    </div>
                </div>
                <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                    <div class="text-center">
                        <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                        <p class="text-xs text-slate-400">Aperçu image</p>
                        <input type="file" name="client_logo[]" class="hidden" id="client_logo-${index}">
                        <label for="client_logo-${index}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                    </div>
                </div>
            `;

            grid.appendChild(div);

            attachClientLogoPreview(div.querySelector('input[name="client_logo[]"]'));
        }



        function addPartenaireSection(){
            const container = document.getElementById('partenaire-container');
            const index = Date.now();

            const grid = document.getElementById('partenaires-grid');
            

            const div = document.createElement('div');
            div.setAttribute('data-partenaire', '');
            div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
            div.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                <button onclick="removePartenaireSection(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash text-xs"></i>
                </button>
                <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Partenaire ${index + 1}</h3>
                <input type="hidden" name="partenaire_page_key" value="accueil">
                <div class="space-y-4">
                    <div>
                        <label for="partenaire_name-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                        <input type="text" id="partenaire_name-${index}" name="partenaire_name[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" placeholder="Nom du partenaire">
                    </div>
                
                    <div class="flex gap-4">
                        
                        <div class="flex-1">
                            <label for="partenaire_url-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Lien Bouton</label>
                            <input type="text" id="partenaire_url-${index}" name="partenaire_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" placeholder="https://...">
                        </div>
                         <div class="flex-1">
                                <label for="partenaire_logo_url-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de l'image</label>
                                <input type="text" id="partenaire_logo_url-${index}" name="partenaire_logo_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" >
                            </div>
                        </div>
                    </div>
                    <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                        <div class="text-center">
                            <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                            <p class="text-xs text-slate-400">Aperçu image</p>
                            <input type="file" name="partenaire_logo[]" class="hidden" id="partenaire_logo-${index}">
                            <label for="partenaire_logo-${index}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                        </div>
                    </div>
                </div>
                    
                    `;
            grid.appendChild(div);
            attachPartenaireLogoPreview(div.querySelector('input[name="partenaire_logo[]"]'));
        }

        function addTemoignageSection(){
            const container = document.getElementById('temoignage-container');
            const index = Date.now();

            const grid = document.getElementById('temoignages-grid');
            

            const div = document.createElement('div');
            div.setAttribute('data-temoignage', '');
            div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
            div.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                <button onclick="removeTemoignageSection(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                    <i class="fas fa-trash text-xs"></i>
                </button>
                <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2"><i class="fas fa-star text-purple-500"></i> Témoignage ${index + 1}</h3>
                <input type="hidden" name="temoignage_page_key" value="accueil">
                <div class="space-y-4">
                    <div>
                        <label for="temoignage_name-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Nom</label>
                        <input type="text" id="temoignage_name-${index}" name="temoignage_name[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-lg text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" placeholder="Nom de la personne">
                    </div>
                    <div class="flex-1">
                        <label for="temoignage_company-${index }}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Entreprise</label>
                        <input type="text" id="temoignage_company-${index}" name="temoignage_company[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $temoignage->company ?? '' }}">
                    </div>
                    <div class="flex-1">
                        <label for="temoignage_position-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Position/Fonction</label>
                        <input type="text" id="temoignage_position-${index}" name="temoignage_position[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" value="{{ $temoignage->position ?? '' }}">
                    </div>
                
                    <div>
                        <label for="temoignage_message-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Contenu du témoignage</label>
                        <textarea id="temoignage_message-${index}" name="temoignage_message[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-purple-500 outline-none" rows="4" placeholder="Contenu du témoignage"></textarea>
                    </div>

                </div>
                <div class="flex gap-4 mt-4">
                    <div class="flex-1">
                        <label for="temoignage_photo_url-${index}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url de la photo</label>
                        <input type="text" id="temoignage_photo_url-${index}" name="temoignage_photo_url[]" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono text-blue-500" placeholder="https://...">
                    </div>
                </div>
                <div class="preview bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed mt-6">
                    <div class="text-center">
                        <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                        <p class="text-xs text-slate-400">Aperçu image</p>
                        <input type="file" name="temoignage_photo[]" class="hidden" id="temoignage_photo-${index}">
                        <label for="temoignage_photo-${index}" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                    </div>
                </div>

                
            `;
            grid.appendChild(div);
            attachTemoignageLogoPreview(div.querySelector('input[name="temoignage_photo[]"]'));
        }

        // Supprimer un slide du carousel
        function removeSlide(btn) {
            btn.closest('[data-slide]').remove();
        }

        // Supprimer un témoignage
        function removeTemoignageSection(btn) {
            btn.closest('[data-temoignage]').remove();
        }

        function removeClientSection(btn) {
            btn.closest('[data-client]').remove();
        }

        function removePartenaireSection(btn) {
            btn.closest('[data-partenaire]').remove();
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

        
        document.addEventListener('DOMContentLoaded', function () {
            document.querySelectorAll('[data-client] input[name="client_logo[]"]').forEach(attachClientLogoPreview);
            document.querySelectorAll('[data-partenaire] input[name="partenaire_logo[]"]').forEach(attachPartenaireLogoPreview);
            document.querySelectorAll('[data-temoignage] input[name="temoignage_photo[]"]').forEach(attachTemoignageLogoPreview);
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


            document.querySelectorAll('#temoignage-container [data-temoignage]').forEach((temoignage, index) => {
                const idInput = temoignage.querySelector('input[name="id[]"]');
                if (idInput?.value) formData.append(`temoignages[${index}][id]`, idInput.value);
                formData.append(`temoignages[${index}][name]`, temoignage.querySelector('input[name="temoignage_name[]"]')?.value ?? '');
                formData.append(`temoignages[${index}][message]`, temoignage.querySelector('textarea[name="temoignage_message[]"]')?.value ?? '');
                formData.append(`temoignages[${index}][position]`, temoignage.querySelector('input[name="temoignage_position[]"]')?.value ?? '');
                formData.append(`temoignages[${index}][page_key]`, 'accueil');
                formData.append(`temoignages[${index}][photo_url]`, temoignage.querySelector('input[name="temoignage_photo_url[]"]')?.value ?? '');
                formData.append(`temoignages[${index}][company]`, temoignage.querySelector('input[name="temoignage_company[]"]')?.value ?? '');
                const photoInput = temoignage.querySelector('input[name="temoignage_photo[]"]');
                if (photoInput?.files[0]) formData.append(`temoignages[${index}][photo]`, photoInput.files[0]);
            });

            // Clients
            document.querySelectorAll('#client-container [data-client]').forEach((client, index) => {
                const idInput = client.querySelector('input[name="id[]"]');
                if (idInput?.value) formData.append(`clients[${index}][id]`, idInput.value);
                formData.append(`clients[${index}][name]`, client.querySelector('input[name="client_name[]"]')?.value ?? '');
                formData.append(`clients[${index}][url]`, client.querySelector('input[name="client_url[]"]')?.value ?? '');
                formData.append(`clients[${index}][page_key]`, 'accueil');
                formData.append(`clients[${index}][logo_url]`, client.querySelector('input[name="client_logo_url[]"]')?.value ?? '');
                const logoInput = client.querySelector('input[name="client_logo[]"]');
                if (logoInput?.files[0]) formData.append(`clients[${index}][logo]`, logoInput.files[0]);
            });

            // Partenaires
            document.querySelectorAll('#partenaire-container [data-partenaire]').forEach((partenaire, index) => {
                const idInput = partenaire.querySelector('input[name="id[]"]');
                if (idInput?.value) formData.append(`partenaires[${index}][id]`, idInput.value);
                formData.append(`partenaires[${index}][name]`, partenaire.querySelector('input[name="partenaire_name[]"]')?.value ?? '');
                formData.append(`partenaires[${index}][url]`, partenaire.querySelector('input[name="partenaire_url[]"]')?.value ?? '');
                formData.append(`partenaires[${index}][page_key]`, 'accueil');
                formData.append(`partenaires[${index}][logo_url]`, partenaire.querySelector('input[name="partenaire_logo_url[]"]')?.value ?? '');
                const logoInput = partenaire.querySelector('input[name="partenaire_logo[]"]');
                if (logoInput?.files[0]) formData.append(`partenaires[${index}][logo]`, logoInput.files[0]);
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

        
    
    </script>       

@endsection