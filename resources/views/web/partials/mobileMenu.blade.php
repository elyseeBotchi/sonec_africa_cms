<div id="mobile-menu" class="mobile-menu fixed top-0 left-0 w-80 h-full bg-white shadow-2xl z-50 overflow-y-auto lg:hidden">
    <div class="p-6">
        <div class="flex justify-between items-center mb-8">
            <div class="w-24 h-8 {{ get_general_settings()->site_logo ? '' : 'bg-sonec-dark' }} rounded flex items-center justify-center">
                @if(get_general_settings()->site_logo)
                    <img src="{{ asset('/storage/' . get_general_settings()->site_logo) }}"
                        alt="Logo" class="max-h-full max-w-full">
                @else
                    <span class="text-white font-bold text-lg">SONEC</span>
                @endif
            </div>
            <button id="mobile-menu-close" class="text-2xl text-sonec-dark">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <nav class="space-y-2">
            @foreach (get_menu() as $menu)

                {{-- Lien simple (Actualités, Carrières...) --}}
                @if($menu->type === 'link')
                    <a href="{{ url($menu->url ?? '#') }}"
                        class="block text-sonec-dark font-semibold py-2 border-b border-gray-100">
                        {{ $menu->label }}
                    </a>

                {{-- Dropdown ou Megamenu --}}
                @elseif($menu->type === 'dropdown' || $menu->type === 'megamenu')
                    <div class="border-b border-gray-200 pb-2">

                        <button class="mobile-accordion w-full flex justify-between items-center text-sonec-dark font-semibold py-2">
                            {{ $menu->label }}
                            <i class="fas fa-chevron-down text-sm transition-transform duration-200"></i>
                        </button>

                        <div class="mobile-accordion-content hidden pl-4 pt-2 space-y-1">
                            @foreach ($menu->children as $child)
                                @php
                                    $childUrl = resolve_menu_child_url($child);
                                @endphp
                                <a href="{{ $childUrl }}"
                                    class="flex items-center gap-2 py-2 text-gray-700 hover:text-sonec-green transition-colors">
                                    @if(!empty($child->icon))
                                        <i class="{{ $child->icon }} text-sonec-green text-sm w-4"></i>
                                    @endif
                                    {{ $child->label }}
                                </a>
                            @endforeach

                            {{-- Lien "Voir tout" vers la page parente --}}
                            @if(!empty($menu->url) && $menu->url !== '#')
                                <a href="{{ url($menu->url) }}"
                                    class="block py-2 text-sonec-green font-semibold text-sm mt-1">
                                    Voir tout {{ strtolower($menu->label) }}
                                    <i class="fas fa-arrow-right text-xs ml-1"></i>
                                </a>
                            @endif
                        </div>

                    </div>
                @endif

            @endforeach

            <a href="{{ route('web.contact') ?? '#' }}"
                class="block bg-sonec-green text-white px-6 py-3 rounded-lg font-semibold text-center mt-6">
                Nous contacter
            </a>
        </nav>
    </div>
</div>