@extends('admin.layout.appLayout')

@section('content')
    <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
        <div class="flex items-center gap-4">
            <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Gestion du Menu</h2>
            <span id="status-badge" class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-md border border-green-200 hidden">Modifications en cours ...</span>
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

    {{-- Liste des éléments du menu sous forme de tableau--}}
    <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-bold text-sonec-dark">Éléments du Menu</h3>

                <div class="flex items-center gap-4">
                    <button onclick="openEspacementModule()" class="bg-sonec-dark hover:bg-sonec-green text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                        <i class="fas fa-grip-lines"></i> Configurer l'espacement des sous-menus
                    </button>

                    <button onclick="addMenuItem()" class="bg-sonec-green hover:bg-sonec-dark text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                        <i class="fas fa-plus"></i> Ajouter un élément
                    </button>
                </div>

            </div>
            <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50">
                            <th></th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Position</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Libellé</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">URL</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Slug</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Parent</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Type de menu</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Icon/Image</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Lien externe</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Affiché</th>                            
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($menus as $menu)
                            {{-- possibilite de drag and drop pour changer la position des elements --}}
                            <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors cursor-move" data-id="{{ $menu->id }}">
                                <input type="hidden" class="menu-id" value="{{ $menu->id }}">
                                <td class="px-6 py-4">
                                    <i class="fas fa-grip-vertical text-slate-400 cursor-move px-3"></i>
                                </td>
                                <td class="px-6 py-4">{{ $menu->position }}</td>
                                <td class="px-6 py-4">{{ $menu->label }}</td>
                                <td class="px-6 py-4">{{ $menu->url }}</td>
                                <td class="px-6 py-4">{{ $menu->slug }}</td>
                                <td class="px-6 py-4">{{ $menu->parent ? $menu->parent->label : 'Menu Principal' }}</td>
                                <td class="px-6 py-4 text-sm">{{ $menu->type}}</td>
                                <td class="px-6 py-4">
                                    @if($menu->icon && str_starts_with($menu->icon, 'fa'))
                                        <i class="{{ $menu->icon }} text-md rounded-full bg-green-600 text-white p-4"></i>
                                    @elseif($menu->image)
                                        
                                        <img src="{{ asset('storage/' . $menu->image) }}" alt="Menu Image" class="w-8 h-8 object-cover rounded">
                                    @elseif($menu->img_src)
                                        <img src="{{ $menu->img_src }}" alt="Menu Image" class="w-8 h-8 object-cover rounded">
                                    @else
                                        {{-- Ca peut être un svg --}}
                                       <span class="text-md {{ $menu->icon ? 'rounded-full bg-green-600 text-white p-4' : '' }}">{{ $menu->icon }}</span>
                                    @endif
                                </td>
                                
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none  {{ $menu->is_external ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }} " >
                                        {{ $menu->is_external ? 'Oui' : 'Non' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    {{-- Si oui fond vert sinon fond rouge --}}
                                    <span class="inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none {{ $menu->is_active ? 'text-green-800 bg-green-100' : 'text-red-800 bg-red-100' }}" >
                                        {{ $menu->is_active ? 'Oui' : 'Non' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    <button class="bg-transparent text-blue-500 px-3 py-1 text-sm transition-all flex items-center gap-1" onclick="editMenuItem({{ $menu->id }})">
                                        <i class="fas fa-pencil"></i>
                                    </button>
                                    <button class="bg-transparent text-red-500 px-3 py-1 text-sm transition-all flex items-center gap-1" onclick="deleteMenuItem({{ $menu->id }})" data-id="{{ $menu->id }}" data-label="{{ $menu->label }}" data-toggle="tooltip" data-title="Supprimer {{ $menu->label }}">
                                        <i class="fas fa-trash"></i> 
                                    </button>
                                </td>
                            </tr>

                            {{-- Formulaire de modification d'un élément --}}
                            <div id="edit-menu-modal-{{ $menu->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 ">
                                <div class=" bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative overflow-y-auto max-h-[70vh]" >
                                    
                                    <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="closeEditMenuModal({{ $menu->id }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <h2 class="text-xl font-bold text-sonec-dark mb-4">Modifier un élément de menu</h2>
                                    
                                    
                                    <div id="form-errors" class="bg-red-100 text-red-500 mb-4 hidden"></div>

                                    <form id="edit-sidebar-form-{{ $menu->id }}" data-menu-id="{{ $menu->id }}" class="space-y-4 overflow-y-auto custom-scrollbar max-h-[70vh]" enctype="multipart/form-data">
                                        
                                        <div>
                                            <label for="editLabel-{{ $menu->id }}" class="block text-sm font-medium text-slate-700">Libellé <span class="text-red-500">*</span></label>
                                            <input type="text" id="editLabel-{{ $menu->id }}" name="label" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $menu->label }}" required>
                                        </div>
                                        <div>
                                            <label for="editUrl-{{ $menu->id }}" class="block text-sm font-medium text-slate-700">URL <span class="text-red-500">*</span></label>
                                            <input type="text" id="editUrl-{{ $menu->id }}" name="url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $menu->url }}" required>
                                        </div>
                                        <div class="hidden">
                                            <label for="editSlug-{{ $menu->id }}" class="block text-sm font-medium text-slate-700">Slug (formaté automatiquement)</label>
                                            <input type="text" readonly id="editSlug-{{ $menu->id }}" name="slug" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $menu->slug }}">
                                        </div>
                                        <div>
                                            <label for="editIcon-{{ $menu->id }}" class="block text-sm font-medium text-slate-700">Icone</label>
                                            <small class="text-slate-400"> (ex: "fas fa-home" ou "far fa-heart" ou une icône svg)</small>
                                            <input type="text" id="editIcon-{{ $menu->id }}" name="icon" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $menu->icon }}">
                                        </div>
                                        
                                        {{-- Ajouter un message d'information --}}
                                        <div class="bg-blue-100 text-blue-500 p-3 rounded mb-4 flex items-center gap-2">
                                            <i class="fas fa-info-circle"></i>
                                            <p>Si vous souhaitez utiliser une image pour cet élément de menu, vous pouvez soit fournir une URL d'image valide dans le champ "URL de l'image", soit télécharger une image depuis votre ordinateur. Si les deux champs sont remplis, l'URL de l'image sera prioritaire.</p>
                                        </div>


                                        {{-- renseigner l'URL de l'image --}}
                                        <div>
                                            <label for="editImgSrc-{{ $menu->id }}" class="block text-sm font-medium text-slate-700">URL de l'image</label>
                                            <input type="text" id="editImgSrc-{{ $menu->id }}" name="img_src" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $menu->img_src }}">
                                        </div>

                                        {{-- image à uploader avec preview --}}
                                        <div>
                                            <label for="editImage-{{ $menu->id }}" class="block text-sm font-medium text-slate-700">Image (optionnel)</label>
                                            <input type="file" id="editImage-{{ $menu->id }}" name="image" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                            
                                            <img id="image-preview" src="#" alt="Image Preview" class="mt-2 w-20 h-20 object-cover rounded hidden">
                                        </div>

                                        <div>
                                            <label for="editType-{{ $menu->id }}" class="block text-sm font-medium text-slate-700">Type <span class="text-red-500">*</span></label>
                                            <select id="editType-{{ $menu->id }}" name="type" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                                <option {{ $menu->type == 'link' ? 'selected' : '' }} value="link">Lien</option>
                                                <option {{ $menu->type == 'dropdown' ? 'selected' : '' }} value="dropdown">Menu déroulant</option>
                                                <option {{ $menu->type == 'megamenu' ? 'selected' : '' }} value="megamenu">Mega Menu</option>
                                            </select>
                                            {{-- <input type="text" id="type" name="type" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none"> --}}
                                        </div>
                                        <div>
                                            <label for="editPosition-{{ $menu->id }}" class="block text-sm font-medium text-slate-700">Position</label>
                                            <select id="editPosition-{{ $menu->id }}" name="position" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                                <option {{ $menu->position == 0 ? 'selected' : '' }} value="0">0</option>
                                                <option {{ $menu->position == 1 ? 'selected' : '' }} value="1">1</option>
                                                <option {{ $menu->position == 2 ? 'selected' : '' }} value="2">2</option>
                                                <option {{ $menu->position == 3 ? 'selected' : '' }} value="3">3</option>
                                                <option {{ $menu->position == 4 ? 'selected' : '' }} value="4">4</option>
                                                <option {{ $menu->position == 5 ? 'selected' : '' }} value="5">5</option>
                                                <option {{ $menu->position == 6 ? 'selected' : '' }} value="6">6</option>
                                                <option {{ $menu->position == 7 ? 'selected' : '' }} value="7">7</option>
                                            </select>
                                            {{-- <input type="text" id="type" name="type" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none"> --}}
                                        </div>
                                        <div>
                                            <label for="editParentId-{{ $menu->id }}" class="block text-sm font-medium text-slate-700">Menu Parent</label>
                                            <select id="editParentId-{{ $menu->id }}" name="parent_id" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                                <option value="">Aucun</option>
                                                @foreach($menus as $item)
                                                    <option {{ $menu->parent_id == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label for="editDescription-{{ $menu->id }}" class="block text-sm font-medium text-slate-700">Description</label>
                                            <textarea id="editDescription-{{ $menu->id }}" name="description" rows="3" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                                {!!  $menu->description  !!}
                                            </textarea>
                                        </div>

                                        {{-- checkboxs alignés is_active et is_external --}}
                                        <div class="flex items-center gap-6">
                                            <div class="flex items-center gap-2">
                                                {{-- <input type="checkbox" {{ $menu->is_active ? 'checked' : '' }} id="editIsActive" name="is_active" class="toggle-checkbox hidden">
                                                <label for="editIsActive" class="toggle-label block w-10 h-5 bg-gray-300 rounded-full cursor-pointer relative"></label> --}}

                                                <input type="checkbox" {{ $menu->is_active ? 'checked' : '' }} id="editIsActive-{{ $menu->id }}" name="is_active" class="toggle-checkbox hidden">
                                                <label for="editIsActive-{{ $menu->id }}" class="toggle-label block w-10 h-5 bg-gray-300 rounded-full cursor-pointer relative"></label>
                                                <span class="text-sm text-slate-700">Visible </span>
                                            </div>

                                            <div class="flex items-center gap-2">
                                                {{-- <input type="checkbox" {{ $menu->is_external ? 'checked' : '' }} id="editIsExternal" name="is_external" class="toggle-checkbox hidden">
                                                <label for="editIsExternal" class="toggle-label block w-10 h-5 bg-gray-300 rounded-full cursor-pointer relative"></label>
                                                --}}
                                                <input type="checkbox" {{ $menu->is_external ? 'checked' : '' }} id="editIsExternal-{{ $menu->id }}" name="is_external" class="toggle-checkbox hidden">
                                                <label for="editIsExternal-{{ $menu->id }}" class="toggle-label block w-10 h-5 bg-gray-300 rounded-full cursor-pointer relative"></label>
                                                <span class="text-sm text-slate-700">Lien Externe</span>
                                             {{-- <small>Si vous souhaitez que cet élément de menu soit un lien vers une page externe, assurez-vous de cocher "Lien externe" et de fournir l'URL complète (y compris http:// ou https://). Sinon, pour les liens internes, vous pouvez simplement fournir le chemin relatif (ex: /contact).</small>     --}}
                                                
                                            </div>
                                            
                                        </div>
                                        <div class="bg-blue-100 text-blue-500 p-3 rounded mb-4 flex items-center gap-2 mt-2">
                                            <i class="fas fa-info-circle"></i>
                                            <small >
                                                Si vous souhaitez que cet élément de menu soit un lien vers une page externe, assurez-vous de cocher "Lien externe" et de fournir l'URL complète (y compris http:// ou https://). Sinon, pour les liens internes, vous pouvez simplement fournir le chemin relatif (ex: /contact).
                                            </small>
                                        </div>
                                        
                                        <button type="submit" class="w-full bg-sonec-green hover:bg-sonec-dark text-white py-2 px-4 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20" >
                                            <i class="fas fa-save"></i> Enregistrer les modifications
                                        </button>
                                    </form>
                                </div>
                            </div>

                            {{-- Modal de confirmation de suppression   --}}
                            <div id="delete-menu-modal-{{ $menu->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 ">
                                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative " >
                                    
                                    <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="closeDeleteMenuModal({{ $menu->id }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <h2 class="text-xl font-bold text-sonec-dark mb-4">Confirmer la suppression</h2>
                                    
                                    <p class="mb-6 text-slate-700">Êtes-vous sûr de vouloir supprimer le menu <span class="font-bold">{{ $menu->label }}</span> ? Cette action est irréversible.</p>

                                    <div class="flex justify-end gap-4">
                                        <button onclick="closeDeleteMenuModal({{ $menu->id }})" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md font-bold text-sm transition-all">
                                            Annuler
                                        </button>
                                        <button onclick="confirmDeleteMenu({{ $menu->id }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Formulaire en modal pour enregistrer un élémént --}}
            <div id="menu-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 ">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative " >
                    
                    <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="toggleMenuModal()">
                        <i class="fas fa-times"></i>
                    </button>
                    <h2 class="text-xl font-bold text-sonec-dark mb-4">Ajouter un élément de menu</h2>
                    
                    {{-- Afficher les messages d'erreur --}}
                    <div id="form-errors" class="bg-red-100 text-red-500 mb-4 hidden"></div>

                    <form id="menu-form" class="space-y-4 overflow-y-auto custom-scrollbar max-h-[70vh]" enctype="multipart/form-data">
                        <div>
                            <label for="label" class="block text-sm font-medium text-slate-700">Libellé <span class="text-red-500">*</span></label>
                            <input type="text" id="label" name="label" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" required>
                        </div>
                        <div>
                            <label for="url" class="block text-sm font-medium text-slate-700">URL <span class="text-red-500">*</span></label>
                            <input type="text" id="url" name="url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" required>
                        </div>
                        <div class="hidden">
                            <label for="slug" class="block text-sm font-medium text-slate-700">Slug (formaté automatiquement)</label>
                            <input type="text" readonly id="slug" name="slug" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                        </div>
                        <div>
                            <label for="icon" class="block text-sm font-medium text-slate-700">Icone</label>
                            <small class="text-slate-400"> (ex: "fas fa-home" ou "far fa-heart" ou une icône svg)</small>
                            <input type="text" id="icon" name="icon" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                        </div>
                        
                        {{-- Ajouter un message d'information --}}
                        <div class="bg-blue-100 text-blue-500 p-3 rounded mb-4 flex items-center gap-2">
                            <i class="fas fa-info-circle"></i>
                            <small>Si vous souhaitez utiliser une image pour cet élément de menu, vous pouvez soit fournir une URL d'image valide dans le champ "URL de l'image", soit télécharger une image depuis votre ordinateur. Si les deux champs sont remplis, l'URL de l'image sera prioritaire.</small>
                        </div>
                        {{-- renseigner l'URL de l'image --}}
                        <div>
                            <label for="editImgSrc-{{ $menu->id }}" class="block text-sm font-medium text-slate-700">URL de l'image</label>
                            <input type="text" id="editImgSrc-{{ $menu->id }}" name="img_src" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $menu->img_src }}">
                        </div>

                        {{-- image à uploader avec preview --}}
                        <div>
                            <label for="image" class="block text-sm font-medium text-slate-700">Image (optionnel)</label>
                            <input type="file" id="image" name="image" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                            <img id="image-preview" src="#" alt="Image Preview" class="mt-2 w-20 h-20 object-cover rounded hidden">
                        </div>

                        <div>
                            <label for="type" class="block text-sm font-medium text-slate-700">Type <span class="text-red-500">*</span></label>
                            <select id="type" name="type" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                <option value="link">Lien</option>
                                <option value="dropdown">Menu déroulant</option>
                                <option value="megamenu">Mega Menu</option>
                            </select>
                            {{-- <input type="text" id="type" name="type" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none"> --}}
                        </div>
                        <div>
                            <label for="position" class="block text-sm font-medium text-slate-700">Position</label>
                            <select id="position" name="position" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                <option value="0">0</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                            </select>
                            {{-- <input type="text" id="type" name="type" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none"> --}}
                        </div>
                        {{-- menu parent --}}
                        <div>
                            <label for="parent_id" class="block text-sm font-medium text-slate-700">Menu Parent</label>
                            <select id="parent_id" name="parent_id" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                <option value="">Aucun</option>
                                @foreach($menus as $item)
                                    <option value="{{ $item->id }}">{{ $item->label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                            <textarea id="description" name="description" rows="3" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none"></textarea>
                        </div>

                        {{-- checkboxs alignés is_active et is_external --}}
                        <div class="flex items-center gap-6">
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="is_active" name="is_active" class="toggle-checkbox hidden">
                                <label for="is_active" class="toggle-label block w-10 h-5 bg-gray-300 rounded-full cursor-pointer relative"></label>
                                <span class="text-sm text-slate-700">Visible </span>
                            </div>
                            <div class="flex items-center gap-2">
                                <input type="checkbox" id="is_external" name="is_external" class="toggle-checkbox hidden">
                                <label for="is_external"  class="toggle-label block w-10 h-5 bg-gray-300 rounded-full cursor-pointer relative"></label>
                                <span class="text-sm text-slate-700">Lien Externe</span>
                                
                            </div>
                        </div>
                        <div class="bg-blue-100 text-blue-500 p-3 rounded mb-4 flex items-center gap-2">
                            <i class="fas fa-info-circle"></i>
                            <small >
                                Si vous souhaitez que cet élément de menu soit un lien vers une page externe, assurez-vous de cocher "Lien externe" et de fournir l'URL complète (y compris http:// ou https://). Sinon, pour les liens internes, vous pouvez simplement fournir le chemin relatif (ex: /contact).
                            </small>
                        </div>
                        

                        <!-- Autres champs comme icon, image, position, etc. -->
                        <button type="submit" class="w-full bg-sonec-green hover:bg-sonec-dark text-white py-2 px-4 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                    </form>
                </div>
            </div>

            
        </div>
        
    </div>

     
    {{-- Configuration du sidebar menu --}}
    <div id="sidebar-menu" class="flex-1 overflow-y-auto custom-scrollbar p-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-bold text-sonec-dark">Sidebar du Menu</h3>

                <div class="flex items-center gap-4">                  

                    <button onclick="addSidebarMenuItem()" class="bg-sonec-green hover:bg-sonec-dark text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                        <i class="fas fa-plus"></i> Ajouter
                    </button>
                </div>

            </div>
            <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50">
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Menu concerné</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Libellé</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">cta url</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">cta libellé</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">image</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">description</th>                            
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($sidebarMenus as $sidebarMenu)
                            {{-- possibilite de drag and drop pour changer la position des elements --}}
                            <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors cursor-move" data-sidebar-menu-id="{{ $sidebarMenu->menu->id }}">
                                <input type="hidden" class="menu-id" value="{{ $sidebarMenu->menu->id }}">
                                
                                <td class="px-6 py-4">{{ $sidebarMenu->menu->label }}</td>
                                <td class="px-6 py-4">{{ $sidebarMenu->title }}</td>
                                <td class="px-6 py-4">{{ $sidebarMenu->cta_url }}</td>
                                <td class="px-6 py-4">{{ $sidebarMenu->cta_label }}</td>
                                <td class="px-6 py-4">
                                    @if($sidebarMenu->image && file_exists(storage_path('app/public/' . $sidebarMenu->image)))
                                        <img src="{{ asset('storage/' . $sidebarMenu->image) }}" alt="{{ $sidebarMenu->title }}" class="w-16 h-16 object-cover rounded">
                                    @elseif($sidebarMenu->img_url)
                                        <img src="{{ $sidebarMenu->img_url }}" alt="{{ $sidebarMenu->title }}" class="w-16 h-16 object-cover rounded">
                                    @else
                                        Aucune image
                                    @endif
                                </td>

                                <td class="px-6 py-4">{{ $sidebarMenu->description }}</td>
                                
                               
                                <td class="px-6 py-4 flex gap-2">
                                    <button class="bg-transparent text-blue-500 px-3 py-1 text-sm transition-all flex items-center gap-1" onclick="editSidebarMenu({{ $sidebarMenu->id }})">
                                        <i class="fas fa-pencil"></i>
                                    </button>
                                    <button class="bg-transparent text-red-500 px-3 py-1 text-sm transition-all flex items-center gap-1" onclick="deleteSidebarMenu({{ $sidebarMenu->id }})" data-id="{{ $sidebarMenu->id }}" data-label="{{ $sidebarMenu->title }}" data-toggle="tooltip" data-title="Supprimer {{ $sidebarMenu->title }}">
                                        <i class="fas fa-trash"></i> 
                                    </button>
                                </td>
                            </tr>

                            {{-- Formulaire de modification d'un élément --}}
                            <div id="edit-sidebar-modal-{{ $sidebarMenu->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 ">
                                <div class=" bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative overflow-y-auto max-h-[70vh]" >
                                    
                                    <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="closeEditSidebarMenuModal({{ $sidebarMenu->id }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <h2 class="text-xl font-bold text-sonec-dark mb-4">Modifier {{ $sidebarMenu->title }}</h2>
                                    
                                    
                                    <div id="form-errors" class="bg-red-100 text-red-500 mb-4 hidden"></div>

                                    <form id="edit-sidebar-form-{{ $sidebarMenu->id }}" data-sidebar-id="{{ $sidebarMenu->id }}" class="space-y-4 overflow-y-auto custom-scrollbar max-h-[70vh]" enctype="multipart/form-data">
                                        
                                        <div>
                                            <label for="title-{{ $sidebarMenu->id }}" class="block text-sm font-medium text-slate-700">Libellé <span class="text-red-500">*</span></label>
                                            <input type="text" id="title-{{ $sidebarMenu->id }}" name="title" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $sidebarMenu->title }}" required>
                                        </div>
                                        <div>
                                            <label for="cta_url-{{ $sidebarMenu->id }}" class="block text-sm font-medium text-slate-700">CTA URL <span class="text-red-500">*</span></label>
                                            <input type="text" id="cta_url-{{ $sidebarMenu->id }}" name="cta_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $sidebarMenu->url }}" >
                                        </div>
                                        <div>
                                            <label for="cta_label-{{ $sidebarMenu->id }}" class="block text-sm font-medium text-slate-700">CTA Label <span class="text-red-500">*</span></label>
                                            <input type="text" id="cta_label-{{ $sidebarMenu->id }}" name="cta_label" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $sidebarMenu->cta_label }}" >
                                        </div>
                                        <div>
                                            <label for="img_url-{{ $sidebarMenu->id }}" class="block text-sm font-medium text-slate-700">URL de l'image</label>
                                            <input type="text" id="img_url-{{ $sidebarMenu->id }}" name="img_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $sidebarMenu->img_url }}">
                                        </div>
                                        <div>
                                            <label for="menu_id-{{ $sidebarMenu->id }}" class="block text-sm font-medium text-slate-700">Menu déroulant concerné</label>
                                            <select id="menu_id-{{ $sidebarMenu->id }}" name="menu_id" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                                <option value="">Aucun</option>
                                                @foreach($menusPrincipaux as $item)
                                                    <option {{ $item->id == $sidebarMenu->menu_id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->label }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label for="editDescription-{{ $sidebarMenu->id }}" class="block text-sm font-medium text-slate-700">Description</label>
                                            <textarea id="editDescription-{{ $sidebarMenu->id }}" name="description" rows="3" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                                {!!  $sidebarMenu->description  !!}
                                            </textarea>
                                        </div>
                                        
                                        <button type="submit" class="w-full bg-sonec-green hover:bg-sonec-dark text-white py-2 px-4 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20" >
                                            <i class="fas fa-save"></i> Enregistrer les modifications
                                        </button>
                                    </form>
                                </div>
                            </div>

                            {{-- Modal de confirmation de suppression   --}}
                            <div id="delete-menu-modal-{{ $menu->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 ">
                                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative " >
                                    
                                    <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="closeDeleteMenuModal({{ $menu->id }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <h2 class="text-xl font-bold text-sonec-dark mb-4">Confirmer la suppression</h2>
                                    
                                    <p class="mb-6 text-slate-700">Êtes-vous sûr de vouloir supprimer le menu <span class="font-bold">{{ $menu->label }}</span> ? Cette action est irréversible.</p>

                                    <div class="flex justify-end gap-4">
                                        <button onclick="closeDeleteMenuModal({{ $menu->id }})" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md font-bold text-sm transition-all">
                                            Annuler
                                        </button>
                                        <button onclick="confirmDeleteMenu({{ $menu->id }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- Formulaire en modal pour enregistrer un élémént --}}
            <div id="sidebar-menu-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 ">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative " >
                    
                    <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="toggleSidebarMenuModal()">
                        <i class="fas fa-times"></i>
                    </button>
                    <h2 class="text-xl font-bold text-sonec-dark mb-4">Ajouter un élément de menu</h2>
                    
                    {{-- Afficher les messages d'erreur --}}
                    <div id="form-errors" class="bg-red-100 text-red-500 mb-4 hidden"></div>

                    <form id="sidebar-menu-form" class="space-y-4 overflow-y-auto custom-scrollbar max-h-[70vh]" enctype="multipart/form-data">
                        <div>
                            <label for="title" class="block text-sm font-medium text-slate-700">Libellé <span class="text-red-500">*</span></label>
                            <input type="text" id="title" name="title" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" >
                        </div>
                        <div>
                            <label for="cta_url" class="block text-sm font-medium text-slate-700">CTA URL <span class="text-red-500">*</span></label>
                            <input type="text" id="cta_url" name="cta_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" >
                        </div>
                        <div>
                            <label for="cta_label" class="block text-sm font-medium text-slate-700">CTA Label <span class="text-red-500">*</span></label>
                            <input type="text" id="cta_label" name="cta_label" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none"  >
                        </div>

                        <div>
                            <label for="img_url" class="block text-sm font-medium text-slate-700">URL de l'image</label>
                            <input type="text" id="img_url" name="img_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" >
                        </div>

                        <div>
                            <label for="menu_id" class="block text-sm font-medium text-slate-700">Menu déroulant concerné</label>
                            <select id="menu_id" name="menu_id" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                
                                @foreach($menusPrincipaux as $item)
                                    <option value="{{ $item->id }}">{{ $item->label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="editDescription" class="block text-sm font-medium text-slate-700">Description</label>
                            <textarea id="editDescription" name="description" rows="3" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                               
                            </textarea>
                        </div>
                        

                        <!-- Autres champs comme icon, image, position, etc. -->
                        <button type="submit" class="w-full bg-sonec-green hover:bg-sonec-dark text-white py-2 px-4 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                            <i class="fas fa-save"></i> Enregistrer
                        </button>
                    </form>
                </div>
            </div>
            
        </div>
        
    </div>

    <script>
        function toggleMenuModal() {
            const modal = document.getElementById('menu-modal');
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
        }

        function addMenuItem() {
            toggleMenuModal();
        }

        // Générer le slug à partir du titre
        document.getElementById('label').addEventListener('input', function() {
            // Doire pourvoir gérer les accents et les caractères spéciaux comme "é" ou "ç" et les convertir en "e" et "c"
            const slug = this.value.toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '') 
                .replace(/[^a-z0-9]+/g, '-') 
                .replace(/^-+|-+$/g, '');
            document.getElementById('slug').value = slug;
            document.getElementById('url').value = '/' + slug;
        });

        // document.getElementById('editLabel').addEventListener('input', function() {
        //     // Doire pourvoir gérer les accents et les caractères spéciaux comme "é" ou "ç" et les convertir en "e" et "c"
        //    console.log("valeur de url :"+this.value);
           
        //     const editSlug = this.value.toLowerCase()
        //         .normalize('NFD').replace(/[\u0300-\u036f]/g, '') 
        //         .replace(/[^a-z0-9]+/g, '-') 
        //         .replace(/^-+|-+$/g, '');
        //     document.getElementById('editSlug').value = editSlug;
        //     document.getElementById('editUrl').value = '/' + editSlug;
        // });
        document.querySelectorAll('[id^="editLabel-"]').forEach(input => {
            input.addEventListener('input', function() {
                const id = this.id.split('-')[1];
                const editSlug = this.value.toLowerCase()
                    .normalize('NFD').replace(/[\u0300-\u036f]/g, '') 
                    .replace(/[^a-z0-9]+/g, '-') 
                    .replace(/^-+|-+$/g, '');
                document.getElementById(`editSlug-${id}`).value = editSlug;
                document.getElementById(`editUrl-${id}`).value = '/' + editSlug;
            });
        });
        // Preview de l'image uploadé
        document.getElementById('image').addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('image-preview');
                    preview.src = e.target.result;
                    preview.classList.remove('hidden');
                }
                reader.readAsDataURL(file);
            }
        });

        // Drang and drop pour réorganiser les éléments du menu en mettant à jour leur position dans la base de données via AJAX
        let draggedItem = null;
        document.querySelectorAll('tbody tr').forEach(row => {
            row.addEventListener('dragstart', function() {
                draggedItem = this;
                this.classList.add('opacity-50');
            });
            row.addEventListener('dragend', function() {
                draggedItem = null;
                this.classList.remove('opacity-50');
            });
            row.addEventListener('dragover', function(e) {
                e.preventDefault();
                this.classList.add('bg-slate-100');
            });
            row.addEventListener('dragleave', function() {
                this.classList.remove('bg-slate-100');
            });
            row.addEventListener('drop', function(e) {
                e.preventDefault();
                this.classList.remove('bg-slate-100');
                if (draggedItem !== this) {
                    const tbody = this.parentNode;
                    const draggedIndex = Array.from(tbody.children).indexOf(draggedItem);
                    const targetIndex = Array.from(tbody.children).indexOf(this);
                    if (draggedIndex < targetIndex) {
                        tbody.insertBefore(draggedItem, this.nextSibling);
                    } else {
                        tbody.insertBefore(draggedItem, this);
                    }
                    // Mettre à jour la position dans la base de données via AJAX
                    const menuId = draggedItem.getAttribute('data-id');

                    fetch(`/admin/menus/${menuId}/update-position`, {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': "{{ csrf_token() }}",
                            'Content-Type': 'application/json'
                        },
                        body: JSON.stringify({ position: targetIndex })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success===true) {
                            showToast();
                        } else {
                            showToastError();
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showToastError();
                    });
                }
            });
        });        

        // Enregistrer le formulaire
        document.getElementById('menu-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            const btn = this.querySelector('button[type="submit"]');
            const originalContent = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';
            btn.disabled = true;

            //convertir les checkboxs en valeurs 0 ou 1
            formData.set('is_active', document.getElementById('is_active').checked ? 1 : 0);
            formData.set('is_external', document.getElementById('is_external').checked ? 1 : 0);
            formData.set('description', document.getElementById('description').value);


            fetch("{{ route('menus.store') }}", {
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
                    successDescription.textContent = data.description || 'Le menu enregistré avec succès.';

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
                errorMessage.textContent = 'Erreur lors de l\'enregistrement du menu';
                errorDescription.textContent = 'Une erreur est survenue lors de l\'enregistrement du menu. Veuillez réessayer.';

                showToastError();
            });
        });

        function toggleEditMenuModal() {
            // Recuperer l'id du menu à modifier à partir du dataset de la ligne cliquée
            const menuId = event.target.closest('tr').getAttribute('data-id');
            const modal = document.getElementById('edit-menu-modal-' + menuId);
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
        }

        function toogleDeleteMenuModal() {
            // Recuperer l'id du menu à supprimer à partir du dataset de la ligne cliquée
            const menuId = event.target.closest('tr').getAttribute('data-id');
            const modal = document.getElementById('delete-menu-modal-' + menuId);
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
        }

        
        // afficher le modal de modification en fonction de l'id du menu
        function editMenuItem(menuId) {            
            // Fermer tous les modals ouverts d'abord
            document.querySelectorAll('[id^="edit-menu-modal-"]').forEach(modal => {
                modal.classList.add('opacity-0');
                modal.classList.add('pointer-events-none');
            });

            const modal = document.getElementById('edit-menu-modal-' + menuId);
            modal.classList.remove('opacity-0');
            modal.classList.remove('pointer-events-none');
        }

        function closeEditMenuModal(menuId) {
            const modal = document.getElementById('edit-menu-modal-' + menuId);
            modal.classList.add('opacity-0');
            modal.classList.add('pointer-events-none');
        }

        function closeDeleteMenuModal(menuId) {
            const modal = document.getElementById('delete-menu-modal-' + menuId);
            modal.classList.add('opacity-0');
            modal.classList.add('pointer-events-none');
        }

        // Enregistrer les modifications d'un élément de menu
        document.querySelectorAll('[id^="edit-menu-form-"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const menuId = this.getAttribute('data-menu-id');
                const formData = new FormData(this);

                const btn = document.querySelector(`#edit-menu-modal-${menuId} button[type="submit"]`);
                const originalContent = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement en cours...';
                btn.disabled = true;

                formData.set('is_active', document.getElementById('editIsActive-' + menuId).checked ? 1 : 0);
                formData.set('is_external', document.getElementById('editIsExternal-' + menuId).checked ? 1 : 0);
                formData.set('description', document.getElementById('editDescription-' + menuId).value);

                formData.append('_method', 'PUT');

                console.log("Données envoyées :", Array.from(formData.entries()));

                fetch(`/admin/menus/${menuId}`, {
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
                        successDescription.textContent = data.description || 'Le menu enregistré avec succès.';

                        showToast();
                        setTimeout(() => {
                            btn.innerHTML = originalContent;
                            btn.disabled = false;
                            btn.classList.remove('opacity-75', 'cursor-not-allowed');
                        }, 1200);
                        closeEditMenuModal(menuId);
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

        // ouvrir le modal de confirmation de suppression et confirmer la suppression d'un menu
        function deleteMenuItem(menuId) {
            // Afficher le modal de confirmation de suppression
            toogleDeleteMenuModal();

            // Ajouter un écouteur d'événement au bouton de confirmation de suppression
            const confirmBtn = document.querySelector(`#delete-menu-modal-${menuId} button.bg-red-500`);
            confirmBtn.addEventListener('click', function() {
                fetch(`/admin/menus/${menuId}`, {
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

        // Ouvrir le module de configuration de l'espacement
        function openEspacementModule() {
            window.location.href = "{{ route('espacement-menus.index') }}";
        }

        // Sidebar menu gestion
        function toggleSidebarMenuModal() {
            const modal = document.getElementById('sidebar-menu-modal');
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
        }

        function addSidebarMenuItem() {
            toggleSidebarMenuModal();
        }
        document.getElementById('sidebar-menu-form').addEventListener('submit', function(e) {
            e.preventDefault();
            const formData = new FormData(this);

            const btn = this.querySelector('#sidebar-menu-form button[type="submit"]');
            const originalContent = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';
            btn.disabled = true;

            fetch("{{ route('sidebar-menus.store') }}", {
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
                    successDescription.textContent = data.description || 'Enregistrement effectué avec succès.';

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
                errorMessage.textContent = 'Erreur lors de l\'enregistrement du menu';
                errorDescription.textContent = 'Une erreur est survenue lors de l\'enregistrement du menu. Veuillez réessayer.';

                showToastError();
            });
        });

        function toggleEditMenuModal() {
            // Recuperer l'id du menu à modifier à partir du dataset de la ligne cliquée
            const sidebarMenuId = event.target.closest('tr').getAttribute('data-sidebar-menu-id');
            const modal = document.getElementById('edit-sidebar-modal-' + sidebarMenuId);
            modal.classList.toggle('opacity-0');
            modal.classList.toggle('pointer-events-none');
        }
        function editSidebarMenu(sidebarMenuId) {            
            // Fermer tous les modals ouverts d'abord
            document.querySelectorAll('[id^="edit-sidebar-modal-"]').forEach(modal => {
                modal.classList.add('opacity-0');
                modal.classList.add('pointer-events-none');
            });

            const modal = document.getElementById('edit-sidebar-modal-' + sidebarMenuId);
            modal.classList.remove('opacity-0');
            modal.classList.remove('pointer-events-none');
        }

        function closeEditSidebarMenuModal(sidebarMenuId) {
            const modal = document.getElementById('edit-sidebar-modal-' + sidebarMenuId);
            modal.classList.add('opacity-0');
            modal.classList.add('pointer-events-none');
        }
        document.querySelectorAll('[id^="edit-sidebar-form-"]').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                const sidebarMenuId = this.getAttribute('data-sidebar-id');
                const formData = new FormData(this);

                const btn = document.querySelector(`#edit-sidebar-modal-${sidebarMenuId} button[type="submit"]`);
                const originalContent = btn.innerHTML;
                btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement en cours...';
                btn.disabled = true;

                formData.append('_method', 'PUT');

                fetch(`/admin/sidebar-menus/${sidebarMenuId}`, {
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
                        successDescription.textContent = data.description || 'Modification effectuée avec succès.';

                        showToast();
                        setTimeout(() => {
                            btn.innerHTML = originalContent;
                            btn.disabled = false;
                            btn.classList.remove('opacity-75', 'cursor-not-allowed');
                        }, 1200);
                        closeEditSidebarMenuModal(sidebarMenuId);
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