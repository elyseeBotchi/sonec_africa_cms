@extends('admin.layout.appLayout')

@section('content')
    <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
        <div class="flex items-center gap-4">
            <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Gestion du Menu</h2>
            <span id="status-badge" class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-md border border-green-200 hidden">Modifications en cours ...</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="#" class="text-sm font-semibold text-slate-500 hover:text-sonec-green flex items-center gap-2">
                <i class="fas fa-external-link-alt"></i> Voir le site
            </a>
        </div>
    </header>
     <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-bold text-sonec-dark">Éléments du Menu</h3>
                <button onclick="addMenuItem()" class="bg-sonec-green hover:bg-sonec-dark text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                    <i class="fas fa-plus"></i> Ajouter un élément
                </button>

            </div>
            <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Menu concerné</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Espacement</th>               
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Alignement</th>               
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Sous menus en gras/italique</th>               
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Couleur de fond de l'icône</th>               
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($espacementMenus as $espacementMenu)
                            {{-- possibilite de drag and drop pour changer la position des elements --}}
                            <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors cursor-move" data-id="{{ $espacementMenu->id }}">
                                <input type="hidden" class="espacement-menu-id" value="{{ $espacementMenu->id }}">
                                
                                <td class="px-6 py-4">{{ $espacementMenu->menu->label }}</td>
                                <td class="px-6 py-4">gap-{{ $espacementMenu->espacement }} ({{ $espacementMenu->espacement * 4 }}px)</td>
                                <td class="px-6 py-4">{{ ucfirst($espacementMenu->alignement) }}</td>
                                <td class="px-6 py-4">
                                    @if($espacementMenu->gras && $espacementMenu->italique)
                                        Gras et Italique
                                    @elseif($espacementMenu->gras)
                                        Gras
                                    @elseif($espacementMenu->italique)
                                        Italique
                                    @else
                                        Aucun
                                    @endif
                                </td>
                                <td class="px-6 py-4">
                                    {{ $espacementMenu->couleur_fond_icon ? 'Oui' : 'Non' }}
                                </td>
                                
                                <td class="px-6 py-4 flex gap-2">
                                    <button class="bg-transparent text-blue-500 px-3 py-1 text-sm transition-all flex items-center gap-1" onclick="editEspacementMenuItem({{ $espacementMenu->id }})">
                                        <i class="fas fa-pencil"></i>
                                    </button>
                                    <button class="bg-transparent text-red-500 px-3 py-1 text-sm transition-all flex items-center gap-1" onclick="deleteMenuItem({{ $espacementMenu->id }})" data-id="{{ $espacementMenu->id }}" data-label="{{ $espacementMenu->label }}" data-toggle="tooltip" data-title="Supprimer {{ $espacementMenu->label }}">
                                        <i class="fas fa-trash"></i> 
                                    </button>
                                </td>
                            </tr>

                            <div id="edit-espacement-modal-{{ $espacementMenu->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 ">
                                <div class=" bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative overflow-y-auto max-h-[70vh]" >
                                    
                                    <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="closeEditEspacementMenuModal({{ $espacementMenu->id }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <h2 class="text-xl font-bold text-sonec-dark mb-4">Modifier un élément de menu</h2>
                                    
                                    
                                    <div id="form-errors" class="bg-red-100 text-red-500 mb-4 hidden"></div>

                                    <form id="edit-espacement-form-{{ $espacementMenu->id }}" data-espacement-id="{{ $espacementMenu->id }}" class="space-y-4 overflow-y-auto custom-scrollbar max-h-[70vh]" enctype="multipart/form-data">
                
                                        <div>
                                            <label for="espacement-{{ $espacementMenu->id }}" class="block text-sm font-medium text-slate-700">Position</label>
                                            <select id="espacement-{{ $espacementMenu->id }}" name="espacement" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                                <option {{ $espacementMenu->espacement == 0 ? 'selected' : '' }} value="0">gap-0 (aucun)</option>
                                                <option {{ $espacementMenu->espacement == 1 ? 'selected' : '' }} value="1">gap-1 (4px)</option>
                                                <option {{ $espacementMenu->espacement == 2 ? 'selected' : '' }} value="2">gap-2 (8px)</option>
                                                <option {{ $espacementMenu->espacement == 3 ? 'selected' : '' }} value="3">gap-3 (12px)</option>
                                                <option {{ $espacementMenu->espacement == 4 ? 'selected' : '' }} value="4">gap-4 (16px)</option>
                                                <option {{ $espacementMenu->espacement == 5 ? 'selected' : '' }} value="5">gap-5 (20px)</option>
                                                <option {{ $espacementMenu->espacement == 6 ? 'selected' : '' }} value="6">gap-6 (24px)</option>
                                                <option {{ $espacementMenu->espacement == 7 ? 'selected' : '' }} value="7">gap-7 (28px)</option>
                                                <option {{ $espacementMenu->espacement == 8 ? 'selected' : '' }} value="8">gap-8 (32px)</option>
                                                <option {{ $espacementMenu->espacement == 9 ? 'selected' : '' }} value="9">gap-9 (36px)</option>
                                                <option {{ $espacementMenu->espacement == 10 ? 'selected' : '' }} value="10">gap-10 (40px)</option>
                                            </select>
                                            {{-- <input type="text" id="type" name="type" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none"> --}}
                                        </div>
                                        {{-- menu parent --}}
                                        <div>
                                            <label for="menu_id-{{ $espacementMenu->id }}" class="block text-sm font-medium text-slate-700">Menu Parent</label>
                                            <select id="menu_id-{{ $espacementMenu->id }}" name="menu_id" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                                <option value="">Sélectionner un menu</option>
                                                @foreach($menusWithoutEspacement as $item)
                                                    <option {{ $item->id == $espacementMenu->menu_id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        
                                        <div class="bg-blue-100 text-blue-500 p-3 rounded mb-4 flex items-center gap-2">
                                            <i class="fas fa-info-circle"></i>
                                            <small >
                                                L'espacement correspond à la distance entre les sous-menus d'un même menu parent. Plus la valeur est élevée, plus l'espacement est grand. (ex: 0 = pas d'espacement, 10 = espacement maximum)
                                            </small>
                                        </div>
                                        {{-- mettre en gras ou pas --}}
                                        <div class="flex items-center gap-2 mb-2">
                                            <input type="checkbox" id="gras" name="gras" class="form-checkbox h-5 w-5 text-sonec-green focus:ring-sonec-green" {{ $espacementMenu->gras ? 'checked' : '' }}>
                                            <label for="gras" class="block text-sm font-medium text-slate-700">Gras</label>
                                        </div>

                                        {{-- mettre en italique ou pas --}}
                                        <div class="flex items-center gap-2 mb-2">
                                            <input type="checkbox" id="italique" name="italique" class="form-checkbox h-5 w-5 text-sonec-green focus:ring-sonec-green" {{ $espacementMenu->italique ? 'checked' : '' }}>
                                            <label for="italique" class="block text-sm font-medium text-slate-700">Italique</label>
                                        </div>

                                        {{-- alignement --}}
                                        <div class="flex items-center gap-2 mb-4">
                                            <label for="alignement-{{ $espacementMenu->id }}" class="block text-sm font-medium text-slate-700">Alignement</label>
                                            <select id="alignement-{{ $espacementMenu->id }}" name="alignement" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                                <option {{ $espacementMenu->alignement == 'horizontal' ? 'selected' : '' }} value="horizontal">Horizontal</option>
                                                <option {{ $espacementMenu->alignement == 'vertical' ? 'selected' : '' }} value="vertical">Vertical</option>
                                            </select>   
                                        </div>

                                        {{-- mettre en couleur de fond pour l'icône ou pas --}}
                                        <div class="flex items-center gap-2 mb-2">
                                            <input type="checkbox" id="couleur_fond_icon" name="couleur_fond_icon" class="form-checkbox h-5 w-5 text-sonec-green focus:ring-sonec-green" {{ $espacementMenu->couleur_fond_icon ? 'checked' : '' }}>
                                            <label for="couleur_fond_icon" class="block text-sm font-medium text-slate-700">Couleur de fond pour l'icône</label>
                                        </div>

                                        <!-- Autres champs comme icon, image, position, etc. -->
                                        <button type="submit" class="w-full bg-sonec-green hover:bg-sonec-dark text-white py-2 px-4 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                                            <i class="fas fa-save"></i> Enregistrer
                                        </button>
                                    </form>
                                </div>
                            </div>


                        @endforeach
                    </tbody>
                </table>
            </div>           
            
        </div>
        
    </div>

    {{-- Formulaire en modal pour enregistrer un élémént --}}
    <div id="espacement-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 ">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative " >
            
            <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="toggleMenuModal()">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-xl font-bold text-sonec-dark mb-4">Ajouter un élément de menu</h2>
            
            {{-- Afficher les messages d'erreur --}}
            <div id="form-errors" class="bg-red-100 text-red-500 mb-4 hidden"></div>

            <form id="espacement-form" class="space-y-4 overflow-y-auto custom-scrollbar max-h-[70vh]" enctype="multipart/form-data">
                
                <div>
                    <label for="espacement" class="block text-sm font-medium text-slate-700">Position</label>
                    <select id="espacement" name="espacement" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                        <option value="0">gap-0 (aucun)</option>
                        <option value="1">gap-1 (4px)</option>
                        <option value="2">gap-2 (8px)</option>
                        <option value="3">gap-3 (12px)</option>
                        <option value="4">gap-4 (16px)</option>
                        <option value="5">gap-5 (20px)</option>
                        <option value="6">gap-6 (24px)</option>
                        <option value="7">gap-7 (28px)</option>
                        <option value="8">gap-8 (32px)</option>
                        <option value="9">gap-9 (36px)</option>
                        <option value="10">gap-10 (40px)</option>
                    </select>
                    {{-- <input type="text" id="type" name="type" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none"> --}}
                </div>
                {{-- menu parent --}}
                <div>
                    <label for="menu_id" class="block text-sm font-medium text-slate-700">Menu Parent</label>
                    <select id="menu_id" name="menu_id" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                        <option value="">Sélectionner un menu</option>
                        @foreach($menusWithoutEspacement as $item)
                            <option value="{{ $item->id }}">{{ $item->label }}</option>
                        @endforeach
                    </select>
                </div>

                {{--  --}}
                
                <div class="bg-blue-100 text-blue-500 p-3 rounded mb-4 flex items-center gap-2">
                    <i class="fas fa-info-circle"></i>
                    <small >
                        L'espacement correspond à la distance entre les sous-menus d'un même menu parent. Plus la valeur est élevée, plus l'espacement est grand. (ex: 0 = pas d'espacement, 10 = espacement maximum)
                    </small>
                </div>

                {{-- mettre en gras ou pas --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="gras" name="gras" class="form-checkbox h-5 w-5 text-sonec-green focus:ring-sonec-green">
                    <label for="gras" class="block text-sm font-medium text-slate-700">Gras</label>
                </div>

                {{-- mettre en italique ou pas --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="italique" name="italique" class="form-checkbox h-5 w-5 text-sonec-green focus:ring-sonec-green">
                    <label for="italique" class="block text-sm font-medium text-slate-700">Italique</label> 
                </div>

                {{-- alignement --}}
                <div>
                    <label for="alignement" class="block text-sm font-medium text-slate-700">Alignement</label>
                    <select id="alignement" name="alignement" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                        <option value="horizontal">Horizontal</option>
                        <option value="vertical">Vertical</option>
                    </select>
                </div>
                
                {{-- couleur de fond des icônes ou pas --}}
                <div class="flex items-center gap-2">
                    <input type="checkbox" id="couleur_fond_icon" name="couleur_fond_icon" class="form-checkbox h-5 w-5 text-sonec-green focus:ring-sonec-green">
                    <label for="couleur_fond_icon" class="block text-sm font-medium text-slate-700">Couleur de fond des icônes</label>  
                </div>

                <!-- Autres champs comme icon, image, position, etc. -->
                <button type="submit" class="w-full bg-sonec-green hover:bg-sonec-dark text-white py-2 px-4 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </form>
        </div>
    </div>

    <script>
        function toggleMenuModal() {
            const modal = document.getElementById('espacement-modal');
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
        }

        function addMenuItem() {
            toggleMenuModal();
        }

         // Enregistrer le formulaire
        document.getElementById('espacement-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);


            formData.set('gras', document.getElementById('gras').checked ? 1 : 0);
            formData.set('italique', document.getElementById('italique').checked ? 1 : 0);
            formData.set('couleur_fond_icon', document.getElementById('couleur_fond_icon').checked ? 1 : 0);

            const btn = this.querySelector('button[type="submit"]');
            const originalContent = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';
            btn.disabled = true;


            fetch("{{ route('espacement-menus.store') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}",
                    'Accept': 'application/json'
                },
                body: formData,
            })
            .then(response => response.json())
            .then(data => {

                // console.log(data);
                const statusBadge = document.getElementById('status-badge');
                statusBadge.classList.remove('hidden');

                const successMessage = document.querySelector('#toast .success-message');
                const successDescription = document.querySelector('#toast .success-description');

                if (data.success===true) {
                    toggleMenuModal();
                    showToast();
                    setTimeout(() => {
                        btn.innerHTML = originalContent;
                        btn.disabled = false;
                        btn.classList.remove('opacity-75', 'cursor-not-allowed');
                    }, 1200);

                    successMessage.textContent = data.message || 'Enregistrement effectué !';
                    successDescription.textContent = data.description || 'L\'espacement enregistré avec succès.';

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
                console.error('Error:', error);
                const errorMessage = document.querySelector('#toastError .error-message');
                const errorDescription = document.querySelector('#toastError .error-description');
                errorMessage.textContent = 'Erreur lors de l\'enregistrement de l\'espacement';
                errorDescription.textContent = 'Une erreur est survenue lors de l\'enregistrement de l\'espacement. Veuillez réessayer.';

                showToastError();
            });
        });

        function toggleEditEspacementMenuModal() {
            // Recuperer l'id du menu à modifier à partir du dataset de la ligne cliquée
            const espacementId = event.target.closest('tr').getAttribute('data-id');
            const modal = document.getElementById('edit-espacement-modal-' + espacementId);
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
        }

        function editEspacementMenuItem(espacementMenuId) {            
            // Fermer tous les modals ouverts d'abord
            document.querySelectorAll('[id^="edit-espacement-modal-"]').forEach(modal => {
                modal.classList.add('opacity-0');
                modal.classList.add('pointer-events-none');
            });

            const modal = document.getElementById('edit-espacement-modal-' + espacementMenuId);
            modal.classList.remove('opacity-0');
            modal.classList.remove('pointer-events-none');
        }



        function closeEditEspacementMenuModal(espacementMenuId) {
            const modal = document.getElementById('edit-espacement-modal-' + espacementMenuId);
            modal.classList.add('opacity-0');
            modal.classList.add('pointer-events-none');
        }

        function toggleDeleteEspacementMenuModal() {
            // Recuperer l'id du menu à supprimer à partir du dataset de la ligne cliquée
            const espacementId = event.target.closest('tr').getAttribute('data-id');
            const modal = document.getElementById('delete-espacement-modal-' + espacementId);
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
        }

        function closeDeleteEspacementMenuModal(espacementId) {
            const modal = document.getElementById('delete-espacement-modal-' + espacementId);
            modal.classList.add('opacity-0');
            modal.classList.add('pointer-events-none');
        }

        function deleteEspacementMenuItem(espacementId) {
            // Afficher le modal de confirmation de suppression
            toggleDeleteEspacementMenuModal();

            // Ajouter un écouteur d'événement au bouton de confirmation de suppression
            const confirmBtn = document.querySelector(`#delete-espacement-modal-${espacementId} button.bg-red-500`);
            confirmBtn.addEventListener('click', function() {
                fetch(`/admin/espacement-menus/${espacementId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}",
                        'Accept': 'application/json'
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success===true) {
                        showToast();
                        setTimeout(() => {
                            toogleDeleteMenuModal();
                            window.location.reload();
                        }, 1200);
                    } else {
                        const errorMessage = document.querySelector('#toastError .error-message');
                        const errorDescription = document.querySelector('#toastError .error-description');
                        errorMessage.textContent = data.message || 'Erreur lors de la suppression du menu';
                        errorDescription.textContent = data.error || '. Veuillez réessayer.';
                        showToastError();

                        closeDeleteMenuModal(menuId);
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



        // Modification
        document.querySelectorAll('[id^="edit-espacement-form-"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const espacementId = this.getAttribute('data-espacement-id');
                const formData = new FormData(this);
                formData.set('gras', document.getElementById('gras').checked ? 1 : 0);
                formData.set('italique', document.getElementById('italique').checked ? 1 : 0);
                formData.set('couleur_fond_icon', document.getElementById('couleur_fond_icon').checked ? 1 : 0);


                const btn = document.querySelector(`#edit-espacement-modal-${espacementId} button[type="submit"]`);
                const originalContent = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement en cours...';
                btn.disabled = true;

                formData.append('_method', 'PUT');

                // console.log("Données envoyées :", Array.from(formData.entries()));

                fetch(`/admin/espacement-menus/${espacementId}`, {
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
                        successMessage.textContent = data.message || 'Enregistrement effectué !';
                        successDescription.textContent = data.description || 'L\'espacement de menu a été modifié avec succès.';

                        showToast();
                        setTimeout(() => {
                            btn.innerHTML = originalContent;
                            btn.disabled = false;
                            btn.classList.remove('opacity-75', 'cursor-not-allowed');
                        }, 1200);
                        closeEditEspacementMenuModal(espacementId);
                        window.location.reload();
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

    </script>

@endsection