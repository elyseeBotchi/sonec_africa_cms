@extends('web.layout.websiteLayout')

@section('content')
    <main class="pt-20">
        <section id="article-hero" class="bg-gradient-to-br from-sonec-dark to-sonec-dark/90 py-16 lg:py-24">
            <div class="container mx-auto px-6 lg:px-12">
                <div class="max-w-5xl mx-auto">
                    <div class="flex items-center gap-4 mb-8">
                        <span class="px-4 py-1.5 bg-sonec-green rounded-full text-white text-sm font-semibold">{{ $article->category->label }}</span>
                        <span class="text-gray-300 flex items-center gap-2">
                            <i class="far fa-calendar"></i>
                            {{-- afficher la date en français --}}
                            {{ $article->published_at->locale('fr')->isoFormat('LL') }}
                        </span>
                        <span class="text-gray-300 flex items-center gap-2">
                            <i class="far fa-clock"></i>
                            {{ $article->temps_lecture ?? '' }}
                        </span>
                    </div>
                    <h1 class="text-4xl lg:text-6xl font-bold text-white mb-6 leading-tight">{{ $article->title }}</h1>
                    <p class="text-xl lg:text-2xl text-gray-200 leading-relaxed">{!! $article->notes !!}</p>
                </div>
            </div>
        </section>

        <section id="article-metadata" class="bg-white border-b border-gray-100 py-8">
            <div class="container mx-auto px-6 lg:px-12">
                <div class="max-w-5xl mx-auto flex flex-wrap items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <img src="{{ $article->photo_auteur_url ?? asset('storage/' . $article->photo_auteur) }}" alt="author" class="w-14 h-14 rounded-full ring-2 ring-sonec-green/20" />
                        <div>
                            <p class="font-semibold text-sonec-dark text-lg">{{ $article->author ?? '' }}</p>
                            <p class="text-sm text-gray-500">{{ $article->position_auteur ?? '' }}</p>
                        </div>
                    </div>
                    @if($article->activer_partage_reseaux_sociaux == 1)
                        <div class="flex items-center gap-3">
                            <span class="text-sm text-gray-500 font-medium">Partager :</span>
                            <button class="share-btn w-11 h-11 bg-gray-50 rounded-full flex items-center justify-center hover:bg-sonec-green hover:text-white transition-all">
                                <i class="fab fa-facebook-f"></i>
                            </button>
                            <button class="share-btn w-11 h-11 bg-gray-50 rounded-full flex items-center justify-center hover:bg-sonec-green hover:text-white transition-all">
                                <i class="fab fa-twitter"></i>
                            </button>
                            <button class="share-btn w-11 h-11 bg-gray-50 rounded-full flex items-center justify-center hover:bg-sonec-green hover:text-white transition-all">
                                <i class="fab fa-linkedin-in"></i>
                            </button>
                            <button class="share-btn w-11 h-11 bg-gray-50 rounded-full flex items-center justify-center hover:bg-sonec-green hover:text-white transition-all">
                                <i class="fas fa-link"></i>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </section>

        <section id="article-image" class="bg-white py-16">
            <div class="container mx-auto px-6 lg:px-12">
                <div class="max-w-6xl mx-auto">
                    <div class="h-[600px] overflow-hidden rounded-3xl shadow-2xl">
                        <img class="w-full h-full object-cover" src="{{ $article->image_url ?? asset('storage/' . $article->image_article) }}" alt="{{ $article->title }}" />
                    </div>
                </div>
            </div>
        </section>

        <section id="article-content-main" class="bg-white py-16">
            <div class="container mx-auto px-6 lg:px-12">
                <div class="max-w-4xl mx-auto">
                    <div class="article-content text-lg text-gray-700 leading-relaxed">
                        {!! $article->content !!}
                    </div>
                </div>
            </div>
        </section>

        @if(isset($tags) && count($tags) > 0)
        <section id="article-tags" class="bg-gray-50 py-12">
            <div class="container mx-auto px-6 lg:px-12">
                <div class="max-w-4xl mx-auto">
                    <h3 class="text-xs font-bold text-gray-400 tracking-wider mb-5 uppercase">Tags</h3>
                    <div class="flex flex-wrap gap-3">
                        @foreach($article->tags as $tag)
                            {{-- <a href="{{ route('web.tags', $tag->slug) }}"> --}}
                            <span class="px-5 py-2.5 bg-white border border-gray-200 rounded-full text-sm font-medium text-sonec-dark hover:border-sonec-green hover:text-sonec-green hover:shadow-sm transition-all cursor-pointer">{{ $tag->name }}</span>
                            {{-- </a> --}}
                        @endforeach
                    </div>
                </div>
            </div>
        </section>
        @endif

        <section id="article-share-bottom" class="bg-white py-16 border-t border-gray-100">
            <div class="container mx-auto px-6 lg:px-12">
                <div class="max-w-4xl mx-auto">
                    <div class="bg-gradient-to-br from-gray-50 to-white rounded-3xl p-10 flex flex-col md:flex-row items-center justify-between gap-8 border border-gray-100">
                        <div>
                            <h3 class="text-3xl font-bold text-sonec-dark mb-2">Cet article vous a plu ?</h3>
                            <p class="text-gray-500 text-lg">Partagez-le avec votre réseau</p>
                        </div>
                        <div class="flex items-center gap-3">
                            <button class="share-btn w-14 h-14 bg-white rounded-full flex items-center justify-center hover:bg-sonec-green hover:text-white transition-all shadow-md hover:shadow-lg">
                                <i class="fab fa-facebook-f text-lg"></i>
                            </button>
                            <button class="share-btn w-14 h-14 bg-white rounded-full flex items-center justify-center hover:bg-sonec-green hover:text-white transition-all shadow-md hover:shadow-lg">
                                <i class="fab fa-twitter text-lg"></i>
                            </button>
                            <button class="share-btn w-14 h-14 bg-white rounded-full flex items-center justify-center hover:bg-sonec-green hover:text-white transition-all shadow-md hover:shadow-lg">
                                <i class="fab fa-linkedin-in text-lg"></i>
                            </button>
                            <button class="share-btn w-14 h-14 bg-white rounded-full flex items-center justify-center hover:bg-sonec-green hover:text-white transition-all shadow-md hover:shadow-lg">
                                <i class="fas fa-envelope text-lg"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        @if($article_similaires && count($article_similaires) > 0)
            <section id="related-articles" class="bg-gray-50 py-20">
                <div class="container mx-auto px-6 lg:px-12">
                    <div class="max-w-6xl mx-auto">
                        <h2 class="text-4xl font-bold text-sonec-dark mb-12">Articles similaires</h2>
                        <div class="grid md:grid-cols-3 gap-8">

                            @foreach ($article_similaires as $article_similaire)
                                <article class="bg-white rounded-2xl overflow-hidden hover:shadow-2xl transition-all group">
                                    <div class="h-56 overflow-hidden">
                                        <img class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700" src="{{ $article_similaire->image_url ?? asset('storage/' . $article_similaire->image_article) }}" alt="{{ $article_similaire->title }}" />
                                    </div>
                                    <div class="p-7">
                                        <span class="px-3 py-1.5 bg-sonec-green/10 text-sonec-green rounded-full text-xs font-semibold uppercase tracking-wide">{{ $article_similaire->categorie->label ?? '' }}</span>
                                        <h3 class="text-xl font-bold text-sonec-dark mt-4 mb-3 group-hover:text-sonec-green transition-colors cursor-pointer leading-snug">{{ $article_similaire->title }}</h3>
                                        <p class="text-sm text-gray-600 mb-5 leading-relaxed">{!! $article_similaire->description_courte !!}</p>
                                        <a href="{{ route('web.actualites.show', $article_similaire->slug) }}" class="text-sonec-green font-semibold text-sm inline-flex items-center gap-2 hover:gap-4 transition-all">
                                            Lire l'article
                                            <i class="fas fa-arrow-right text-xs"></i>
                                        </a>
                                    </div>
                                </article>
                            @endforeach
                            

                            
                        </div>
                    </div>
                </div>
            </section>
        @endif

        <section id="article-cta" class="bg-gradient-to-r from-sonec-dark to-sonec-green py-20">
            <div class="container mx-auto px-6 lg:px-12">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight">Prêt à transformer votre établissement avec EcoleWeb ?</h2>
                    <p class="text-xl text-gray-100 mb-10 leading-relaxed">Découvrez comment l'intelligence artificielle peut révolutionner l'apprentissage dans votre école</p>
                    <div class="flex flex-col sm:flex-row gap-5 justify-center">
                        <a href="#" class="inline-block bg-white text-sonec-dark px-10 py-4 rounded-xl font-semibold hover:bg-sonec-lime hover:shadow-xl transition-all">
                            Demander une démo
                        </a>
                        <a href="#" class="inline-block bg-transparent border-2 border-white text-white px-10 py-4 rounded-xl font-semibold hover:bg-white hover:text-sonec-dark transition-all">
                            En savoir plus
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection