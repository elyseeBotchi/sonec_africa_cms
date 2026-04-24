@extends('web.layout.websiteLayout')

@section('content')
    <main class="pt-20">
        @if(isset(get_solution_content()['banniere']) && (get_solution_content()['banniere']->image_url || get_solution_content()['banniere']->title || get_solution_content()['banniere']->image))

        <section id="solutions-hero" class="h-[500px] bg-gradient-to-br from-sonec-dark via-sonec-dark to-gray-900 flex items-center">
            <div class="container mx-auto px-6">
                <div class="max-w-4xl">
                    <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6">{{get_solution_content()['banniere']->title}}</h1>
                    <p class="text-2xl text-gray-200">{!! get_solution_content()['banniere']->subtitle !!}</p>
                </div>
            </div>
        </section>
        @endif

       <div class="container mx-auto px-6">
        <div class="max-w-7xl mx-auto">
        <div id="product-ecole-web" class="py-16 bg-gray-50">
            <div class="container mx-auto px-6">
              <div class="max-w-6xl mx-auto">
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @if(isset(get_solution_content()['solutions_mis_en_avant']) && get_solution_content()['solutions_mis_en_avant']->isNotEmpty())
                    
                        @foreach (get_solution_content()['solutions_mis_en_avant'] as $solution)
                            <a href="#product-{{ $solution->slug }}"
                                class="group bg-white rounded-2xl p-8 shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-transparent hover:border-sonec-green cursor-pointer">
                                <div class="w-16 h-16 bg-sonec-green rounded-2xl flex items-center justify-center mb-6">
                                    @if($solution->icon && str_starts_with($solution->icon, 'fa'))
                                        <i class="{{ $solution->icon }} text-white text-3xl"></i>
                                    @else
                                        {{ $solution->icon }}
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold text-sonec-dark mb-2 group-hover:text-sonec-green transition-colors duration-300">
                                    {{$solution->title}}
                                </h3>
                                <p class="text-sm text-gray-600 mb-4">{{$solution->subtitle}}</p>
                                <div
                                class="flex items-center text-sonec-green opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span class="text-sm font-semibold mr-2">Voir
                                    détails</span><i class="fas fa-arrow-down text-xs"></i>
                                </div>
                            </a>
                        @endforeach
                  
                    
                    @endif

                    @if(isset(get_solution_content()['autres_solutions']) && get_solution_content()['autres_solutions']->isNotEmpty())

                        {{-- @foreach (get_solution_content()['autres_solutions'] as $solution) --}}
                            
                        <a href="#other-solutions" class="group bg-white rounded-2xl p-8 shadow-md hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 border-2 border-transparent hover:border-sonec-green cursor-pointer">
                        <div class="w-16 h-16 bg-sonec-green rounded-2xl flex items-center justify-center mb-6">
                                <i class="fas fa-folder-open text-white text-3xl"></i>
                            </div>
                        <h3 class="text-xl font-bold text-sonec-dark mb-2 group-hover:text-sonec-green transition-colors duration-300">
                            Autres services
                        </h3>
                        <p class="text-sm text-gray-600 mb-4">
                            @foreach (get_solution_content()['autres_solutions'] as $solution)
                                {{$solution->title}}@if(!$loop->last), @endif
                            @endforeach
                            et plus
                        </p>
                        <div class="flex items-center text-sonec-green opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                            <span class="text-sm font-semibold mr-2">
                                Voir détails
                            </span>
                            <i class="fas fa-arrow-down text-xs"></i>
                        </div>
                    </a>
                        {{-- @endforeach --}}
                    @endif

                </div>
              </div>
            </div>
          </div>
        </div>
        
        @if(isset(get_solution_content()['solutions_mis_en_avant']) && get_solution_content()['solutions_mis_en_avant']->isNotEmpty())
            @foreach (get_solution_content()['solutions_mis_en_avant'] as $solution)

                <section id="{{ $solution->slug }}-product" class="py-24 bg-white">
                    <div class="container mx-auto px-6">
                        <div class="grid lg:grid-cols-2 gap-16 items-center">
                            <div class="h-[600px] overflow-hidden rounded-2xl shadow-2xl">
                                <img class="w-full h-full object-cover" src="{{ $solution->image_url ? $solution->image_url  : asset('storage/'.$solution->image) }}" alt="student using tablet in modern african classroom digital learning platform interface" />
                            </div>
                            <div>
                                <div class="w-16 h-16 bg-sonec-green rounded-2xl flex items-center justify-center mb-6">
                                    @if($solution->icon && str_starts_with($solution->icon, 'fa'))
                                        <i class="{{ $solution->icon }} text-white text-3xl"></i>
                                    @else
                                        {{ $solution->icon }}
                                    @endif
                                </div>
                                <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-6"> {{$solution->title}}</h2>
                                <h3 class="text-2xl font-semibold text-gray-700 mb-6">{{$solution->subtitle}}</h3>
                                {!! $solution->resume !!}
                                <a href="{{ route('web.solutions.show', $solution->slug) }}" class="inline-block bg-sonec-green text-white px-8 py-4 rounded-xl font-semibold hover:bg-sonec-dark transition-colors">
                                    Découvrir {{ $solution->title }}
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
            @endforeach
        @endif




        <section id="other-solutions" class="py-24 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-6">Autres solutions</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Des outils complémentaires pour accompagner votre transformation digitale</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @if(isset(get_solution_content()['autres_solutions']) && get_solution_content()['autres_solutions']->isNotEmpty())
                        @foreach (get_solution_content()['autres_solutions'] as $solution)
                            <div id="{{ $solution->slug }}-card" class="bg-white p-10 rounded-2xl border border-gray-200 hover:shadow-xl transition-shadow">
                                <div class="w-16 h-16 bg-sonec-green/10 rounded-xl flex items-center justify-center mb-6">
                                    
                                    @if($solution->icon && str_starts_with($solution->icon, 'fa'))
                                        <i class="{{ $solution->icon }} text-white text-3xl"></i>
                                    @else
                                        {{ $solution->icon }}
                                    @endif
                                </div>
                                <h3 class="text-2xl font-bold text-sonec-dark mb-4">{{ $solution->title }}</h3>
                                <p class="text-gray-700 mb-6">{!! $solution->resume !!}</p>
                                <a href="{{ route('web.solutions.show',$solution->slug) }}" class="inline-flex items-center gap-2 text-sonec-green font-semibold hover:text-sonec-dark transition-colors">
                                    En savoir plus
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        @endforeach
                    @endif

                    
                </div>
            </div>
        </section>

        <section id="integration-section" class="py-24 bg-white">
            <div class="container mx-auto px-6">
                <div class="max-w-5xl mx-auto">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-6">Intégration & Personnalisation</h2>
                        <p class="text-xl text-gray-600">Nos solutions s'adaptent à votre écosystème existant</p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8 mb-16">
                        <div class="bg-gray-50 p-8 rounded-2xl">
                            <div class="w-14 h-14 bg-sonec-green/10 rounded-xl flex items-center justify-center mb-6">
                                <i class="fas fa-plug text-sonec-green text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-sonec-dark mb-4">API Ouvertes</h3>
                            <p class="text-gray-700">Connectez facilement nos plateformes à vos systèmes existants grâce à nos API REST documentées et nos webhooks en temps réel.</p>
                        </div>

                        <div class="bg-gray-50 p-8 rounded-2xl">
                            <div class="w-14 h-14 bg-sonec-green/10 rounded-xl flex items-center justify-center mb-6">
                                <i class="fas fa-palette text-sonec-green text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-sonec-dark mb-4">Personnalisation</h3>
                            <p class="text-gray-700">Adaptez l'interface, les workflows et les fonctionnalités selon vos processus métier spécifiques. Votre solution, vos règles.</p>
                        </div>

                        <div class="bg-gray-50 p-8 rounded-2xl">
                            <div class="w-14 h-14 bg-sonec-green/10 rounded-xl flex items-center justify-center mb-6">
                                <i class="fas fa-cloud text-sonec-green text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-sonec-dark mb-4">Cloud & On-Premise</h3>
                            <p class="text-gray-700">Choisissez le mode de déploiement qui correspond à vos contraintes : cloud sécurisé, infrastructure privée ou modèle hybride.</p>
                        </div>

                        <div class="bg-gray-50 p-8 rounded-2xl">
                            <div class="w-14 h-14 bg-sonec-green/10 rounded-xl flex items-center justify-center mb-6">
                                <i class="fas fa-headset text-sonec-green text-2xl"></i>
                            </div>
                            <h3 class="text-2xl font-bold text-sonec-dark mb-4">Support Dédié</h3>
                            <p class="text-gray-700">Bénéficiez d'un accompagnement personnalisé avec une équipe d'experts disponible 24/7 pour garantir votre succès.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="solutions-benefits" class="py-24 bg-gradient-to-br from-sonec-dark to-gray-900 text-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-5xl font-bold mb-6">Pourquoi Choisir Nos Solutions ?</h2>
                    <p class="text-xl text-gray-300 max-w-3xl mx-auto">Des avantages concrets qui font la différence</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="text-center">
                        <div class="w-20 h-20 bg-sonec-green rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-rocket text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Déploiement Rapide</h3>
                        <p class="text-gray-300">Mise en production en quelques semaines avec formation complète de vos équipes</p>
                    </div>

                    <div class="text-center">
                        <div class="w-20 h-20 bg-sonec-green rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-chart-line text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">ROI Mesurable</h3>
                        <p class="text-gray-300">Réduction des coûts opérationnels et amélioration de la productivité dès le premier mois</p>
                    </div>

                    <div class="text-center">
                        <div class="w-20 h-20 bg-sonec-green rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-lock text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Sécurité Maximale</h3>
                        <p class="text-gray-300">Conformité RGPD, cryptage bout-en-bout et audits de sécurité réguliers</p>
                    </div>

                    <div class="text-center">
                        <div class="w-20 h-20 bg-sonec-green rounded-2xl flex items-center justify-center mx-auto mb-6">
                            <i class="fas fa-sync text-white text-3xl"></i>
                        </div>
                        <h3 class="text-xl font-bold mb-3">Mises à Jour Continues</h3>
                        <p class="text-gray-300">Nouvelles fonctionnalités et améliorations régulières sans coût supplémentaire</p>
                    </div>
                </div>
            </div>
        </section>

        @if(isset(get_solution_content()['temoignages']) && get_solution_content()['temoignages']->isNotEmpty())

            <section id="solutions-testimonials" class="py-24 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-6">Ils ont transformé leur organisation</h2>
                        <p class="text-xl text-gray-600">Des résultats concrets qui parlent d'eux-mêmes</p>
                    </div>

                    <div class="grid lg:grid-cols-2 gap-8">
                        @foreach (get_solution_content()['temoignages'] as $temoignage)
                            <div class="bg-white p-10 rounded-2xl shadow-md">
                                <div class="flex items-center gap-1 text-sonec-lime mb-6">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="text-lg text-gray-700 mb-6 italic">
                                    {!! $temoignage->content !!}
                                </p>
                                <div class="flex items-center gap-4">
                                    <img src="{{ $temoignage->author_photo_url ? $temoignage->author_photo_url : asset('storage/'.$temoignage->author_photo) }}" alt="Client" class="w-16 h-16 rounded-full object-cover">
                                    <div>
                                        <div class="font-bold text-sonec-dark text-lg">{{ $temoignage->author_name }}</div>
                                        <div class="text-gray-600">{{ $temoignage->author_position }}</div>
                                        <div class="text-sm text-sonec-green font-semibold mt-1">{{ $temoignage->author_location }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                       
                    </div>
                </div>
            </section>
        @endif

        <section id="solutions-cta" class="py-24 bg-white">
            <div class="container mx-auto px-6">
                <div class="max-w-4xl mx-auto bg-gradient-to-br from-sonec-green to-sonec-dark rounded-3xl p-12 lg:p-16 text-center text-white">
                    <h2 class="text-4xl lg:text-5xl font-bold mb-6">Prêt à démarrer votre transformation ?</h2>
                    <p class="text-xl mb-10 text-gray-100">Nos experts sont disponibles pour vous présenter nos solutions et répondre à toutes vos questions</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                        <a href="#" class="inline-block bg-white text-sonec-dark px-8 py-4 rounded-xl font-semibold hover:bg-gray-100 transition-colors">
                            Demander une démonstration
                        </a>
                        <a href="#" class="inline-block bg-transparent border-2 border-white text-white px-8 py-4 rounded-xl font-semibold hover:bg-white hover:text-sonec-dark transition-colors">
                            Télécharger la brochure
                        </a>
                    </div>
                    <div class="flex flex-col md:flex-row justify-center items-center gap-8 text-white">
                        <div class="flex items-center gap-3">
                            <i class="fas fa-phone-alt text-2xl"></i>
                            <div class="text-left">
                                <div class="text-sm text-gray-200">Appelez-nous</div>
                                <div class="font-bold">+225 XX XX XX XX</div>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <i class="fas fa-envelope text-2xl"></i>
                            <div class="text-left">
                                <div class="text-sm text-gray-200">Écrivez-nous</div>
                                <div class="font-bold">solutions@sonecafrica.com</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection