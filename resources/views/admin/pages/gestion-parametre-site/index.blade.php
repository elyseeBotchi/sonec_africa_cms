@extends('admin.layout.appLayout')

@section('content')
     <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
        <div class="flex items-center gap-4">
            <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Paramètres du site</h2>
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
        <div class="flex gap-1 bg-slate-200 p-1 rounded-xl mb-8 w-fit">
                <button onclick="showTab('general')" class="px-6 py-2 rounded-lg bg-white shadow-sm text-sm font-bold text-sonec-dark">Infos générales</button>
                <button onclick="showTab('media')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Images & Médias</button>
                <button onclick="showTab('seo')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">SEO & Méta</button>
            </div>
        {{-- Contenu des tabs --}}
        <div id="tab-content" class="tab-content">
            <div id="tab-general" class="tab-pane">
                @include('admin.pages.gestion-parametre-site.partials.general')
            </div>
            <div id="tab-media" class="tab-pane hidden">
                @include('admin.pages.gestion-parametre-site.partials.media')
            </div>
            <div id="tab-seo" class="tab-pane hidden">
                @include('admin.pages.gestion-parametre-site.partials.seo')
            </div>
        </div>
    </div>


    <script>
    function showTab(tab) {
        // Cacher tous les contenus de tab
        document.querySelectorAll('.tab-pane').forEach(pane => pane.classList.add('hidden'));
        // Afficher le contenu de la tab sélectionnée
        document.getElementById(`tab-${tab}`).classList.remove('hidden');
            // Mettre à jour le style des boutons. le bouton actif aura un fond blanc et une ombre, les autres seront gris
        document.querySelectorAll('.tab-content button').forEach(button => {
            if (button.textContent.trim() === (tab === 'general' ? 'Infos générales' : tab === 'media' ? 'Images & Médias' : 'SEO & Méta')) {
                button.classList.add('bg-white', 'shadow-sm', 'text-sonec-dark');
                button.classList.remove('text-slate-500');
            } else {
                button.classList.remove('bg-white', 'shadow-sm', 'text-sonec-dark');
                button.classList.add('text-slate-500');
            }
        });
        
    }

    // Gerer le telechargement des images et afficher un aperçu avant de les enregistrer
    document.getElementById('site_logo').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Afficher l'aperçu de l'image
                // const preview = document.querySelector('#preview-area-logo').parentElement.querySelector('i');
                const preview = document.querySelector('.preview-area-logo');
                const icon = preview.querySelector('i');
                if (icon) {
                    icon.remove(); // Supprimer l'icône d'image
                }
                preview.style.backgroundImage = `url(${e.target.result})`;
                preview.style.backgroundSize = 'cover';
                preview.style.backgroundPosition = 'center';
                icon.textContent = ''; // Supprimer l'icône
            }
            reader.readAsDataURL(file);
        }
    });

     document.getElementById('logo_footer').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Afficher l'aperçu de l'image
                // const preview = document.querySelector('#preview-area-logo').parentElement.querySelector('i');
                const preview = document.querySelector('.preview-area-logo-footer');
                const icon = preview.querySelector('i');
                if (icon) {
                    icon.remove(); // Supprimer l'icône d'image
                }
                preview.style.backgroundImage = `url(${e.target.result})`;
                preview.style.backgroundSize = 'cover';
                preview.style.backgroundPosition = 'center';
                icon.textContent = ''; // Supprimer l'icône
            }
            reader.readAsDataURL(file);
        }
    });

    document.getElementById('site_favicon').addEventListener('change', function(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                // Afficher l'aperçu de l'image
                // const preview = document.querySelector('#preview-area-logo').parentElement.querySelector('i');
                const preview = document.querySelector('.preview-area-favicon');
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

    function saveAll() {
        const btn = document.querySelector('button[onclick="saveAll()"]');
        const originalContent = btn.innerHTML;
        
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';
        btn.disabled = true;
        btn.classList.add('opacity-75', 'cursor-not-allowed');

        // Récuperer et enregistrer les données y compris les images de chaque section
        
        const formData = new FormData();
        formData.append('site_name', document.getElementById('site_name').value);
        formData.append('description', document.getElementById('description').value);
        formData.append('footer_text', document.getElementById('footer_text').value);
        formData.append('contact_email', document.getElementById('contact_email').value);
        formData.append('contact_phone', document.getElementById('contact_phone').value);
        formData.append('contact_address', document.getElementById('contact_address').value);
        formData.append('meta_title', document.getElementById('meta_title').value);
        formData.append('meta_keywords', document.getElementById('meta_keywords').value);
        formData.append('meta_description', document.getElementById('meta_description').value);
        formData.append('footer_text', document.getElementById('footer_text').value);
        const siteLogoInput = document.getElementById('site_logo');
        if (siteLogoInput.files[0]) {
            formData.append('site_logo', siteLogoInput.files[0]);
        }
        const siteFaviconInput = document.getElementById('site_favicon');
        if (siteFaviconInput.files[0]) {
            formData.append('site_favicon', siteFaviconInput.files[0]);
        }
        const logoFooterInput = document.getElementById('logo_footer');
        if (logoFooterInput.files[0]) {
            formData.append('logo_footer', logoFooterInput.files[0]);
        }
        // envoyer les données au serveur
        fetch("{{ route('general-settings.store') }}", {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            }, 
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            
            const statusBadge = document.getElementById('status-badge');
            statusBadge.classList.remove('hidden');

            const successMessage = document.querySelector('#toast .success-message');
            const successDescription = document.querySelector('#toast .success-description');

            if(data.success === true) {
                showToast();
                setTimeout(() => {
                        btn.innerHTML = originalContent;
                        btn.disabled = false;
                        btn.classList.remove('opacity-75', 'cursor-not-allowed');
                    }, 1200);
                successMessage.textContent = 'Paramètres mis à jour avec succès !';
                successDescription.textContent = 'Les modifications ont été enregistrées.';
                
                statusBadge.classList.add('hidden');
                window.location.reload();
            } else {
                showToastError();
                btn.innerHTML = originalContent;
                btn.disabled = false;
                btn.classList.remove('opacity-75', 'cursor-not-allowed');

                // Afficher les erreurs de validation
                const errorsDiv = document.getElementById('form-errors');
                errorsDiv.innerHTML = '';
                if (data.errors) {
                    Object.values(data.errors).forEach(error => {
                        const errorP = document.createElement('p');
                        errorP.textContent = error[0];
                        errorsDiv.appendChild(errorP);
                    });
                    errorsDiv.classList.remove('hidden');
                }

                statusBadge.classList.add('hidden');
            }
        })
        .catch(error => {
            const errorMessage = document.querySelector('#toastError .error-message');
            const errorDescription = document.querySelector('#toastError .error-description');
            errorMessage.textContent = 'Erreur lors de l\'enregistrement du menu';
            errorDescription.textContent = 'Une erreur est survenue lors de l\'enregistrement du menu. Veuillez réessayer.';

            showToastError();

            btn.innerHTML = originalContent;
            btn.disabled = false;
            btn.classList.remove('opacity-75', 'cursor-not-allowed');

        });

        
        
    }
</script>
   

@endsection

