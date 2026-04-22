<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SONEC Africa - Admin Console</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" >
    {{-- Charger TinyMCE --}}
    {{-- <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script> --}}
    {{-- <script src="{{ asset('assets/js/tinymce/tinymce.min.js') }}"></script> --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Place the first <script> tag in your HTML's <head> -->
        <script src="https://cdn.tiny.cloud/1/w96o6s9z16xn8z6mtipqsil6ns77luq64hg670qndl5z91ir/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
        {{-- Importer tailwind.min.js depuis assets/js --}}
        <script src="{{ asset('assets/js/tailwindcss/tailwind.min.js') }}"></script>
        {{-- <script src="https://cdn.tailwindcss.com"></script> --}}

    
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
    <script>
        const tinyMCEConfig = {
            plugins: [
            // Core editing features
            'anchor', 'autolink', 'charmap', 'codesample', 'emoticons', 'link', 'lists', 'media', 'searchreplace', 'table', 'visualblocks', 'wordcount',
            // Your account includes a free trial of TinyMCE premium features
            // Try the most popular premium features until Apr 29, 2026:
            'checklist', 'mediaembed', 'casechange', 'formatpainter', 'pageembed', 'a11ychecker', 'tinymcespellchecker', 'permanentpen', 'powerpaste', 'advtable', 'advcode', 'advtemplate', 'tinymceai', 'uploadcare', 'mentions', 'tinycomments', 'tableofcontents', 'footnotes', 'mergetags', 'autocorrect', 'typography', 'inlinecss', 'markdown','importword', 'exportword', 'exportpdf'
            ],
            toolbar: 'undo redo | tinymceai-chat tinymceai-quickactions tinymceai-review | blocks fontfamily fontsize | bold italic underline strikethrough | link media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography uploadcare | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
            tinycomments_mode: 'embedded',
            tinycomments_author: 'Author name',
            mergetags_list: [
            { value: 'First.Name', title: 'First Name' },
            { value: 'Email', title: 'Email' },
            ],
            tinymceai_token_provider: async () => {
            await fetch(`https://demo.api.tiny.cloud/1/w96o6s9z16xn8z6mtipqsil6ns77luq64hg670qndl5z91ir/auth/random`, { method: "POST", credentials: "include" });
            return { token: await fetch(`https://demo.api.tiny.cloud/1/w96o6s9z16xn8z6mtipqsil6ns77luq64hg670qndl5z91ir/jwt/tinymceai`, { credentials: "include" }).then(r => r.text()) };
            },
            uploadcare_public_key: 'c22d95532e9e6d46e4d6',
        };
        tinymce.init({
            selector: 'textarea',
            valid_elements: '*[*]',
            extended_valid_elements: 'i[class]',
            ...tinyMCEConfig
        });
    </script>
</body>
</html>