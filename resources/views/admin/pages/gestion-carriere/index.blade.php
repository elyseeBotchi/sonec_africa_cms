@extends('admin.layout.appLayout')

@section('content')

    <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
        <div class="flex items-center gap-4">
            <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Carrière</h2>
            <span id="status-badge" class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-md border border-green-200 hidden">Modifications en cours</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('web.home') }}" target="_blank" class="text-sm font-semibold text-slate-500 hover:text-sonec-green flex items-center gap-2">
                <i class="fas fa-external-link-alt"></i> Voir le site
            </a>
            {{-- <button onclick="saveAll()" class="bg-sonec-dark hover:bg-sonec-green text-white px-5 py-2 rounded-lg font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                <i class="fas fa-save"></i> Enregistrer
            </button> --}}
        </div>
    </header>
    <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
        <div class=" max-w-5xl mx-auto">
            <div class="flex gap-1 bg-slate-200 p-1 rounded-xl mb-8 w-fit">
                <button onclick="showTab('offres_emploi')" class="px-6 py-2 rounded-lg bg-white font-bold shadow-sm text-sm  text-sonec-dark">Offres d'emploi</button>
                <button onclick="showTab('candidatures')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Candidatures</button>
                {{-- <button onclick="showTab('articles')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Articles</button> --}}
                <button onclick="showTab('seo')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">SEO & Méta</button>
            </div>
            <div class="space-y-8">        

               

                <div id="tab-content" class="tab-content p-8 rounded-3xl shadow-sm border border-slate-100">
                    <div id="tab-content-offres_emploi" class="tab-pane active">
                        @include('admin.pages.gestion-carriere.partials.offres_emploi')
                    </div>
                    <div id="tab-content-candidatures" class="tab-pane hidden">
                        @include('admin.pages.gestion-carriere.partials.candidatures')
                    </div>
                    <div id="tab-content-seo" class="tab-pane hidden">
                        @include('admin.pages.gestion-carriere.partials.seo')
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

        
        
        
        // // Gestion des offres d'emploi

        function toggleOffreEmploiModal() {
            const modal = document.getElementById('offre-emploi-modal');
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
        }

        function addOffreEmploi() {
            toggleOffreEmploiModal();
        }

        function editOffreEmploi(offreEmploiId) {            
            // Fermer tous les modals ouverts d'abord
            document.querySelectorAll('[id^="edit-offre-emploi-modal-"]').forEach(modal => {
                modal.classList.add('opacity-0');
                modal.classList.add('pointer-events-none');
            });

            const modal = document.getElementById('edit-offre-emploi-modal-' + offreEmploiId);
            modal.classList.remove('opacity-0');
            modal.classList.remove('pointer-events-none');
        }

        function closeEditOffreEmploiModal(offreEmploiId) {

            const modal = document.getElementById('edit-offre-emploi-modal-' + offreEmploiId);
            modal.classList.add('opacity-0');
            modal.classList.add('pointer-events-none');
        }

        function toggleDeleteOffreEmploiModal(offreEmploiId) {            
            // Fermer tous les modals ouverts d'abord
            document.querySelectorAll('[id^="edit-offre-emploi-modal-"]').forEach(modal => {
                modal.classList.add('opacity-0');
                modal.classList.add('pointer-events-none');
            });

            const modal = document.getElementById('delete-offre-emploi-modal-' + offreEmploiId);
            modal.classList.remove('opacity-0');
            modal.classList.remove('pointer-events-none');
        }

        function closeDeleteOffreEmploiModal(offreEmploiId) {
            const modal = document.getElementById('delete-offre-emploi-modal-' + offreEmploiId);
            modal.classList.add('opacity-0');
            modal.classList.add('pointer-events-none');
        }

        

        document.getElementById('offre-emploi-form').addEventListener('submit', function(e) {
            e.preventDefault();


            const formData = new FormData(this);

            tinymce.triggerSave();

            formData.append('page_key','carriere');

            // formData.append('content', tinymce.get('content').getContent());
            formData.append('description', tinymce.get('description').getContent());   

            // formData.append('missions', tinymce.get('missions').getContent());
            formData.append('missions', tinymce.get('missions').getContent());   

            // formData.append('avantages', tinymce.get('avantages').getContent());
            formData.append('avantages', tinymce.get('avantages').getContent()); 

            // formData.append('profil_recherche', tinymce.get('profil_recherche').getContent());
            formData.append('profil_recherche', tinymce.get('profil_recherche').getContent()); 
           

            
            const btn = this.querySelector('button[type="submit"]');
            const originalContent = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';
            btn.disabled = true;

            console.log('FormData entries:');
            for (let pair of formData.entries()) {
                console.log(pair[0]+ ': ' + pair[1]);
            }

            fetch("{{ route('offres-emploi.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json'
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {

                console.log(data);
                const statusBadge = document.getElementById('status-badge');
                statusBadge.classList.remove('hidden');

                const successMessage = document.querySelector('#toast .success-message');
                const successDescription = document.querySelector('#toast .success-description');
                successMessage.textContent = data.message || 'Enregistrement effectué !';
                successDescription.textContent = data.description || 'L\'offre d\'emploi enregistrée avec succès.';

                statusBadge.classList.add('hidden');
                if (data.success===true) {
                    toggleOffreEmploiModal();
                    showToast();
                    setTimeout(() => {
                        btn.innerHTML = originalContent;
                        btn.disabled = false;
                        btn.classList.remove('opacity-75', 'cursor-not-allowed');
                        

                        window.location.reload();
                    }, 1200);

                    

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
                console.error('Error:', error);
                const errorMessage = document.querySelector('#toastError .error-message');
                const errorDescription = document.querySelector('#toastError .error-description');
                errorMessage.textContent = 'Erreur lors de l\'enregistrement de l\'offre d\'emploi';
                errorDescription.textContent = 'Une erreur est survenue lors de l\'enregistrement de l\'offre d\'emploi. Veuillez réessayer.';

                showToastError();
            });
        });

        document.querySelectorAll('[id^="edit-offre-emploi-form-"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const offreEmploiId = this.getAttribute('data-offre-emploi-id');
                const formData = new FormData(this);

                const fields = ['description', 'missions', 'avantages', 'profil_recherche'];

                console.log('id de l\'offre d\'emploi :', offreEmploiId);

                const btn = document.querySelector(`#edit-offre-emploi-modal-${offreEmploiId} button[type="submit"]`);
                const originalContent = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement en cours...';
                btn.disabled = true;

                tinymce.triggerSave();

                formData.append('page_key','carriere');

                fields.forEach(field => {
                    const editor = tinymce.get(`${field}-${offreEmploiId}`);
                    if (editor) {
                        formData.set(field, editor.getContent()); 
                    }
                });

          
                formData.append('_method', 'PUT');

                console.log("Données envoyées :", Array.from(formData.entries()));

                fetch(`/admin/offres-emploi/${offreEmploiId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json'
                    },
                    body: formData,
                })
                .then(response => response.json())
                .then(data => {
                    const successMessage = document.querySelector('#toast .success-message');
                    const successDescription = document.querySelector('#toast .success-description');
                    
                    if (data.success===true) {
                        successMessage.textContent = data.message || 'Modification effectuée !';
                        successDescription.textContent = data.description || 'L\'offre d\'emploi a été enregistrée avec succès.';

                        showToast();
                        setTimeout(() => {
                            btn.innerHTML = originalContent;
                            btn.disabled = false;
                            btn.classList.remove('opacity-75', 'cursor-not-allowed');
                            closeEditOffreEmploiModal(offreEmploiId);
                            // window.location.reload();
                        }, 1200);

                        // console.log('Offre d\'emploi modifiée avec succès :', data);
                    } else {
                        showToastError();
                        btn.innerHTML = originalContent;
                        btn.disabled = false;
                        btn.classList.remove('opacity-75', 'cursor-not-allowed');

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
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    const errorMessage = document.querySelector('#toastError .error-message');
                    const errorDescription = document.querySelector('#toastError .error-description');
                    errorMessage.textContent = 'Erreur lors de la modification de l\'offre d\'emploi';
                    errorDescription.textContent = 'Une erreur est survenue lors de la modification de l\'offre d\'emploi. Veuillez réessayer.';
                    showToastError();
                });
            });
        });
        function deleteOffreEmploi(offreEmploiId) {
            // Afficher le modal de confirmation de suppression
            toggleDeleteOffreEmploiModal();

            // Ajouter un écouteur d'événement au bouton de confirmation de suppression
            const confirmBtn = document.querySelector(`#delete-offre-emploi-modal-${offreEmploiId} button.bg-red-500`);
            confirmBtn.addEventListener('click', function() {
                fetch(`/admin/offres-emploi/${offreEmploiId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success===true) {
                        const successMessage = document.querySelector('#toast .success-message');
                        const successDescription = document.querySelector('#toast .success-description');
                        successMessage.textContent = data.message || 'Suppression effectuée !';
                        successDescription.textContent = data.description || 'L\'offre d\'emploi a été supprimée avec succès.';

                        showToast();
                        setTimeout(() => {
                            closeDeleteOffreEmploiModal(offreEmploiId);
                            toggleDeleteOffreEmploiModal();
                        }, 1200);
                        window.location.reload();
                    } else {
                        const errorMessage = document.querySelector('#toastError .error-message');
                        const errorDescription = document.querySelector('#toastError .error-description');
                        errorMessage.textContent = data.message || 'Erreur lors de la suppression de l\'offre d\'emploi';
                        errorDescription.textContent = data.error || '. Veuillez réessayer.';
                        showToastError();

                        closeDeleteOffreEmploiModal(offreEmploiId);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    const errorMessage = document.querySelector('#toastError .error-message');
                    const errorDescription = document.querySelector('#toastError .error-description');
                    errorMessage.textContent = 'Erreur lors de la suppression de l\'offre d\'emploi';
                    errorDescription.textContent = 'Une erreur est survenue lors de la suppression de l\'offre d\'emploi. Veuillez réessayer.';
                    showToastError();
                });
            });
        }


        

    </script>
@endsection