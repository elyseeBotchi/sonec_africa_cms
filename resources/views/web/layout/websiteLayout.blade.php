<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Accueil</title>
    <script src="{{ asset('assets/js/tailwindcss/tailwind.min.js') }}"></script>
    {{-- favicon --}}
    <link rel="icon" type="image/png" href="{{ get_general_settings()->site_logo ? asset('/storage/' . get_general_settings()->site_logo) : asset('assets/images/LOGO-Sonec-Header.png') }}">
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800&amp;display=swap" rel="stylesheet">
    <script>window.FontAwesomeConfig = { autoReplaceSvg: 'nest'};</script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'sonec-dark': '#0d3136',
                        'sonec-green': '#06b654',
                        'sonec-lime': '#b4ec58',
                    },
                    fontFamily: {
                        sans: ['Montserrat', 'sans-serif'],
                    },
                }
            }
        }
    </script>
    <style>
        ::-webkit-scrollbar { display: none; }
        .mega-menu { 
            opacity: 0; 
            visibility: hidden; 
            transform: translateY(-20px);
            transition: opacity 0.4s cubic-bezier(0.4, 0, 0.2, 1), 
                    transform 0.4s cubic-bezier(0.4, 0, 0.2, 1), 
                    visibility 0.4s;
            pointer-events: none;
            position: absolute;
            left: 0;
            right: 0;
            min-width: 100vw;
            margin-left: -23vw;
            top: 100%;
            z-index: 1000;
        }
        .nav-item:hover .mega-menu { 
            opacity: 1; 
            visibility: visible; 
            transform: translateY(0);
            pointer-events: auto;
        }
        .carousel-slide {
            transition: opacity 1s ease-in-out;
            position: absolute;
            width: 100%;
            height: 100%;
            opacity: 0;
        }
        .carousel-slide.active {
            opacity: 1;
            z-index: 10;
        }
        .carousel-dot {
            transition: all 0.3s ease;
        }
        .carousel-dot.active {
            background-color: #b4ec58;
            transform: scale(1.25);
        }
        .partner-scroll {
            animation: scroll 30s linear infinite;
        }
        @keyframes scroll {
            0% { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .mobile-menu {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        .mobile-menu.active {
            transform: translateX(0);
        }
        /* Fix pour éviter les débordements horizontaux */
        html, body {
            overflow-x: hidden;
            max-width: 100%;
        }
        /* Assure un espacement correct pour les éléments internes */
        .mega-menu .container {
            max-width: 1200px;
            margin: 0 auto;
        }
        /* Améliore l'affichage du contenu */
        .mega-menu .grid {
            gap: 2rem;
        }
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

        .timeline-line {
            background: linear-gradient(to bottom, #06b654 0%, #06b654 100%);
            width: 4px;
            min-height: 100%;
        }
        .timeline-item {
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.6s ease;
        }
        .timeline-item.visible {
            opacity: 1;
            transform: translateY(0);
        }
        .timeline-dot {
            transition: all 0.3s ease;
        }
        .timeline-item:hover .timeline-dot {
            transform: scale(1.3) translateX(-50%) translateY(-50%);
            box-shadow: 0 0 0 8px rgba(6, 182, 84, 0.1);
        }
        .country-highlight {
            fill: #06b654;
            transition: fill 0.3s ease;
        }
        .country-base {
            fill: #e5e7eb;
        }
    </style>
</head>
<body class="bg-white font-sans text-gray-800">
    @include('web.partials.header')

    @include('web.partials.mobileMenu')
    <main>
        @yield('content')
    </main>
    @include('web.partials.footer')

    <script>
        window.addEventListener('load', function() {
            const mobileMenuBtn = document.getElementById('mobile-menu-btn');
            const mobileMenu = document.getElementById('mobile-menu');
            const mobileMenuClose = document.getElementById('mobile-menu-close');
            const mobileAccordions = document.querySelectorAll('.mobile-accordion');

            mobileMenuBtn.addEventListener('click', function() {
                mobileMenu.classList.add('active');
            });

            mobileMenuClose.addEventListener('click', function() {
                mobileMenu.classList.remove('active');
            });

            mobileAccordions.forEach(function(accordion) {
                accordion.addEventListener('click', function() {
                    const content = this.nextElementSibling;
                    const icon = this.querySelector('i');
                    
                    content.classList.toggle('hidden');
                    icon.classList.toggle('fa-chevron-down');
                    icon.classList.toggle('fa-chevron-up');
                });
            });

            
        });
    </script>
</body>
</html>