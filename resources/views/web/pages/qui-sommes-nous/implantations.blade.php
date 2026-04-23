@extends('web.layout.websiteLayout')

@section('content')
    <main class="pt-20">
        @if(isset(get_implantation_content()['section_premiere']))
            <section id="hero-map" class="h-[700px] bg-gradient-to-br from-gray-50 to-white relative overflow-hidden">
                <div class="container mx-auto px-6 h-full">
                    <div class="flex flex-col lg:flex-row items-center justify-between h-full gap-12">
                        <div class="lg:w-1/2 pt-12 lg:pt-0">
                            <h1 class="text-5xl lg:text-6xl font-bold text-sonec-dark mb-6">{{ get_implantation_content()['section_premiere']->title ?? 'Une expertise sans frontières' }}</h1>
                            <p class="text-xl text-gray-700 mb-8">{!! get_implantation_content()['section_premiere']->description !!}</p>
                            {{-- <div class="flex flex-wrap gap-4">
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-sonec-green rounded-full"></div>
                                    <span class="text-gray-700 font-medium">Pays d'implantation</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div class="w-3 h-3 bg-gray-300 rounded-full"></div>
                                    <span class="text-gray-700 font-medium">Autres pays</span>
                                </div>
                            </div> --}}
                        </div>
                        <div class="lg:w-1/2 flex items-center justify-center">
                            <div class="relative w-full max-w-md h-[500px]">
                                <svg viewBox="0 0 400 500" class="w-full h-full">
                                    <path class="country-base" d="M200,50 L220,55 L225,70 L235,75 L240,85 L250,90 L255,105 L265,110 L270,125 L260,135 L255,145 L250,155 L245,165 L240,175 L230,180 L220,185 L210,190 L200,195 L190,190 L180,185 L170,180 L160,175 L155,165 L150,155 L145,145 L140,135 L135,125 L140,115 L145,105 L150,95 L160,90 L170,85 L180,80 L190,75 L195,65 L200,50 Z"/>
                                    <path class="country-highlight" d="M150,155 L160,160 L170,165 L175,175 L180,185 L185,195 L190,205 L185,215 L180,225 L175,235 L170,245 L165,255 L160,265 L155,275 L150,285 L145,275 L140,265 L135,255 L130,245 L135,235 L140,225 L145,215 L148,205 L150,195 L150,185 L150,175 L150,165 L150,155 Z"/>
                                    <path class="country-highlight" d="M185,195 L195,200 L205,205 L210,215 L215,225 L220,235 L215,245 L210,255 L205,265 L200,275 L195,285 L190,295 L185,285 L180,275 L175,265 L170,255 L175,245 L180,235 L185,225 L188,215 L190,205 L185,195 Z"/>
                                    <path class="country-highlight" d="M220,235 L230,240 L240,245 L245,255 L250,265 L255,275 L250,285 L245,295 L240,305 L235,315 L230,325 L225,315 L220,305 L215,295 L210,285 L215,275 L220,265 L225,255 L228,245 L220,235 Z"/>
                                    <path class="country-highlight" d="M155,275 L165,280 L175,285 L180,295 L185,305 L190,315 L185,325 L180,335 L175,345 L170,355 L165,365 L160,355 L155,345 L150,335 L145,325 L150,315 L155,305 L158,295 L155,285 L155,275 Z"/>
                                    <path class="country-highlight" d="M190,315 L200,320 L210,325 L215,335 L220,345 L225,355 L220,365 L215,375 L210,385 L205,395 L200,405 L195,395 L190,385 L185,375 L180,365 L185,355 L190,345 L193,335 L190,325 L190,315 Z"/>
                                    <path class="country-highlight" d="M225,355 L235,360 L245,365 L250,375 L255,385 L260,395 L255,405 L250,415 L245,425 L240,435 L235,445 L230,435 L225,425 L220,415 L215,405 L220,395 L225,385 L228,375 L225,365 L225,355 Z"/>
                                    <path class="country-highlight" d="M260,395 L270,400 L280,405 L285,415 L290,425 L295,435 L290,445 L285,455 L280,465 L275,475 L270,485 L265,475 L260,465 L255,455 L250,445 L255,435 L260,425 L263,415 L260,405 L260,395 Z"/>
                                    <path class="country-highlight" d="M205,395 L215,400 L225,405 L230,415 L235,425 L240,435 L235,445 L230,455 L225,465 L220,475 L215,485 L210,475 L205,465 L200,455 L195,445 L200,435 L205,425 L208,415 L205,405 L205,395 Z"/>
                                    <circle cx="160" cy="220" r="5" class="fill-white stroke-sonec-green" stroke-width="2"/>
                                    <circle cx="195" cy="250" r="5" class="fill-white stroke-sonec-green" stroke-width="2"/>
                                    <circle cx="230" cy="290" r="5" class="fill-white stroke-sonec-green" stroke-width="2"/>
                                    <circle cx="165" cy="330" r="5" class="fill-white stroke-sonec-green" stroke-width="2"/>
                                    <circle cx="200" cy="360" r="5" class="fill-white stroke-sonec-green" stroke-width="2"/>
                                    <circle cx="235" cy="400" r="5" class="fill-white stroke-sonec-green" stroke-width="2"/>
                                    <circle cx="270" cy="440" r="5" class="fill-white stroke-sonec-green" stroke-width="2"/>
                                    <circle cx="215" cy="440" r="5" class="fill-white stroke-sonec-green" stroke-width="2"/>
                                    <circle cx="175" cy="380" r="5" class="fill-white stroke-sonec-green" stroke-width="2"/>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        
        @if(isset(get_implantation_content()['bureaux']) && get_implantation_content()['bureaux']->isNotEmpty())

            <section id="offices-grid" class="py-20 bg-white">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Nos Bureaux en Afrique</h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Retrouvez les coordonnées de nos représentations dans chaque pays. Notre équipe locale est à votre disposition pour répondre à tous vos besoins.</p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        {{-- @foreach (get_implantation_content()['bureaux'] as $bureau)
                        
                            <div id="office-{{ Str::slug($bureau->pays) }}" class="bg-white border-2 border-gray-200 rounded-2xl p-8 hover:shadow-2xl hover:border-sonec-green transition-all">
                                <div class="flex items-start gap-4 mb-6">
                                    <div class="w-16 h-12 bg-gradient-to-b from-orange-500 via-white to-green-600 rounded-lg flex items-center justify-center text-2xl">
                                        🇨🇮
                                    </div>
                                    <div>
                                        <h3 class="text-2xl font-bold text-sonec-dark">{{ $bureau->pays }}</h3>
                                        <p class="text-sm text-gray-500">{{ $bureau->type_bureau }}</p>
                                    </div>
                                </div>
                                <div class="space-y-4 mb-6">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Représentant</p>
                                            <p class="font-semibold text-sonec-dark">{{ $bureau->representant }}</p>
                                        </div>
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-envelope text-sonec-green mt-1"></i>
                                        <div>
                                            <p class="text-sm text-gray-500">Email</p>
                                            <a href="mailto:{{ $bureau->email }}" class="text-sonec-dark hover:text-sonec-green transition-colors">{{ $bureau->email }}</a>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-phone text-sonec-green mt-1"></i>
                                        <div>
                                            <p class="text-sm text-gray-500">Téléphone</p>
                                            <a href="tel:{{ $bureau->telephone }}" class="text-sonec-dark hover:text-sonec-green transition-colors">{{ $bureau->telephone }}</a>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-map-marker-alt text-sonec-green mt-1"></i>
                                        <div>
                                            <p class="text-sm text-gray-500">Adresse</p>
                                            <p class="text-sonec-dark">{{ $bureau->adresse }}</p>
                                        </div>
                                    </div>
                                </div>
                                <a href="{{ $bureau->maps_url ?? "#" }}" class="inline-flex items-center gap-2 text-sonec-green font-semibold border-2 border-sonec-green px-6 py-3 rounded-lg hover:bg-sonec-green hover:text-white transition-all w-full justify-center">
                                    <i class="fas fa-map-marked-alt"></i>
                                    Localiser sur Maps
                                </a>
                            </div>
                        @endforeach --}}

                        @foreach (get_implantation_content()['bureaux'] as $bureau)
                            @php $flag = get_country_flag($bureau->pays); @endphp

                            <div id="office-{{ Str::slug($bureau->pays) }}"
                                class="bg-white border-2 border-gray-200 rounded-2xl p-8 hover:shadow-2xl hover:{{ $flag['border'] }} transition-all">

                                <div class="flex items-start gap-4 mb-6">

                                    {{-- Drapeau dynamique --}}
                                    <div class="w-16 h-12 {{ $flag['gradient'] }} rounded-lg flex items-center justify-center text-2xl shadow-sm">
                                        {{ $flag['iso'] }}
                                    </div>

                                    <div>
                                        <h3 class="text-2xl font-bold text-sonec-dark">{{ $bureau->pays }}</h3>
                                        <div class="flex items-center gap-2">
                                            <span class="text-sm text-gray-500">{{ $bureau->type_bureau }}</span>
                                            {{-- Badge code ISO --}}
                                            <span class="text-xs font-bold px-2 py-0.5 rounded-full {{ $flag['text'] }} bg-gray-100 border {{ $flag['border'] }}">
                                                {{ $flag['iso'] }}
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                {{-- Bande de couleurs du drapeau en bas de la card --}}
                                <div class="flex h-1 rounded-full overflow-hidden mb-6">
                                    @foreach ($flag['colors'] as $color)
                                        <div class="flex-1 {{ $color }}"></div>
                                    @endforeach
                                </div>

                                <div class="space-y-4 mb-6">
                                    <div>
                                        <p class="text-sm text-gray-500 mb-1">Représentant</p>
                                        <p class="font-semibold text-sonec-dark">{{ $bureau->representant }}</p>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-envelope {{ $flag['text'] }} mt-1"></i>
                                        <div>
                                            <p class="text-sm text-gray-500">Email</p>
                                            <a href="mailto:{{ $bureau->email }}" class="text-sonec-dark hover:{{ $flag['text'] }} transition-colors">
                                                {{ $bureau->email }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-phone {{ $flag['text'] }} mt-1"></i>
                                        <div>
                                            <p class="text-sm text-gray-500">Téléphone</p>
                                            <a href="tel:{{ $bureau->telephone }}" class="text-sonec-dark hover:{{ $flag['text'] }} transition-colors">
                                                {{ $bureau->telephone }}
                                            </a>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3">
                                        <i class="fas fa-map-marker-alt {{ $flag['text'] }} mt-1"></i>
                                        <div>
                                            <p class="text-sm text-gray-500">Adresse</p>
                                            <p class="text-sonec-dark">{{ $bureau->adresse }}</p>
                                        </div>
                                    </div>
                                </div>

                                <a href="{{ $bureau->maps_url ?? '#' }}"
                                class="inline-flex items-center gap-2 {{ $flag['text'] }} font-semibold border-2 {{ $flag['border'] }} px-6 py-3 rounded-lg hover:{{ str_replace('text-', 'bg-', $flag['text']) }} hover:text-white transition-all w-full justify-center">
                                    <i class="fas fa-map-marked-alt"></i>
                                    Localiser sur Maps
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if(isset(get_implantation_content()['chiffres']) && get_implantation_content()['chiffres']->isNotEmpty())
            <section id="coverage-stats" class="py-20 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Notre Couverture Géographique</h2>
                        <p class="text-xl text-gray-600">Des chiffres qui témoignent de notre présence et de notre engagement</p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach (get_implantation_content()['chiffres'] as $chiffre)
                        
                            <div class="bg-white p-8 rounded-2xl shadow-md text-center">
                                <div class="w-20 h-20 bg-sonec-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                    @if($chiffre->icon && str_starts_with($chiffre->icon, 'fa'))
                                        <i class="{{ $chiffre->icon }} text-sonec-green text-3xl"></i>
                                    @else
                                        {{ $chiffre->icon }}
                                    @endif
                                </div>
                                <div class="text-5xl font-bold text-sonec-dark mb-2">{{ $chiffre->value }}</div>
                                <div class="text-gray-600 font-medium">{{ $chiffre->label }}</div>
                            </div>
                        @endforeach

                        
                    </div>
                </div>
            </section>
        @endif
        
        @if(isset(get_implantation_content()['about']))

            <section id="expansion-section" class="py-20 bg-white">
                <div class="container mx-auto px-6">
                    <div class="grid lg:grid-cols-2 gap-12 items-center">
                        <div class="h-[500px] overflow-hidden rounded-2xl shadow-xl">
                            <img class="w-full h-full object-cover" src="{{ get_implantation_content()['about']->image_url ?? asset('storage/'.get_implantation_content()['about']->image) }}" alt="{{ get_implantation_content()['about']->title }}" />
                        </div>
                        <div>
                            <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-6">{{ get_implantation_content()['about']->title }}</h2>
                            <p class="text-lg text-gray-700 mb-6">{!! get_implantation_content()['about']->description !!}</p>
                            {{-- <div class="space-y-4 mb-8">
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-sonec-green/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-check text-sonec-green text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-sonec-dark mb-1">{{ get_implantation_content()['about']->feature1_title }}</h3>
                                        <p class="text-gray-700">{{ get_implantation_content()['about']->feature1_description }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-sonec-green/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-check text-sonec-green text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-sonec-dark mb-1">{{ get_implantation_content()['about']->feature2_title }}</h3>
                                        <p class="text-gray-700">{{ get_implantation_content()['about']->feature2_description }}</p>
                                    </div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="w-12 h-12 bg-sonec-green/10 rounded-lg flex items-center justify-center flex-shrink-0">
                                        <i class="fas fa-check text-sonec-green text-xl"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-bold text-sonec-dark mb-1">{{ get_implantation_content()['about']->feature3_title }}</h3>
                                        <p class="text-gray-700">{{ get_implantation_content()['about']->feature3_description }}</p>
                                    </div>
                                </div>
                            </div> --}}
                            @if(get_implantation_content()['about']->cta_label && get_implantation_content()['about']->cta_url)
                                <a href="{{ get_implantation_content()['about']->cta_url }}" class="inline-flex items-center gap-2 bg-sonec-green text-white px-8 py-4 rounded-lg font-semibold hover:bg-sonec-dark transition-colors">
                                    {{ get_implantation_content()['about']->cta_label }}
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </section>
        @endif
        
        @if(isset(get_implantation_content()['accroche']))

            <section id="contact-cta" class="py-20 bg-sonec-dark">
                <div class="container mx-auto px-6">
                    <div class="max-w-4xl mx-auto text-center">
                        <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">{{ get_implantation_content()['accroche']->title }}</h2>
                        <p class="text-xl text-gray-300 mb-10">{!! get_implantation_content()['accroche']->description !!}</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            @if(get_implantation_content()['accroche']->cta_label && get_implantation_content()['accroche']->cta_url)
                            <a href="{{ get_implantation_content()['accroche']->cta_url }}" class="inline-block bg-sonec-green text-white px-8 py-4 rounded-lg font-semibold hover:bg-sonec-lime hover:text-sonec-dark transition-colors">
                                {{ get_implantation_content()['accroche']->cta_label }}
                            </a>
                            @endif
                            <a href="{{ route('web.contact') }}" class="inline-block bg-white text-sonec-dark px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                                Demander un rendez-vous
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection