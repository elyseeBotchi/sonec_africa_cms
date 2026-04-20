<aside class="w-72 bg-white shadow-xl z-20 flex flex-col h-full border-r border-slate-200">
    <!-- Logo -->
    <div class="p-6 border-b border-slate-100 flex items-center gap-3">
        <div class="w-10 h-10 bg-sonec-dark rounded-lg flex items-center justify-center text-white font-bold text-xl">S</div>
        <div>
            <h1 class="font-extrabold text-sonec-dark text-lg tracking-tight">SONEC <span class="text-sonec-green">CMS</span></h1>
            <p class="text-[10px] text-slate-400 uppercase tracking-wider font-bold">Version 2.4.0</p>
        </div>
    </div>

    <!-- Menu -->
    <nav class="flex-1 overflow-y-auto custom-scrollbar py-6 space-y-1">
        <p class="px-6 text-xs font-bold text-slate-400 uppercase tracking-widest mb-2">Tableau de bord</p>
        <a href="#" onclick="switchTab('dashboard')" id="nav-dashboard" class="nav-item active flex items-center gap-3 px-6 py-3 hover:bg-slate-50 transition-colors">
            <i class="fas fa-th-large w-5"></i> Vue d'ensemble
        </a>
        <a href="#" class="nav-item flex items-center gap-3 px-6 py-3 hover:bg-slate-50 transition-colors">
            <i class="fas fa-inbox w-5"></i> Messages <span class="ml-auto bg-red-500 text-white text-[10px] font-bold px-2 py-0.5 rounded-full">3</span>
        </a>
        {{-- <p class="px-6 text-xs font-bold text-slate-400 uppercase tracking-widest mt-8 mb-2">Gestion des Pages</p> --}}



        <p class="px-6 text-xs font-bold text-slate-400 uppercase tracking-widest mt-8 mb-2">Gestion des Pages</p>
        
        <a href="{{ route('admin.accueil') }}" id="nav-page-home" class="nav-item flex items-center gap-3 px-6 py-3 hover:bg-slate-50 transition-colors">
            <i class="fas fa-home w-5 text-purple-500"></i> Accueil
        </a>
        <!-- Solutions avec sous-menu -->
        @if(count(get_solutions()) > 0)
            <div class="relative">
                <a href="#"
                onclick="toggleSubMenu(event, 'solutions-submenu')"
                id="nav-page-solutions"
                class="nav-item flex items-center justify-between gap-3 px-6 py-3 hover:bg-slate-50 transition-colors">
                    <span class="flex items-center gap-3">
                        <i class="fas fa-layer-group w-5 text-blue-500"></i>
                        Solutions
                    </span>
                    <i class="fas fa-chevron-down text-xs"></i>
                </a>

                <!-- Sous-menus -->
                <div id="solutions-submenu"
                    class="submenu hidden ml-8 flex flex-col border-l border-slate-200">
                    @foreach (get_solutions() as $solution)
                        <a href="{{ route('solutions.edit', $solution->id) }}" class="px-6 py-2 hover:bg-slate-50">
                            {{ $solution->title }}
                        </a>                        
                    @endforeach
                    {{-- <a href="#" onclick="switchPage('ecoleweb')" class="px-6 py-2 hover:bg-slate-50">
                        ECOLEWEB
                    </a>
                    <a href="#" onclick="switchPage('solution-sante')" class="px-6 py-2 hover:bg-slate-50">
                        GDEC
                    </a>
                    <a href="#" onclick="switchPage('solution-agriculture')" class="px-6 py-2 hover:bg-slate-50">
                        SONEC PAY
                    </a> --}}

                </div>
            </div>
        @else
            <a href="{{ route('solutions.index') }}" id="nav-page-solutions" class="nav-item flex items-center gap-3 px-6 py-3 hover:bg-slate-50 transition-colors">
                <i class="fas fa-layer-group w-5 text-blue-500"></i> Solutions
            </a>
        @endif


        <!-- Industries avec sous-menu -->
        <div class="relative">
            <a href="#"
            onclick="toggleSubMenu(event, 'industries-submenu')"
            id="nav-page-banking"
            class="nav-item flex items-center justify-between gap-3 px-6 py-3 hover:bg-slate-50 transition-colors">
                <span class="flex items-center gap-3">
                    <i class="fas fa-university w-5 text-sonec-green"></i>
                    Industries
                </span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>

            <div id="industries-submenu"
                class="submenu hidden ml-8 flex flex-col border-l border-slate-200">
                <a href="#" onclick="switchPage('banking')" class="px-6 py-2 hover:bg-slate-50">
                    Banques & Assurances
                </a>
                <a href="#" onclick="switchPage('industrie-telecom')" class="px-6 py-2 hover:bg-slate-50">
                    Télécom
                </a>
                <a href="#" onclick="switchPage('industrie-education')" class="px-6 py-2 hover:bg-slate-50">
                        Éducation
                </a>
                <a href="#" onclick="switchPage('industrie-sante')" class="px-6 py-2 hover:bg-slate-50">
                    Santé
                </a>
                <a href="#" onclick="switchPage('industrie-institution')" class="px-6 py-2 hover:bg-slate-50">
                    Institution & Administration
                </a>
                <a href="#" onclick="switchPage('industrie-energie')" class="px-6 py-2 hover:bg-slate-50">
                    Industrie & Énergie
                </a>
            </div>
        </div>

        <a href="{{ route('admin.actualites') }}" id="nav-page-ecoleweb" class="nav-item flex items-center gap-3 px-6 py-3 hover:bg-slate-50 transition-colors">
            <i class="fas fa-graduation-cap w-5 text-yellow-500"></i> Actualité
        </a>
        <!-- Qui sommes-nous avec sous-menu -->
        <div class="relative">
            <a href="#"
            onclick="toggleSubMenu(event, 'about-submenu')"
            id="nav-page-careers"
            class="nav-item flex items-center justify-between gap-3 px-6 py-3 hover:bg-slate-50 transition-colors">
                <span class="flex items-center gap-3">
                    <i class="fas fa-briefcase w-5 text-orange-500"></i>
                    Qui sommes nous
                </span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>

            <div id="about-submenu"
                class="submenu hidden ml-8 flex flex-col border-l border-slate-200">
                <a href="{{ route('admin.decouvrir-sonec-africa') }}" onclick="switchPage('about-discover')" class="px-6 py-2 hover:bg-slate-50">
                    Découvrir Sonec Africa
                </a>
                <a href="{{ route('admin.histoire') }}" onclick="switchPage('about-history')" class="px-6 py-2 hover:bg-slate-50">
                    Notre Histoire
                </a>
                <a href="{{ route('admin.notre-equipe') }}" onclick="switchPage('about-team')" class="px-6 py-2 hover:bg-slate-50">
                    Équipe de direction
                </a>
               
                 <a href="{{ route('admin.implantation') }}" onclick="switchPage('about-implantation')" class="px-6 py-2 hover:bg-slate-50">
                     Implantation
                 </a>   
            </div>
        </div>

        <a href="{{ route('offres-emploi.index') }}" onclick="switchPage('careers')" id="nav-page-blog" class="nav-item flex items-center gap-3 px-6 py-3 hover:bg-slate-50 transition-colors">
            <i class="fas fa-newspaper w-5 text-pink-500"></i> Carrières
        </a>



        <div class="relative">
            <a href="#"
            onclick="toggleSubMenu(event, 'settings-submenu')"
            id="nav-page-careers"
            class="nav-item flex items-center justify-between gap-3 px-6 py-3 hover:bg-slate-50 transition-colors">
                <span class="flex items-center gap-3">
                    <i class="fas fa-cogs w-5 text-orange-500"></i>
                    Configurations
                </span>
                <i class="fas fa-chevron-down text-xs"></i>
            </a>

            <div id="settings-submenu"
                class="submenu hidden ml-8 flex flex-col border-l border-slate-200">
                <a href="{{ route('menus.index') }}" class="px-6 py-2 hover:bg-slate-50">
                    Menus de navigation
                </a>
                <a href="{{ route('general-settings.index') }}"  class="px-6 py-2 hover:bg-slate-50 ">
                    Paramètres du site
                </a>
                <a href="#"  class="px-6 py-2 hover:bg-slate-50">
                    Gestion des utilisateurs
                </a>
            </div>
        </div>

        {{-- <a href="#"  id="nav-page-blog" class="nav-item flex items-center gap-3 px-6 py-3 hover:bg-slate-50 transition-colors">
            <i class="fas fa-cogs w-5 text-pink-500"></i> Utilisateurs
        </a> --}}
    </nav>

    <!-- User Profile -->
    <div class="p-4 border-t border-slate-200 bg-slate-50">
        <div class="flex items-center gap-3">
            <img src="https://ui-avatars.com/api/?name=Admin+Sys&background=0d3136&color=fff" class="w-9 h-9 rounded-full border-2 border-white shadow-sm">
            <div class="flex-1 min-w-0">
                <p class="text-sm font-bold text-sonec-dark truncate">{{ ucfirst(auth()->user()->role) }}</p>
                <p class="text-xs text-slate-500 truncate">{{ auth()->user()->email }}</p>
            </div>
            <button class="text-slate-400 hover:text-red-500 transition-colors" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                <i class="fas fa-sign-out-alt"></i>
                <form id="logout-form" action="{{ route('admin.logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            </button>
        </div>
    </div>
</aside>