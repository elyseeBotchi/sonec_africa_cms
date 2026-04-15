@extends('admin.layout.appLayout')

@section('content')
    <header class="h-16 bg-white border-b border-slate-200 flex justify-between items-center px-8 z-10">
        <div class="flex items-center gap-4">
            <h2 id="header-title" class="text-xl font-bold text-sonec-dark">Vue d'ensemble</h2>
            <span id="status-badge" class="px-2 py-1 bg-green-100 text-green-700 text-xs font-bold rounded-md border border-green-200 hidden">Modifications en cours</span>
        </div>
        <div class="flex items-center gap-4">
            <a href="#" class="text-sm font-semibold text-slate-500 hover:text-sonec-green flex items-center gap-2">
                <i class="fas fa-external-link-alt"></i> Voir le site
            </a>
            <button onclick="saveAll(event)" class="bg-sonec-dark hover:bg-sonec-green text-white px-5 py-2 rounded-lg font-bold text-sm transition-all flex items-center gap-2 shadow-lg shadow-sonec-green/20">
                <i class="fas fa-save"></i> Enregistrer
            </button>
        </div>
    </header>
    <div class="flex-1 overflow-y-auto custom-scrollbar p-8">

        <div id="view-blog" class="max-w-5xl mx-auto">
            <div class="bg-white p-8 rounded-3xl shadow-sm border border-slate-100">
                <h3 class="text-lg font-bold text-sonec-dark mb-6">Article à la une</h3>
                <form id="create-article-form" class="space-y-4 overflow-y-auto custom-scrollbar" enctype="multipart/form-data">
                    
                    @csrf
                    <div id="form-errors" class="bg-red-100 text-red-500 mb-4 hidden"></div>
                    
                    <div>
                        <div class="preview-area-image-article bg-slate-50 rounded-xl p-4 flex items-center justify-center border border-slate-200 border-dashed">
                            <div class="text-center ">
                                <input id="image_article" type="file" class=" hidden w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold" accept="image/*" name="image_article">
                                <i class="fas fa-image text-3xl text-slate-300 mb-2"></i>
                                <p class="text-xs text-slate-400 mb-2">Aperçu image de couverture</p>
                                <label for="image_article" class="mt-2 text-xs bg-white px-3 py-1 rounded border hover:bg-slate-100 cursor-pointer">Changer</label>
                            </div>                        
                        </div>
                        <div class="mt-6">
                            <label for="image_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Url image (Si l'image existe en ligne)</label>
                            <input type="text" id="image_url" name="image_url" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-normal text-sm" placeholder="https://storage.googleapis.com/uxpilot-auth.appspot.com/avatars/avatar-5.jpg">
                        </div>

                        <div class="bg-blue-200 text-blue-700  mt-3 rounded-md px-5">
                            <i class="fas fa-info-circle"></i>
                            <small >
                                Si vous ne disposez pas d'image en sur votre machine locale, vous avez la possibilté de renseigner l'url de l'image. <br> Veuillez que l'image est obligatoire.
                            </small>
                        </div>
                    </div>
                    <div class="mt-6">
                        <label for="title" class="block text-xs font-bold text-slate-400 uppercase mb-1">Titre de l'article <span class="text-red-700">*</span> </label>
                        <input type="text" id="title" name="title" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md" placeholder="INNOVATION ECOLEWEB : L'IA AU SERVICE D'UN APPRENTISSAGE PERSONNALISÉ">
                        <input type="hidden" readonly id="slug" name="slug" class="mt-4 w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md" >
                        <input type="hidden" readonly id="user_id" name="user_id" class="mt-4 w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md" value="{{ auth()->user()->id }}" >
                        
                    </div>
                    <div class="grid grid-cols-3 gap-4 mt-4">
                        <div>
                            <label for="published_at" class="block text-xs font-bold text-slate-400 uppercase mb-1">Date</label>
                            <input type="date" id="published_at" name="published_at" class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm" placeholder="2024-01-15" value="{{ now()->format('Y-m-d') }}">
                        </div>
                        <div>
                            <label for="category_id" class="block text-xs font-bold text-slate-400 uppercase mb-1">Catégorie <span class="text-red-700">*</span> </label>
                            <select name="category_id" id="category_id" class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm">
                                @foreach($categorie_articles as $categorie)
                                    <option value="{{ $categorie->id }}">{{ $categorie->label }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label for="temps_lecture" class="block text-xs font-bold text-slate-400 uppercase mb-1">Temps de lecture</label>
                            <input type="text" id="temps_lecture" name="temps_lecture" class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm" placeholder="8 min">
                        </div>
                    </div>
                    <div class="mt-6">
                        <label for="description_courte" class="block text-xs font-bold text-slate-400 uppercase mb-1">Extrait <span class="text-red-700">*</span> </label>
                        <textarea id="description_courte" name="description_courte" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono" rows="6" placeholder="L'éducation entre dans une nouvelle ère. Avec l'intégration de l'intelligence artificielle, de la robotique et d'un assistant intelligent, Ecoleweb révolutionne l'apprentissage numérique en proposant une expérience plus personnalisée."></textarea>
                    </div>
                    <div class="mt-6">
                        <label for="notes" class="block text-xs font-bold text-slate-400 uppercase mb-1">Ajouter une note</label>
                        <textarea id="notes" name="notes" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono" rows="4"></textarea>
                    </div>
                    <div class="mt-6">
                        <label for="content" class="block text-xs font-bold text-slate-400 uppercase mb-1">Contenu de l'article  <span class="text-red-700">*</span> </label>
                        <textarea id="content" name="content" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-xl text-sm font-mono" rows="20"></textarea>
                    </div>

                    <div id="article-tags" class="mt-6 bg-gray-50 py-12">
                        <div class="container mx-auto px-6 lg:px-12">
                            <div class="max-w-4xl mx-auto">
                                <h3 class="text-xs font-bold text-gray-400 tracking-wider mb-5 uppercase">Tags</h3>
                                <div class="flex flex-wrap gap-3">
                                    @foreach ($tags as $tag )
                                        <label class="px-5 py-2.5 bg-white border border-gray-200 rounded-full text-sm font-medium text-sonec-dark hover:border-sonec-green hover:text-sonec-green hover:shadow-sm transition-all cursor-pointer">
                                            <input type="checkbox" name="tags[]" value="{{ $tag->id }}" class="hidden peer">
                                            {{ $tag->name }}
                                        </label>
                                    @endforeach
                                    {{-- <span class="px-5 py-2.5 bg-white border border-gray-200 rounded-full text-sm font-medium text-sonec-dark hover:border-sonec-green hover:text-sonec-green hover:shadow-sm transition-all cursor-pointer">Intelligence Artificielle</span> --}}
                                    
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-3 gap-4 mt-4">
                        <div>
                            <label for="author" class="block text-xs font-bold text-slate-400 uppercase mb-1">Auteur <span class="text-red-700">*</span> </label>
                            <input id="author" name="author" type="text" class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm" placeholder="Equipe Sonec Africa">
                        </div>
                        <div>
                            <label for="position_auteur" class="block text-xs font-bold text-slate-400 uppercase mb-1">Position/Fonction</label>
                            <input type="text" id="position_auteur" name="position_auteur" class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm" placeholder="Direction Innovation">
                        </div>
                        <div>
                            <label for="photo_auteur" class="block text-xs font-bold text-slate-400 uppercase mb-1">Photo</label>
                            <input type="file" name="photo_auteur" id="photo_auteur" class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm">
                        </div>
                        <div>
                            <label for="photo_auteur_url" class="block text-xs font-bold text-slate-400 uppercase mb-1">Photo URL (Si disponible en ligne)</label>
                            <input type="text" name="photo_auteur_url" id="photo_auteur_url" class="w-full p-2 bg-slate-50 border border-slate-200 rounded-lg text-sm" placeholder="https://storage.googleapis.com/uxpilot-auth.appspot.com/avatars/avatar-5.jpg">
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mt-4">
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="a_la_une" name="a_la_une" checked class="form-checkbox h-5 w-5 text-sonec-green focus:ring-sonec-green">
                            <label for="a_la_une" class="block text-sm font-medium text-slate-700">Article à la une</label> 
                        </div>
                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="activer_partage_reseaux_sociaux" name="activer_partage_reseaux_sociaux" class="form-checkbox h-5 w-5 text-sonec-green focus:ring-sonec-green">
                            <label for="activer_partage_reseaux_sociaux" class="block text-sm font-medium text-slate-700">Autoriser le partage sur les réseaux sociaux</label>
                        </div> 

                        <div class="flex items-center gap-2">
                            <input type="checkbox" id="is_published" name="is_published" checked class="form-checkbox h-5 w-5 text-sonec-green focus:ring-sonec-green">
                            <label for="is_published" class="block text-sm font-medium text-slate-700">Publier maintenant</label> 
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>

    <script>
        document.getElementById('title').addEventListener('input', function() {
            // Doire pourvoir gérer les accents et les caractères spéciaux comme "é" ou "ç" et les convertir en "e" et "c"
            const slug = this.value.toLowerCase()
                .normalize('NFD').replace(/[\u0300-\u036f]/g, '') 
                .replace(/[^a-z0-9]+/g, '-') 
                .replace(/^-+|-+$/g, '');
            document.getElementById('slug').value = 'article/'+slug;
        });
        
        // Si un tag est coché, ajouter la classe "bg-sonec-green" et "text-white", sinon les retirer
        document.querySelectorAll('input[name="tags[]"]').forEach(checkbox => { 
            checkbox.addEventListener('change', function() {
                if (this.checked) {
                    this.parentElement.classList.add('bg-sonec-green', 'text-white');
                    this.parentElement.classList.remove('border-gray-200');
                } else {
                    this.parentElement.classList.remove('bg-sonec-green', 'text-white');
                    this.parentElement.classList.add('border-gray-200');
                }
            });
        });
        
        document.getElementById('image_article').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    const previewContainer = document.querySelector('.preview-area-image-article');
                    let img = previewContainer.querySelector('img');
                    if (!img) {
                        img = document.createElement('img');
                        img.className = 'max-h-40 object-contain mb-2';
                        previewContainer.insertBefore(img, previewContainer.firstChild);
                    }
                    img.src = event.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        function saveAll(e){
            e.preventDefault();
             const form = document.getElementById('create-article-form');
            const formData = new FormData(form);

            formData.set('a_la_une', document.getElementById('a_la_une').checked ? 1 : 0);
            formData.set('activer_partage_reseaux_sociaux', document.getElementById('activer_partage_reseaux_sociaux').checked ? 1 : 0);
            formData.set('is_published', document.getElementById('is_published').checked ? 1 : 0);

            formData.append('page_key','actualites');

            // Recuperer le contenu de l'éditeur TinyMCE et l'ajouter au formData
            const content = tinymce.get('content').getContent();
            formData.set('content', content);

            // Recuper le contenu de extrait et l'ajouter au formData
            const description_courte = tinymce.get('description_courte').getContent();
            formData.set('description_courte', description_courte);

            // Recuperer le contenu de notes et l'ajouter au formData
            const notes = tinymce.get('notes').getContent();
            formData.set('notes', notes);
           
            const btn = document.querySelector('button[onclick="saveAll(event)"]');
            const originalContent = btn.innerHTML;
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement en cours...';
            btn.disabled = true;

            console.log('FormData entries:');
            for (let pair of formData.entries()) {
                console.log(pair[0]+ ': ' + pair[1]);
            }

            fetch("{{ route('articles.store') }}", {
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
                    // toggleCategorieModal();
                    successMessage.textContent = data.message || 'Enregistrement effectué !';
                    successDescription.textContent = data.description || 'Article enregistré avec succès.';

                    showToast();
                    setTimeout(() => {
                        btn.innerHTML = originalContent;
                        btn.disabled = false;
                        btn.classList.remove('opacity-75', 'cursor-not-allowed');
                        
                        statusBadge.classList.add('hidden');
                        form.reset();

                        // window.location.href = "{{ route('articles.index') }}";
                    }, 1200);                    

                } else {
                    showToastError();
                    btn.innerHTML = originalContent;
                    btn.disabled = false;
                    btn.classList.remove('opacity-75', 'cursor-not-allowed');

                    // Afficher les erreurs de validation
                    const errorsDiv = document.getElementById('form-errors');
                    errorsDiv.innerHTML = '';
                    const errorMessage = document.querySelector('#toastError .error-message');

                    if (data.errors) {
                        Object.values(data.errors).forEach(error => {
                            const errorP = document.createElement('p');
                            errorP.textContent = error[0];
                            errorMessage.textContent = error[0];
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
        }


    </script>

@endsection