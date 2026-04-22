@extends('web.layout.websiteLayout')

@section('content')
    <main class="pt-20">
        @if(isset($secteur->image_url) || isset($secteur->image))
            <section id="industry-hero" class="relative h-[600px] overflow-hidden">
                <img
                    src="{{ $secteur->image_url ?? asset('storage/' . $secteur->image) }}"
                    alt="{{ $secteur->title }} image"
                    class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-sonec-dark/70 flex items-center">
                    <div class="container mx-auto px-6">
                        <div class="max-w-3xl">
                            <div class="flex items-center gap-3 mb-6">
                                <div
                                    class="w-16 h-16 bg-sonec-green rounded-xl flex items-center justify-center">
                                    @if($secteur->icon && str_starts_with($secteur->icon, 'fa'))
                                        <i class="{{ $secteur->icon }} text-white text-2xl"></i>
                                    @else
                                        {{ $secteur->icon }}
                                    @endif
                                </div>
                                <span class="text-sonec-lime font-semibold text-lg">{{ $secteur->name }}</span>    
                            </div>
                            <h1 class="text-5xl lg:text-6xl font-bold text-white mb-6">{{ $secteur->title_hero }}</h1>
                            <p class="text-xl text-gray-200 mb-8">{!! $secteur->resume !!}</p>


                            <div class="flex flex-col sm:flex-row gap-4">
                                @if(isset($secteur->cta_label_1) && isset($secteur->cta_url_1))
                                    <a href="{{ $secteur->cta_url_1 }}"
                                        class="inline-block bg-sonec-green text-white px-8 py-4 rounded-lg font-semibold hover:bg-sonec-lime hover:text-sonec-dark transition-colors text-center">
                                        {{ $secteur->cta_label_1 }}
                                    </a>
                                @endif

                                @if(isset($secteur->cta_label_2) && isset($secteur->cta_url_2))
                                    <a href="{{ $secteur->cta_url_2 }}"
                                        class="inline-block bg-white text-sonec-dark px-8 py-4 rounded-lg font-semibold hover:bg-sonec-lime hover:text-sonec-dark transition-colors text-center">
                                        {{ $secteur->cta_label_2 }}
                                    </a>
                                @endif

                                {{-- <a href="#solutions"
                                    class="inline-block bg-sonec-green text-white px-8 py-4 rounded-lg font-semibold hover:bg-sonec-lime hover:text-sonec-dark transition-colors text-center">
                                    Découvrir nos solutions
                                </a><a href="#contact"
                                    class="inline-block bg-white text-sonec-dark px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors text-center">
                                    Demander une démo
                                </a> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif

        @if(isset($section_enjeux))    
            <section id="{{ $section_enjeux->section_key ?? 'challenge-section' }}" class="py-20 bg-white">
                {!! $section_enjeux->content !!}
            </section>
        @endif

        

        @if(isset($autresSecteurs) && count($autresSecteurs) > 0)
            <section id="other-industries" class="py-20 bg-white">
                <div class="container mx-auto px-6">
                    <div class="text-center mb-16">
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">Nos
                        autres secteurs d'expertise</h2>
                        <p class="text-xl text-gray-600">Découvrez comment nous accompagnons
                        d'autres industries</p>
                    </div>
                    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                        @foreach($autresSecteurs as $autreSecteur)
                            <a href="{{ route('secteur.show', $autreSecteur->slug) }}" class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-all border border-gray-100 group">
                            
                                @if(isset($autreSecteur->icon))
                                    <div class="w-16 h-16 bg-sonec-green/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-sonec-green transition-colors">
                                        @if($autreSecteur->icon && str_starts_with($autreSecteur->icon, 'fa'))
                                            <i class="{{ $autreSecteur->icon }} text-sonec-green text-3xl group-hover:text-white transition-colors"></i>    
                                        @else
                                            {{ $autreSecteur->icon }}
                                        @endif
                                    {{-- <i class="fas fa-signal text-sonec-green text-3xl group-hover:text-white transition-colors"></i> --}}
                                
                                    </div>
                                @endif
                                <h3 class="text-xl font-bold text-sonec-dark mb-3"> {{ $autreSecteur->name }}</h3>
                                <p class="text-gray-700 mb-4">{!! $autreSecteur->resume !!}</p>
                                <span class="inline-flex items-center gap-2 text-sonec-green font-semibold group-hover:text-sonec-dark transition-colors">
                                    En savoir plus
                                    <i class="fas fa-arrow-right"></i>
                                </span>
                            </a>
                        @endforeach
                        <a href="#" class="bg-gray-50 p-8 rounded-xl hover:shadow-lg transition-all border border-gray-100 group">
                            <div
                                class="w-16 h-16 bg-sonec-green/10 rounded-xl flex items-center justify-center mb-4 group-hover:bg-sonec-green transition-colors">
                                <i
                                class="fas fa-th text-sonec-green text-3xl group-hover:text-white transition-colors"></i>
                            </div>
                            <h3 class="text-xl font-bold text-sonec-dark mb-3">Voir tous les
                                secteurs</h3>
                            <p class="text-gray-700 mb-4">Découvrez l'ensemble de nos domaines
                                d'intervention
                            </p>
                            <span class="inline-flex items-center gap-2 text-sonec-green font-semibold group-hover:text-sonec-dark transition-colors">
                                Explorer
                                <i class="fas fa-arrow-right"></i>
                            </span>
                        </a>
                    </div>
                </div>
            </section>
        @endif
      
      
        @if(isset($section_avantages))    
            <section id="{{ $section_avantages->section_key ?? 'avantage-section' }}" class="py-20 bg-gray-50">
                {!! $section_avantages->content !!}
            </section>
        @endif
    

      <section id="case-study" class="py-20 bg-white">
        <div class="container mx-auto px-6">
          <div class="max-w-5xl mx-auto">
            <div class="text-center mb-12"><span
                class="inline-block px-4 py-2 bg-sonec-lime/20 text-sonec-dark rounded-full font-semibold mb-4">Étude
                de Cas</span>
              <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-4">
                Une transformation réussie</h2>
            </div>
            <div
              class="bg-gradient-to-br from-sonec-dark to-sonec-dark/90 rounded-3xl overflow-hidden shadow-2xl">
              <div class="grid lg:grid-cols-2">
                <div class="p-12 flex flex-col justify-center">
                  <div class="text-sonec-lime font-bold text-lg mb-4">Banque
                    continentale Africa</div>
                  <h3 class="text-3xl font-bold text-white mb-6">+50 banques
                    accompagnées dans leur digitalisation</h3>
                  <p class="text-gray-300 mb-8">En partenariat avec SONEC
                    Africa, la Banque Continentale a réussi sa transformation
                    digitale en déployant nos solutions dans 85 agences
                    réparties dans 8 pays africains.</p>
                    @if(isset($secteur->chiffres) && count($secteur->chiffres) > 0)
                        <div class="grid grid-cols-2 gap-6 mb-8">
                            @foreach ($secteur->chiffres as $chiffre)
                                <div>
                                    <div class="text-4xl font-bold text-sonec-lime mb-2">{{ $chiffre->value ?? '' }}</div>
                                    <div class="text-gray-300 text-sm">{{ $chiffre->label ?? '' }}</div>
                                </div>
                                
                            @endforeach
                            {{-- <div>
                                <div class="text-4xl font-bold text-sonec-lime mb-2">85
                                </div>
                                <div class="text-gray-300 text-sm">Agences digitalisées
                                </div>
                            </div>                             --}}
                        </div>
                    @endif
                  <blockquote class="border-l-4 border-sonec-lime pl-6 mb-8">
                    <p class="text-white italic mb-3">"SONEC Africa a été un
                      partenaire stratégique essentiel dans notre transformation
                      digitale. Leurs solutions sont robustes, sécurisées et
                      parfaitement adaptées au contexte africain."</p>
                    <div class="flex items-center gap-3"><img
                        src="https://storage.googleapis.com/uxpilot-auth.appspot.com/avatars/avatar-2.jpg"
                        alt="CEO" class="w-12 h-12 rounded-full object-cover">
                      <div>
                        <div class="text-white font-semibold">Amadou Diarra
                        </div>
                        <div class="text-gray-400 text-sm">CEO, Banque
                          Continentale</div>
                      </div>
                    </div>
                  </blockquote>
                </div>
                <div class="h-full min-h-[600px] overflow-hidden"><img
                    src="https://media.istockphoto.com/id/640267784/fr/photo/bank-building.jpg?s=612x612&w=0&k=20&c=LAskx4kHK_K3uucr0fk8Awi6Fgs-rTPQsLu_lR02Kjg="
                    alt="modern bank interior customers using digital kiosks african banking innovation"
                    class="w-full h-full object-cover"></div>
              </div>
            </div>

            @if(isset($secteur->partenaires) && count($secteur->partenaires) > 0)
                <div class="mt-12 grid md:grid-cols-4 gap-6">
                    @foreach ($secteur->partenaires as $partenaire)
                        <div class="text-center">
                            <div class="w-16 h-16 bg-sonec-green/10 rounded-full flex items-center justify-center mx-auto mb-3">
                                @if ($partenaire->icon && str_starts_with($partenaire->icon, 'fa'))                                    
                                    <i class="{{ $partenaire->icon }} text-sonec-green text-2xl"></i>
                                @elseif($partenaire->logo_url || $partenaire->logo)
                                    <img src="{{ $partenaire->logo ?? asset('storage/' . $partenaire->logo) }}" alt="{{ $partenaire->name }} logo" class="w-8 h-8 object-contain">
                                @else
                                    {{ $partenaire->icon ?? '' }}
                                @endif    
                            
                            </div>
                            <div class="font-bold text-gray-400 text-sm mb-1">{{ $partenaire->name ?? '' }}</div>
                        </div>
                    @endforeach
                    
                </div>
            @endif
          </div>
        </div>
      </section>



      <section id="contact" class="py-20 bg-sonec-green">
        <div class="container mx-auto px-6">
          <div class="max-w-4xl mx-auto text-center">
            <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">{{$secteur->accroche->title ?? ''}}</h2>
            <p class="text-xl text-white/90 mb-10">{{$secteur->accroche->subtitle ?? ''}}</p>
            <div class="flex flex-col sm:flex-row gap-4 justify-center"><a
                href="#"
                class="inline-block bg-white text-sonec-dark px-8 py-4 rounded-lg font-semibold hover:bg-sonec-lime transition-colors">
                {{$secteur->accroche->cta_label ?? 'Demander une démo personnalisée'}}
              </a><a href="{{$secteur->accroche->cta_url ?? '#'}}"
                class="inline-block bg-sonec-dark text-white px-8 py-4 rounded-lg font-semibold hover:bg-sonec-dark/80 transition-colors">
                {{'Télécharger notre brochure'}}
              </a>
            </div>
            
            @if(isset($secteur->contact_email) || isset($secteur->contact_phone))
                <div class="mt-12 flex flex-col md:flex-row items-center justify-center gap-8 text-white">
                    <div class="flex items-center gap-3"><i
                        class="fas fa-phone text-2xl"></i>
                        <div class="text-left">
                        <div class="text-sm opacity-80">Appelez-nous</div>
                        <div class="font-semibold">{{$secteur->contact_phone ?? '+225 XX XX XX XX'}}</div>
                        </div>
                    </div>
                    <div class="flex items-center gap-3"><i
                        class="fas fa-envelope text-2xl"></i>
                        <div class="text-left">
                        <div class="text-sm opacity-80">Écrivez-nous</div>
                        <div class="font-semibold">{{$secteur->contact_email ?? 'banking@sonecafrica.com'}}</div>
                        </div>
                    </div>
                </div>
            @endif
          </div>
        </div>
      </section>

    </main>
@endsection