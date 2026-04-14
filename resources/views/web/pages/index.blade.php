@extends('web.layout.websiteLayout')

@section('content')

    <main class="pt-20">
        <section id="hero-carousel" class="relative h-[600px] lg:h-[700px] overflow-hidden bg-gray-900">
            @foreach (get_accueil_content()['carousels'] as $carousel)
                <div class="carousel-slide {{ $loop->first ? 'active' : '' }}">
                    @if ($carousel->image_url)
                        <img class="w-full h-full object-cover" src="{{ $carousel->image_url }}" alt="{{ $carousel->title }}">
                    @else
                     <img class="w-full h-full object-cover" src="{{ asset('storage/'.$carousel->image) }}" alt="{{ $carousel->title }}">
                    @endif   
                    <div class="absolute inset-0 bg-sonec-dark/60 flex items-center">
                        <div class="container mx-auto px-6">
                            <div class="max-w-2xl">
                                <h1 class="text-4xl lg:text-6xl font-bold text-white mb-6">{{ $carousel->title }}</h1>
                                <p class="text-xl text-gray-200 mb-8">{{ $carousel->description }}</p>
                                @if ($carousel->cta_label && $carousel->cta_url)
                                    <a href="{{ $carousel->cta_url }}" class="inline-block bg-sonec-green text-white px-8 py-4 rounded-lg font-semibold hover:bg-sonec-lime hover:text-sonec-dark transition-colors">
                                        {{ $carousel->cta_label }}
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                
            @endforeach

           

            <div class="absolute bottom-8 left-1/2 -translate-x-1/2 flex gap-3 z-20">
                @foreach (get_accueil_content()['carousels'] as $carousel)
                    <button class="carousel-dot w-3 h-3 rounded-full bg-white/50 {{ $loop->first ? 'active' : '' }}"></button>
                @endforeach
                {{-- <button class="carousel-dot w-3 h-3 rounded-full bg-white/50 active"></button>
                <button class="carousel-dot w-3 h-3 rounded-full bg-white/50"></button>
                <button class="carousel-dot w-3 h-3 rounded-full bg-white/50"></button> --}}
            </div>

            <button id="carousel-prev" class="absolute left-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-colors z-20">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button id="carousel-next" class="absolute right-4 top-1/2 -translate-y-1/2 w-12 h-12 bg-white/20 hover:bg-white/30 rounded-full flex items-center justify-center text-white transition-colors z-20">
                <i class="fas fa-chevron-right"></i>
            </button>
        </section>

        @if(isset(get_accueil_content()['services']) && get_accueil_content()['services'])
        
            <section id="quick-overview" class="py-16 bg-white border-b border-gray-100">
                <div class="container mx-auto px-6">
                    <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-8">
                        @foreach (get_accueil_content()['services'] as $service)
                            <div class="text-center">
                                <div class="w-16 h-16 bg-sonec-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                    @if($service->icon && str_starts_with($service->icon, 'fa'))
                                        <i class="{{ $service->icon }} text-sonec-green text-2xl"></i>
                                    @else
                                        {{ $service->icon }}
                                    @endif
                                </div>
                                <h3 class="font-semibold text-sonec-dark text-sm">{{ $service->title }}</h3>
                            </div>
                            
                        @endforeach
                        
                    </div>
                </div>
            </section>
        @endif

        @if(isset(get_accueil_content()['presentationEntreprise']) && get_accueil_content()['presentationEntreprise'])
            <section id="about-section" class="py-20 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        <div>
                            <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-6">{{ get_accueil_content()['presentationEntreprise']->title }}</h2>

                            @if(get_accueil_content()['presentationEntreprise']->description && str_contains(get_accueil_content()['presentationEntreprise']->description, '<p>') || str_contains(get_accueil_content()['presentationEntreprise']->description, '<br>') || str_contains(get_accueil_content()['presentationEntreprise']->description, '<div>'))
                                {!! get_accueil_content()['presentationEntreprise']->description !!}
                            @else
                                <p class="text-lg text-gray-700 mb-6">{!! get_accueil_content()['presentationEntreprise']->description !!}</p>
                            @endif

                            
                            <div class="grid grid-cols-3 gap-6 mb-8">
                                <div class="text-center">
                                    <div class="text-4xl font-bold text-sonec-green mb-2">{{get_accueil_content()['presentationEntreprise']->annees_experience}}</div>
                                    <div class="text-sm text-gray-600">Années d'expertise</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-4xl font-bold text-sonec-green mb-2">{{get_accueil_content()['presentationEntreprise']->clients}}</div>
                                    <div class="text-sm text-gray-600">Clients satisfaits</div>
                                </div>
                                <div class="text-center">
                                    <div class="text-4xl font-bold text-sonec-green mb-2">{{get_accueil_content()['presentationEntreprise']->pays}}</div>
                                    <div class="text-sm text-gray-600">Pays d'implantation</div>
                                </div>
                            </div>
                            @if(get_accueil_content()['presentationEntreprise']->cta_label && get_accueil_content()['presentationEntreprise']->cta_url)
                                <a href="{{ get_accueil_content()['presentationEntreprise']->cta_url }}" class="inline-flex items-center gap-2 text-sonec-green font-semibold hover:text-sonec-dark transition-colors">
                                    {{ get_accueil_content()['presentationEntreprise']->cta_label }}
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                        
                        @if(get_accueil_content()['presentationEntreprise']->image_url || get_accueil_content()['presentationEntreprise']->image)
                        
                        <div class="h-[500px] overflow-hidden rounded-2xl shadow-xl">
                            @if(get_accueil_content()['presentationEntreprise']->image_url && get_accueil_content()['presentationEntreprise']->image)
                                <img class="w-full h-full object-cover" src="{{ get_accueil_content()['presentationEntreprise']->image_url }}" alt="{{ get_accueil_content()['presentationEntreprise']->title }}">  
                            @elseif(get_accueil_content()['presentationEntreprise']->image_url && !get_accueil_content()['presentationEntreprise']->image)
                                <img class="w-full h-full object-cover" src="{{ get_accueil_content()['presentationEntreprise']->image_url }}" alt="{{ get_accueil_content()['presentationEntreprise']->title }}">  
                            @else
                                 <img class="w-full h-full object-cover" src="{{ asset('storage/'.get_accueil_content()['presentationEntreprise']->image) }}" alt="{{ get_accueil_content()['presentationEntreprise']->title }}">   
                            @endif
                            {{-- <img class="w-full h-full object-cover" src="{{ get_accueil_content()['presentationEntreprise']->image_url }}" alt="diverse african business team collaboration modern office space professional environment"> --}}
                        </div>
                        @endif
                    </div>
                </div>
            </section>
        @endif

        <section id="solutions-section" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Nos solutions phares</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Des produits innovants conçus pour répondre aux défis spécifiques de chaque secteur</p>
                </div>

                <div class="grid lg:grid-cols-3 gap-8">
                    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-2xl transition-shadow">
                        <div class="h-56 overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/3c5693e84e-391694b11c586ba6057d.png" alt="students using tablets in modern african classroom digital education technology">
                        </div>
                        <div class="p-8">
                            <div class="w-14 h-14 bg-sonec-green rounded-xl flex items-center justify-center mb-4">
                                <i class="fas fa-graduation-cap text-white text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-sonec-dark mb-3">EcoleWeb</h3>
                            <p class="text-gray-700 mb-6">Plateforme éducative complète qui digitalise l'ensemble de l'écosystème scolaire : gestion administrative, apprentissage en ligne, suivi pédagogique et communication parents-enseignants.</p>
                            <ul class="space-y-2 mb-6">
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check text-sonec-green mt-1"></i>
                                    <span class="text-gray-700">Gestion administrative automatisée</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check text-sonec-green mt-1"></i>
                                    <span class="text-gray-700">Cours en ligne interactifs</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check text-sonec-green mt-1"></i>
                                    <span class="text-gray-700">Suivi en temps réel</span>
                                </li>
                            </ul>
                            <a href="#" class="inline-flex items-center gap-2 text-sonec-green font-semibold hover:text-sonec-dark transition-colors">
                                En savoir plus
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-2xl transition-shadow">
                        <div class="h-56 overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/22e6189fbd-581b304e58fa556f0225.png" alt="business analytics dashboard on computer screen modern office professional">
                        </div>
                        <div class="p-8">
                            <div class="w-14 h-14 bg-sonec-green rounded-xl flex items-center justify-center mb-4">
                                <i class="fas fa-chart-line text-white text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-sonec-dark mb-3">GDEC</h3>
                            <p class="text-gray-700 mb-6">Solution intégrée de gestion d'entreprise qui optimise vos processus opérationnels : comptabilité, ressources humaines, gestion de stock, CRM et reporting avancé.</p>
                            <ul class="space-y-2 mb-6">
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check text-sonec-green mt-1"></i>
                                    <span class="text-gray-700">ERP complet et modulaire</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check text-sonec-green mt-1"></i>
                                    <span class="text-gray-700">Tableaux de bord personnalisés</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check text-sonec-green mt-1"></i>
                                    <span class="text-gray-700">Automatisation des workflows</span>
                                </li>
                            </ul>
                            <a href="#" class="inline-flex items-center gap-2 text-sonec-green font-semibold hover:text-sonec-dark transition-colors">
                                En savoir plus
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>

                    <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-2xl transition-shadow">
                        <div class="h-56 overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/8c790e2c64-3ae483694b69e49bd0cc.png" alt="contactless payment mobile phone transaction modern fintech africa">
                        </div>
                        <div class="p-8">
                            <div class="w-14 h-14 bg-sonec-green rounded-xl flex items-center justify-center mb-4">
                                <i class="fas fa-credit-card text-white text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-sonec-dark mb-3">SonecPay</h3>
                            <p class="text-gray-700 mb-6">Plateforme de paiement sécurisée et innovante qui facilite les transactions financières : paiements mobiles, transferts, gestion de portefeuille et intégration e-commerce.</p>
                            <ul class="space-y-2 mb-6">
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check text-sonec-green mt-1"></i>
                                    <span class="text-gray-700">Transactions sécurisées 24/7</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check text-sonec-green mt-1"></i>
                                    <span class="text-gray-700">Multi-devises et multi-canaux</span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <i class="fas fa-check text-sonec-green mt-1"></i>
                                    <span class="text-gray-700">API d'intégration simple</span>
                                </li>
                            </ul>
                            <a href="#" class="inline-flex items-center gap-2 text-sonec-green font-semibold hover:text-sonec-dark transition-colors">
                                En savoir plus
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-12">
                    <a href="#" class="inline-block bg-sonec-green text-white px-8 py-4 rounded-lg font-semibold hover:bg-sonec-dark transition-colors">
                        Voir toutes nos solutions
                    </a>
                </div>
            </div>
        </section>

        <section id="trust-section" class="py-20 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Ils nous font confiance</h2>
                    <p class="text-xl text-gray-600">Des partenaires prestigieux à travers l'Afrique</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center">
                    <div class="bg-white p-6 rounded-lg flex items-center justify-center h-24 grayscale hover:grayscale-0 transition-all">
                        <div class="text-2xl font-bold text-gray-400">CLIENT 1</div>
                    </div>
                    <div class="bg-white p-6 rounded-lg flex items-center justify-center h-24 grayscale hover:grayscale-0 transition-all">
                        <div class="text-2xl font-bold text-gray-400">CLIENT 2</div>
                    </div>
                    <div class="bg-white p-6 rounded-lg flex items-center justify-center h-24 grayscale hover:grayscale-0 transition-all">
                        <div class="text-2xl font-bold text-gray-400">CLIENT 3</div>
                    </div>
                    <div class="bg-white p-6 rounded-lg flex items-center justify-center h-24 grayscale hover:grayscale-0 transition-all">
                        <div class="text-2xl font-bold text-gray-400">CLIENT 4</div>
                    </div>
                    <div class="bg-white p-6 rounded-lg flex items-center justify-center h-24 grayscale hover:grayscale-0 transition-all">
                        <div class="text-2xl font-bold text-gray-400">CLIENT 5</div>
                    </div>
                    <div class="bg-white p-6 rounded-lg flex items-center justify-center h-24 grayscale hover:grayscale-0 transition-all">
                        <div class="text-2xl font-bold text-gray-400">CLIENT 6</div>
                    </div>
                </div>
            </div>
        </section>

        <section id="industries-section" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Nos secteurs d'expertise</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Une connaissance approfondie des enjeux spécifiques à chaque industrie</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-shadow border border-gray-100">
                        <div class="w-16 h-16 bg-sonec-green/10 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-university text-sonec-green text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-sonec-dark mb-3">Banques &amp; Assurances</h3>
                        <p class="text-gray-700">Solutions fintech sécurisées et conformes aux régulations bancaires africaines</p>
                    </div>

                    <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-shadow border border-gray-100">
                        <div class="w-16 h-16 bg-sonec-green/10 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-signal text-sonec-green text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-sonec-dark mb-3">Télécommunications</h3>
                        <p class="text-gray-700">Plateformes de gestion d'abonnés et services à valeur ajoutée</p>
                    </div>

                    <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-shadow border border-gray-100">
                        <div class="w-16 h-16 bg-sonec-green/10 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-school text-sonec-green text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-sonec-dark mb-3">Éducation</h3>
                        <p class="text-gray-700">Digitalisation complète des établissements scolaires et universitaires</p>
                    </div>

                    <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-shadow border border-gray-100">
                        <div class="w-16 h-16 bg-sonec-green/10 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-heartbeat text-sonec-green text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-sonec-dark mb-3">Santé</h3>
                        <p class="text-gray-700">Systèmes d'information hospitaliers et télémédecine</p>
                    </div>

                    <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-shadow border border-gray-100">
                        <div class="w-16 h-16 bg-sonec-green/10 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-landmark text-sonec-green text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-sonec-dark mb-3">Institutions Publiques</h3>
                        <p class="text-gray-700">E-gouvernement et services administratifs digitaux</p>
                    </div>

                    <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-shadow border border-gray-100">
                        <div class="w-16 h-16 bg-sonec-green/10 rounded-xl flex items-center justify-center mb-4">
                            <i class="fas fa-industry text-sonec-green text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold text-sonec-dark mb-3">Industrie &amp; Énergie</h3>
                        <p class="text-gray-700">Solutions IoT et optimisation des processus industriels</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="partners-section" class="py-20 bg-gray-50 overflow-hidden">
            <div class="container mx-auto px-6 mb-12">
                <div class="text-center">
                    <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Nos Partenaires Technologiques</h2>
                    <p class="text-xl text-gray-600">Des alliances stratégiques avec les leaders mondiaux de la tech</p>
                </div>
            </div>

            <div class="relative">
                <div class="flex gap-12 partner-scroll">
                    <div class="flex-shrink-0 bg-white px-12 py-8 rounded-lg flex items-center justify-center min-w-[200px]">
                        <div class="text-3xl font-bold text-gray-300">MICROSOFT</div>
                    </div>
                    <div class="flex-shrink-0 bg-white px-12 py-8 rounded-lg flex items-center justify-center min-w-[200px]">
                        <div class="text-3xl font-bold text-gray-300">AWS</div>
                    </div>
                    <div class="flex-shrink-0 bg-white px-12 py-8 rounded-lg flex items-center justify-center min-w-[200px]">
                        <div class="text-3xl font-bold text-gray-300">ORACLE</div>
                    </div>
                    <div class="flex-shrink-0 bg-white px-12 py-8 rounded-lg flex items-center justify-center min-w-[200px]">
                        <div class="text-3xl font-bold text-gray-300">SAP</div>
                    </div>
                    <div class="flex-shrink-0 bg-white px-12 py-8 rounded-lg flex items-center justify-center min-w-[200px]">
                        <div class="text-3xl font-bold text-gray-300">IBM</div>
                    </div>
                    <div class="flex-shrink-0 bg-white px-12 py-8 rounded-lg flex items-center justify-center min-w-[200px]">
                        <div class="text-3xl font-bold text-gray-300">CISCO</div>
                    </div>
                    <div class="flex-shrink-0 bg-white px-12 py-8 rounded-lg flex items-center justify-center min-w-[200px]">
                        <div class="text-3xl font-bold text-gray-300">MICROSOFT</div>
                    </div>
                    <div class="flex-shrink-0 bg-white px-12 py-8 rounded-lg flex items-center justify-center min-w-[200px]">
                        <div class="text-3xl font-bold text-gray-300">AWS</div>
                    </div>
                    <div class="flex-shrink-0 bg-white px-12 py-8 rounded-lg flex items-center justify-center min-w-[200px]">
                        <div class="text-3xl font-bold text-gray-300">ORACLE</div>
                    </div>
                    <div class="flex-shrink-0 bg-white px-12 py-8 rounded-lg flex items-center justify-center min-w-[200px]">
                        <div class="text-3xl font-bold text-gray-300">SAP</div>
                    </div>
                </div>
            </div>
        </section>

        
        <section id="news-section" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-16">
                    <div>
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Actualités &amp; Insights</h2>
                        <p class="text-xl text-gray-600">Restez informés de nos dernières innovations</p>
                    </div>
                    <a href="#" class="mt-6 lg:mt-0 inline-flex items-center gap-2 text-sonec-green font-semibold hover:text-sonec-dark transition-colors">
                        Voir toutes les actualités
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>

                <div class="grid lg:grid-cols-3 gap-8">
                    <article class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="h-56 overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/1f7b182d18-81c45f3a57399ca8d5fb.png" alt="african tech conference innovation digital transformation">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                                <span class="flex items-center gap-1">
                                    <i class="far fa-calendar"></i>
                                    15 Janvier 2024
                                </span>
                                <span class="px-3 py-1 bg-sonec-lime/20 text-sonec-dark rounded-full text-xs font-semibold">Innovation</span>
                            </div>
                            <h3 class="text-xl font-bold text-sonec-dark mb-3">SONEC Africa lance sa nouvelle solution d'IA pour l'éducation</h3>
                            <p class="text-gray-700 mb-4">Notre plateforme EcoleWeb intègre désormais des fonctionnalités d'intelligence artificielle pour personnaliser l'apprentissage...</p>
                            <a href="#" class="inline-flex items-center gap-2 text-sonec-green font-semibold hover:text-sonec-dark transition-colors">
                                Lire la suite
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>

                    <article class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="h-56 overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/f9677547db-823822a5f363ba49d483.png" alt="business partnership handshake african executives modern office">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                                <span class="flex items-center gap-1">
                                    <i class="far fa-calendar"></i>
                                    10 Janvier 2024
                                </span>
                                <span class="px-3 py-1 bg-sonec-lime/20 text-sonec-dark rounded-full text-xs font-semibold">Partenariat</span>
                            </div>
                            <h3 class="text-xl font-bold text-sonec-dark mb-3">Nouveau partenariat stratégique avec une grande banque africaine</h3>
                            <p class="text-gray-700 mb-4">SONEC Africa et la Banque Continentale signent un accord pour digitaliser l'ensemble des agences...</p>
                            <a href="#" class="inline-flex items-center gap-2 text-sonec-green font-semibold hover:text-sonec-dark transition-colors">
                                Lire la suite
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>

                    <article class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-shadow">
                        <div class="h-56 overflow-hidden">
                            <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/a427ead029-75c3227315b625bd3535.png" alt="award ceremony business excellence trophy african entrepreneur">
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                                <span class="flex items-center gap-1">
                                    <i class="far fa-calendar"></i>
                                    5 Janvier 2024
                                </span>
                                <span class="px-3 py-1 bg-sonec-lime/20 text-sonec-dark rounded-full text-xs font-semibold">Récompense</span>
                            </div>
                            <h3 class="text-xl font-bold text-sonec-dark mb-3">SONEC Africa élu "Meilleure Entreprise Tech de l'année"</h3>
                            <p class="text-gray-700 mb-4">Nous sommes fiers d'annoncer que SONEC Africa a reçu le prestigieux prix de l'innovation technologique...</p>
                            <a href="#" class="inline-flex items-center gap-2 text-sonec-green font-semibold hover:text-sonec-dark transition-colors">
                                Lire la suite
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <section id="testimonials-section" class="py-20 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Ce que disent nos clients</h2>
                    <p class="text-xl text-gray-600">Des témoignages qui reflètent notre engagement envers l'excellence</p>
                </div>

                <div class="grid lg:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-shadow">
                        <div class="flex items-center gap-1 text-sonec-lime mb-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-700 mb-6 italic">"EcoleWeb a complètement transformé la gestion de notre établissement. L'interface est intuitive et le support client exceptionnel. Nos parents et enseignants sont ravis."</p>
                        <div class="flex items-center gap-4">
                            <img src="https://storage.googleapis.com/uxpilot-auth.appspot.com/avatars/avatar-5.jpg" alt="Client" class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <div class="font-bold text-sonec-dark">Aminata Diallo</div>
                                <div class="text-sm text-gray-600">Directrice, Lycée Excellence</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-shadow">
                        <div class="flex items-center gap-1 text-sonec-lime mb-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-700 mb-6 italic">"Grâce à GDEC, nous avons optimisé tous nos processus internes. La productivité a augmenté de 40% et nos coûts opérationnels ont diminué significativement."</p>
                        <div class="flex items-center gap-4">
                            <img src="https://storage.googleapis.com/uxpilot-auth.appspot.com/avatars/avatar-3.jpg" alt="Client" class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <div class="font-bold text-sonec-dark">Mohamed Konaté</div>
                                <div class="text-sm text-gray-600">DG, Industries Modernes SA</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-shadow">
                        <div class="flex items-center gap-1 text-sonec-lime mb-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-700 mb-6 italic">"SonecPay nous a permis de sécuriser nos transactions tout en offrant une expérience fluide à nos clients. Un vrai game-changer pour notre activité e-commerce."</p>
                        <div class="flex items-center gap-4">
                            <img src="https://storage.googleapis.com/uxpilot-auth.appspot.com/avatars/avatar-6.jpg" alt="Client" class="w-12 h-12 rounded-full object-cover">
                            <div>
                                <div class="font-bold text-sonec-dark">Fatou Ndiaye</div>
                                <div class="text-sm text-gray-600">CEO, AfriShop Online</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if(isset(get_accueil_content()['accroche']) && get_accueil_content()['accroche'])
            <section id="cta-section" class="py-20 bg-sonec-dark">
                <div class="container mx-auto px-6">
                    <div class="max-w-4xl mx-auto text-center">
                        <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">{{ get_accueil_content()['accroche']->title }}</h2>
                        <p class="text-xl text-gray-300 mb-10">{{ get_accueil_content()['accroche']->subtitle }}</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            @if(get_accueil_content()['accroche']->cta_label && get_accueil_content()['accroche']->cta_url)
                                <a href="{{ get_accueil_content()['accroche']->cta_url }}" class="inline-block bg-sonec-green text-white px-8 py-4 rounded-lg font-semibold hover:bg-sonec-lime hover:text-sonec-dark transition-colors">
                                    {{ get_accueil_content()['accroche']->cta_label }}
                                </a>
                            @endif
                            {{-- <a href="#" class="inline-block bg-sonec-green text-white px-8 py-4 rounded-lg font-semibold hover:bg-sonec-lime hover:text-sonec-dark transition-colors">
                                Demander une démo
                            </a> --}}
                            <a href="#" class="inline-block bg-white text-sonec-dark px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                                Nous contacter
                            </a>
                        </div>
                        <div class="mt-12 grid grid-cols-1 md:grid-cols-3 gap-8 text-white">
                            <div>
                                <div class="text-4xl font-bold text-sonec-lime mb-2">24/7</div>
                                <div class="text-gray-300">Support client</div>
                            </div>
                            <div>
                                <div class="text-4xl font-bold text-sonec-lime mb-2">99.9%</div>
                                <div class="text-gray-300">Disponibilité</div>
                            </div>
                            <div>
                                <div class="text-4xl font-bold text-sonec-lime mb-2">100%</div>
                                <div class="text-gray-300">Satisfaction client</div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection