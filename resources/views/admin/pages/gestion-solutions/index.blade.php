@extends('admin.layout.appLayout')

@section('content')

    <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
        <div class="flex items-center gap-4">
            <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Solutions</h2>
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
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-bold text-sonec-dark">Liste des Solutions</h3>

                <div class="flex items-center gap-4">
                    <button onclick="openSolutionModule()" class="bg-sonec-dark hover:bg-sonec-green text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                        <i class="fas fa-grip-lines"></i> Configurer la page solutions
                    </button>

                    <button onclick="addSolution()" class="bg-sonec-green hover:bg-sonec-dark text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                        <i class="fas fa-plus"></i> Ajouter une solution
                    </button>
                </div>

            </div>
            <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50">
                            {{-- <th></th> --}}
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Image</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Description</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Slug</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Contact</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Disponibilité</th>
                            {{-- <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Icon/Image</th> --}}
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Mise en avant</th>
                            {{-- <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Affiché</th>                             --}}
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($solutions as $solution)
                            {{-- possibilite de drag and drop pour changer la position des elements --}}
                            <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors cursor-move" data-id="{{ $solution->id }}">
                                <input type="hidden" class="solution-id" value="{{ $solution->id }}">
                                <td class="px-6 py-4">
                                    <img src="{{ $solution->image ? asset('storage/' . $solution->image) : $solution->image_url }}" alt="{{ $solution->title }}" class="w-16 h-16 object-cover rounded-md">
                                    
                                </td>
                                <td class="px-6 py-4">{{ $solution->title }}</td>
                                <td class="px-6 py-4">{{ $solution->subtitle }}</td>
                                <td class="px-6 py-4">{{ $solution->slug }}</td>
                                <td class="px-6 py-4">{{ $solution->contact_email ?? '' }} <br> {{$solution->contact_phone ?? ''}}</td>
                                {{-- <td class="px-6 py-4">{{ $solution->resume }}</td> --}}
                                <td class="px-6 py-4">
                                    {{-- Disponibilité est un json qu'on doit extraire --}}
                                    @if($solution->disponibilite)
                                        @php
                                            $disponibilite = json_decode($solution->disponibilite, true);
                                        @endphp
                                        <ul class="list-disc list-inside text-sm">
                                            @foreach($disponibilite as $item)
                                                <li>{{ $item }}</li>
                                            @endforeach
                                        </ul>
                                    @endif

                                </td>
                                
                                
                                <td class="px-6 py-4">
                                    {{-- Si oui fond vert sinon fond rouge --}}
                                    <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none {{ $solution->mis_avant == 1 ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }}" >
                                        {{ $solution->mis_avant == 1 ? 'Oui' : 'Non' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    <a href="{{ route('solutions.edit',['solution' => $solution->id]) }}" class="bg-transparent text-blue-500 px-3 py-1 text-sm transition-all flex items-center gap-1">
                                        <i class="fas fa-pencil"></i>
                                    </a>
                                    <button class="bg-transparent text-red-500 px-3 py-1 text-sm transition-all flex items-center gap-1" onclick="deleteSolution({{ $solution->id }})" data-id="{{ $solution->id }}" data-label="{{ $solution->title }}" data-toggle="tooltip" data-title="Supprimer {{ $solution->title }}">
                                        <i class="fas fa-trash"></i> 
                                    </button>
                                </td>
                            </tr>

                            <div id="delete-solution-modal-{{ $solution->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 " >
                                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative " >
                                    
                                    <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="closeDeleteSolutionModal({{ $solution->id }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <h2 class="text-xl font-bold text-sonec-dark mb-4">Confirmer la suppression</h2>
                                    
                                    <p class="mb-6 text-slate-700">Êtes-vous sûr de vouloir supprimer la solution <span class="font-bold">{{ $solution->title }}</span> ? Cette action est irréversible.</p>

                                    <div class="flex justify-end gap-4">
                                        <button onclick="closeDeleteSolutionModal({{ $solution->id }})" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md font-bold text-sm transition-all">
                                            Annuler
                                        </button>
                                        <button onclick="deleteSolution({{ $solution->id }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2">
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

    <script>
       
        function addSolution() {
            window.location.href = "{{ route('solutions.create') }}";
        }

        function editSolution(id) {
            window.location.href = "{{ route('solutions.edit', "+id+") }}/" ;
        }

        function toggleDeleteSolutionModal(id) {            
            const modal = document.getElementById('delete-solution-modal-' + id);
            modal.classList.remove('opacity-0');
            modal.classList.remove('pointer-events-none');
        }

        function closeDeleteSolutionModal(id) {
            const modal = document.getElementById('delete-solution-modal-' + id);
            modal.classList.add('opacity-0');
            modal.classList.add('pointer-events-none');
        }

        function deleteSolution(id) {
            // if (confirm("Êtes-vous sûr de vouloir supprimer cette solution ?")) {
            //     window.location.href = "{{ route('solutions.destroy', "+id+") }}/" ;
            // }
            toggleDeleteSolutionModal(id);

            const confirmBtn = document.querySelector(`#delete-solution-modal-${id} button.bg-red-500`);
            confirmBtn.addEventListener('click', function() {
                fetch(`/admin/solutions/${id}`, {
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
                        successDescription.textContent = data.description || 'La solution a été supprimée avec succès.';

                        showToast();
                        setTimeout(() => {
                            closeDeleteSolutionModal(id);
                            toggleDeleteSolutionModal(id);
                        }, 1200);
                        window.location.reload();
                    } else {
                        const errorMessage = document.querySelector('#toastError .error-message');
                        const errorDescription = document.querySelector('#toastError .error-description');
                        errorMessage.textContent = data.message || 'Erreur lors de la suppression de la solution';
                        errorDescription.textContent = data.error || '. Veuillez réessayer.';
                        showToastError();

                        closeDeleteSolutionModal(id);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    const errorMessage = document.querySelector('#toastError .error-message');
                    const errorDescription = document.querySelector('#toastError .error-description');
                    errorMessage.textContent = 'Erreur lors de la suppression de la solution';
                    errorDescription.textContent = 'Une erreur est survenue lors de la suppression de la solution. Veuillez réessayer.';
                    showToastError();
                });
            });
        }
        
        function openSolutionModule() {
            window.location.href = "{{ route('admin.solution-page.config') }}";
        }

    </script>
@endsection