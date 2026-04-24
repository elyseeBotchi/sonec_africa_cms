<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SONEC Africa - Administration</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'sonec-dark': '#0d3136',
                        'sonec-green': '#06b654',
                        'sonec-lime': '#b4ec58',
                        'admin-bg': '#f1f5f9'
                    },
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                    },
                }
            }
        }
        function toggleSubMenu(event, submenuId) {
            event.preventDefault();

            // Fermer tous les sous-menus
            document.querySelectorAll('.submenu').forEach(menu => {
                if (menu.id !== submenuId) {
                    menu.classList.add('hidden');
                }
            });

            // Ouvrir / fermer le sous-menu cliqué
            const submenu = document.getElementById(submenuId);
            if (submenu) {
                submenu.classList.toggle('hidden');
            }
        }
    </script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 5px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 10px; }
        
        .nav-item.active { 
            background: linear-gradient(90deg, rgba(6, 182, 84, 0.1) 0%, transparent 100%);
            border-left: 4px solid #06b654; 
            color: #0d3136; 
            font-weight: 700; 
        }
        .nav-item { border-left: 4px solid transparent; }
        
        .editor-section { display: none; }
        .editor-section.active { display: block; animation: slideIn 0.3s ease-out; }
        
        @keyframes slideIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .toggle-checkbox:checked {
            right: 0;
            border-color: #06b654;
        }
        .toggle-checkbox:checked + .toggle-label {
            background-color: #06b654;
        }
        
    </style>
</head>
<body class="bg-admin-bg font-sans text-slate-600 h-screen flex overflow-hidden justify-center items-center">    

    <!-- MAIN CONTENT AREA -->
    <main class="min-h-screen flex items-center justify-center">
        {{-- Logo du site --}}
        
        
        {{-- Formulaire de connexion --}}
        <div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto center">
            <div class="mb-4 flex items-center gap-2">
                @if(get_general_settings()->site_logo)
                    <img src="{{ asset('/storage/' . get_general_settings()->site_logo) }}" alt="Logo SONEC Africa" class="max-h-12 max-w-48">   
                @else
                    <span class="text-white font-bold text-xl">SONEC</span>
                @endif
            </div>
            <h2 class="text-2xl font-bold text-center text-sonec-dark mb-6">Code de vérification</h2>
            <form method="POST" class="space-y-4" action="{{ route('otp.verify') }}">
                @csrf
                
                @if(session('error'))
                    <div class="mb-4 text-center bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-md">
                        <span class="text-red-500 text-sm font-bold mb-2 block">
                            {{ session('error') }}
                        </span>
                    </div>
                @endif

                {{-- Message d'information --}}
                <div class="mb-4 text-center bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-md">
                    <span class="text-green-500 text-sm font-bold mb-2 block">
                        Un code de vérification a été envoyé à votre adresse e-mail. Veuillez le saisir ci-dessous pour continuer.
                    </span>
                </div>
                
                
                <div class="mb-4">
                    <label for="otp" class="block text-sm font-medium text-slate-700">Code OTP</label>
                    <input type="text" id="otp" name="otp" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" required>
                    
                    {{-- Bouton pour renvoyer le code OTP --}}
                    <button type="button" onclick="window.location.href='{{ route('otp.resend') }}'" class="block mt-2 text-sm text-sonec-green hover:underline">Renvoyer le code</button>
                
                </div>
                <button type="submit" class="w-full bg-sonec-green text-white py-2 px-4 rounded-md hover:bg-sonec-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sonec-green">
                    Vérifier
                </button>
            </form>
            <a href="{{ url('/') }}" class="block mt-4 text-center text-sm text-sonec-green hover:underline">Aller sur le site</a>
        </div>
    </main>

    <!-- Toast Notification -->
    <div id="toast" class="fixed bottom-8 right-8 bg-sonec-dark text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-4 translate-y-32 opacity-0 transition-all duration-500 z-50">
        <div class="w-8 h-8 bg-sonec-green rounded-full flex items-center justify-center shadow-lg shadow-sonec-green/50">
            <i class="fas fa-check text-xs"></i>
        </div>
        <div>
            <p class="font-bold text-sm">Connexion réussie !</p>
            <p class="text-xs text-white/70">Vous êtes maintenant connecté à l'administration.</p>
        </div>
    </div>
    {{-- <script src="{{ asset('assets/js/login.js') }}"></script> --}}
    
</body>
</html>
