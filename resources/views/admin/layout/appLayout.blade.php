<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SONEC Africa - Admin Console</title>
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" >
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
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
        /* @import url('{{ asset("assets/css/styles.css") }}'); */
    </style>
</head>
<body class="bg-admin-bg font-sans text-slate-600 h-screen flex overflow-hidden">
    @include('admin.partials.aside')

    <main class="flex-1 flex flex-col h-full overflow-hidden relative">
        @yield('content')
    </main>

   
    <div id="toast" class="fixed bottom-8 right-8 bg-sonec-dark text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-4 translate-y-32 opacity-0 transition-all duration-500 z-50">
        <div class="w-8 h-8 bg-sonec-green rounded-full flex items-center justify-center shadow-lg shadow-sonec-green/50">
            <i class="fas fa-check text-xs"></i>
        </div>
        <div>
            <p class="font-bold text-sm success-message"></p>
            <p class="text-xs text-white/70 success-description"></p>
        </div>
    </div>

    <div id="toastError" class="fixed bottom-8 right-8 bg-red-500 text-white px-6 py-4 rounded-xl shadow-2xl flex items-center gap-4 translate-y-32 opacity-0 transition-all duration-500 z-50">
        <div class="w-8 h-8 bg-sonec-red rounded-full flex items-center justify-center shadow-lg shadow-sonec-red/50">
            <i class="fas fa-exclamation text-xs"></i>
        </div>
        <div>
            <p class="font-bold text-sm error-message"></p>
            <p class="text-xs text-white/70 error-description"></p>
        </div>
    </div>

    <script>
        // State management
        const pages = {
            'dashboard': 'Tableau de bord',
            'home': 'Éditeur : Accueil',
            'solutions': 'Éditeur : Nos Solutions',
            'banking': 'Éditeur : Banques & Assurances',
            'ecoleweb': 'Éditeur : Produit ÉcoleWeb',
            'careers': 'Éditeur : Carrières',
            'blog': 'Éditeur : Blog'
        };

        function switchPage(pageId) {
            // Hide all sections
            document.querySelectorAll('.editor-section').forEach(el => el.classList.remove('active'));
            // Remove active state from nav
            document.querySelectorAll('.nav-item').forEach(el => el.classList.remove('active'));

            // Show selected section
            const target = document.getElementById(`view-${pageId}`);
            if(target) target.classList.add('active');

            // Activate nav item
            const navBtn = document.getElementById(`nav-page-${pageId}`);
            if(navBtn) navBtn.classList.add('active');

            // Update Header
            document.getElementById('header-title').innerText = pages[pageId] || 'Éditeur';
            
            // Scroll to top
            document.querySelector('main > div').scrollTop = 0;
        }

        function switchTab(tabId) {
            switchPage(tabId);
            // Specific logic for dashboard main tab if needed
            document.getElementById('nav-dashboard').classList.add('active');
        }

        // function saveAll() {
        //     const btn = document.querySelector('button[onclick="saveAll()"]');
        //     const originalContent = btn.innerHTML;
            
        //     btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Enregistrement...';
        //     btn.disabled = true;
        //     btn.classList.add('opacity-75', 'cursor-not-allowed');

        //     setTimeout(() => {
        //         btn.innerHTML = originalContent;
        //         btn.disabled = false;
        //         btn.classList.remove('opacity-75', 'cursor-not-allowed');
                
        //         showToast();
        //     }, 1200);
        // }

        function showToast() {
            const toast = document.getElementById('toast');
            toast.classList.remove('translate-y-32', 'opacity-0');
            setTimeout(() => {
                toast.classList.add('translate-y-32', 'opacity-0');
            }, 3000);
        }

        function showToastError() {
            const toastError = document.getElementById('toastError');
            toastError.classList.remove('translate-y-32', 'opacity-0');
            setTimeout(() => {
                toastError.classList.add('translate-y-32', 'opacity-0');
            }, 3000);
        }

        // Initialize inputs animation (visual feedback)
        document.querySelectorAll('input, textarea').forEach(input => {
            input.addEventListener('change', () => {
                document.getElementById('status-badge').classList.remove('hidden');
                input.classList.add('bg-yellow-50', 'border-yellow-200');
            });
        });
    </script>
</body>
</html>