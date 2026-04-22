@extends('web.layout.websiteLayout')

@section('content')
    <main class="pt-20">

        @if(isset(get_decouvrir_sonec_africa_content()['banniere']) && (get_decouvrir_sonec_africa_content()['banniere']->image_url || get_decouvrir_sonec_africa_content()['banniere']->title || get_decouvrir_sonec_africa_content()['banniere']->image))
            <section id="hero-header" class="relative h-[500px] bg-sonec-dark overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <img class="w-full h-full object-cover" src="{{get_decouvrir_sonec_africa_content()['banniere']->image_url ?? asset('storage/'.get_decouvrir_sonec_africa_content()['banniere']->image)}}" alt="{{get_decouvrir_sonec_africa_content()['banniere']->title}}" />
                </div>
                <div class="relative container mx-auto px-6 h-full flex items-center">
                    <div class="max-w-3xl">
                        <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">{{get_decouvrir_sonec_africa_content()['banniere']->title}}</h1>
                        <p class="text-2xl text-gray-300 leading-relaxed">{!! get_decouvrir_sonec_africa_content()['banniere']->subtitle !!}</p>
                    </div>
                </div>
            </section>
            {{-- @else
            <section id="hero-header" class="relative h-[500px] bg-sonec-dark overflow-hidden">
                <div class="absolute inset-0 opacity-10">
                    <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/e8b3f52d1a-9f2a4e6b8c1d3f5a7b9e.png" alt="abstract digital network connections technology pattern dark background" />
                </div>
                <div class="relative container mx-auto px-6 h-full flex items-center">
                    <div class="max-w-3xl">
                        <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6 leading-tight">Bâtir l'Afrique Digitale de demain.</h1>
                        <p class="text-2xl text-gray-300 leading-relaxed">Plus qu'une entreprise technologique, nous sommes le partenaire de votre transformation numérique.</p>
                    </div>
                </div>
            </section>         --}}
        @endif


        @if(isset(get_decouvrir_sonec_africa_content()['vision']))
            <section id="vision-section" class="py-24 bg-white">
                <div class="container mx-auto px-6">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <div id="vision-text">
                            <h2 class="text-5xl font-bold text-sonec-dark mb-8">{{ get_decouvrir_sonec_africa_content()['vision']->title }}</h2>
                            {!! get_decouvrir_sonec_africa_content()['vision']->description !!}
                        </div>
                        <div id="vision-image" class="h-[600px] overflow-hidden rounded-2xl shadow-2xl">
                            <img class="w-full h-full object-cover" src="{{ get_decouvrir_sonec_africa_content()['vision']->image_url ?? asset('storage/'.get_decouvrir_sonec_africa_content()['vision']->image) }}" alt="{{ get_decouvrir_sonec_africa_content()['vision']->title }}" />
                        </div>
                    </div>
                </div>
            </section>
        @endif
        
        @if(isset(get_decouvrir_sonec_africa_content()['piliers']) && get_decouvrir_sonec_africa_content()['piliers']->isNotEmpty())

            <section id="values-section" class="py-24 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-5xl font-bold text-sonec-dark mb-6">Nos 3 Piliers</h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Les valeurs fondamentales qui guident chacune de nos actions et décisions</p>
                    </div>

                    <div class="grid lg:grid-cols-3 gap-10">
                        @foreach(get_decouvrir_sonec_africa_content()['piliers'] as $pilier)
                        
                            <div id="value-innovation" class="bg-white rounded-2xl p-12 shadow-md hover:shadow-2xl transition-shadow">
                                <div class="w-20 h-20 bg-sonec-green rounded-xl flex items-center justify-center mb-8">
                                    @if($pilier->icon)
                                        {{-- <img class="w-10 h-10 object-contain" src="{{ asset('storage/'.$pilier->icon) }}" alt="{{ $pilier->title }}" /> --}}
                                        <i class="{{ $pilier->icon }} text-white text-4xl"></i>
                                    @else
                                        {{ $pilier->icon }}
                                    @endif
                                </div>
                                <h3 class="text-3xl font-bold text-sonec-dark mb-6">{{ $pilier->title ?? '' }}</h3>
                                <p class="text-lg text-gray-700 leading-relaxed">{!! $pilier->description !!}</p>
                            </div>
                        @endforeach                            
                    </div>
                </div>
            </section>

        @endif
        
        @if(isset(get_decouvrir_sonec_africa_content()['chiffres']) && get_decouvrir_sonec_africa_content()['chiffres']->isNotEmpty())

            <section id="impact-section" class="py-24 bg-white">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-5xl font-bold text-sonec-dark mb-6">Notre Impact en Chiffres</h2>
                        <p class="text-xl text-gray-600">Des résultats concrets qui témoignent de notre engagement</p>
                    </div>
                    
                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach(get_decouvrir_sonec_africa_content()['chiffres'] as $chiffre)

                            <div id="stat-years" class="text-center bg-gray-50 rounded-2xl p-10">
                                <div class="text-6xl font-bold text-sonec-green mb-4">{{ $chiffre->value ?? '' }}</div>
                                <h3 class="text-xl font-semibold text-sonec-dark mb-2">{{ $chiffre->title ?? '' }}</h3>
                                <p class="text-gray-600">{!! $chiffre->description ?? '' !!}</p>
                            </div>
                        @endforeach

                        
                    </div>
                </div>
            </section>

        @endif

        @if(isset(get_decouvrir_sonec_africa_content()['approches']) && get_decouvrir_sonec_africa_content()['approches']->isNotEmpty())
            <section id="approach-section" class="py-24 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="max-w-5xl mx-auto">
                        <div class="text-center mb-16">
                            <h2 class="text-5xl font-bold text-sonec-dark mb-6">Notre Approche</h2>
                            <p class="text-xl text-gray-600">Une méthodologie éprouvée pour garantir votre succès</p>
                        </div>

                        <div class="space-y-8">
                            @foreach(get_decouvrir_sonec_africa_content()['approches'] as $index => $approche)

                                <div id="approach-{{ $index }}" class="bg-white rounded-2xl p-10 flex items-start gap-8 shadow-md hover:shadow-xl transition-shadow">
                                    <div class="flex-shrink-0">
                                        <div class="w-16 h-16 bg-sonec-green/10 rounded-full flex items-center justify-center">
                                            <span class="text-3xl font-bold text-sonec-green">{{ $index + 1 }}</span>
                                        </div>
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-sonec-dark mb-4">{{ $approche->title ?? '' }}</h3>
                                        <p class="text-lg text-gray-700 leading-relaxed">{!! $approche->description ?? '' !!}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
        
        @if(isset(get_decouvrir_sonec_africa_content()['engagement']))

            <section id="commitment-section" class="py-24 bg-white">
                <div class="container mx-auto px-6">
                    <div class="grid lg:grid-cols-2 gap-16 items-center">
                        <div id="commitment-image" class="h-[600px] overflow-hidden rounded-2xl shadow-2xl">
                            <img class="w-full h-full object-cover" src="{{ get_decouvrir_sonec_africa_content()['engagement']->image_url ?? asset('storage/'.get_decouvrir_sonec_africa_content()['engagement']->image) }}" alt="african business team handshake partnership trust modern office professional" />
                        </div>
                        <div id="commitment-text">
                            <h2 class="text-5xl font-bold text-sonec-dark mb-8">{{ get_decouvrir_sonec_africa_content()['engagement']->title ?? '' }}</h2>
                            <p class="text-xl text-gray-700 leading-relaxed mb-8">{!! get_decouvrir_sonec_africa_content()['engagement']->description ?? '' !!}</p>
                            @if(isset(get_decouvrir_sonec_africa_content()['engagements']) && get_decouvrir_sonec_africa_content()['engagements']->isNotEmpty())
                            
                                <div class="space-y-6">
                                    @foreach (get_decouvrir_sonec_africa_content()['engagements'] as $engagement_item)
                                        <div class="flex items-start gap-4">
                                            <div class="flex-shrink-0 w-12 h-12 bg-sonec-green/10 rounded-lg flex items-center justify-center">
                                                @if($engagement_item->icon)
                                                    {{-- <img class="w-6 h-6 object-contain" src="{{ asset('storage/'.$engagement_item->icon) }}" alt="{{ $engagement_item->title }}" /> --}}
                                                    <i class="{{ $engagement_item->icon }} text-sonec-green text-xl"></i>
                                                @else
                                                    {{ $engagement_item->icon }}
                                                @endif
                                            </div>
                                            <div>
                                                <h3 class="text-xl font-bold text-sonec-dark mb-2">{{ $engagement_item->label ?? '' }}</h3>
                                                <p class="text-gray-700">{!! $engagement_item->description ?? '' !!}</p>
                                            </div>
                                        </div>
                                        
                                    @endforeach
                                                                    
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endif
        
        @if(isset(get_decouvrir_sonec_africa_content()['certifications']) && get_decouvrir_sonec_africa_content()['certifications']->isNotEmpty())

            <section id="recognition-section" class="py-24 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-5xl font-bold text-sonec-dark mb-6">Reconnaissances et Certifications</h2>
                        <p class="text-xl text-gray-600">L'excellence reconnue par nos pairs et les instances internationales</p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach(get_decouvrir_sonec_africa_content()['certifications'] as $certification)
                            <div id="cert-{{ $certification->id }}" class="bg-white rounded-xl p-8 text-center shadow-md hover:shadow-xl transition-shadow">
                                <div class="w-20 h-20 bg-sonec-green/10 rounded-full flex items-center justify-center mx-auto mb-6">
                                    <i class="{{ $certification->icon }} text-sonec-green text-3xl"></i>
                                </div>
                                <h3 class="text-xl font-bold text-sonec-dark mb-3">{{ $certification->label }}</h3>
                                <p class="text-gray-600">{!! $certification->description !!}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif
        
        @if(isset(get_decouvrir_sonec_africa_content()['accroche']))
            <section id="cta-section" class="py-24 bg-sonec-dark">
                <div class="container mx-auto px-6">
                    <div class="max-w-4xl mx-auto text-center">
                        <h2 class="text-5xl font-bold text-white mb-8">{{ get_decouvrir_sonec_africa_content()['accroche']->title ?? '' }}</h2>
                        <p class="text-2xl text-gray-300 mb-12 leading-relaxed">{!! get_decouvrir_sonec_africa_content()['accroche']->description ?? '' !!}</p>
                        <div class="flex flex-col sm:flex-row gap-6 justify-center">
                            <a href="{{ get_decouvrir_sonec_africa_content()['accroche']->cta_url ?? '#' }}" class="inline-block bg-sonec-green text-white px-10 py-5 rounded-xl font-bold text-lg hover:bg-sonec-lime hover:text-sonec-dark transition-colors">
                                {{ get_decouvrir_sonec_africa_content()['accroche']->cta_label ?? 'Découvrir nos solutions' }}
                            </a>
                            <a href="#" class="inline-block bg-white text-sonec-dark px-10 py-5 rounded-xl font-bold text-lg hover:bg-gray-100 transition-colors">
                                Contactez-nous
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection