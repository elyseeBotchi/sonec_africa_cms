@extends('web.layout.websiteLayout')

@section('content')
    <main>
            <section id="careers-hero" class="relative bg-sonec-dark pt-32 pb-20 md:pt-40 md:pb-28 text-white h-[550px]">
                <div class="absolute inset-0 overflow-hidden">
                    <img class="w-full h-full object-cover opacity-20" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/98ba9d13ea-d84dfb16327d103fdb93.png" alt="diverse team of african tech professionals collaborating in a modern office, cinematic lighting, panoramic shot" />
                </div>
                <div id="careers-hero-content" class="container mx-auto px-6 relative z-10 text-center">
                    <h1 class="text-4xl md:text-6xl font-extrabold mb-4 leading-tight">
                        Rejoignez une <span class="text-sonec-lime">Aventure Panafricaine</span>
                    </h1>
                    <p class="text-lg md:text-xl max-w-3xl mx-auto mb-12 text-gray-300">
                        Chez SONEC AFRICA, nous bâtissons l'avenir numérique du continent. Contribuez à des projets innovants qui ont un impact réel et développez votre potentiel au sein d'une équipe dynamique et passionnée.
                    </p>
                    <div id="why-join-us" class="grid grid-cols-1 md:grid-cols-3 gap-8 max-w-4xl mx-auto">
                        <div id="benefit-1" class="flex flex-col items-center">
                            <div class="bg-sonec-green/20 text-sonec-lime rounded-full h-16 w-16 flex items-center justify-center mb-4">
                                <i class="fa-solid fa-lightbulb text-3xl"></i>
                            </div>
                            <h3 class="font-bold text-xl">Innovation</h3>
                            <p class="text-gray-400 text-center">Travaillez sur des technologies de pointe.</p>
                        </div>
                        <div id="benefit-2" class="flex flex-col items-center">
                            <div class="bg-sonec-green/20 text-sonec-lime rounded-full h-16 w-16 flex items-center justify-center mb-4">
                                <i class="fa-solid fa-globe-africa text-3xl"></i>
                            </div>
                            <h3 class="font-bold text-xl">Impact</h3>
                            <p class="text-gray-400 text-center">Participez à la transformation de l'Afrique.</p>
                        </div>
                        <div id="benefit-3" class="flex flex-col items-center">
                            <div class="bg-sonec-green/20 text-sonec-lime rounded-full h-16 w-16 flex items-center justify-center mb-4">
                                <i class="fa-solid fa-arrow-trend-up text-3xl"></i>
                            </div>
                            <h3 class="font-bold text-xl">Croissance</h3>
                            <p class="text-gray-400 text-center">Développez vos compétences et votre carrière.</p>
                        </div>
                    </div>
                </div>
            </section>
            
            <section id="job-listings-section" class="py-20 lg:py-28 bg-white">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-12">
                        <h2 class="text-3xl lg:text-4xl font-bold text-sonec-dark mb-4">Nos Offres d'Emploi</h2>
                        <p class="max-w-2xl mx-auto text-gray-600">
                            Trouvez l'opportunité qui correspond à votre talent et à vos ambitions.
                        </p>
                    </div>

                    <div id="job-filters" class="mb-10 p-6 bg-gray-50 rounded-lg border flex flex-col md:flex-row items-center gap-4">
                        <div class="w-full md:w-1/3 relative">
                            <label for="country-filter" class="font-semibold text-gray-700 sr-only">Pays</label>
                            <i class="fa-solid fa-map-marker-alt absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <select id="country-filter" class="custom-select w-full pl-10 pr-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-sonec-lime focus:border-sonec-green transition">
                                <option value="all">Tous les pays</option>
                                @foreach ($bureaux as $bureau )                                    
                                    <option value="{{ $bureau->id }}">{{ $bureau->pays }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="w-full md:w-1/3 relative">
                            <label for="domain-filter" class="font-semibold text-gray-700 sr-only">Domaine</label>
                            <i class="fa-solid fa-briefcase absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                            <select id="domain-filter" class="custom-select w-full pl-10 pr-4 py-3 border border-gray-300 rounded-md focus:ring-2 focus:ring-sonec-lime focus:border-sonec-green transition">
                                <option value="all">Tous les domaines</option>
                                <option value="technologie_et_developpement">Technologie & Développement</option>
                                <option value="commercial_et_vente">Commercial & Vente</option>
                                <option value="marketing_et_communication">Marketing & Communication</option>
                                <option value="support_client">Support Client</option>
                                <option value="administration">Administration</option>
                            </select>
                        </div>
                        <button onclick="filterJobs()" class="w-full md:w-auto bg-sonec-green text-white font-bold py-3 px-8 rounded-md hover:bg-sonec-dark transition duration-300">
                            Rechercher
                        </button>
                    </div>

                    <div id="job-list" class="space-y-6">
                        @foreach ($offres as $offre)
                            <div id="job-card-{{ $offre->id }}" class="job-card bg-white border border-gray-200 rounded-lg p-6 flex flex-col md:flex-row justify-between items-center" data-country="{{ $offre->bureauPays->id ?? '' }}" data-domain="{{ $offre->domaine ?? '' }}">
                                <div>
                                    <h3 class="text-xl font-bold text-sonec-dark">{{ $offre->title }}</h3>
                                    <div class="flex items-center text-gray-500 mt-2 space-x-4">
                                        <span class="flex items-center"><i class="fa-solid fa-briefcase mr-2 text-sonec-green"></i>{{ $offre->domaine }}</span>
                                        <span class="flex items-center"><i class="fa-solid fa-map-marker-alt mr-2 text-sonec-green"></i>{{ $offre->lieu }}, {{ $offre->bureauPays->pays ?? '' }}</span>
                                        <span class="flex items-center"><i class="fa-solid fa-clock mr-2 text-sonec-green"></i>{{ $offre->type_contrat }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('web.carrieres.show', $offre->slug) }}" class="mt-4 md:mt-0 bg-sonec-lime text-sonec-dark font-bold py-2 px-5 rounded-full hover:bg-sonec-dark hover:text-white transition duration-300 whitespace-nowrap">
                                    Voir l'offre
                                </a>
                            </div>
                        @endforeach                       
                    </div>
                </div>
            </section>
            
            <section id="spontaneous-application-section" class="bg-gray-50 py-20 lg:py-28">
                <div class="container mx-auto px-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                        <div id="application-intro-text">
                            <h2 class="text-3xl lg:text-4xl font-bold text-sonec-dark mb-4">Aucune offre ne vous correspond ?</h2>
                            <p class="text-gray-600 mb-6 text-lg">
                                Nous sommes toujours à la recherche de talents exceptionnels. Si vous êtes passionné par la technologie et l'Afrique, envoyez-nous votre candidature spontanée. Nous serons ravis d'étudier votre profil.
                            </p>
                            <div class="space-y-4">
                                <div class="flex items-start">
                                    <i class="fa-solid fa-check-circle text-sonec-green mt-1 mr-3"></i>
                                    <p class="text-gray-700">Votre profil sera ajouté à notre vivier de talents pour les futures opportunités.</p>
                                </div>
                                <div class="flex items-start">
                                    <i class="fa-solid fa-check-circle text-sonec-green mt-1 mr-3"></i>
                                    <p class="text-gray-700">Nous vous contacterons dès qu'un poste correspondant à vos compétences se libère.</p>
                                </div>
                            </div>
                        </div>
                        <div id="application-form-container" class="bg-white p-8 rounded-lg shadow-lg border">
                            <h3 class="text-2xl font-bold text-sonec-dark mb-6">Candidature Spontanée</h3>
                            <form id="application-form" class="space-y-6" method="POST" action="#" enctype="multipart/form-data">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                        <label for="first-name" class="block text-sm font-medium text-gray-700 mb-1">Prénom <span class="text-red-500">*</span></label>
                                        <input type="text" id="first-name" name="prenom" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md transition" placeholder="Votre prénom">
                                    </div>
                                    <div>
                                        <label for="last-name" class="block text-sm font-medium text-gray-700 mb-1">Nom <span class="text-red-500">*</span></label>
                                        <input type="text" id="last-name" name="nom" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md transition" placeholder="Votre nom">
                                    </div>
                                </div>
                                <div>
                                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email <span class="text-red-500">*</span></label>
                                    <input type="email" id="email" name="email" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md transition" placeholder="Votre adresse email">
                                </div>
                                <div>
                                    <label for="cv-upload" class="block text-sm font-medium text-gray-700 mb-1">Votre CV <span class="text-red-500">*</span></label>
                                    <input type="file" id="cv-upload" name="cv" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-md file:border-0 file:text-sm file:font-semibold file:bg-sonec-lime/20 file:text-sonec-green hover:file:bg-sonec-lime/40 transition">
                                    <p class="text-xs text-gray-500 mt-1">PDF, DOC, DOCX (Max. 5MB)</p>
                                </div>
                                <div>
                                    <label for="cover-letter" class="block text-sm font-medium text-gray-700 mb-1">Lettre de motivation (Optionnel)</label>
                                    <textarea id="cover-letter" name="lettre_motivation" rows="4" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md transition" placeholder="Parlez-nous de vous..."></textarea>
                                </div>
                                <button type="submit" class="w-full bg-sonec-green text-white font-bold py-3 px-6 rounded-md hover:bg-sonec-dark transition duration-300 transform hover:scale-105">
                                    Envoyer ma candidature
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>
        </main>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const countryFilter = document.getElementById('country-filter');
                const domainFilter  = document.getElementById('domain-filter');
                const jobCards      = document.querySelectorAll('.job-card');
                const jobList       = document.getElementById('job-list');

                function filterJobs() {
                    const selectedCountry = countryFilter.value;
                    const selectedDomain  = domainFilter.value;
                    let visibleCount = 0;

                    jobCards.forEach(card => {
                        const matchCountry = selectedCountry === 'all' || card.dataset.country === selectedCountry;
                        const matchDomain  = selectedDomain  === 'all' || card.dataset.domain  === selectedDomain;

                        if (matchCountry && matchDomain) {
                            card.style.display = '';
                            visibleCount++;
                        } else {
                            card.style.display = 'none';
                        }
                    });

                    // Message si aucun résultat
                    const emptyMsg = document.getElementById('no-results');
                    if (visibleCount === 0) {
                        if (!emptyMsg) {
                            const msg = document.createElement('div');
                            msg.id = 'no-results';
                            msg.className = 'text-center py-16 text-gray-500';
                            msg.innerHTML = '<i class="fa-solid fa-search text-4xl mb-4 block text-gray-300"></i>Aucune offre ne correspond à votre recherche.';
                            jobList.appendChild(msg);
                        }
                    } else {
                        if (emptyMsg) emptyMsg.remove();
                    }
                }

                // Filtrage en temps réel au changement de select
                countryFilter.addEventListener('change', filterJobs);
                domainFilter.addEventListener('change', filterJobs);

                // Bouton Rechercher (optionnel, déclenche aussi le filtre)
                document.querySelector('#job-filters button').addEventListener('click', filterJobs);
            });
        </script>
        <script>
            document.addEventListener('DOMContentLoaded', function () {
                const form       = document.getElementById('application-form');
                const submitBtn  = form.querySelector('button[type="submit"]');

                form.addEventListener('submit', async function (e) {
                    e.preventDefault();

                    // Reset erreurs
                    clearErrors();

                    // Récupération des données
                    const formData = new FormData();
                    formData.append('prenom',            document.getElementById('first-name').value);
                    formData.append('nom',               document.getElementById('last-name').value);
                    formData.append('email',             document.getElementById('email').value);
                    formData.append('lettre_motivation', document.getElementById('cover-letter').value);

                    const cvFile = document.getElementById('cv-upload').files[0];
                    if (cvFile) formData.append('cv', cvFile);

                    // État chargement
                    setLoading(true);

                    console.log('Envoi de la candidature spontanée...',formData.get('prenom'), formData.get('nom'), formData.get('email'), formData.get('cv'), formData.get('lettre_motivation'));

                    try {
                        const response = await fetch('{{ route("web.carrieres.candidature.store") }}', {
                            method: 'POST',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                                'Accept': 'application/json',
                            },
                            body: formData,
                        });

                        const data = await response.json();

                        if (response.ok && data.success === true) {
                            showSuccess(data.message);
                            form.reset();
                        } else if (response.status === 422) {
                            // Erreurs de validation Laravel
                            showValidationErrors(data.errors);
                        } else {
                            // recupérer message d'erreur du serveur si disponible
                            const errorMsg = data.message || 'Une erreur est survenue. Veuillez réessayer.';
                            showAlert('error', 'Une erreur est survenue. Veuillez réessayer.');
                            showAlert(errorMsg)
                        }
                    } catch (err) {
                        showAlert('error', 'Impossible de contacter le serveur. Vérifiez votre connexion.');
                        // Afficher l'erreur serveur pour le développement
                        console.error('Erreur lors de l\'envoi de la candidature spontanée :', err);
                    } finally {
                        setLoading(false);
                    }
                });

                // ── Helpers ──────────────────────────────────────────────

                function setLoading(loading) {
                    if (loading) {
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = `
                            <span class="inline-flex items-center gap-2">
                                <svg class="animate-spin h-5 w-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8z"></path>
                                </svg>
                                Envoi en cours...
                            </span>`;
                    } else {
                        submitBtn.disabled = false;
                        submitBtn.innerHTML = 'Envoyer ma candidature';
                    }
                }

                function showValidationErrors(errors) {
                    const fieldMap = {
                        prenom:            'first-name',
                        nom:               'last-name',
                        email:             'email',
                        cv:                'cv-upload',
                        lettre_motivation: 'cover-letter',
                    };

                    Object.entries(errors).forEach(([field, messages]) => {
                        const inputId = fieldMap[field];
                        const input   = document.getElementById(inputId);
                        if (!input) return;

                        input.classList.add('border-red-500', 'ring-1', 'ring-red-400');

                        const errorEl = document.createElement('p');
                        errorEl.className   = 'field-error text-red-500 text-xs mt-1';
                        errorEl.textContent = messages[0];
                        input.parentElement.appendChild(errorEl);
                    });
                }

                function clearErrors() {
                    document.querySelectorAll('.field-error').forEach(el => el.remove());
                    document.querySelectorAll('.border-red-500').forEach(el => {
                        el.classList.remove('border-red-500', 'ring-1', 'ring-red-400');
                    });
                    const alert = document.getElementById('form-alert');
                    if (alert) alert.remove();
                }

                function showSuccess(message) {
                    const container = document.getElementById('application-form-container');
                    container.innerHTML = `
                        <div class="flex flex-col items-center justify-center py-16 text-center">
                            <div class="w-20 h-20 bg-sonec-green/10 rounded-full flex items-center justify-center mb-6">
                                <i class="fa-solid fa-check text-sonec-green text-4xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-sonec-dark mb-3">Candidature envoyée !</h3>
                            <p class="text-gray-600 max-w-sm">${message}</p>
                        </div>`;
                }

                function showAlert(type, message) {
                    const existing = document.getElementById('form-alert');
                    if (existing) existing.remove();

                    const alert = document.createElement('div');
                    alert.id = 'form-alert';
                    alert.className = `mb-4 px-4 py-3 rounded-md text-sm font-medium ${
                        type === 'error'
                            ? 'bg-red-50 text-red-700 border border-red-200'
                            : 'bg-green-50 text-green-700 border border-green-200'
                    }`;
                    alert.innerHTML = `<i class="fa-solid fa-${type === 'error' ? 'circle-exclamation' : 'check'} mr-2"></i>${message}`;
                    form.prepend(alert);
                }
            });
        </script>
@endsection