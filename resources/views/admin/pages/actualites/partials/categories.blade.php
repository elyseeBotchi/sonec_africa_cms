 <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold text-sonec-dark">Catégories</h3>
            <button onclick="addCategorieItem()" class="bg-sonec-green hover:bg-sonec-dark text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                <i class="fas fa-plus"></i> Ajouter une catégorie
            </button>

        </div>
        <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Libellé</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Slug</th>               
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $categorie)
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors cursor-move" data-id="{{ $categorie->id }}">
                            <input type="hidden" class="categorie-id" value="{{ $categorie->id }}">
                            
                            <td class="px-6 py-4">{{ $categorie->label }}</td>
                            <td class="px-6 py-4">{{ $categorie->slug }}</td>
                            
                            
                            <td class="px-6 py-4 flex gap-2">
                                <button class="bg-transparent text-blue-500 px-3 py-1 text-sm transition-all flex items-center gap-1" onclick="editCategorieItem({{ $categorie->id }})">
                                    <i class="fas fa-pencil"></i>
                                </button>
                                <button class="bg-transparent text-red-500 px-3 py-1 text-sm transition-all flex items-center gap-1" onclick="deleteCategorieItem({{ $categorie->id }})" data-id="{{ $categorie->id }}" data-label="{{ $categorie->label }}" data-toggle="tooltip" data-title="Supprimer {{ $categorie->label }}">
                                    <i class="fas fa-trash"></i> 
                                </button>
                            </td>
                        </tr>

                        <div id="edit-categorie-modal-{{ $categorie->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 ">
                            <div class=" bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative overflow-y-auto max-h-[70vh]" >
                                
                                <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="closeEditCategorieModal({{ $categorie->id }})">
                                    <i class="fas fa-times"></i>
                                </button>
                                <h2 class="text-xl font-bold text-sonec-dark mb-4">Modifier une catégorie</h2>
                                        
                                <div id="form-errors" class="bg-red-100 text-red-500 mb-4 hidden"></div>

                                <form id="edit-categorie-form-{{ $categorie->id }}" data-categorie-id="{{ $categorie->id }}" class="space-y-4 overflow-y-auto custom-scrollbar max-h-[70vh]" enctype="multipart/form-data">
            
                                    {{-- Libellé --}}
                                    <div>
                                        <label for="label-{{ $categorie->id }}" class="block text-sm font-medium text-slate-700">Libellé</label>
                                        <input type="text" id="label-{{ $categorie->id }}" name="label" value="{{ $categorie->label }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                    </div>

                                    {{-- Slug --}}
                                    <div>
                                        <label for="slug-{{ $categorie->id }}" class="block text-sm font-medium text-slate-700">Slug</label>
                                        <input readonly type="text" id="slug-{{ $categorie->id }}" name="slug" value="{{ $categorie->slug }}" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                    </div>

                                    <!-- Autres champs comme icon, image, position, etc. -->
                                    <button type="submit" class="w-full bg-sonec-green hover:bg-sonec-dark text-white py-2 px-4 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                                        <i class="fas fa-save"></i> Enregistrer
                                    </button>
                                </form>
                            </div>
                        </div>


                        <div id="delete-categorie-modal-{{ $categorie->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 " >
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative " >
                                
                                <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="closeDeleteCategorieModal({{ $categorie->id }})">
                                    <i class="fas fa-times"></i>
                                </button>
                                <h2 class="text-xl font-bold text-sonec-dark mb-4">Confirmer la suppression</h2>
                                
                                <p class="mb-6 text-slate-700">Êtes-vous sûr de vouloir supprimer la catégorie <span class="font-bold">{{ $categorie->label }}</span> ? Cette action est irréversible.</p>

                                <div class="flex justify-end gap-4">
                                    <button onclick="closeDeleteCategorieModal({{ $categorie->id }})" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md font-bold text-sm transition-all">
                                        Annuler
                                    </button>
                                    <button onclick="deleteCategorieItem({{ $categorie->id }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2">
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

{{-- Formulaire en modal pour enregistrer un élémént --}}
<div id="categorie-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 ">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative " >
        
        <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="toggleCategorieModal()">
            <i class="fas fa-times"></i>Fermer
        </button>
        <h2 class="text-xl font-bold text-sonec-dark mb-4">Ajouter une categorie</h2>
        
        {{-- Afficher les messages d'erreur --}}
        <div id="form-errors" class="bg-red-100 text-red-500 mb-4 hidden"></div>

        <form id="categorie-form" class="space-y-4 overflow-y-auto custom-scrollbar max-h-[70vh]" enctype="multipart/form-data">
            
            <div>
                <label for="label" class="block text-sm font-medium text-slate-700">Libellé</label>
                <input type="text" id="label" name="label" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
            </div>

            {{-- Slug --}}
            <div>
                <label for="slug" class="block text-sm font-medium text-slate-700">Slug</label>
                <input type="text" id="slug" name="slug"  class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
            </div>

            <!-- Autres champs comme icon, image, position, etc. -->
            <button type="submit" class="w-full bg-sonec-green hover:bg-sonec-dark text-white py-2 px-4 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                <i class="fas fa-save"></i> Enregistrer
            </button>
        </form>
    </div>
</div>
