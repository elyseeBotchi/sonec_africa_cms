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
                                <p class="text-xl text-gray-200 mb-8">{!! $carousel->description !!}</p>
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
        
        @if(isset(get_accueil_content()['solutions']) && get_accueil_content()['solutions']->isNotEmpty())

            <section id="solutions-section" class="py-20 bg-white">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Nos solutions phares</h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Des produits innovants conçus pour répondre aux défis spécifiques de chaque secteur</p>
                    </div>

                    <div class="grid lg:grid-cols-3 gap-8">
                        @foreach(get_accueil_content()['solutions'] as $solution)
                        <div class="bg-white border border-gray-200 rounded-2xl overflow-hidden hover:shadow-2xl transition-shadow">
                            <div class="h-56 overflow-hidden">
                                <img class="w-full h-full object-cover" src="{{ $solution->image ? asset('storage/'.$solution->image) : $solution->image_url }}" alt="{{ $solution->title }}">
                            </div>
                            <div class="p-8">
                                <div class="w-14 h-14 bg-sonec-green rounded-xl flex items-center justify-center mb-4">
                                    <i class="{{ $solution->icon }} text-white text-2xl"></i>
                                    @if($solution->icon && str_starts_with($solution->icon, 'fa'))
                                    @else
                                        {{ $solution->icon }}
                                    @endif
                                    {{-- <i class="fas fa-graduation-cap text-white text-2xl"></i> --}}
                                </div>
                                <h3 class="text-2xl font-bold text-sonec-dark mb-3">{{ $solution->title }}</h3>
                                <p class="text-gray-700 mb-6">{!! $solution->resume !!}</p>
                                <ul class="space-y-2 mb-6">
                                    @foreach($solution->fonctionnalites as $fonctionnalite)
                                        <li class="flex items-start gap-3">
                                            <i class="fas fa-check text-sonec-green mt-1"></i>
                                            <span class="text-gray-700">{!! $fonctionnalite->description !!}</span>
                                        </li>
                                    @endforeach
                                </ul>
                                <a href="#" class="inline-flex items-center gap-2 text-sonec-green font-semibold hover:text-sonec-dark transition-colors">
                                    En savoir plus
                                    <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>


                        @endforeach
                    </div>

                    <div class="text-center mt-12">
                        <a href="#" class="inline-block bg-sonec-green text-white px-8 py-4 rounded-lg font-semibold hover:bg-sonec-dark transition-colors">
                            Voir toutes nos solutions
                        </a>
                    </div>
                </div>
            </section>
        @endif

        @if(isset(get_accueil_content()['clients']) && get_accueil_content()['clients']->isNotEmpty())
            <section id="trust-section" class="py-20 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Ils nous font confiance</h2>
                        <p class="text-xl text-gray-600">Des partenaires prestigieux à travers l'Afrique</p>
                    </div>

                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center">
                        @foreach (get_accueil_content()['clients'] as $client)
                            <div class="bg-white p-6 rounded-lg flex items-center justify-center h-24 grayscale hover:grayscale-0 transition-all">
                                @if($client->logo_url || $client->logo)
                                    <img class="h-12 object-contain" src="{{ $client->logo_url ?? asset('storage/'.$client->logo) }}" alt="{{ $client->name }}">    
                                @else
                                    <div class="text-2xl font-bold text-gray-400">{{ $client->name }}</div>
                                @endif
                            </div>
                        @endforeach
                        
                    </div>
                </div>
            </section>
        @endif
        
        @if(isset(get_accueil_content()['secteurs_expertise']) && get_accueil_content()['secteurs_expertise']->isNotEmpty())
        
            <section id="industries-section" class="py-20 bg-white">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Nos secteurs d'expertise</h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Une connaissance approfondie des enjeux spécifiques à chaque industrie</p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        {{-- <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-shadow border border-gray-100">
                            <div class="w-16 h-16 bg-sonec-green/10 rounded-xl flex items-center justify-center mb-4">
                                <i class="fas fa-university text-sonec-green text-3xl"></i>
                            </div>
                            <h3 class="text-xl font-bold text-sonec-dark mb-3">Banques &amp; Assurances</h3>
                            <p class="text-gray-700">Solutions fintech sécurisées et conformes aux régulations bancaires africaines</p>
                        </div> --}}

                        @foreach (get_accueil_content()['secteurs_expertise'] as $secteur)
                            <div class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-shadow border border-gray-100">
                                <div class="w-16 h-16 bg-sonec-green/10 rounded-xl flex items-center justify-center mb-4">
                                    @if($secteur->icon && str_starts_with($secteur->icon, 'fa'))
                                        <i class="{{ $secteur->icon }} text-sonec-green text-3xl"></i>
                                    @else
                                        {{ $secteur->icon }}
                                    @endif
                                </div>
                                <h3 class="text-xl font-bold text-sonec-dark mb-3">{{ $secteur->name }}</h3>
                                <p class="text-gray-700">{{ $secteur->subtitle_hero }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </section>

        @endif

        @if(isset(get_accueil_content()['partenaires']) && get_accueil_content()['partenaires']->isNotEmpty())

            <section id="partners-section" class="py-20 bg-gray-50 overflow-hidden">
                <div class="container mx-auto px-6 mb-12">
                    <div class="text-center">
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Nos Partenaires Technologiques</h2>
                        <p class="text-xl text-gray-600">Des alliances stratégiques avec les leaders mondiaux de la tech</p>
                    </div>
                </div>

                <div class="relative">
                    <div class="flex gap-12 partner-scroll">
                        @foreach (get_accueil_content()['partenaires'] as $partenaire)
                            <div class="flex-shrink-0 bg-white px-12 py-8 rounded-lg flex items-center justify-center min-w-[200px]">
                                @if($partenaire->logo_url || $partenaire->logo)
                                    <img class="h-12 object-contain" src="{{ $partenaire->logo_url ?? asset('storage/'.$partenaire->logo) }}" alt="{{ $partenaire->name }}">
                                @else
                                    <div class="text-3xl font-bold text-gray-300">{{ $partenaire->name }}</div>
                                @endif
                            </div>                            
                        @endforeach                        
                    </div>
                </div>
            </section>
        @endif
        
        @if(isset(get_accueil_content()['articles']) && get_accueil_content()['articles']->isNotEmpty())
            
            <section id="news-section" class="py-20 bg-white">
                <div class="container mx-auto px-6">
                    <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center mb-16">
                        <div>
                            <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Actualités &amp; Insights</h2>
                            <p class="text-xl text-gray-600">Restez informés de nos dernières innovations</p>
                        </div>
                        <a href="{{ route('web.actualites') }}" class="mt-6 lg:mt-0 inline-flex items-center gap-2 text-sonec-green font-semibold hover:text-sonec-dark transition-colors">
                            Voir toutes les actualités
                            <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>

                    <div class="grid lg:grid-cols-3 gap-8">
                        @foreach (get_accueil_content()['articles'] as $article)
                            <article class="bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-shadow">
                                <div class="h-56 overflow-hidden">
                                    <img class="w-full h-full object-cover" src="{{ $article->image_url ?? asset('storage/'.$article->image_article) }}" alt="{{ $article->title }}">
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                                        <span class="flex items-center gap-1">
                                            <i class="far fa-calendar"></i>
                                            {{-- convertir la date au format 15 Janvier 2024 --}}
                                            {{ $article->published_at->format('d F Y') }}
                                        </span>
                                        <span class="px-3 py-1 bg-sonec-lime/20 text-sonec-dark rounded-full text-xs font-semibold">{{ $article->category->label }}</span>
                                    </div>
                                    <h3 class="text-xl font-bold text-sonec-dark mb-3">{{ $article->title }}</h3>
                                    <p class="text-gray-700 mb-4">{!! $article->description_courte !!}</p>
                                    <a href="{{ route('web.actualites.show',$article->slug) }}" class="inline-flex items-center gap-2 text-sonec-green font-semibold hover:text-sonec-dark transition-colors">
                                        Lire la suite
                                        <i class="fas fa-arrow-right"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        @endif

        @if(isset(get_accueil_content()['temoignages']) && get_accueil_content()['temoignages']->isNotEmpty())
            <section id="testimonials-section" class="py-20 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Ce que disent nos clients</h2>
                        <p class="text-xl text-gray-600">Des témoignages qui reflètent notre engagement envers l'excellence</p>
                    </div>

                    <div class="grid lg:grid-cols-3 gap-8">
                        @foreach (get_accueil_content()['temoignages'] as $temoignage)
                            <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-xl transition-shadow">
                                <div class="flex items-center gap-1 text-sonec-lime mb-4">
                                    @for ($i = 0; $i < 5; $i++)
                                        <i class="fas fa-star"></i>
                                    @endfor
                                </div>
                                <p class="text-gray-700 mb-6 italic">{!! $temoignage->message !!}</p>
                                <div class="flex items-center gap-4">
                                    <img src="{{ $temoignage->photo_url ?? asset('storage/'.$temoignage->photo) }}" alt="{{ $temoignage->name }}" class="w-12 h-12 rounded-full object-cover">
                                    <div>
                                        <div class="font-bold text-sonec-dark">{{ $temoignage->name }}</div>
                                        <div class="text-sm text-gray-600">{{ $temoignage->position }}</div>
                                    </div>
                                </div>
                            </div>                            
                        @endforeach                       
                    </div>
                </div>
            </section>
        @endif

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

    <script>
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.carousel-dot');
        let currentIndex = 0;

        function showSlide(index) {
            slides.forEach((slide, i) => {
                slide.style.opacity = i === index ? '1' : '0';
                slide.style.visibility = i === index ? 'visible' : 'hidden';
            });
            dots.forEach((dot, i) => {
                dot.classList.toggle('active', i === index);
            });
            currentIndex = index;
        }

        document.getElementById('carousel-prev').addEventListener('click', () => {
            const newIndex = (currentIndex - 1 + slides.length) % slides.length;
            showSlide(newIndex);
        });

        document.getElementById('carousel-next').addEventListener('click', () => {
            const newIndex = (currentIndex + 1) % slides.length;
            showSlide(newIndex);
        });

        dots.forEach((dot, index) => {
            dot.addEventListener('click', () => {
                showSlide(index);
            });
        });

        // Auto-slide every 5 seconds
        setInterval(() => {
            const newIndex = (currentIndex + 1) % slides.length;
            showSlide(newIndex);
        }, 5000);
    </script>
@endsection

