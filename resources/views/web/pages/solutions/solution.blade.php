@extends('web.layout.websiteLayout')

@section('content')
    <main class="pt-20">
        @if(isset($solution->sections) && $solution->sections->count() > 0)
            @foreach($solution->sections as $section)
                <section id="{{ $section->section_key }}" class="h-[700px] bg-white flex items-center mb-16">
                    {!! $section->content !!}
                </section>
            @endforeach
        @endif  
        @if(isset($solution->chiffres) && $solution->chiffres->count() > 0 || isset($solution->partenaires) && $solution->partenaires->count() > 0 )
        
            <section id="preuve-sociale" class="py-24 bg-gray-50">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-6">Ils nous font confiance</h2>
                        <p class="text-xl text-gray-600">Plus de 150 établissements utilisent ÉcoleWeb au quotidien</p>
                    </div>               
                   
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-16">
                        
                         @foreach ($solution->chiffres as $chiffre)
                        
                            <div class="bg-white p-8 rounded-xl flex items-center justify-center h-32 shadow-sm">
                                <div class="text-center">
                                    <div class="text-4xl font-bold text-sonec-green mb-1">{{ $chiffre->value }}</div>
                                    <div class="text-sm text-gray-600">{{ $chiffre->label }}</div>
                                </div>
                            </div>
                        @endforeach
                        
                    </div>

                    <div class="bg-white p-12 rounded-2xl shadow-md">
                        <h3 class="text-2xl font-bold text-sonec-dark mb-8 text-center">Nos écoles partenaires</h3>
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center opacity-60">
                            @foreach ($solution->partenaires as $partenaire)
                            
                            <div class="h-20 bg-gray-100 rounded-lg flex items-center justify-center">
                                <span class="text-gray-400 font-semibold">{{ $partenaire->name }}</span>
                            </div>
                            @endforeach
                            
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if($solution->temoignages && $solution->temoignages->count() > 0)
            <section id="testimonials" class="py-24 bg-white">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-6">Ce qu'ils disent de nous</h2>
                        <p class="text-xl text-gray-600">Des témoignages qui parlent d'eux-mêmes</p>
                    </div>
                    <div class="grid lg:grid-cols-3 gap-8">
                        @foreach ($solution->temoignages as $temoignage)
                            <div class="bg-gray-50 p-8 rounded-2xl">
                                <div class="flex items-center gap-1 text-yellow-400 mb-4">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                </div>
                                <p class="text-gray-700 mb-6 italic">"{!! $temoignage->content !!}"</p>
                                <div class="flex items-center gap-4">
                                    <img src="{{ $temoignage->author_photo_url ?? asset('storage/'.$temoignage->author_photo) }}" alt="{{ $temoignage->author_name }}" class="w-14 h-14 rounded-full object-cover">
                                    <div>
                                        <div class="font-bold text-sonec-dark">{{ $temoignage->author_name }}</div>
                                        <div class="text-sm text-gray-600">{{ $temoignage->author_position }}</div>
                                    </div>
                                </div>
                            </div>
                        @endforeach                        
                    </div>
                </div>
            </section>
        @endif

        @if($solution->fonctionnalites && $solution->fonctionnalites->count() > 0)

            <section id="features-details" class="py-24 bg-gradient-to-br from-sonec-dark to-gray-900 text-white">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl lg:text-5xl font-bold mb-6">Fonctionnalités avancées</h2>
                        <p class="text-xl text-gray-300">Tout ce dont vous avez besoin pour une gestion moderne de votre établissement</p>
                    </div>

                    <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                        @foreach ($solution->fonctionnalites as $fonctionnalite)
                            <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl">
                                @if($fonctionnalite->icon && str_starts_with($fonctionnalite->icon, 'fa'))
                                    <i class="{{ $fonctionnalite->icon }} text-sonec-green text-3xl mb-4"></i>
                                @else
                                    {{ $fonctionnalite->icon }}
                                @endif
                                <h4 class="font-bold text-lg mb-2">{{ $fonctionnalite->title }}</h4>
                                <p class="text-gray-300 text-sm">{!! $fonctionnalite->description !!}</p>
                            </div>
                        @endforeach
                       
                    </div>
                </div>
            </section>

        @endif

        <section id="cta-final" class="py-24 bg-white">
            <div class="container mx-auto px-6">
                <div class="max-w-5xl mx-auto bg-gradient-to-br from-sonec-green to-green-600 rounded-3xl p-16 text-center text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                    <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full -ml-48 -mb-48"></div>
                    <div class="relative z-10">
                        <h2 class="text-4xl lg:text-5xl font-bold mb-6">Transformez votre établissement dès aujourd'hui</h2>
                        <p class="text-xl mb-10 text-white/90">Rejoignez les centaines d'écoles qui ont fait le choix de l'excellence avec ÉcoleWeb</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                            <a href="#" class="inline-block bg-white text-sonec-green px-10 py-4 rounded-xl font-bold hover:bg-gray-100 transition-colors text-lg">
                                Contacter notre équipe commerciale
                            </a>
                            <a href="#" class="inline-block bg-transparent border-2 border-white text-white px-10 py-4 rounded-xl font-bold hover:bg-white hover:text-sonec-green transition-colors text-lg">
                                Voir une démo en ligne
                            </a>
                        </div>
                        <div class="flex flex-col md:flex-row justify-center items-center gap-8 text-white">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-phone-alt text-2xl"></i>
                                <div class="text-left">
                                    <div class="text-sm opacity-90">Appelez-nous</div>
                                    <div class="font-bold text-lg">{{$solution->contact_phone}}</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-envelope text-2xl"></i>
                                <div class="text-left">
                                    <div class="text-sm opacity-90">Écrivez-nous</div>
                                    <div class="font-bold text-lg">{{$solution->contact_email}}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection