@extends('admin.layout.appLayout')

@section('content')
    <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
        <div class="flex items-center gap-4">
            <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Gestion des Messages</h2>
            <span id="status-badge" class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-md border border-green-200 hidden">Modifications en cours ...</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="{{ route('web.home') }}" target="_blank" class="text-sm font-semibold text-slate-500 hover:text-sonec-green flex items-center gap-2">
                <i class="fas fa-external-link-alt"></i> Voir le site
            </a>
        </div>
    </header>
    <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
            <div class="p-6 border-b border-slate-100 flex justify-between items-center">
                <h3 class="font-bold text-sonec-dark">Messages</h3>

               

            </div>
            <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-slate-50">
                            {{-- <th></th> --}}
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Nom</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Prénom(s)</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Sujet</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Message</th>
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Date</th>                          
                            <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($messages as $message)
                            {{-- possibilite de drag and drop pour changer la position des elements --}}
                            <tr class="text-sm border-b border-slate-100 hover:bg-slate-50 transition-colors cursor-move {{ is_null($message->read_at) ? 'bg-slate-100 font-bold' : '' }}" data-id="{{ $message->id ?? '' }}">
                                <input type="hidden" class="message-id" value="{{ $message->id ?? '' }}">
                              
                                <td class="px-6 py-4">{{ $message->nom ?? '' }}</td>
                                <td class="px-6 py-4">{{ $message->prenom ?? '' }}</td>
                                <td class="px-6 py-4">{{ $message->email ?? '' }}</td>
                                <td class="px-6 py-4">{{ $message->sujet ?? '' }}</td>
                                <td class="px-6 py-4">{{ $message->message ?? '' }}</td>
                                <td class="px-6 py-4 text-sm">{{ $message->created_at ?? '' }}</td>
                                
                                
                               
                                <td class="px-6 py-4 flex gap-2">
                                        <button class="bg-transparent text-blue-500 px-3 py-1 text-sm transition-all flex items-center gap-1" onclick="viewMessage({{ $message->id ?? '' }})">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                    <button class="bg-transparent text-red-500 px-3 py-1 text-sm transition-all flex items-center gap-1" onclick="deleteMessage({{ $message->id ?? '' }})" data-id="{{ $message->id ?? '' }}" data-label="{{ $message->label ?? '' }}" data-toggle="tooltip" data-title="Supprimer {{ $message->label ?? '' }}">
                                        <i class="fas fa-trash"></i> 
                                    </button>
                                </td>
                            </tr>

                          
                            {{-- Modal de confirmation de suppression   --}}
                            {{-- <div id="delete-menu-modal-{{ $menu->id ?? '' }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 ">
                                <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative " >
                                    
                                    <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="closeDeleteMenuModal({{ $menu->id ?? '' }})">
                                        <i class="fas fa-times"></i>
                                    </button>
                                    <h2 class="text-xl font-bold text-sonec-dark mb-4">Confirmer la suppression</h2>
                                    
                                    <p class="mb-6 text-slate-700">Êtes-vous sûr de vouloir supprimer le menu <span class="font-bold">{{ $menu->label }}</span> ? Cette action est irréversible.</p>

                                    <div class="flex justify-end gap-4">
                                        <button onclick="closeDeleteMenuModal({{ $menu->id ?? '' }})" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md font-bold text-sm transition-all">
                                            Annuler
                                        </button>
                                        <button onclick="confirmDeleteMenu({{ $menu->id ?? '' }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2">
                                            <i class="fas fa-trash"></i> Supprimer
                                        </button>
                                    </div>
                                </div>
                            </div> --}}
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
        
    </div>
@endsection