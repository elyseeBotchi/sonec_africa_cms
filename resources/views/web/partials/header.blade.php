<header id="header" class="bg-white shadow-sm fixed top-0 left-0 right-0 z-50">
    <div class="container mx-auto px-6">
        <div class="flex justify-between items-center py-4">
            <div id="logo-container" class="flex items-center">
                <div class="w-32 h-10 bg-sonec-dark rounded flex items-center justify-center">
                    <span class="text-white font-bold text-xl">SONEC</span>
                </div>
            </div>

            <nav id="desktop-nav" class="hidden lg:flex items-center space-x-8">
                @foreach (get_menu() as $menu)

                    {{-- Lien simple --}}
                    @if($menu->type === 'link')
                        <a href="{{ $menu->url }}" 
                        class="text-sonec-dark font-semibold hover:text-sonec-green transition-colors py-6">
                            {{ $menu->label }}
                        </a>

                    {{-- Dropdown ou Megamenu --}}
                    @elseif($menu->type === 'dropdown' || $menu->type === 'megamenu')
                        <div class="relative nav-item">
                            <button class="text-sonec-dark font-semibold hover:text-sonec-green transition-colors flex items-center gap-2 py-6">
                                {{ $menu->label }}
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>

                            <div class="mega-menu bg-white shadow-xl border-t-4 border-sonec-green" style="left: -155%;">
                                <div class="container mx-auto px-6 py-10">
                                    <div class="grid grid-cols-4 gap-8">

                                        {{-- Colonne principale : enfants --}}
                                        <div class="col-span-3">
                                            <div class="grid grid-cols-3 {{ 'gap-' . $menu->espacement->espacement }}">
                                                @foreach ($menu->children as $child)

                                                    {{-- Enfant avec image --}}
                                                    @if(!empty($child->image) || !empty($child->img_src))
                                                        
                                                        <a href="{{ $child->url ?? '#' }}" 
                                                        class="text-center bg-gray-50 p-6 rounded-lg hover:shadow-md transition-shadow block">
                                                            <div class="h-32 bg-gray-100 rounded-lg mb-3 overflow-hidden">
                                                                <img class="w-full h-full object-cover"
                                                                    src="{{ !empty($child->img_src) ? $child->img_src : asset('storage/' . $child->image) }}"
                                                                    alt="{{ $child->description }}">
                                                            </div>
                                                            <h4 class="font-bold text-sonec-dark text-sm mb-1">{{ $child->label }}</h4>
                                                            <p class="text-xs text-gray-600">{{ $child->description }}</p>
                                                        </a>

                                                    {{-- Enfant avec icône FontAwesome --}}
                                                    @elseif(!empty($child->icon))
                                                        @if($menu->espacement->alignement === 'vertical')
                                                            <a href="{{ $child->url ?? '#' }}" class="bg-gray-50 p-6 rounded-lg hover:shadow-md transition-shadow block">
                                                                    
                                                                    <div class="w-12 h-12 {{ $menu->espacement->couleur_fond_icon == 1 ? 'bg-sonec-green' : 'transparent' }} rounded-lg flex items-center justify-center mb-4">
                                                                        <i class="{{ $child->icon }} text-white text-xl"></i>
                                                                    </div>
                                                                    <h3 class="font-bold text-sonec-dark mb-2">{{ $child->label }}</h3>
                                                                    <p class="text-sm text-gray-600">{{ $child->description }}</p>
                                                            </a>
                                                            
                                                        @else

                                                            <a href="#" class="flex items-center gap-3 p-4 rounded hover:bg-gray-50 bg-gray-50 p-6 rounded-lg hover:shadow-md transition-shadow">
                                                                <i class="{{ $child->icon }} text-sonec-green text-xl"></i>
                                                                <span class="text-sonec-dark font-medium">{{ $child->label }}</span>
                                                            
                                                            </a>

                                                        @endif



                                                    {{-- Enfant sans icône ni image (lien simple) --}}
                                                    @else
                                                        <a href="{{ $child->url ?? '#' }}" 
                                                        class="flex items-center gap-3 p-4 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
                                                            <span class="text-sonec-dark font-medium">{{ $child->label }}</span>
                                                        </a>
                                                    @endif

                                                @endforeach
                                            </div>

                                            {{-- Lien "Voir tout" si défini sur le menu parent --}}
                                            {{-- @if(!empty($menu->url) && $menu->url !== '#')
                                                <div class="mt-6">
                                                    <a href="{{ $menu->url }}" 
                                                    class="inline-flex items-center gap-2 text-sonec-green font-semibold hover:text-sonec-dark transition-colors">
                                                        Voir tout {{ strtolower($menu->label) }}
                                                        <i class="fas fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            @endif --}}
                                        </div>

                                        {{-- Colonne latérale : sidebar du menu parent --}}
                                        {{-- Colonne latérale dynamique --}}
                                        @if($menu->sidebar)
                                            @if($menu->slug === 'qui-sommes-nous')
                                                <div class="text-center bg-gray-50 p-6 rounded-lg hover:shadow-md transition-shadow">
                                                    <div class="h-32 bg-gray-100 rounded-lg mb-3 overflow-hidden">
                                                        @if($menu->sidebar->image)
                                                            <img class="w-full h-full object-cover" src="{{ asset('storage/' . $menu->sidebar->image) }}" alt="{{ $menu->sidebar->title }}">
                                                        @else
                                                            <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/2d3921e135-fd245e85b999673d3000.png" alt="africa map with location pins business expansion">
                                                        @endif
                                                    </div>
                                                    <h4 class="font-bold text-sonec-dark text-sm mb-1">{{ $menu->sidebar->title }}</h4>
                                                    <p class="text-xs text-gray-600">{{ $menu->sidebar->description }}</p>
                                                </div>
                                            @else
                                                <div class="bg-gray-50 p-8 rounded-lg">
                                                
                                                    @if($menu->sidebar->image)
                                                        <div class="h-32 bg-gray-100 rounded-lg mb-4 overflow-hidden">
                                                            <img class="w-full h-full object-cover" 
                                                                src="{{ asset('storage/' . $menu->sidebar->image) }}" 
                                                                alt="{{ $menu->sidebar->title }}">
                                                        </div>
                                                    @endif

                                                    <h3 class="text-xl font-bold text-sonec-dark mb-4">
                                                        {{ $menu->sidebar->title }}
                                                    </h3>

                                                    @if($menu->sidebar->description)
                                                        <p class="text-gray-700 mb-6">{{ $menu->sidebar->description }}</p>
                                                    @endif

                                                    @if($menu->sidebar->cta_url)
                                                        <a href="{{ $menu->sidebar->cta_url }}"
                                                        class="inline-flex items-center gap-2 bg-sonec-green text-white px-6 py-3 rounded-lg font-semibold hover:bg-sonec-dark transition-colors">
                                                            {{ $menu->sidebar->cta_label ?? 'En savoir plus' }}
                                                            <i class="fas fa-arrow-right"></i>
                                                        </a>
                                                    @endif                                           
                                                
                                                </div>
                                            @endif
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                @endforeach
            </nav>

            <div class="flex items-center gap-4">
                <a href="#" class="hidden lg:inline-block bg-sonec-green text-white px-6 py-2.5 rounded-lg font-semibold hover:bg-sonec-dark transition-colors">
                    Nous contacter
                </a>
                <button id="mobile-menu-btn" class="lg:hidden text-sonec-dark text-2xl">
                    <i class="fas fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</header>