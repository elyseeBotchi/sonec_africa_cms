<footer id="footer" class="bg-sonec-dark text-white pt-16 pb-8">
    <div class="container mx-auto px-6">
        <div class="grid md:grid-cols-2 lg:grid-cols-5 gap-12 mb-12">
            <div class="lg:col-span-2">
                <div class="w-32 h-10 bg-white rounded flex items-center justify-center mb-6">
                    {{-- <span class="text-sonec-dark font-bold text-xl">SONEC</span> --}}
                    @if(get_general_settings()->logo_footer)
                        <img src="{{ asset('/storage/' . get_general_settings()->logo_footer) }}" alt="Logo du footer" class="max-h-full max-w-full">   
                    @else
                        <span class="text-sonec-dark font-bold text-xl">SONEC</span>
                    @endif
                </div>
                <p class="text-gray-300 mb-6">{{ get_general_settings()->description ?? '' }}</p>
                <div class="flex gap-4">
                    @if(get_general_settings()->facebook_url)
                        <a href="{{ get_general_settings()->facebook_url }}" target="_blank" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-sonec-green transition-colors">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                    @endif
                    @if(get_general_settings()->twitter_url)
                        <a href="{{ get_general_settings()->twitter_url }}" target="_blank" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-sonec-green transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                    @endif
                    @if(get_general_settings()->linkedin_url)
                        <a href="{{ get_general_settings()->linkedin_url }}" target="_blank" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-sonec-green transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                    @endif
                    @if(get_general_settings()->instagram_url)
                        <a href="{{ get_general_settings()->instagram_url }}" target="_blank" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-sonec-green transition-colors">
                            <i class="fab fa-instagram"></i>
                        </a>
                    @endif
                    {{-- <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-sonec-green transition-colors">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a href="#" class="w-10 h-10 bg-white/10 rounded-full flex items-center justify-center hover:bg-sonec-green transition-colors">
                        <i class="fab fa-instagram"></i>
                    </a> --}}
                </div>
            </div>


            <div>
                <h3 class="font-bold text-lg mb-4">Solutions</h3>
                <ul class="space-y-3">
                    @php
                        $solutions = \App\Models\Solution::where('mis_avant',true)->limit(3)->get();
                    @endphp
                    @foreach ($solutions as $solution)
                        <li><a href="{{ route('web.solutions.show', $solution->slug) }}" class="text-gray-300 hover:text-sonec-lime transition-colors">{{ $solution->title }}</a></li>
                    @endforeach
                    {{-- <li><a href="#" class="text-gray-300 hover:text-sonec-lime transition-colors">EcoleWeb</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-sonec-lime transition-colors">GDEC</a></li>
                    <li><a href="#" class="text-gray-300 hover:text-sonec-lime transition-colors">SonecPay</a></li>
                     --}}
                    <li><a href="{{ route('web.solutions.index') }}" class="text-gray-300 hover:text-sonec-lime transition-colors">Toutes les solutions</a></li>
                
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-lg mb-4">Entreprise</h3>
                <ul class="space-y-3">
                    <li><a href="{{ route('web.decouvrir-sonec-africa') }}" class="text-gray-300 hover:text-sonec-lime transition-colors">À propos</a></li>
                    <li><a href="{{ route('web.notre-histoire') }}" class="text-gray-300 hover:text-sonec-lime transition-colors">Notre histoire</a></li>
                    <li><a href="{{ route('web.equipe-de-direction') }}" class="text-gray-300 hover:text-sonec-lime transition-colors">Équipe</a></li>
                    <li><a href="{{ route('web.carrieres') }}" class="text-gray-300 hover:text-sonec-lime transition-colors">Carrières</a></li>
                    <li><a href="{{ route('web.actualites') }}" class="text-gray-300 hover:text-sonec-lime transition-colors">Actualités</a></li>
                </ul>
            </div>

            <div>
                <h3 class="font-bold text-lg mb-4">Contact</h3>
                <ul class="space-y-3 text-gray-300">
                    <li class="flex items-start gap-2">
                        <i class="fas fa-map-marker-alt mt-1"></i>
                        <span>{{ get_general_settings()->contact_address }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-phone"></i>
                        <span>{{ get_general_settings()->contact_phone }}</span>
                    </li>
                    <li class="flex items-center gap-2">
                        <i class="fas fa-envelope"></i>
                        <span>{{ get_general_settings()->contact_email }}</span>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/10 pt-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-gray-400 text-sm">
                <p>{{ get_general_settings()->footer_text }}</p>
                <div class="flex gap-6">
                    <a href="#" class="hover:text-sonec-lime transition-colors">Mentions légales</a>
                    <a href="#" class="hover:text-sonec-lime transition-colors">Politique de confidentialité</a>
                    <a href="#" class="hover:text-sonec-lime transition-colors">Cookies</a>
                </div>
            </div>
        </div>
    </div>
</footer>