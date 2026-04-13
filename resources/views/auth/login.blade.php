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
        {{-- Formulaire de connexion --}}

        <div class="bg-white shadow-md rounded-lg p-6 max-w-md mx-auto">
            <h2 class="text-2xl font-bold text-center text-sonec-dark mb-6">Connexion à l'administration</h2>
            <form method="POST" class="space-y-4" action="{{ route('login') }}">
                @csrf
                
                @if(session('error'))
                    <div class="mb-4 text-center bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-md">
                        <span class="text-red-500 text-sm font-bold mb-2 block">
                            {{ session('error') }}
                        </span>
                    </div>
                @endif
                
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-slate-700">Adresse e-mail</label>
                    <input type="email" id="email" name="email" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" required>
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-slate-700">Mot de passe</label>
                    <input type="password" id="password" name="password" class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-md text-sonec-dark focus:ring-2 focus:ring-purple-500 outline-none" required>
                    {{-- Oeil pour voir le mot de passe --}}
                    <div class="relative">
                        <button type="button" class="absolute right-3 top-3/4 transform -translate-y-[2rem] text-slate-400 hover:text-slate-600 focus:outline-none" onclick="togglePasswordVisibility()">
                            <i class="fas fa-eye"></i>
                        </button>  
                    </div>
                </div>
                <button type="submit" class="w-full bg-sonec-green text-white py-2 px-4 rounded-md hover:bg-sonec-dark focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sonec-green">
                    Se connecter
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
    <script src="{{ asset('assets/js/login.js') }}"></script>
    {{-- <script type="text/javascript">        

        function getLogin() {
            console.log('Tentative de connexion...');

            const btn = document.querySelector('button[onclick="getLogin()"]');
            const originalContent = btn.innerHTML;      

            
            btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> connexion en cours...';
            btn.disabled = true;
            btn.classList.add('opacity-75', 'cursor-not-allowed');

            // Connexion ajax
            $.ajax({
                url: "{{ route('login') }}",
                method: "POST",
                data: {
                    email: document.getElementById('email').value,
                    password: document.getElementById('password').value,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    setTimeout(() => {
                        btn.innerHTML = originalContent;
                        btn.disabled = false;
                        btn.classList.remove('opacity-75', 'cursor-not-allowed');
                        
                        showToast();
                    }, 1200);
                    // Redirection vers le dashboard
                    window.location.href = "{{ route('admin.dashboard') }}";
                },
                error: function() {
                    btn.innerHTML = originalContent;
                    btn.disabled = false;
                    btn.classList.remove('opacity-75', 'cursor-not-allowed');
                    // Afficher le message d'erreur
                    errorMessage.classList.remove('hidden');
                    
                }
            });

            
        } 

        
    </script> --}}
</body>
</html>
