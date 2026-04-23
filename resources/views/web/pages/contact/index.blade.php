@extends('web.layout.websiteLayout')

@section('content')

    <main class="pt-20">

        {{-- Section hero --}}
        <section id="hero-header" class="relative h-[500px] bg-sonec-dark overflow-hidden">
            <div class="absolute inset-0 opacity-10">
                <img class="w-full h-full object-cover" src="{{get_decouvrir_sonec_africa_content()['banniere']->image_url ?? asset('storage/'.get_decouvrir_sonec_africa_content()['banniere']->image)}}" alt="{{get_decouvrir_sonec_africa_content()['banniere']->title}}" />
            </div>
            <div class="relative container mx-auto px-6 h-full flex items-center">
                <div class="max-w-3xl text-center mx-auto">
                    <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">Contactez-nous</h1>
                    <p class="text-2xl text-gray-300 leading-relaxed">
                        Vous avez des questions, des suggestions ou souhaitez en savoir plus sur nos services ? N'hésitez pas à nous contacter ! Notre équipe est là pour vous aider.
                    </p>
                </div>
            </div>
        </section>

        <section id="spontaneous-application-section" class="bg-gray-50 py-20 lg:py-28">
                <div class="container mx-auto px-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">
                        <div id="application-intro-text">
                            <h2 class="text-3xl lg:text-4xl font-bold text-sonec-dark mb-4">
                                Vous avez des questions ?
                            </h2>
                            <p class="text-gray-600 mb-6 text-lg">
                                Que vous soyez un client potentiel, un partenaire ou simplement curieux d'en savoir plus sur Sonec Africa, nous sommes là pour vous aider. N'hésitez pas à nous envoyer un message en utilisant le formulaire à droite, ou à nous contacter directement via les coordonnées ci-dessous. Nous avons hâte de vous entendre !
                            </p>

                            {{-- Points forts --}}
                            <div class="space-y-4 mb-8">
                                <div class="flex items-start">
                                    <i class="fa-solid fa-circle-check text-sonec-green mt-1 mr-3"></i>
                                    <p class="text-gray-700">Disponibles 5j/7 pour répondre à vos questions.</p>
                                </div>
                                <div class="flex items-start">
                                    <i class="fa-solid fa-circle-check text-sonec-green mt-1 mr-3"></i>
                                    <p class="text-gray-700">Réponses rapides et efficaces à toutes vos questions.</p>
                                </div>
                                <div class="flex items-start">
                                    <i class="fa-solid fa-circle-check text-sonec-green mt-1 mr-3"></i>
                                    <p class="text-gray-700">Toutes les demandes sont traitées avec soin par notre équipe.</p>
                                </div>
                            </div>

                            {{-- Coordonnées --}}
                            <div class="border-t border-gray-200 pt-6 mb-6">
                                <p class="text-xs font-semibold tracking-widest text-gray-400 uppercase mb-4">Nous contacter</p>
                                <div class="space-y-3">

                                    <a href="mailto:{{ get_general_settings()->contact_email }}" class="flex items-center gap-3 group">
                                        <div class="w-9 h-9 rounded-lg bg-green-50 border border-green-100 flex items-center justify-center flex-shrink-0">
                                            <i class="fa-solid fa-envelope text-sonec-green text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400">Email RH</p>
                                            <p class="text-sm font-medium text-sonec-green group-hover:underline">{{ get_general_settings()->contact_email }}</p>
                                        </div>
                                    </a>

                                    <a href="tel:{{ get_general_settings()->contact_phone }}" class="flex items-center gap-3 group">
                                        <div class="w-9 h-9 rounded-lg bg-green-50 border border-green-100 flex items-center justify-center flex-shrink-0">
                                            <i class="fa-solid fa-phone text-sonec-green text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400">Téléphone</p>
                                            <p class="text-sm font-medium text-sonec-green group-hover:underline">{{ get_general_settings()->contact_phone }}</p>
                                        </div>
                                    </a>

                                    <div class="flex items-center gap-3">
                                        <div class="w-9 h-9 rounded-lg bg-green-50 border border-green-100 flex items-center justify-center flex-shrink-0">
                                            <i class="fa-solid fa-location-dot text-sonec-green text-sm"></i>
                                        </div>
                                        <div>
                                            <p class="text-xs text-gray-400">Adresse</p>
                                            <p class="text-sm font-medium text-gray-700">{{ get_general_settings()->contact_address }}</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            {{-- Réseaux sociaux --}}
                            <div class="border-t border-gray-200 pt-6">
                                <p class="text-xs font-semibold tracking-widest text-gray-400 uppercase mb-4">Suivez-nous</p>
                                <div class="flex flex-wrap gap-3">
                                    @if(isset(get_general_settings()->linkedin_url))
                                        <a href="{{ get_general_settings()->linkedin_url }}" target="_blank"
                                        class="flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                            <i class="fa-brands fa-linkedin text-[#0A66C2] text-base"></i>
                                            <span class="text-sm font-medium text-gray-700">LinkedIn</span>
                                        </a>
                                    @endif

                                    @if(isset(get_general_settings()->twitter_url))
                                        <a href="{{ get_general_settings()->twitter_url }}" target="_blank"
                                        class="flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                            <i class="fa-brands fa-x-twitter text-[#1D9BF0] text-base"></i>
                                            <span class="text-sm font-medium text-gray-700">Twitter / X</span>
                                        </a>
                                    @endif

                                    @if(isset(get_general_settings()->facebook_url))
                                        <a href="{{ get_general_settings()->facebook_url }}" target="_blank"
                                        class="flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                            <i class="fa-brands fa-facebook text-[#1877F2] text-base"></i>
                                            <span class="text-sm font-medium text-gray-700">Facebook</span>
                                        </a>
                                    @endif
                                    

                                    @if(isset(get_general_settings()->instagram_url))
                                        <a href="{{ get_general_settings()->instagram_url }}" target="_blank"
                                        class="flex items-center gap-2 px-4 py-2 rounded-lg border border-gray-200 hover:bg-gray-50 transition-colors">
                                            <i class="fa-brands fa-instagram text-[#E4405F] text-base"></i>
                                            <span class="text-sm font-medium text-gray-700">Instagram</span>    
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div id="application-form-container" class="bg-white p-8 rounded-lg shadow-lg border">
                            <h3 class="text-2xl font-bold text-sonec-dark mb-6">Envoyez-nous un message</h3>
                            <form id="application-form" class="space-y-6" method="POST" action="{{ route('web.contact.send') }}" enctype="multipart/form-data">
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
                                    <label for="subject" class="block text-sm font-medium text-gray-700 mb-1">Sujet <span class="text-red-500">*</span></label>
                                    <input type="text" id="subject" name="sujet" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md transition" placeholder="Sujet de votre message">
                                </div>
                                <div>
                                    <label for="message" class="block text-sm font-medium text-gray-700 mb-1">Message <span class="text-red-500">*</span></label>
                                    <textarea id="message" name="message" rows="4" class="form-input w-full px-4 py-2 border border-gray-300 rounded-md transition" placeholder="Votre message..."></textarea>
                                </div>
                                
                                
                                <button type="submit" class="w-full bg-sonec-green text-white font-bold py-3 px-6 rounded-md hover:bg-sonec-dark transition duration-300 transform hover:scale-105">
                                    Envoyer mon message
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </section>

        
    </main>
    <script>
        document.getElementById('application-form').addEventListener('submit', async function (e) {
            e.preventDefault();

            const form = e.target;
            const btn = form.querySelector('button[type="submit"]');
            const originalText = btn.textContent;

            clearErrors(form);
            btn.disabled = true;
            btn.textContent = 'Envoi en cours...';

            try {
                const response = await fetch(form.action, {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json',
                    },
                    body: new FormData(form),
                });

                const result = await response.json();

                if (response.ok && result.success) {
                    showAlert('success', result.message);
                    form.reset();
                } else if (response.status === 422 && result.errors) {
                    showFieldErrors(form, result.errors);
                    showAlert('error', 'Veuillez corriger les erreurs ci-dessous.');
                } else {
                    showAlert('error', result.message || 'Une erreur est survenue. Veuillez réessayer.');
                }

            } catch (err) {
                showAlert('error', 'Impossible de contacter le serveur. Vérifiez votre connexion.');
            } finally {
                btn.disabled = false;
                btn.textContent = originalText;
            }
        });

        function showFieldErrors(form, errors) {
            Object.entries(errors).forEach(([field, messages]) => {
                const input = form.querySelector(`[name="${field}"]`);
                if (!input) return;
                input.classList.add('border-red-400');
                const err = document.createElement('p');
                err.className = 'field-error text-red-500 text-xs mt-1';
                err.textContent = messages[0];
                input.parentNode.appendChild(err);
            });
        }

        function clearErrors(form) {
            form.querySelectorAll('.field-error').forEach(el => el.remove());
            form.querySelectorAll('.border-red-400').forEach(el => el.classList.remove('border-red-400'));
            const existing = document.getElementById('form-alert');
            if (existing) existing.remove();
        }

        function showAlert(type, message) {
            const existing = document.getElementById('form-alert');
            if (existing) existing.remove();

            const colors = {
                success: 'bg-green-50 border-green-200 text-green-800',
                error:   'bg-red-50 border-red-200 text-red-800',
            };
            const icons = {
                success: '&#10003;',
                error:   '&#10007;',
            };

            const alert = document.createElement('div');
            alert.id = 'form-alert';
            alert.className = `flex items-start gap-3 p-4 rounded-lg border text-sm ${colors[type]}`;
            alert.innerHTML = `<span class="font-bold text-base leading-none mt-0.5">${icons[type]}</span><span>${message}</span>`;

            const form = document.getElementById('application-form');
            form.insertAdjacentElement('beforebegin', alert);
            alert.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }
</script>
@endsection