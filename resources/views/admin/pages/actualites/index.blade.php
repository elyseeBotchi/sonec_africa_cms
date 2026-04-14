@extends('admin.layout.appLayout')

@section('content')

    <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
        <div class="flex items-center gap-4">
            <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Actualités</h2>
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
                <button onclick="showTab('categories')" class="px-6 py-2 rounded-lg bg-white font-bold shadow-sm text-sm  text-sonec-dark">Catégories</button>
                <button onclick="showTab('tags')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Tags</button>
                <button onclick="showTab('articles')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">Articles</button>
                {{-- <button onclick="showTab('seo')" class="px-6 py-2 rounded-lg text-sm font-bold text-slate-500 hover:text-sonec-dark">SEO & Méta</button> --}}
            </div>
            <div class="space-y-8">        

               

                <div id="tab-content" class="tab-content p-8 rounded-3xl shadow-sm border border-slate-100">
                    <div id="tab-content-categories" class="tab-pane active">
                        @include('admin.pages.actualites.partials.categories')
                    </div>
                    <div id="tab-content-tags" class="tab-pane hidden">
                        @include('admin.pages.actualites.partials.tags')
                    </div>
                    <div id="tab-content-articles" class="tab-pane hidden">
                        @include('admin.pages.actualites.partials.articles')
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
        
        
        // Gestion des catégories

        function toggleCategorieModal() {
            const modal = document.getElementById('categorie-modal');
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
        }

        function addCategorieItem() {
            toggleCategorieModal();
        }

        function editCategorieItem(categorieId) {            
            // Fermer tous les modals ouverts d'abord
            document.querySelectorAll('[id^="edit-categorie-modal-"]').forEach(modal => {
                modal.classList.add('opacity-0');
                modal.classList.add('pointer-events-none');
            });

            const modal = document.getElementById('edit-categorie-modal-' + categorieId);
            modal.classList.remove('opacity-0');
            modal.classList.remove('pointer-events-none');
        }
        function closeEditCategorieModal(categorieId) {

            const modal = document.getElementById('edit-categorie-modal-' + categorieId);
            modal.classList.add('opacity-0');
            modal.classList.add('pointer-events-none');
        }

        function toggleDeleteCategorieModal() {            
            const categorieId = event.target.closest('tr').getAttribute('data-id');
            const modal = document.getElementById('delete-categorie-modal-' + categorieId);
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
        }

        function closeDeleteCategorieModal(categorieId) {
            const modal = document.getElementById('delete-categorie-modal-' + categorieId);
            modal.classList.add('opacity-0');
            modal.classList.add('pointer-events-none');
        }

        document.getElementById('label').addEventListener('input', function() {
            // Doire pourvoir gérer les accents et les caractères spéciaux comme "é" ou "ç" et les convertir en "e" et "c"
            const slug = this.value.toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '') 
                .replace(/[^a-z0-9]+/g, '-') 
                .replace(/^-+|-+$/g, '');
            document.getElementById('slug').value = 'categorie/'+slug;
        });

        document.querySelectorAll('[id^="label-"]').forEach(input => {
            input.addEventListener('input', function() {
                const id = this.id.split('-')[1];
                const editSlug = this.value.toLowerCase()
                    .normalize('NFD').replace(/[\u0300-\u036f]/g, '') 
                    .replace(/[^a-z0-9]+/g, '-') 
                    .replace(/^-+|-+$/g, '');
                // document.getElementById(`editSlug-${id}`).value = editSlug;
                // document.getElementById(`editUrl-${id}`).value = '/' + editSlug;

                document.getElementById(`slug-${id}`).value = 'categorie/'+editSlug;

            });
        });

        document.getElementById('categorie-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);
            formData.append('page_key','actualites');
           
            const btn = this.querySelector('button[type="submit"]');
            const originalContent = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';
            btn.disabled = true;

            console.log('FormData entries:');
            for (let pair of formData.entries()) {
                console.log(pair[0]+ ': ' + pair[1]);
            }

            fetch("{{ route('categorie-articles.store') }}", {
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

                if (data.success===true) {
                    toggleCategorieModal();
                    showToast();
                    setTimeout(() => {
                        btn.innerHTML = originalContent;
                        btn.disabled = false;
                        btn.classList.remove('opacity-75', 'cursor-not-allowed');
                        successMessage.textContent = data.message || 'Enregistrement effectué !';
                        successDescription.textContent = data.description || 'L\'espacement enregistré avec succès.';

                        statusBadge.classList.add('hidden');

                        // window.location.reload();
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
                errorMessage.textContent = 'Erreur lors de l\'enregistrement de la catégorie';
                errorDescription.textContent = 'Une erreur est survenue lors de l\'enregistrement de la catégorie. Veuillez réessayer.';

                showToastError();
            });
        });

        document.querySelectorAll('[id^="edit-categorie-form-"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const categorieId = this.getAttribute('data-categorie-id');
                const formData = new FormData(this);

                const btn = document.querySelector(`#edit-categorie-modal-${categorieId} button[type="submit"]`);
                const originalContent = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement en cours...';
                btn.disabled = true;
          
                formData.append('_method', 'PUT');

                console.log("Données envoyées :", Array.from(formData.entries()));

                fetch(`/admin/categorie-articles/${categorieId}`, {
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
                        successDescription.textContent = data.description || 'La catégorie a été enregistrée avec succès.';

                        showToast();
                        setTimeout(() => {
                            btn.innerHTML = originalContent;
                            btn.disabled = false;
                            btn.classList.remove('opacity-75', 'cursor-not-allowed');
                            closeEditCategorieModal(categorieId);
                            window.location.reload();
                        }, 1200);
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
                    errorMessage.textContent = 'Erreur lors de la modification du menu';
                    errorDescription.textContent = 'Une erreur est survenue lors de la modification du menu. Veuillez réessayer.';
                    showToastError();
                });
            });
        });
        function deleteCategorieItem(categorieId) {
            // Afficher le modal de confirmation de suppression
            toggleDeleteCategorieModal();

            // Ajouter un écouteur d'événement au bouton de confirmation de suppression
            const confirmBtn = document.querySelector(`#delete-categorie-modal-${categorieId} button.bg-red-500`);
            confirmBtn.addEventListener('click', function() {
                fetch(`/admin/categorie-articles/${categorieId}`, {
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
                        successDescription.textContent = data.description || 'La catégorie a été supprimée avec succès.';

                        showToast();
                        setTimeout(() => {
                            closeDeleteCategorieModal(categorieId);
                            toggleDeleteCategorieModal();
                        }, 1200);
                        window.location.reload();
                    } else {
                        const errorMessage = document.querySelector('#toastError .error-message');
                        const errorDescription = document.querySelector('#toastError .error-description');
                        errorMessage.textContent = data.message || 'Erreur lors de la suppression du menu';
                        errorDescription.textContent = data.error || '. Veuillez réessayer.';
                        showToastError();

                        closeDeleteCategorieModal(categorieId);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    const errorMessage = document.querySelector('#toastError .error-message');
                    const errorDescription = document.querySelector('#toastError .error-description');
                    errorMessage.textContent = 'Erreur lors de la suppression du menu';
                    errorDescription.textContent = 'Une erreur est survenue lors de la suppression du menu. Veuillez réessayer.';
                    showToastError();
                });
            });
        }


        // Gest




    </script>
@endsection