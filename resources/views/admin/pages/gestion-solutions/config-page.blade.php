@extends('admin.layout.appLayout')

@section('content')
    <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
        <div class="flex items-center gap-4">
            <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Page Solutions</h2>
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
                {{-- <button onclick="showTab('collaboration')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Collaborations & témoignages</button> --}}
                <button onclick="showTab('seo')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">SEO & Méta</button>
            </div>

            <div class="space-y-8">
           

                {{-- Affichage des erreurs serveurs --}}
                <div id="form-errors" class="bg-red-100 text-red-700 p-4 rounded mb-6 hidden"></div>


                <div id="tab-content" class="tab-content p-8 rounded-3xl shadow-sm border border-slate-100">
                    <div id="tab-content-home-content" class="tab-pane active">
                        @include('admin.pages.gestion-solutions.partials.config-page-content')
                    </div>
                    <div id="tab-content-home-media" class="tab-pane hidden">
                        
                        @include('admin.pages.gestion-solutions.partials.config-page-media') 
                    </div>
                    {{-- <div id="tab-content-home-collaboration" class="tab-pane hidden">
                        @include('admin.pages.gestion-solutions.partials.config-page-collaboration')
                    </div> --}}
                    <div id="tab-content-home-seo" class="tab-pane hidden">
                        @include('admin.pages.gestion-solutions.partials.config-page-seo')
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

        function addAvantageItem() {
            const container = document.getElementById('avantages-container');
            const count = Date.now();


            const div = document.createElement('div');
            div.setAttribute('data-avantage-item', '');
            div.className = 'bg-white p-8 rounded-3xl shadow-sm border border-slate-100 relative overflow-hidden';
            div.innerHTML = `
                <div class="absolute top-0 left-0 w-2 h-full bg-purple-500"></div>
                    <button type="button" onclick="removeAvantageItem(this)" class="absolute top-4 right-4 bg-red-500 text-white p-2 rounded-full hover:bg-red-600 transition-colors">
                        <i class="fas fa-trash text-xs"></i>
                    </button>
                    <h3 class="text-lg font-bold text-sonec-dark mb-6 flex items-center gap-2">
                        <i class="fas fa-star text-purple-500"></i> Avantage ${count}
                    </h3>
                    <input type="hidden" id="avantage_item_section_key-${count}" name="avantage_item_section_key[]" value="avantage_item">
                    <label for="avantage_item_title${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Titre</label>
                    <input type="text" name="avantage_item_title[]" id="avantage_item_title${count}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-sonec-dark focus:ring-2 focus:ring-green-500 outline-none" 
                        placeholder="Libellé de l'avantage">

                    <label for="avantage_item_icon_${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1">Icône (classe FontAwesome)</label>
                    <input type="text" name="avantage_item_icon[]" id="avantage_item_icon_${count}"
                            class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm font-mono text-blue-500" 
                            placeholder="fas fa-cog"> 
                    
                    
                    <label for="avantage_item_description_${count}" class="block text-xs font-bold text-slate-400 uppercase mb-1 mt-4">Description</label>
                    <textarea name="avantage_item_description[]" id="avantage_item_description_${count}"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl text-sm focus:ring-2 focus:ring-green-500 outline-none" 
                        rows="4" placeholder="Description de l'avantage"></textarea>
                </div>

            `;
            container.appendChild(div);
        }


        function removeAvantageItem(button) {
            const avantageDiv = button.closest('[data-avantage-item]');
            if (avantageDiv) {
                avantageDiv.remove();
            }
        }

        function saveAll() {
            const formData = new FormData(); 
            const val = (id) => document.getElementById(id)?.value ?? '';
            
            tinymce.triggerSave();
            formData.append(' page_key', '{{ $page_key }}' ?? 'solutions');
            
            formData.append('accroche_title', val('accroche_title'));
            formData.append('accroche_subtitle', val('accroche_subtitle'));
            formData.append('accroche_description', val('accroche_description'));
            formData.append('accroche_cta_label', val('accroche_cta_label'));
            formData.append('accroche_cta_url', val('accroche_cta_url'));
            formData.append('accroche_page_key', '{{ $page_key }}');
            formData.append('accroche_section_key', 'accroche');
            formData.append('accroche_id', document.querySelector('input[name="accroche_id"]')?.value ?? '');


            // banniere
            formData.append('banniere_title', val('banniere_title'));
            formData.append('banniere_subtitle', val('banniere_subtitle'));
            formData.append('banniere_description', val('banniere_description'));
            formData.append('banniere_cta_label', val('banniere_cta_label'));
            formData.append('banniere_cta_url', val('banniere_cta_url'));
            formData.append('banniere_image_url', val('banniere_image_url'));
            formData.append('banniere_page_key', '{{ $page_key }}');
            formData.append('banniere_section_key', 'banniere');
            formData.append('banniere_id', document.querySelector('input[name="banniere_id"]')?.value ?? '');

            const banniereImageInput = document.getElementById('banniere_image');
            if (banniereImageInput?.files[0]) formData.append('banniere_image', banniereImageInput.files[0]);


            // avantages items
            document.querySelectorAll('#avantages-container [data-avantage-item]').forEach((avantageItem, index) => {
                const idInput = avantageItem.querySelector('input[name="id[]"]');
                // if (idInput) formData.append(`avantages[${index}][id]`, idInput.value);
                if (idInput && idInput.value.trim() !== '') {
                    formData.append(`avantages[${index}][id]`, idInput.value);
                }

                formData.append(`avantages[${index}][icon]`, avantageItem.querySelector('input[name="avantage_item_icon[]"]')?.value ?? '');
                formData.append(`avantages[${index}][title]`, avantageItem.querySelector('input[name="avantage_item_title[]"]')?.value ?? '');
                formData.append(`avantages[${index}][description]`, avantageItem.querySelector('textarea[name="avantage_item_description[]"]')?.value ?? '');
                formData.append(`avantages[${index}][section_key]`, avantageItem.querySelector('input[name="avantage_item_section_key[]"]')?.value ?? 'avantages');
            });

            // seo
            formData.append('seo_title', val('seo_title'));
            formData.append('seo_description', val('seo_description'));
            formData.append('seo_keywords', val('seo_keywords'));
            formData.append('seo_page_key', '{{ $page_key }}');
            formData.append('seo_id', document.querySelector('input[name="seo_id"]')?.value ?? '');

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
             fetch('{{ route("admin.solution-page.config.save") }}', {
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