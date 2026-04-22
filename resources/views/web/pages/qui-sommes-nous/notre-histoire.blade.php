@extends('web.layout.websiteLayout')

@section('content')
    <main class="pt-20">
        <section id="hero-history" class="relative h-[400px] bg-gradient-to-br from-sonec-dark to-sonec-green flex items-center">
            <div class="absolute inset-0 opacity-10">
                <div class="w-full h-full" style="background-image: url('data:image/svg+xml,%3Csvg width=\'60\' height=\'60\' viewBox=\'0 0 60 60\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cg fill=\'none\' fill-rule=\'evenodd\'%3E%3Cg fill=\'%23ffffff\' fill-opacity=\'1\'%3E%3Cpath d=\'M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z\'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E');"></div>
            </div>
            <div class="container mx-auto px-6 relative z-10">
                <div class="max-w-3xl">
                    <div class="inline-block bg-sonec-lime/20 px-4 py-2 rounded-full mb-4">
                        <span class="text-white font-semibold text-sm">Qui sommes-nous</span>
                    </div>
                    <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6">Notre Histoire</h1>
                    <p class="text-xl text-gray-100">Plus de 15 ans d'innovation et d'excellence au service de la transformation digitale en Afrique</p>
                </div>
            </div>
        </section>

        <section id="intro-section" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-4xl font-bold text-sonec-dark mb-6">Une Aventure Panafricaine</h2>
                    <p class="text-xl text-gray-700 leading-relaxed">Depuis sa création en 2009 en Côte d'Ivoire, SONEC Africa n'a cessé de croître et d'innover. Notre parcours est marqué par des étapes clés qui témoignent de notre engagement constant envers l'excellence technologique et notre vision d'une Afrique digitalisée et connectée.</p>
                </div>
            </div>
        </section>

        <section id="timeline-section" class="py-20 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="max-w-5xl mx-auto relative">
                    <div class="absolute left-1/2 top-0 bottom-0 w-1 timeline-line hidden lg:block transform -translate-x-1/2"></div>

                    <div class="space-y-16">
                        <div id="timeline-item-2009" class="timeline-item relative">
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
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="stats-section" class="py-20 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-sonec-dark mb-4">Notre Impact en Chiffres</h2>
                    <p class="text-xl text-gray-600">Des résultats qui témoignent de notre croissance</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">
                    <div class="bg-gray-50 p-8 rounded-2xl text-center hover:shadow-xl transition-shadow">
                        <div class="w-20 h-20 bg-sonec-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-calendar-alt text-sonec-green text-3xl"></i>
                        </div>
                        <div class="text-5xl font-bold text-sonec-green mb-2">15+</div>
                        <p class="text-gray-700 font-semibold">Années d'Expérience</p>
                    </div>

                    <div class="bg-gray-50 p-8 rounded-2xl text-center hover:shadow-xl transition-shadow">
                        <div class="w-20 h-20 bg-sonec-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-map-marked-alt text-sonec-green text-3xl"></i>
                        </div>
                        <div class="text-5xl font-bold text-sonec-green mb-2">7</div>
                        <p class="text-gray-700 font-semibold">Pays d'Implantation</p>
                    </div>

                    <div class="bg-gray-50 p-8 rounded-2xl text-center hover:shadow-xl transition-shadow">
                        <div class="w-20 h-20 bg-sonec-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-trophy text-sonec-green text-3xl"></i>
                        </div>
                        <div class="text-5xl font-bold text-sonec-green mb-2">2</div>
                        <p class="text-gray-700 font-semibold">Prix d'Excellence</p>
                    </div>

                    <div class="bg-gray-50 p-8 rounded-2xl text-center hover:shadow-xl transition-shadow">
                        <div class="w-20 h-20 bg-sonec-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-chart-line text-sonec-green text-3xl"></i>
                        </div>
                        <div class="text-5xl font-bold text-sonec-green mb-2">1Mrd+</div>
                        <p class="text-gray-700 font-semibold">FCFA de CA</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="values-section" class="py-20 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl font-bold text-sonec-dark mb-4">Les Valeurs Qui Nous Guident</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Depuis nos débuts, ces principes fondamentaux orientent chacune de nos décisions</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-shadow">
                        <div class="w-16 h-16 bg-sonec-green rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-lightbulb text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-sonec-dark mb-4">Innovation</h3>
                        <p class="text-gray-700">Nous repoussons constamment les limites technologiques pour offrir des solutions avant-gardistes adaptées au contexte africain.</p>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-shadow">
                        <div class="w-16 h-16 bg-sonec-green rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-star text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-sonec-dark mb-4">Excellence</h3>
                        <p class="text-gray-700">La qualité est au cœur de tout ce que nous faisons. Nos prix d'excellence en sont la preuve tangible.</p>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-shadow">
                        <div class="w-16 h-16 bg-sonec-green rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-handshake text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-sonec-dark mb-4">Partenariat</h3>
                        <p class="text-gray-700">Nous construisons des relations durables basées sur la confiance et le succès mutuel avec nos clients.</p>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-shadow">
                        <div class="w-16 h-16 bg-sonec-green rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-users text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-sonec-dark mb-4">Impact Social</h3>
                        <p class="text-gray-700">Nous contribuons activement au développement économique et social des communautés où nous opérons.</p>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-shadow">
                        <div class="w-16 h-16 bg-sonec-green rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-shield-alt text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-sonec-dark mb-4">Intégrité</h3>
                        <p class="text-gray-700">Transparence, éthique et responsabilité guident toutes nos actions et décisions d'entreprise.</p>
                    </div>

                    <div class="bg-white p-8 rounded-2xl shadow-md hover:shadow-xl transition-shadow">
                        <div class="w-16 h-16 bg-sonec-green rounded-xl flex items-center justify-center mb-6">
                            <i class="fas fa-globe-africa text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-sonec-dark mb-4">Vision Panafricaine</h3>
                        <p class="text-gray-700">Notre expansion continue témoigne de notre engagement à connecter et digitaliser l'ensemble du continent.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="cta-history" class="py-20 bg-sonec-dark">
            <div class="container mx-auto px-6">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">Rejoignez Notre Histoire</h2>
                    <p class="text-xl text-gray-300 mb-10">Faites partie de la prochaine étape de notre aventure et contribuez à façonner l'avenir digital de l'Afrique</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#" class="inline-block bg-sonec-green text-white px-8 py-4 rounded-lg font-semibold hover:bg-sonec-lime hover:text-sonec-dark transition-colors">
                            Découvrir nos opportunités
                        </a>
                        <a href="#" class="inline-block bg-white text-sonec-dark px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            Nous contacter
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection