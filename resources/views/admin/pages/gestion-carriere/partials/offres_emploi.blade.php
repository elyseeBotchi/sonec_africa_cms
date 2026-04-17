 <div class="flex-1 overflow-y-auto custom-scrollbar">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold text-sonec-dark">Offres d'emploi</h3>
            <button onclick="addOffreEmploi()" class="bg-sonec-green hover:bg-sonec-dark text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                <i class="fas fa-plus"></i> Ajouter une offre d'emploi
            </button>

        </div>
        <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Titre du poste</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Domaine</th>               
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Localisation</th>               
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Type de contrat</th>               
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Date de publication</th>               
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Date de clôture</th>               
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Statut</th>               
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Nombre de candidatures</th>               
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($offresEmploi as $offre)
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors cursor-move" data-id="{{ $offre->id }}">
                            <input type="hidden" class="offre-id" value="{{ $offre->id }}">
                            
                            <td class="px-6 py-4">{{ $offre->title }}</td>
                            <td class="px-6 py-4">{{ $offre->domaine }}</td>
                            <td class="px-6 py-4">{{ $offre->lieu }} - {{ $offre->bureauPays->pays }}</td>
                            <td class="px-6 py-4">{{ $offre->type_contrat }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($offre->created_at)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">{{ \Carbon\Carbon::parse($offre->date_expiration)->format('d/m/Y') }}</td>
                            <td class="px-6 py-4">
                                {{-- verifier sd'abord par date de publication et fermeture. --}}
                                @php
                                    $publication = \Carbon\Carbon::parse($offre->created_at);
                                    $expiration = \Carbon\Carbon::parse($offre->date_expiration);   
                                @endphp
                                @if($publication->lt($expiration))
                                    <span class="bg-green-500 text-white text-sm px-2 py-1 rounded">Ouvert</span>
                                @else
                                    <span class="bg-red-500 text-white text-sm px-2 py-1 rounded">Fermé</span>
                                @endif
                                {{-- {!! $offre->statut == 'ouvert' ? '<span class="text-green-500 font-bold">Ouvert</span>' : '<span class="text-red-500 font-bold">Fermé</span>' !!} --}}
                            </td>
                            <td class="px-6 py-4">{{ $offre->candidatures_count ?? 0 }}</td>
                            
                            
                            <td class="px-6 py-4 flex gap-2">
                                <button class="bg-transparent text-blue-500 px-3 py-1 text-sm transition-all flex items-center gap-1" onclick="editOffreEmploi({{ $offre->id }})">
                                    <i class="fas fa-pencil"></i>
                                </button>
                                <button class="bg-transparent text-red-500 px-3 py-1 text-sm transition-all flex items-center gap-1" onclick="deleteOffreEmploi({{ $offre->id }})" data-id="{{ $offre->id }}" data-label="{{ $offre->title }}" data-toggle="tooltip" data-title="Supprimer {{ $offre->title }}">
                                    <i class="fas fa-trash"></i> 
                                </button>
                            </td>
                        </tr>

                        <div id="edit-offre-emploi-modal-{{ $offre->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 ">
                            <div class=" bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative overflow-y-auto max-h-[70vh]" >
                                
                                <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="closeEditOffreEmploiModal({{ $offre->id }})">
                                    <i class="fas fa-times"></i>
                                </button>
                                <h2 class="text-xl font-bold text-sonec-dark mb-4">Modifier une offre</h2>
                                        
                                <div id="form-errors" class="bg-red-100 text-red-500 mb-4 hidden"></div>

                                <form id="edit-offre-emploi-form-{{ $offre->id }}" data-offre-emploi-id="{{ $offre->id }}" class="space-y-4 overflow-y-auto custom-scrollbar max-h-[70vh]" enctype="multipart/form-data">
                                    <input type="hidden" name="id" value="{{ $offre->id }}">
                                    {{-- Libellé --}}
                                    <div>
                                        <label for="title-{{ $offre->id }}" class="block text-sm font-medium text-slate-700">Titre du poste</label>
                                        <input type="text" id="title-{{ $offre->id }}" name="title" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $offre->title }}">
                                    </div>
                                    <div>
                                        <label for="bureau_pays_id-{{ $offre->id }}" class="block text-sm font-medium text-slate-700">Pays</label>
                                        {{-- <input type="text" id="domaine" name="domaine" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">  --}}
                                        <select id="bureau_pays_id-{{ $offre->id }}" name="bureau_pays_id" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                            <option value="">Sélectionnez un pays</option>
                                            
                                            @foreach($bureauxPays as $pays)
                                                <option {{ $pays->id == $offre->bureau_pays_id ? 'selected' : '' }} value="{{ $pays->id }}">{{ $pays->pays }}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                    <div>
                                        <label for="domaine-{{ $offre->id }}" class="block text-sm font-medium text-slate-700">Domaine</label>
                                        {{-- <input type="text" id="domaine" name="domaine" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">  --}}
                                        <select id="domaine-{{ $offre->id }}" name="domaine" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                            <option value="">Sélectionnez un domaine</option>
                                            <option {{ $offre->domaine == 'technologie_et_developpement' ? 'selected' : '' }} value="technologie_et_developpement">Technologie & développement</option>
                                            <option {{ $offre->domaine == 'commercial_et_vente' ? 'selected' : '' }} value="commercial_et_vente">Commercial & vente</option>
                                            <option {{ $offre->domaine == 'marketing_et_communication' ? 'selected' : '' }} value="marketing_et_communication">Marketing & communication</option>
                                            <option {{ $offre->domaine == 'support_client' ? 'selected' : '' }} value="support_client">Support client</option>
                                            <option {{ $offre->domaine == 'administration' ? 'selected' : '' }} value="administration">Administration</option>
                                            {{-- @foreach($domaines as $domaine)
                                                <option value="{{ $domaine->id }}">{{ $domaine->label }}</option>
                                            @endforeach --}}
                                        </select>

                                    </div>
                                    <div>
                                        <label for="lieu-{{ $offre->id }}" class="block text-sm font-medium text-slate-700">Localisation</label>
                                        <input type="text" id="lieu-{{ $offre->id }}" name="lieu" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $offre->lieu }}">    
                                    </div>
                                    <div>
                                        <label for="type_contrat-{{ $offre->id }}" class="block text-sm font-medium text-slate-700">Type de contrat</label>
                                        <input type="text" id="type_contrat-{{ $offre->id }}" name="type_contrat" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $offre->type_contrat }}">  
                                    </div>
                                    <div>
                                        <label for="niveau_experience-{{ $offre->id }}" class="block text-sm font-medium text-slate-700">Niveau d'expérience</label>
                                        <input type="text" id="niveau_experience-{{ $offre->id }}" name="niveau_experience" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $offre->niveau_experience }}"> 
                                    </div>
                                    <div>
                                        <label for="salaire-{{ $offre->id }}" class="block text-sm font-medium text-slate-700">Salaire</label>
                                        <input type="text" id="salaire-{{ $offre->id }}" name="salaire" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $offre->salaire }}"> 
                                    </div>
                                    <div>
                                        <label for="date_expiration-{{ $offre->id }}" class="block text-sm font-medium text-slate-700">Date de clôture</label>
                                        <input type="date" id="date_expiration-{{ $offre->id }}" name="date_expiration" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $offre->date_expiration->format('Y-m-d') }}"> 
                                    </div>
                                    <div>
                                        <label for="description-{{ $offre->id }}" class="block text-sm font-medium text-slate-700">Description</label>
                                        <textarea id="description-{{ $offre->id }}" name="description" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" rows="5">{{ $offre->description }}</textarea>  
                                    </div>
                                    <div>
                                        <label for="missions-{{ $offre->id }}" class="block text-sm font-medium text-slate-700">Responsabilités</label>
                                        <textarea id="missions-{{ $offre->id }}" name="missions" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" rows="5">{{ $offre->missions }}</textarea>  
                                    </div>
                                    <div>
                                        <label for="avantages-{{ $offre->id }}" class="block text-sm font-medium text-slate-700">Avantages</label>
                                        <textarea id="avantages-{{ $offre->id }}" name="avantages" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" rows="5">{{ $offre->avantages }}</textarea>  
                                    </div>
                                    <div>
                                        <label for="profil_recherche-{{ $offre->id }}" class="block text-sm font-medium text-slate-700">Profil recherché/Qualifications</label>
                                        <textarea id="profil_recherche-{{ $offre->id }}" name="profil_recherche" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" rows="5">{{ $offre->profil_recherche }}</textarea>  
                                    </div>
                                    <div>
                                        <label for="status-{{ $offre->id }}" class="block text-sm font-medium text-slate-700">Statut</label>
                                        <select id="status-{{ $offre->id }}" name="status" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                                            <option value="ouvert" {{ $offre->status === 'ouvert' ? 'selected' : '' }}>Ouvert</option>
                                            <option value="ferme" {{ $offre->status === 'ferme' ? 'selected' : '' }}>Fermé</option>
                                        </select>
                                    </div>
                                    {{-- contact email --}}
                                    <div>
                                        <label for="email_contact-{{ $offre->id }}" class="block text-sm font-medium text-slate-700">Email de contact</label>
                                        <input type="email" id="email_contact-{{ $offre->id }}" name="email_contact" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" value="{{ $offre->email_contact }}">   
                                    </div>

                                    <!-- Autres champs comme icon, image, position, etc. -->
                                    <button type="submit" class="w-full bg-sonec-green hover:bg-sonec-dark text-white py-2 px-4 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                                        <i class="fas fa-save"></i> Enregistrer
                                    </button>
                                </form>
                            </div>
                        </div>


                        <div id="delete-offre-emploi-modal-{{ $offre->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 " >
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative " >
                                
                                <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="closeDeleteOffreEmploiModal({{ $offre->id }})">
                                    <i class="fas fa-times"></i>
                                </button>
                                <h2 class="text-xl font-bold text-sonec-dark mb-4">Confirmer la suppression</h2>
                                
                                <p class="mb-6 text-slate-700">Êtes-vous sûr de vouloir supprimer l'offre <span class="font-bold">{{ $offre->label }}</span> ? Cette action est irréversible.</p>

                                <div class="flex justify-end gap-4">
                                    <button onclick="closeDeleteOffreEmploiModal({{ $offre->id }})" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md font-bold text-sm transition-all">
                                        Annuler
                                    </button>
                                    <button onclick="deleteOffreEmploi({{ $offre->id }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2">
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
<div id="offre-emploi-modal" class="w-full fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 ">
    <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative " >
        
        <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="toggleOffreEmploiModal()">
            <i class="fas fa-times"></i>
        </button>
        <h2 class="text-xl font-bold text-sonec-dark mb-4">Ajouter une offre d'emploi</h2>
        
        {{-- Afficher les messages d'erreur --}}
        <div id="form-errors" class="bg-red-100 text-red-500 mb-4 hidden"></div>

        <form id="offre-emploi-form" class="space-y-4 overflow-y-auto custom-scrollbar max-h-[70vh]" enctype="multipart/form-data">
            <input type="hidden" name="section_key" value="offres_emploi">
            <input type="hidden" name="slug" id="slug">
            {{-- Libellé --}}
            <div>
                <label for="title" class="block text-sm font-medium text-slate-700">Titre du poste</label>
                <input type="text" id="title" name="title" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none"> 
            </div>
            <div>
                <label for="bureau_pays_id" class="block text-sm font-medium text-slate-700">Pays</label>
                {{-- <input type="text" id="domaine" name="domaine" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">  --}}
                <select id="bureau_pays_id" name="bureau_pays_id" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                    <option value="">Sélectionnez un pays</option>
                    
                    @foreach($bureauxPays as $pays)
                        <option value="{{ $pays->id }}">{{ $pays->pays }}</option>
                    @endforeach
                </select>

            </div>
            <div>
                <label for="domaine" class="block text-sm font-medium text-slate-700">Domaine</label>
                {{-- <input type="text" id="domaine" name="domaine" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">  --}}
                <select id="domaine" name="domaine" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                    <option value="">Sélectionnez un domaine</option>
                    <option value="technologie_et_developpement">Technologie & développement</option>
                    <option value="commercial_et_vente">Commercial & vente</option>
                    <option value="marketing_et_communication">Marketing & communication</option>
                    <option value="support_client">Support client</option>
                    <option value="administration">Administration</option>
                    {{-- @foreach($domaines as $domaine)
                        <option value="{{ $domaine->id }}">{{ $domaine->label }}</option>
                    @endforeach --}}
                </select>

            </div>
            <div>
                <label for="lieu" class="block text-sm font-medium text-slate-700">Localisation</label>
                <input type="text" id="lieu" name="lieu" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">   
            </div>
            <div>
                <label for="type_contrat" class="block text-sm font-medium text-slate-700">Type de contrat</label>
                <input type="text" id="type_contrat" name="type_contrat" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">   
            </div>
            <div>
                <label for="niveau_experience" class="block text-sm font-medium text-slate-700">Niveau d'expérience</label>
                <input type="text" id="niveau_experience" name="niveau_experience" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none"> 
            </div>
            <div>
                <label for="salaire" class="block text-sm font-medium text-slate-700">Salaire</label>
                <input type="text" id="salaire" name="salaire" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none"> 
            </div>
            <div>
                <label for="date_expiration" class="block text-sm font-medium text-slate-700">Date de clôture</label>
                <input type="date" id="date_expiration" name="date_expiration" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none"> 
            </div>
            <div>
                <label for="description" class="block text-sm font-medium text-slate-700">Description</label>
                <textarea id="description" name="description" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" rows="5"></textarea>  
            </div>
            <div>
                <label for="missions" class="block text-sm font-medium text-slate-700">Responsabilités</label>
                <textarea id="missions" name="missions" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" rows="5"></textarea>  
            </div>
            <div>
                <label for="avantages" class="block text-sm font-medium text-slate-700">Qualifications</label>
                <textarea id="avantages" name="avantages" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" rows="5"></textarea>  
            </div>
            <div>
                <label for="profil_recherche" class="block text-sm font-medium text-slate-700">Profil recherché</label>
                <textarea id="profil_recherche" name="profil_recherche" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" rows="5"></textarea>  
            </div>
            <div>
                <label for="status" class="block text-sm font-medium text-slate-700">Statut</label>
                <select id="status" name="status" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">
                    <option value="ouvert">Ouvert</option>
                    <option value="ferme">Fermé</option>
                </select>
            </div>
            {{-- contact email --}}
            <div>
                <label for="email_contact" class="block text-sm font-medium text-slate-700">Email de contact</label>
                <input type="email" id="email_contact" name="email_contact" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none">    
            </div>
            <button type="submit" class="w-full bg-sonec-green hover:bg-sonec-dark text-white py-2 px-4 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                <i class="fas fa-save"></i> Enregistrer
            </button>
        </form>
    </div>
</div>
