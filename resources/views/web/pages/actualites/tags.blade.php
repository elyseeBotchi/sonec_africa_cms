@extends('web.layout.websiteLayout')

@section('content')
    <main class="pt-20">
        <section id="news-hero" class="bg-gradient-to-br from-sonec-dark to-sonec-dark/90 py-16 lg:py-24">
            <div class="container mx-auto px-6">
                <div class="max-w-4xl mx-auto text-center">
                    <h1 class="text-4xl lg:text-6xl font-bold text-white mb-6">{{ $tag->label }}</h1>
                    <p class="text-xl text-gray-200">Découvrez nos dernières innovations, événements et actualités du secteur technologique africain</p>
                </div>
            </div>
        </section>

        <section id="news-filters" class="bg-white border-b border-gray-200 sticky top-[72px] z-40">
            <div class="container mx-auto px-6">
                <div class="flex flex-wrap gap-3 py-6 justify-center lg:justify-start">
                    <button class="filter-tab active px-6 py-2.5 rounded-full font-semibold bg-gray-100 text-sonec-dark hover:bg-sonec-green hover:text-white transition-colors" data-filter="tous">
                        Tous
                    </button>
                    @foreach($categories as $categorie)
                        <button class="filter-tab px-6 py-2.5 rounded-full font-semibold bg-gray-100 text-sonec-dark hover:bg-sonec-green hover:text-white transition-colors" data-filter="{{ $categorie->id }}">
                            {{ $categorie->label }}
                        </button>
                    @endforeach

                    
                </div>
            </div>
        </section>

        @if(isset($articles) && $articles->count() > 0)

            <section id="news-grid" class="py-16 bg-white">
                <div class="container mx-auto px-6">
                    <div id="news-grid-container" class="grid lg:grid-cols-3 gap-8">
                        @foreach ($articles as $article)

                            <article class="news-card bg-white border border-gray-200 rounded-xl overflow-hidden hover:shadow-xl transition-shadow" data-category="{{ $article->category->id }}">
                                <div class="h-56 overflow-hidden">
                                    <img class="w-full h-full object-cover hover:scale-105 transition-transform duration-500" src="{{ $article->image_url ?? asset('storage/' . $article->image_article) }}" alt="{{ $article->title }}" />
                                </div>
                                <div class="p-6">
                                    <div class="flex items-center gap-4 mb-3">
                                        <span class="px-3 py-1 bg-sonec-green/10 text-sonec-green rounded-full text-xs font-semibold">{{ $article->category->label }}</span>
                                        <span class="text-sm text-gray-500 flex items-center gap-1">
                                            <i class="far fa-calendar text-xs"></i>
                                            {{ $article->published_at->locale('fr')->isoFormat('LL') }}
                                        </span>
                                    </div>
                                    <h3 class="text-xl font-bold text-sonec-dark mb-3 hover:text-sonec-green transition-colors cursor-pointer">{{ $article->title }}</h3>
                                    <p class="text-gray-700 mb-4 text-sm leading-relaxed">{!! $article->description_courte !!}</p>
                                    <a href="{{ route('web.actualites.show', $article->slug) }}" class="inline-flex items-center gap-2 text-sonec-green font-semibold text-sm hover:gap-4 transition-all">
                                        Lire la suite
                                        <i class="fas fa-arrow-right text-xs"></i>
                                    </a>
                                </div>
                            </article>
                        @endforeach

                       
                    </div>
                </div>
            </section>
        @endif

        <section id="pagination-section" class="py-12 bg-white border-t border-gray-200">
            <div class="container mx-auto px-6">
                @if ($autres_articles->lastPage() > 1)
                <div class="flex justify-center items-center gap-2">

                    {{-- Bouton Précédent --}}
                    @if ($autres_articles->onFirstPage())
                        <span class="w-10 h-10 rounded-lg border border-gray-200 flex items-center justify-center text-gray-300 cursor-not-allowed">
                            <i class="fas fa-chevron-left"></i>
                        </span>
                    @else
                        <a href="{{ $autres_articles->previousPageUrl() }}" class="w-10 h-10 rounded-lg border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-sonec-green hover:text-white hover:border-sonec-green transition-colors">
                            <i class="fas fa-chevron-left"></i>
                        </a>
                    @endif

                    {{-- Pages --}}
                    @php
                        $current = $autres_articles->currentPage();
                        $last    = $autres_articles->lastPage();
                        $pages   = collect();

                        // Toujours afficher la première page
                        $pages->push(1);

                        // Fenêtre autour de la page courante
                        for ($i = max(2, $current - 1); $i <= min($last - 1, $current + 1); $i++) {
                            $pages->push($i);
                        }

                        // Toujours afficher la dernière page
                        if ($last > 1) $pages->push($last);

                        $pages = $pages->unique()->sort()->values();
                    @endphp

                    @php $prev = null; @endphp
                    @foreach ($pages as $page)
                        @if ($prev !== null && $page - $prev > 1)
                            <span class="px-2 text-gray-500">...</span>
                        @endif

                        @if ($page === $current)
                            <span class="w-10 h-10 rounded-lg bg-sonec-green text-white font-semibold flex items-center justify-center">
                                {{ $page }}
                            </span>
                        @else
                            <a href="{{ $autres_articles->url($page) }}" class="w-10 h-10 rounded-lg border border-gray-300 text-gray-600 font-semibold flex items-center justify-center hover:bg-sonec-green hover:text-white hover:border-sonec-green transition-colors">
                                {{ $page }}
                            </a>
                        @endif

                        @php $prev = $page; @endphp
                    @endforeach

                    {{-- Bouton Suivant --}}
                    @if ($autres_articles->hasMorePages())
                        <a href="{{ $autres_articles->nextPageUrl() }}" class="w-10 h-10 rounded-lg border border-gray-300 flex items-center justify-center text-gray-600 hover:bg-sonec-green hover:text-white hover:border-sonec-green transition-colors">
                            <i class="fas fa-chevron-right"></i>
                        </a>
                    @else
                        <span class="w-10 h-10 rounded-lg border border-gray-200 flex items-center justify-center text-gray-300 cursor-not-allowed">
                            <i class="fas fa-chevron-right"></i>
                        </span>
                    @endif

                </div>
                @endif
            </div>
        </section>

        <section id="newsletter-section" class="py-20 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="max-w-4xl mx-auto bg-white rounded-2xl shadow-xl p-12">
                    <div class="text-center mb-8">
                        <div class="w-16 h-16 bg-sonec-green/10 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-envelope text-sonec-green text-2xl"></i>
                        </div>
                        <h2 class="text-3xl lg:text-4xl font-bold text-sonec-dark mb-4">Restez Informé</h2>
                        <p class="text-lg text-gray-600">Abonnez-vous à notre newsletter pour recevoir nos dernières actualités et insights directement dans votre boîte mail</p>
                    </div>
                    <form class="flex flex-col sm:flex-row gap-4 max-w-2xl mx-auto">
                        <input type="email" placeholder="Votre adresse e-mail" class="flex-1 px-6 py-4 rounded-lg border border-gray-300 focus:outline-none focus:border-sonec-green focus:ring-2 focus:ring-sonec-green/20" />
                        <button type="submit" class="px-8 py-4 bg-sonec-green text-white rounded-lg font-semibold hover:bg-sonec-dark transition-colors whitespace-nowrap">
                            S'abonner
                        </button>
                    </form>
                    <p class="text-sm text-gray-500 text-center mt-4">Nous respectons votre vie privée. Désabonnement possible à tout moment.</p>
                </div>
            </div>
        </section>

        <section id="cta-section" class="py-20 bg-sonec-dark">
            <div class="container mx-auto px-6">
                <div class="max-w-4xl mx-auto text-center">
                    <h2 class="text-4xl lg:text-5xl font-bold text-white mb-6">Prêt à Transformer Votre Entreprise ?</h2>
                    <p class="text-xl text-gray-300 mb-10">Rejoignez les centaines d'organisations qui font confiance à SONEC Africa pour leur transformation digitale</p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#" class="inline-block bg-sonec-green text-white px-8 py-4 rounded-lg font-semibold hover:bg-sonec-lime hover:text-sonec-dark transition-colors">
                            Demander une démo
                        </a>
                        <a href="#" class="inline-block bg-white text-sonec-dark px-8 py-4 rounded-lg font-semibold hover:bg-gray-100 transition-colors">
                            Nous contacter
                        </a>
                    </div>
                </div>
            </div>
        </section>
    </main>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            alert('test');
            const filterTabs = document.querySelectorAll('.filter-tab');

            filterTabs.forEach(tab => {
                tab.addEventListener('click', function () {
                    // Onglet actif
                    filterTabs.forEach(t => t.classList.remove('active', 'bg-sonec-green', 'text-white'));
                    this.classList.add('active', 'bg-sonec-green', 'text-white');

                    const filter = this.dataset.filter;
                    filterArticles(filter);
                });
            });

            function filterArticles(filter) {
                const allCards = document.querySelectorAll('.news-card');

                allCards.forEach(card => {
                    const match = filter === 'tous' || card.dataset.category === filter;
                    card.style.display = match ? '' : 'none';
                });

                // Masquer la section featured si aucun article visible dedans
                const featuredSection = document.getElementById('featured-news');
                if (featuredSection) {
                    const visibleFeatured = featuredSection.querySelectorAll('.news-card[style=""], .news-card:not([style])');
                    const hasVisible = [...featuredSection.querySelectorAll('.news-card')]
                        .some(c => c.style.display !== 'none');
                    featuredSection.style.display = hasVisible ? '' : 'none';
                }

                // Masquer la section grille si aucun article visible dedans
                const gridSection = document.getElementById('news-grid');
                if (gridSection) {
                    const hasVisible = [...gridSection.querySelectorAll('.news-card')]
                        .some(c => c.style.display !== 'none');
                    gridSection.style.display = hasVisible ? '' : 'none';
                }
            }
        });
    </script>
@endsection
