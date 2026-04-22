@extends('web.layout.websiteLayout')

@section('content')
    <main class="pt-20">
        @if(isset(get_equipe_content()['banniere']) && (get_equipe_content()['banniere']->image_url || get_equipe_content()['banniere']->title || get_equipe_content()['banniere']->image))
            <section id="hero-history" class="relative h-[400px] bg-gradient-to-br from-sonec-dark to-sonec-green flex items-center">
                <div class="absolute inset-0 opacity-10">
                    <div class="w-full h-full" style="background-image: url('{{ get_equipe_content()['banniere']->image_url ?? asset('storage/'.get_equipe_content()['banniere']->image) }}');"></div>
                </div>
                <div class="container mx-auto px-6 relative z-10">
                    <div class="max-w-3xl">
                        <div class="inline-block bg-sonec-lime/20 px-4 py-2 rounded-full mb-4">
                            <span class="text-white font-semibold text-sm">Qui sommes-nous</span>
                        </div>
                        <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6">{{ get_equipe_content()['banniere']->title }}</h1>
                        <p class="text-xl text-gray-100">{!! get_equipe_content()['banniere']->subtitle !!}</p>
                    </div>
                </div>
            </section>
        @endif
        @if(isset(get_equipe_content()['section_premiere']) )
            <section id="leadership-hero" class="py-20 bg-white border-b border-gray-100">
                <div class="container mx-auto px-6">
                    <div class="max-w-4xl mx-auto text-center">
                        <div class="inline-flex items-center gap-2 text-sonec-green mb-6">
                            <i class="fas fa-users"></i>
                            <span class="font-semibold text-sm uppercase tracking-wider">Qui sommes-nous</span>
                        </div>
                        <h1 class="text-4xl lg:text-6xl font-bold text-sonec-dark mb-6">{{ get_equipe_content()['section_premiere']->title }}</h1>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">{!! get_equipe_content()['section_premiere']->description !!}</p>
                    </div>
                </div>
            </section>
        @endif
        
        @if(isset(get_equipe_content()['equipes']) && get_equipe_content()['equipes']->isNotEmpty())

            <section id="leadership-team" class="py-20 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 mb-16">
                        @foreach (get_equipe_content()['equipes'] as $equipe)
                        
                            <div id="leader-card-{{ $equipe->id }}" class="leader-card bg-white rounded-xl overflow-hidden shadow-md hover:shadow-2xl">
                                <div class="h-80 overflow-hidden bg-gray-100">
                                    <img class="w-full h-full object-cover" src="{{ $equipe->photo_url  ?? asset('storage/'.$equipe->photo) }}" alt="{{ $equipe->name }} Portrait" />
                                </div>
                                <div class="p-6">
                                    <h3 class="text-xl font-bold text-sonec-dark mb-1">{{ $equipe->name }}</h3>
                                    <p class="text-sonec-green font-semibold mb-4">{{ $equipe->position }}</p>
                                    <p class="text-gray-600 text-sm mb-4">{!! $equipe->description !!}</p>
                                    @if($equipe->linkedin_url)
                                        <a href="{{ $equipe->linkedin_url }}" class="inline-flex items-center justify-center w-10 h-10 bg-sonec-green/10 rounded-full text-sonec-green hover:bg-sonec-green hover:text-white transition-colors">
                                            <i class="fab fa-linkedin-in"></i>
                                        </a>
                                    @endif
                                    @if($equipe->facebook_url)
                                        <a href="{{ $equipe->facebook_url }}" class="inline-flex items-center justify-center w-10 h-10 bg-sonec-green/10 rounded-full text-sonec-green hover:bg-sonec-green hover:text-white transition-colors">
                                            <i class="fab fa-facebook-f"></i>
                                        </a>
                                    @endif
                                    @if($equipe->twitter_url)
                                        <a href="{{ $equipe->twitter_url }}" class="inline-flex items-center justify-center w-10 h-10 bg-sonec-green/10 rounded-full text-sonec-green hover:bg-sonec-green hover:text-white transition-colors">
                                            <i class="fab fa-twitter"></i>
                                        </a>
                                    @endif
                                    @if($equipe->instagram_url)
                                        <a href="{{ $equipe->instagram_url }}" class="inline-flex items-center justify-center w-10 h-10 bg-sonec-green/10 rounded-full text-sonec-green hover:bg-sonec-green hover:text-white transition-colors">
                                            <i class="fab fa-instagram"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        @endforeach

                       
                    </div>
                </div>
            </section>

        @endif
        
        @if(isset(get_equipe_content()['valeurs']) && get_equipe_content()['valeurs']->isNotEmpty())
            <section id="leadership-values" class="py-20 bg-white">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Les valeurs qui nous guident</h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Notre comité de direction s'engage à incarner les valeurs fondamentales qui font la force de SONEC Africa</p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                            @foreach (get_equipe_content()['valeurs'] as $valeur)
                                <div id="value-card-{{ $valeur->id }}" class="text-center">
                                    <div class="w-20 h-20 bg-sonec-green/10 rounded-2xl flex items-center justify-center mx-auto mb-6">
                                        @if($valeur->icon && str_starts_with($valeur->icon, 'fa'))
                                            <i class="{{ $valeur->icon }} text-sonec-green text-3xl"></i>
                                        @else
                                            {{ $valeur->icon }}
                                        {{-- <img class="w-10 h-10 object-contain" src="{{ $valeur->icon_url ?? asset('storage/'.$valeur->icon) }}" alt="{{ $valeur->label }} Icon" /> --}}
                                        @endif
                                    </div>
                                    <h3 class="text-xl font-bold text-sonec-dark mb-3">{{ $valeur->title }}</h3>
                                    <p class="text-gray-600">{!! $valeur->description !!}</p>
                                </div>
                            @endforeach
                    </div>
                </div>
            </section>
        @endif
        
        @if(isset(get_equipe_content()['section_presentation']) )

            <section id="leadership-expertise" class="py-20 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        <div>
                            <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-6">{{ get_equipe_content()['section_presentation']->title ?? '' }}</h2>
                            <p class="text-lg text-gray-700 mb-6">{!! get_equipe_content()['section_presentation']->description ?? '' !!}</p>
                            
                        </div>
                        
                        @if(isset(get_equipe_content()['chiffres_presentation']) && get_equipe_content()['chiffres_presentation']->isNotEmpty())
                            <div class="grid grid-cols-2 gap-6">
                            @foreach (get_equipe_content()['chiffres_presentation'] as $chiffre)
                                <div class="bg-white p-8 rounded-xl shadow-md text-center">
                                    <div class="text-5xl font-bold text-sonec-green mb-2">{{ $chiffre->value }}</div>
                                    <div class="text-gray-600">{{ $chiffre->label }}</div>
                                </div>
                            @endforeach
                                
                            </div>
                        @endif
                    </div>
                </div>
            </section>

        @endif
        

        <section id="leadership-vision" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="max-w-5xl mx-auto">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-6">Notre vision pour l'avenir</h2>
                        <p class="text-xl text-gray-600">Le comité de direction de SONEC Africa s'engage à faire de notre entreprise le leader incontesté de la transformation digitale en Afrique d'ici 2030</p>
                    </div>
                    
                    <div class="bg-gradient-to-br from-sonec-dark to-sonec-green p-12 rounded-2xl text-white">
                        @if(isset(get_equipe_content()['chiffres_vision']) && get_equipe_content()['chiffres_vision']->isNotEmpty())
                            <div class="grid md:grid-cols-3 gap-8 mb-12">
                                @foreach (get_equipe_content()['chiffres_vision'] as $chiffre)
                                    <div class="text-center">
                                        <div class="text-5xl font-bold mb-2">{{ $chiffre->value }}</div>
                                        <div class="text-gray-200">{{ $chiffre->label }}</div>
                                    </div>
                                    
                                @endforeach
                                
                            </div>
                        @endif
                    



                            <blockquote class="text-center text-xl italic border-t border-white/20 pt-8">
                                "Notre ambition est de placer la technologie africaine au cœur de la transformation digitale mondiale, en créant des solutions qui répondent aux besoins spécifiques de notre continent tout en rivalisant avec les meilleurs standards internationaux."
                            </blockquote>
                            <div class="text-center mt-6">
                                <div class="font-bold text-lg">Amadou Diallo</div>
                                <div class="text-gray-200">Directeur Général, SONEC Africa</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if(isset(get_equipe_content()['section_gouvernances']) && get_equipe_content()['section_gouvernances']->isNotEmpty())

            <section id="leadership-governance" class="py-20 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Gouvernance et transparence</h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Notre comité de direction applique les principes de gouvernance les plus stricts pour assurer la pérennité et la croissance responsable de l'entreprise</p>
                    </div>

                    <div class="grid md:grid-cols-3 gap-8">
                        @foreach (get_equipe_content()['section_gouvernances'] as $gouvernance)

                            <div id="governance-card-{{ $gouvernance->id }}" class="bg-white p-8 rounded-xl shadow-md border-t-4 border-sonec-green">
                                <div class="w-16 h-16 bg-sonec-green/10 rounded-xl flex items-center justify-center mb-6">
                                    @if($gouvernance->icon && str_starts_with($gouvernance->icon, 'fa'))
                                        <i class="{{ $gouvernance->icon }} text-sonec-green text-2xl"></i>
                                    @else
                                         {{ $gouvernance->icon }}
                                    {{-- <img class="w-10 h-10 object-contain" src="{{ $gouvernance->icon_url ?? asset('storage/'.$gouvernance->icon) }}" alt="{{ $gouvernance->label }} Icon" /> --}}
                                    @endif
                                    {{-- <i class="fas fa-shield-alt text-sonec-green text-2xl"></i> --}}
                                </div>
                                <h3 class="text-2xl font-bold text-sonec-dark mb-4">{{ $gouvernance->title }}</h3>
                                
                                {!! $gouvernance->description !!}
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        
        @if(isset(get_equipe_content()['accroche']))        

        <section id="leadership-cta" class="py-20 bg-sonec-dark">
            <div class="container mx-auto px-6">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">{{ get_equipe_content()['accroche']->title }}</h2>
                    <p class="text-xl text-gray-300 mb-10">{!! get_equipe_content()['accroche']->description !!}</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        @if(get_equipe_content()['accroche']->cta_label && get_equipe_content()['accroche']->cta_url)
                            <a href="{{ get_equipe_content()['accroche']->cta_url ?? '#' }}" class="inline-block bg-sonec-green text-white px-8 py-4 rounded-lg font-semibold hover:bg-sonec-lime hover:text-sonec-dark transition-colors">
                                {{ get_equipe_content()['accroche']->cta_label }}
                            </a>
                        @endif
                        <a href="#" class="inline-block bg-white text-sonec-dark px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            Contactez-nous
                        </a>
                    </div>
                </div>
            </div>
        </section>
        @endif
    </main>
@endsection