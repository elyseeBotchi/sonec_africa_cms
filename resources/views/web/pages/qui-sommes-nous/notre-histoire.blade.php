@extends('web.layout.websiteLayout')

@section('content')
    <main class="pt-20">
        @if(isset(get_histoire_content()['banniere']) && (get_histoire_content()['banniere']->image_url || get_histoire_content()['banniere']->title || get_histoire_content()['banniere']->image))
            <section id="hero-history" class="relative h-[400px] bg-gradient-to-br from-sonec-dark to-sonec-green flex items-center">
                <div class="absolute inset-0 opacity-10">
                    <div class="w-full h-full" style="background-image: url('{{ get_histoire_content()['banniere']->image_url ?? asset('storage/'.get_histoire_content()['banniere']->image) }}');"></div>
                </div>
                <div class="container mx-auto px-6 relative z-10">
                    <div class="max-w-3xl">
                        <div class="inline-block bg-sonec-lime/20 px-4 py-2 rounded-full mb-4">
                            <span class="text-white font-semibold text-sm">Qui sommes-nous</span>
                        </div>
                        <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6">{{ get_histoire_content()['banniere']->title }}</h1>
                        <p class="text-xl text-gray-100">{!! get_histoire_content()['banniere']->subtitle !!}</p>
                    </div>
                </div>
            </section>
        @endif

        @if(isset(get_histoire_content()['section_premiere']))        
            <section id="intro-section" class="py-20 bg-white">
                <div class="container mx-auto px-6">
                    <div class="max-w-4xl mx-auto text-center">
                        <h2 class="text-4xl font-bold text-sonec-dark mb-6">{{ get_histoire_content()['section_premiere']->title }}</h2>
                        <p class="text-xl text-gray-700 leading-relaxed">{!! get_histoire_content()['section_premiere']->description !!}</p>
                    </div>
                </div>
            </section>
        @endif

        @if(isset(get_histoire_content()['historiques']) && get_histoire_content()['historiques']->isNotEmpty())

            <section id="timeline-section" class="py-20 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="max-w-5xl mx-auto relative">
                        <div class="absolute left-1/2 top-0 bottom-0 w-1 timeline-line hidden lg:block transform -translate-x-1/2"></div>

                        <div class="space-y-16">
                            @foreach (get_histoire_content()['historiques'] as $historique)
                                @php $isEven = $loop->iteration % 2 == 0; @endphp
                                
                                <div id="timeline-item-{{ $historique->id }}" class="timeline-item relative">
                                    <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">

                                        {{-- Colonne GAUCHE --}}
                                        @if(!$isEven)
                                            {{-- Impair : Texte à gauche --}}
                                            <div class="lg:text-right mb-8 lg:mb-0">
                                                <div class="inline-block lg:block">
                                                    <div class="text-5xl font-bold text-sonec-green mb-4">{{ $historique->annee }}</div>
                                                    <h3 class="text-2xl font-bold text-sonec-dark mb-4">{{ $historique->title }}</h3>
                                                    <p class="text-lg text-gray-700">{!! $historique->description !!}</p>
                                                </div>
                                            </div>
                                        @else
                                            {{-- Pair : Image à gauche --}}
                                            <div class="order-2 lg:order-1 relative">
                                                <div class="absolute right-0 lg:right-1/2 top-8 lg:top-1/2 w-6 h-6 bg-sonec-green rounded-full timeline-dot border-4 border-white shadow-lg lg:transform lg:translate-x-1/2 lg:-translate-y-1/2 z-10"></div>
                                                <div class="lg:pr-12">
                                                    <div class="h-64 rounded-2xl overflow-hidden shadow-xl">
                                                        <img class="w-full h-full object-cover" src="{{ $historique->image_url ?? asset('storage/'.$historique->image) }}" alt="{{ $historique->title }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                        {{-- Colonne DROITE --}}
                                        @if(!$isEven)
                                            {{-- Impair : Image à droite --}}
                                            <div class="relative">
                                                <div class="absolute left-0 lg:left-1/2 top-8 lg:top-1/2 w-6 h-6 bg-sonec-green rounded-full timeline-dot border-4 border-white shadow-lg lg:transform lg:-translate-x-1/2 lg:-translate-y-1/2 z-10"></div>
                                                <div class="lg:pl-12">
                                                    <div class="h-64 rounded-2xl overflow-hidden shadow-xl">
                                                        <img class="w-full h-full object-cover" src="{{ $historique->image_url ?? asset('storage/'.$historique->image) }}" alt="{{ $historique->title }}" />
                                                    </div>
                                                </div>
                                            </div>
                                        @else
                                            {{-- Pair : Texte à droite --}}
                                            <div class="order-1 lg:order-2 lg:text-left mb-8 lg:mb-0">
                                                <div class="inline-block lg:block">
                                                    <div class="text-5xl font-bold text-sonec-green mb-4">{{ $historique->annee }}</div>
                                                    <h3 class="text-2xl font-bold text-sonec-dark mb-4">{{ $historique->title }}</h3>
                                                    <p class="text-lg text-gray-700">{!! $historique->description !!}</p>
                                                </div>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            @endforeach
                            {{-- <div id="timeline-item-2009" class="timeline-item relative">
                                <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                                    <div class="lg:text-right mb-8 lg:mb-0">
                                        <div class="inline-block lg:block">
                                            <div class="text-5xl font-bold text-sonec-green mb-4">2009</div>
                                            <h3 class="text-2xl font-bold text-sonec-dark mb-4">Création de SONEC AFRICA</h3>
                                            <p class="text-lg text-gray-700">Création de SONEC AFRICA en Côte d'Ivoire. Début de l'aventure panafricaine.</p>
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <div class="absolute left-0 lg:left-1/2 top-8 lg:top-1/2 w-6 h-6 bg-sonec-green rounded-full timeline-dot border-4 border-white shadow-lg lg:transform lg:-translate-x-1/2 lg:-translate-y-1/2 z-10"></div>
                                        <div class="lg:pl-12">
                                            <div class="h-64 rounded-2xl overflow-hidden shadow-xl">
                                                <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/4211f096f3-c4b0a68fd26d7d90dc39.png" alt="modern office building abidjan ivory coast african business district" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="timeline-item-2014" class="timeline-item relative">
                                <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                                    <div class="order-2 lg:order-1 relative">
                                        <div class="absolute right-0 lg:right-1/2 top-8 lg:top-1/2 w-6 h-6 bg-sonec-green rounded-full timeline-dot border-4 border-white shadow-lg lg:transform lg:translate-x-1/2 lg:-translate-y-1/2 z-10"></div>
                                        <div class="lg:pr-12">
                                            <div class="h-64 rounded-2xl overflow-hidden shadow-xl">
                                                <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/2d3921e135-fd245e85b999673d3000.png" alt="benin business expansion west africa map location" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-1 lg:order-2 lg:text-left mb-8 lg:mb-0">
                                        <div class="inline-block lg:block">
                                            <div class="text-5xl font-bold text-sonec-green mb-4">2014</div>
                                            <h3 class="text-2xl font-bold text-sonec-dark mb-4">Expansion Régionale</h3>
                                            <p class="text-lg text-gray-700">Ouverture de la 1ère filiale internationale au Bénin.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="timeline-item-2015" class="timeline-item relative">
                                <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                                    <div class="lg:text-right mb-8 lg:mb-0">
                                        <div class="inline-block lg:block">
                                            <div class="text-5xl font-bold text-sonec-green mb-4">2015</div>
                                            <h3 class="text-2xl font-bold text-sonec-dark mb-4">Renforcement en Afrique de l'Ouest</h3>
                                            <p class="text-lg text-gray-700">Installation en Guinée. Renforcement en Afrique de l'Ouest.</p>
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <div class="absolute left-0 lg:left-1/2 top-8 lg:top-1/2 w-6 h-6 bg-sonec-green rounded-full timeline-dot border-4 border-white shadow-lg lg:transform lg:-translate-x-1/2 lg:-translate-y-1/2 z-10"></div>
                                        <div class="lg:pl-12">
                                            <div class="h-64 rounded-2xl overflow-hidden shadow-xl">
                                                <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/371fdf937d-b35fd7097d2b5e942838.png" alt="modern tech office guinea west africa business professionals" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="timeline-item-2017" class="timeline-item relative">
                                <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                                    <div class="order-2 lg:order-1 relative">
                                        <div class="absolute right-0 lg:right-1/2 top-8 lg:top-1/2 w-6 h-6 bg-sonec-green rounded-full timeline-dot border-4 border-white shadow-lg lg:transform lg:translate-x-1/2 lg:-translate-y-1/2 z-10"></div>
                                        <div class="lg:pr-12">
                                            <div class="h-64 rounded-2xl overflow-hidden shadow-xl">
                                                <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/48669cc797-e8e729ee4a65062eec1c.png" alt="dakar senegal business district modern architecture" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-1 lg:order-2 lg:text-left mb-8 lg:mb-0">
                                        <div class="inline-block lg:block">
                                            <div class="text-5xl font-bold text-sonec-green mb-4">2017</div>
                                            <h3 class="text-2xl font-bold text-sonec-dark mb-4">Élargissement de l'Écosystème</h3>
                                            <p class="text-lg text-gray-700">Ouverture de la filiale au Sénégal. Élargissement de l'écosystème.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="timeline-item-2018" class="timeline-item relative">
                                <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                                    <div class="lg:text-right mb-8 lg:mb-0">
                                        <div class="inline-block lg:block">
                                            <div class="text-5xl font-bold text-sonec-green mb-4">2018</div>
                                            <h3 class="text-2xl font-bold text-sonec-dark mb-4">Reconnaissance Innovation & Qualité</h3>
                                            <p class="text-lg text-gray-700">Premier Prix National d'Excellence en Côte d'Ivoire. Reconnaissance Innovation & Qualité.</p>
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <div class="absolute left-0 lg:left-1/2 top-8 lg:top-1/2 w-6 h-6 bg-sonec-green rounded-full timeline-dot border-4 border-white shadow-lg lg:transform lg:-translate-x-1/2 lg:-translate-y-1/2 z-10"></div>
                                        <div class="lg:pl-12">
                                            <div class="h-64 rounded-2xl overflow-hidden shadow-xl">
                                                <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/a427ead029-75c3227315b625bd3535.png" alt="award ceremony business excellence trophy african entrepreneur" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="timeline-item-2019a" class="timeline-item relative">
                                <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                                    <div class="order-2 lg:order-1 relative">
                                        <div class="absolute right-0 lg:right-1/2 top-8 lg:top-1/2 w-6 h-6 bg-sonec-green rounded-full timeline-dot border-4 border-white shadow-lg lg:transform lg:translate-x-1/2 lg:-translate-y-1/2 z-10"></div>
                                        <div class="lg:pr-12">
                                            <div class="h-64 rounded-2xl overflow-hidden shadow-xl">
                                                <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/c0ef666f3e-734a16213f6c25d79d43.png" alt="chad central africa business expansion modern office" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-1 lg:order-2 lg:text-left mb-8 lg:mb-0">
                                        <div class="inline-block lg:block">
                                            <div class="text-5xl font-bold text-sonec-green mb-4">2019</div>
                                            <h3 class="text-2xl font-bold text-sonec-dark mb-4">Extension en Afrique Centrale</h3>
                                            <p class="text-lg text-gray-700">Extension en Afrique Centrale (Ouverture filiale Tchad).</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="timeline-item-2019b" class="timeline-item relative">
                                <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                                    <div class="lg:text-right mb-8 lg:mb-0">
                                        <div class="inline-block lg:block">
                                            <div class="text-5xl font-bold text-sonec-green mb-4">2019</div>
                                            <h3 class="text-2xl font-bold text-sonec-dark mb-4">Excellence Confirmée</h3>
                                            <p class="text-lg text-gray-700">Deuxième Prix National d'Excellence consécutif.</p>
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <div class="absolute left-0 lg:left-1/2 top-8 lg:top-1/2 w-6 h-6 bg-sonec-green rounded-full timeline-dot border-4 border-white shadow-lg lg:transform lg:-translate-x-1/2 lg:-translate-y-1/2 z-10"></div>
                                        <div class="lg:pl-12">
                                            <div class="bg-gradient-to-br from-sonec-green to-sonec-lime h-64 rounded-2xl flex items-center justify-center shadow-xl">
                                                <div class="text-center text-white">
                                                    <i class="fas fa-trophy text-7xl mb-4 opacity-90"></i>
                                                    <p class="text-2xl font-bold">2ème Prix Consécutif</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="timeline-item-2019c" class="timeline-item relative">
                                <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                                    <div class="order-2 lg:order-1 relative">
                                        <div class="absolute right-0 lg:right-1/2 top-8 lg:top-1/2 w-6 h-6 bg-sonec-green rounded-full timeline-dot border-4 border-white shadow-lg lg:transform lg:translate-x-1/2 lg:-translate-y-1/2 z-10"></div>
                                        <div class="lg:pr-12">
                                            <div class="bg-gradient-to-br from-sonec-dark to-sonec-green h-64 rounded-2xl flex items-center justify-center shadow-xl">
                                                <div class="text-center text-white">
                                                    <div class="text-6xl font-bold mb-2">1 Mrd</div>
                                                    <p class="text-xl font-semibold">FCFA</p>
                                                    <p class="text-sm mt-2 opacity-90">Chiffre d'affaires</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="order-1 lg:order-2 lg:text-left mb-8 lg:mb-0">
                                        <div class="inline-block lg:block">
                                            <div class="text-5xl font-bold text-sonec-green mb-4">2019</div>
                                            <h3 class="text-2xl font-bold text-sonec-dark mb-4">Croissance Soutenue</h3>
                                            <p class="text-lg text-gray-700">Franchissement du cap du milliard de FCFA de chiffre d'affaires. Symbole de croissance soutenue.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="timeline-item-2020" class="timeline-item relative">
                                <div class="lg:grid lg:grid-cols-2 lg:gap-12 items-center">
                                    <div class="lg:text-right mb-8 lg:mb-0">
                                        <div class="inline-block lg:block">
                                            <div class="text-5xl font-bold text-sonec-green mb-4">2020</div>
                                            <h3 class="text-2xl font-bold text-sonec-dark mb-4">Stratégie Afrique Centrale</h3>
                                            <p class="text-lg text-gray-700">Implantation au Cameroun. Poursuite de la stratégie en Afrique Centrale.</p>
                                        </div>
                                    </div>
                                    <div class="relative">
                                        <div class="absolute left-0 lg:left-1/2 top-8 lg:top-1/2 w-6 h-6 bg-sonec-green rounded-full timeline-dot border-4 border-white shadow-lg lg:transform lg:-translate-x-1/2 lg:-translate-y-1/2 z-10"></div>
                                        <div class="lg:pl-12">
                                            <div class="h-64 rounded-2xl overflow-hidden shadow-xl">
                                                <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/b20148e2bf-bf9659b43858c9dd05a5.png" alt="cameroon business district yaoundé modern architecture central africa" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </section>
        @endif


        @if(isset(get_histoire_content()['chiffres']) && get_histoire_content()['chiffres']->isNotEmpty())
        
            <section id="stats-section" class="py-20 bg-white">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-bold text-sonec-dark mb-4">Notre Impact en Chiffres</h2>
                        <p class="text-xl text-gray-600">Des résultats qui témoignent de notre croissance</p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                        @foreach (get_histoire_content()['chiffres'] as $chiffre)
                             <div class="bg-gray-50 p-8 rounded-2xl text-center hover:shadow-xl transition-shadow">
                                <div class="w-20 h-20 bg-sonec-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                                    @if($chiffre->icon && str_contains($chiffre->icon, 'fa-'))
                                        <i class="{{ $chiffre->icon }} text-sonec-green text-3xl"></i>
                                    @else
                                        <i class="fas fa-chart-bar text-sonec-green text-3xl"></i>
                                    @endif
                                </div>
                                <div class="text-5xl font-bold text-sonec-green mb-2">{{ $chiffre->value }}</div>
                                <p class="text-gray-700 font-semibold">{{ $chiffre->label }}</p>
                            </div>
                        @endforeach

                        </div>
                    </div>
                </div>
            </section>
        @endif

        
        
        @if(isset(get_histoire_content()['valeurs']) && get_histoire_content()['valeurs']->isNotEmpty())
            <section id="values-section" class="py-20 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl font-bold text-sonec-dark mb-4">Les Valeurs Qui Nous Guident</h2>
                        <p class="text-xl text-gray-600 max-w-3xl mx-auto">Depuis nos débuts, ces principes fondamentaux orientent chacune de nos décisions</p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                        @foreach (get_histoire_content()['valeurs'] as $valeur)
                                <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-shadow">
                                    <div class="w-16 h-16 bg-sonec-green rounded-xl flex items-center justify-center mb-6">
                                        @if($valeur->icon && str_contains($valeur->icon, 'fa-'))
                                            <i class="{{ $valeur->icon }} text-white text-3xl"></i>
                                        @else
                                            <i class="fas fa-chart-bar text-white text-3xl"></i>
                                        @endif
                                    </div>
                                    <h3 class="text-2xl font-bold text-sonec-dark mb-4">{{ $valeur->label }}</h3>
                                    <p class="text-gray-700">{!! $valeur->description !!}</p>
                                </div>
                        @endforeach
                        
                    </div>
                </div>
            </section>
        @endif
        @if(isset(get_histoire_content()['accroche']))        
            <section id="cta-history" class="py-20 bg-sonec-dark">
                <div class="container mx-auto px-6">
                    <div class="max-w-4xl mx-auto text-center">
                        <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">{{ get_histoire_content()['accroche']->title }}</h2>
                        <p class="text-xl text-gray-300 mb-10">{!! get_histoire_content()['accroche']->description !!}</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center">
                            @if(get_histoire_content()['accroche']->cta_label && get_histoire_content()['accroche']->cta_url)
                                <a href="{{ get_histoire_content()['accroche']->cta_url ?? '#' }}" class="inline-block bg-sonec-green text-white px-8 py-4 rounded-lg font-semibold hover:bg-sonec-lime hover:text-sonec-dark transition-colors">
                                    {{ get_histoire_content()['accroche']->cta_label }}
                                </a>
                            @endif
                            <a href="#" class="inline-block bg-white text-sonec-dark px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                                Nous contacter
                            </a>
                        </div>
                    </div>
                </div>
            </section>
        @endif        
    </main>
     
@endsection

@section('script')
   <script>
        // Animation de la timeline
        window.addEventListener('load', () => {
            const timelineItems = document.querySelectorAll('.timeline-item');

            const observerOptions = {
                threshold: 0.2,
                rootMargin: '0px 0px -100px 0px'
            };

            const observer = new IntersectionObserver(function(entries) {
                entries.forEach(function(entry) {
                    if (entry.isIntersecting) {
                        entry.target.classList.add('visible');
                    }
                });
            }, observerOptions);

            timelineItems.forEach(function(item) {
                observer.observe(item);
            });
        });
    </script>
@endsection