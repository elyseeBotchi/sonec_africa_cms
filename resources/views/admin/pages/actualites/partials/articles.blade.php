 <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
    <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
        <div class="p-6 border-b border-slate-100 flex justify-between items-center">
            <h3 class="font-bold text-sonec-dark">Articles</h3>
            <button onclick="addArticleItem()" class="bg-sonec-green hover:bg-sonec-dark text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                <i class="fas fa-plus"></i> Ajouter un article
            </button>

        </div>
        <div class="flex-1 overflow-y-auto custom-scrollbar p-8">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50">
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Image</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Titre</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Slug</th>               
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Catégorie</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Auteur</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Temps de lecture</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Date publication</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Tags</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Nombre de Vues</th>
                        <th class="px-6 py-3 text-xs font-bold text-slate-400 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($articles as $article)
                        <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors cursor-move" data-id="{{ $article->id }}">
                            <input type="hidden" class="article-id" value="{{ $article->id }}">
                            {{-- recuperer image ou image_url --}}
                            <td class="px-6 py-4"><img src="{{ $article->image_url ?? asset('storage/' . $article->image_article) }}" alt="{{ $article->title }}" class="w-16 h-16 object-cover rounded-md"></td>
                            <td class="px-6 py-4 text-md">{{ $article->title }}</td>
                            <td class="px-6 py-4 text-xs">{{ $article->slug }}</td>
                            <td class="px-6 py-4">{{ $article->category ? $article->category->label : 'N/A' }}</td>
                            <td class="px-6 py-4">{{ $article->author }}</td>
                            <td class="px-6 py-4 text-sm">{{ $article->temps_lecture }} de lecture</td>
                            <td class="px-6 py-4">{{ $article->published_at ? $article->published_at->format('d M Y') : 'N/A' }}</td>
                            <td class="px-6 py-4">
                                @foreach($article->tags as $tag)
                                    <span class="inline-block bg-sonec-green text-white text-xs px-2 py-1 rounded-full mr-1">{{ $tag->name }}</span>
                                @endforeach
                            </td>
                            <td class="px-6 py-4">{{ $article->views }}</td>

                            
                            <td class="px-6 py-4 flex gap-2">
                                <a href="{{ route('articles.edit',['article'=> $article->id]) }}" class="bg-transparent text-blue-500 px-3 py-1 text-sm transition-all flex items-center gap-1">
                                    <i class="fas fa-pencil"></i>
                                </a>
                                <button class="bg-transparent text-red-500 px-3 py-1 text-sm transition-all flex items-center gap-1" onclick="deleteArticleItem({{ $article->id }})" data-id="{{ $article->id }}" data-label="{{ $article->label }}" data-toggle="tooltip" data-title="Supprimer {{ $article->label }}">
                                    <i class="fas fa-trash"></i> 
                                </button>
                            </td>
                        </tr>                        


                        <div id="delete-article-modal-{{ $article->id }}" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center opacity-0 pointer-events-none transition-opacity z-50 " >
                            <div class="bg-white rounded-lg shadow-lg w-full max-w-md p-6 relative " >
                                
                                <button class="absolute top-4 right-4 text-slate-400 hover:text-slate-600 focus:outline-none" onclick="closeDeleteArticleModal({{ $article->id }})">
                                    <i class="fas fa-times"></i>
                                </button>
                                <h2 class="text-xl font-bold text-sonec-dark mb-4">Confirmer la suppression</h2>
                                
                                <p class="mb-6 text-slate-700">Êtes-vous sûr de vouloir supprimer cet article <span class="font-bold">{{ $article->label }}</span> ? Cette action est irréversible.</p>

                                <div class="flex justify-end gap-4">
                                    <button onclick="closeDeleteArticleModal({{ $article->id }})" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-md font-bold text-sm transition-all">
                                        Annuler
                                    </button>
                                    <button onclick="deleteArticleItem({{ $article->id }})" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md font-bold text-sm transition-all flex items-center gap-2">
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


