@extends('admin.layout.appLayout')

@section('content')
    <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
        <div class="flex items-center gap-4">
            <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Gestion des utilisateurs</h2>
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
                <h3 class="font-bold text-sonec-dark">Utilisateurs</h3>
                <button onclick="addUser()" class="bg-sonec-green hover:bg-sonec-dark text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                    <i class="fas fa-plus"></i> Ajouter un utilisateur
                </button>

            </div>
            <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Rôle</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                <input type="hidden" class="user-id" value="{{ $user->id }}">
                                
                                <td class="px-6 py-4">{{ $user->name }}</td>
                                <td class="px-6 py-4">{{ $user->email }}</td>
                                <td class="px-6 py-4">{{ ucfirst($user->role) }}</td>
                                
                                
                                <td class="px-6 py-4 flex gap-2">
                                    <button class="bg-transparent text-blue-500 px-3 py-1 text-sm transition-all flex items-center gap-1" onclick="editUserModal({{ $user->id }})">
                                        <i class="fas fa-pencil"></i>
                                    </button>

                                    {{-- @if(auth()->user()->id !== $user->id && auth()->user()->role !== 'admin') Ne pas afficher le bouton de suppression pour l'utilisateur connecté --}}
                                    <button class="bg-transparent text-red-500 px-3 py-1 text-sm transition-all flex items-center gap-1" onclick="openDeleteUserModal({{ $user->id }})" data-id="{{ $user->id }}" data-label="{{ $user->name }}" data-toggle="tooltip" data-title="Supprimer {{ $user->name }}">
                                        <i class="fas fa-trash"></i> 
                                    </button>
                                    {{-- @endif --}}

                                </td>
                            </tr>

                            <div id="edit-user-modal-{{ $user->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 ">
                                <div class=" bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative overflow-y-auto max-h-[70vh]" >
                                    
                                    <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="closeEditUserModal({{ $user->id }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <h2 class="text-xl font-bold text-sonec-dark mb-4">Modifier un utilisateur</h2>
                                    
                                    
                                    <div id="form-errors" class="bg-red-100 text-red-500 mb-4 hidden"></div>

                                    <form id="edit-user-form-{{ $user->id }}" data-user-id="{{ $user->id }}" class="space-y-4 overflow-y-auto custom-scrollbar max-h-[70vh]" enctype="multipart/form-data">
                                        
                                        <div class="mb-2">
                                            <label for="name-{{ $user->id }}" class="block text-sm font-medium text-slate-700">Nom et prénom <span class="text-red-400">*</span>  </label>
                                            <input type="text" id="name-{{ $user->id }}" name="name" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $user->name }}">
                                        </div>
                                        <div class="mb-2">
                                            <label for="email-{{ $user->id }}" class="block text-sm font-medium text-slate-700">Email <span class="text-red-400">*</span></label>
                                            <input type="email" id="email-{{ $user->id }}" name="email" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $user->email }}">
                                            {{-- <label for="user_email" class="block text-sm font-medium text-slate-700">Email</label> --}}
                                        </div>
                                        <div>
                                            <label for="role-{{ $user->id }}" class="block text-sm font-medium text-slate-700">Position</label>
                                            <select id="role-{{ $user->id }}" name="role" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                                <option {{ $user->role == 'admin' ? 'selected' : '' }} value="admin">Administrateur</option>
                                                <option {{ $user->role == 'editeur' ? 'selected' : '' }} value="editeur">Éditeur</option>
                                                <option {{ $user->role == 'utilisateur' ? 'selected' : '' }} value="utilisateur">Utilisateur</option>
                                            </select>
                                        </div>

                                        {{-- mettre en gras ou pas --}}
                                        <div class="mb-2">
                                            <label for="password-{{ $user->id }}" class="block text-sm font-medium text-slate-700">Mot de passe</label>
                                            <input type="password" id="password-{{ $user->id }}" name="password" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none"  >
                                            {{-- <label for="user_email" class="block text-sm font-medium text-slate-700">Email</label> --}}
                                        </div>

                                        {{-- mettre en italique ou pas --}}
                                        <div class="mb-2">
                                            <label for="confirmPassword-{{ $user->id }}" class="block text-sm font-medium text-slate-700">Confirmer le mot de passe</label>
                                            <input type="password" id="confirmPassword-{{ $user->id }}" name="confirmPassword" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" >
                                        </div>
                                        {{-- texte d'infos pour signifier que pour ne pas modifier le mot de passe, laisser les champs vides --}}
                                        <div class="bg-blue-100 text-blue-500 p-3 rounded mb-4 flex items-center gap-2">
                                            <i class="fas fa-info-circle"></i>
                                            <small >
                                                Laissez les champs vides si vous ne souhaitez pas modifier le mot de passe.
                                            </small>
                                        </div>
                                        {{-- <p class="text-sm text-slate-500">Laissez les champs vides si vous ne souhaitez pas modifier le mot de passe.</p> --}}

                                        <!-- Autres champs comme icon, image, position, etc. -->
                                        <button type="submit" class="w-full bg-sonec-green hover:bg-sonec-dark text-white py-2 px-4 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                                            <i class="fas fa-save"></i> Enregistrer
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <div id="delete-user-modal-{{ $user->id ?? '' }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 ">
                                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative " >
                                    
                                    <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="closeDeleteUserModal({{ $user->id ?? '' }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <h2 class="text-xl font-bold text-sonec-dark mb-4">Confirmer la suppression</h2>
                                    
                                    <p class="mb-6 text-slate-700">Êtes-vous sûr de vouloir supprimer l'utilisateur <span class="font-bold">{{ $user->name ?? '' }}</span> ? Cette action est irréversible.</p>

                                    <div class="flex justify-end gap-4">
                                        <button onclick="closeDeleteUserModal({{ $user->id ?? '' }})" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md font-bold text-sm transition-all">
                                            Annuler
                                        </button>
                                        <button onclick="deleteUser({{ $user->id ?? '' }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </div>
                                </div>
                            </div>


                        @endforeach
                    </tbody>
                </table>
            </div>           
            
        </div>
        
    </div>

    {{-- Formulaire en modal pour enregistrer un utilisateur --}}
    <div id="user-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 ">
        <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative " >
            
            <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="toggleUserModal()">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="text-xl font-bold text-sonec-dark mb-4">Ajouter un utilisateur</h2>
            
            {{-- Afficher les messages d'erreur --}}
            <div id="form-errors-create" class="bg-red-100 text-red-500 mb-4 hidden"></div>

            <form id="user-form" class="space-y-4 overflow-y-auto custom-scrollbar max-h-[70vh]" enctype="multipart/form-data">
                
                <div class="mb-2">
                    <label for="name" class="block text-sm font-medium text-slate-700">Nom et prénom <span class="text-red-400">*</span>  </label>
                    <input type="text" id="name" name="name" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" >
                </div>
                <div class="mb-2">
                    <label for="email" class="block text-sm font-medium text-slate-700">Email <span class="text-red-400">*</span></label>
                    <input type="email" id="email" name="email" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" >
                    {{-- <label for="user_email" class="block text-sm font-medium text-slate-700">Email</label> --}}
                </div>
                <div>
                    <label for="role" class="block text-sm font-medium text-slate-700">Rôle <span class="text-red-400">*</span> </label>
                    <select id="role" name="role" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                        <option value="admin">Administrateur</option>
                        <option  value="editeur">Éditeur</option>
                        <option  value="utilisateur">Utilisateur</option>
                    </select>
                </div>

                {{-- mettre en gras ou pas --}}
                <div class="mb-2">
                    <label for="password" class="block text-sm font-medium text-slate-700">Mot de passe <span class="text-red-400">*</span></label>
                    
                    <div class="relative">
                        <input type="password" id="password" name="password" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" >

                        {{-- Icone oeil caché/affiché --}}
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer" onclick="togglePasswordVisibility('password')">
                            <i class="fas fa-eye" id="togglePassword"></i>
                            <i class="fas fa-eye-slash hidden" id="togglePasswordSlash"></i>
                        </div>
                    </div>

                </div>

                {{-- mettre en italique ou pas --}}
                <div class="mb-2">
                    <label for="confirmPassword" class="block text-sm font-medium text-slate-700">Confirmer le mot de passe <span class="text-red-400">*</span></label>
                    
                    <div class="relative">
                        <input 
                            type="password" 
                            id="confirmPassword" 
                            name="confirmPassword" 
                            class="w-full p-3 pr-10 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none"
                        >
                        {{-- Icone oeil caché/affiché --}}
                        <div class="absolute right-3 top-1/2 -translate-y-1/2 cursor-pointer" onclick="togglePasswordVisibility('confirmPassword')">
                            <i class="fas fa-eye" id="toggleConfirmPassword"></i>
                            <i class="fas fa-eye-slash hidden" id="toggleConfirmPasswordSlash"></i>
                        </div>
                    </div>
                </div>
                

                <!-- Autres champs comme icon, image, position, etc. -->
                <button type="submit" class="w-full bg-sonec-green hover:bg-sonec-dark text-white py-2 px-4 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                    <i class="fas fa-save"></i> Enregistrer
                </button>
            </form>
        </div>
    </div>

    <script>
        function toggleUserModal() {
            const modal = document.getElementById('user-modal');
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
        }

        function addUser() {
            toggleUserModal();
        }

        // Afficher/cacher le mlot de passe
        function togglePasswordVisibility(fieldId) {
            const passwordField = document.getElementById(fieldId);
            const toggleIcon = document.getElementById('toggle' + fieldId.charAt(0).toUpperCase() + fieldId.slice(1));
            const toggleIconSlash = document.getElementById('toggle' + fieldId.charAt(0).toUpperCase() + fieldId.slice(1) + 'Slash');

            if (passwordField.type === 'password') {
                passwordField.type = 'text';
                toggleIcon.classList.add('hidden');
                toggleIconSlash.classList.remove('hidden');
            } else {
                passwordField.type = 'password';
                toggleIcon.classList.remove('hidden');
                toggleIconSlash.classList.add('hidden');
            }
        }

         // Enregistrer le formulaire
        document.getElementById('user-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);


            formData.set('name', document.getElementById('name').value.trim());
            formData.set('email', document.getElementById('email').value.trim());
            formData.set('password', document.getElementById('password').value.trim());
            formData.set('role', document.getElementById('role').value.trim());
            formData.set('confirmPassword', document.getElementById('confirmPassword').value.trim());

            // Verifier que les champs de mot de passe correspondent
            if (formData.get('password') !== formData.get('confirmPassword')) {
                const errorsDiv = document.getElementById('form-errors-create');
                errorsDiv.innerHTML = '<p>Les mots de passe ne correspondent pas.</p>';
                errorsDiv.classList.remove('hidden');

                const errorMessage = document.querySelector('#toastError .error-message');
                const errorDescription = document.querySelector('#toastError .error-description');
                errorMessage.textContent = 'Les mots de passe ne correspondent pas';
                errorDescription.textContent = 'Veuillez vérifier que les mots de passe saisis sont identiques.';
                showToastError();
                return;
            }


            const btn = this.querySelector('button[type="submit"]');
            const originalContent = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';
            btn.disabled = true;


            fetch("{{ route('users.store') }}", {
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
                    toggleUserModal();
                    showToast();
                    setTimeout(() => {
                        btn.innerHTML = originalContent;
                        btn.disabled = false;
                        btn.classList.remove('opacity-75', 'cursor-not-allowed');
                    }, 1200);

                    successMessage.textContent = data.message || 'Enregistrement effectué !';
                    successDescription.textContent = data.description || 'L\'utilisateur a été enregistré avec succès.';

                    statusBadge.classList.add('hidden');
                    window.location.reload();

                } else {
                    showToastError();
                    btn.innerHTML = originalContent;
                    btn.disabled = false;
                    btn.classList.remove('opacity-75', 'cursor-not-allowed');

                    // Afficher les erreurs de validation
                    const errorsDiv = document.getElementById('form-errors-create');
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
                errorMessage.textContent = 'Erreur lors de l\'enregistrement de l\'utilisateur';
                errorDescription.textContent = 'Une erreur est survenue lors de l\'enregistrement de l\'utilisateur. Veuillez réessayer.';

                showToastError();
            });
        });

        
        function editUserModal(userId) {            
            // Fermer tous les modals ouverts d'abord
            document.querySelectorAll('[id^="edit-user-modal-"]').forEach(modal => {
                modal.classList.add('opacity-0');
                modal.classList.add('pointer-events-none');
            });

            const modal = document.getElementById('edit-user-modal-' + userId);
            modal.classList.remove('opacity-0');
            modal.classList.remove('pointer-events-none');
        }
        function closeEditUserModal(userId) {
            const modal = document.getElementById('edit-user-modal-' + userId);
            modal.classList.add('opacity-0');
            modal.classList.add('pointer-events-none');
        }

         // Modification
        document.querySelectorAll('[id^="edit-user-form-"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const userId = this.getAttribute('data-user-id');
                const formData = new FormData(this);
                
                // formData.set('name', document.getElementById('name').value.trim());
                // formData.set('email', document.getElementById('email').value.trim());
                // formData.set('password', document.getElementById('password').value.trim());
                // formData.set('confirmPassword', document.getElementById('confirmPassword').value.trim());


                const btn = document.querySelector(`#edit-user-modal-${userId} button[type="submit"]`);
                const originalContent = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement en cours...';
                btn.disabled = true;

                formData.append('_method', 'PUT');

                // console.log("Données envoyées :", Array.from(formData.entries()));

                fetch(`/admin/users/${userId}`, {
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
                        successDescription.textContent = data.description || 'L\'utilisateur a été modifié avec succès.';

                        showToast();
                        setTimeout(() => {
                            btn.innerHTML = originalContent;
                            btn.disabled = false;
                            btn.classList.remove('opacity-75', 'cursor-not-allowed');
                        }, 1200);
                        closeEditUserModal(userId);
                        // window.location.reload();
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
                    errorMessage.textContent = 'Erreur lors de la modification de l\'utilisateur';
                    errorDescription.textContent = 'Une erreur est survenue lors de la modification de l\'utilisateur. Veuillez réessayer.';
                    showToastError();
                });
            });
        });

        function openDeleteUserModal(userId) {
            const modal = document.getElementById('delete-user-modal-' + userId);
            modal.classList.remove('opacity-0');
            modal.classList.remove('pointer-events-none');
        }

        function closeDeleteUserModal(userId) {
            const modal = document.getElementById('delete-user-modal-' + userId);
            modal.classList.add('opacity-0');
            modal.classList.add('pointer-events-none');
        }

        function deleteUser(userId) {
            // Afficher le modal de confirmation de suppression
            // toggleDeleteUserModal();

            // Ajouter un écouteur d'événement au bouton de confirmation de suppression
            const confirmBtn = document.querySelector(`#delete-user-modal-${userId} button.bg-red-500`);
            confirmBtn.addEventListener('click', function() {
                fetch(`/admin/users/${userId}`, {
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
                            closeDeleteUserModal(userId);
                            window.location.reload();
                        }, 1200);
                    } else {
                        const errorMessage = document.querySelector('#toastError .error-message');
                        const errorDescription = document.querySelector('#toastError .error-description');
                        errorMessage.textContent = data.message || 'Erreur lors de la suppression de l\'utilisateur';
                        errorDescription.textContent = data.error || '. Veuillez réessayer.';
                        showToastError();

                        closeDeleteUserModal(userId);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    const errorMessage = document.querySelector('#toastError .error-message');
                    const errorDescription = document.querySelector('#toastError .error-description');
                    errorMessage.textContent = 'Erreur lors de la suppression de l\'utilisateur';
                    errorDescription.textContent = 'Une erreur est survenue lors de la suppression de l\'utilisateur. Veuillez réessayer.';
                    showToastError();
                });
            });
        }



       

    </script>

@endsection