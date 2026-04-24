<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SONEC Africa - Vérification OTP</title>
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
    </script>
</head>
<body class="bg-admin-bg font-sans text-slate-600 min-h-screen flex overflow-hidden justify-center items-center">

    <main class="min-h-screen flex items-center justify-center w-full px-4">
        <div class="bg-white shadow-md rounded-lg p-8 w-full max-w-md">

            {{-- Logo --}}
            <div class="mb-6 flex items-center justify-center">
                @if(get_general_settings()->site_logo)
                    <img src="{{ asset('/storage/' . get_general_settings()->site_logo) }}" alt="Logo SONEC Africa" class="max-h-12 max-w-48">
                @else
                    <span class="text-sonec-dark font-bold text-xl">SONEC</span>
                @endif
            </div>

            <h2 class="text-2xl font-bold text-center text-sonec-dark mb-6">Code de vérification</h2>

            {{-- Message d'erreur --}}
            @if(session('error'))
                <div class="mb-4 bg-red-100 border border-red-200 text-red-700 px-4 py-3 rounded-md text-sm font-bold text-center">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Message de succès (renvoi OTP) --}}
            @if(session('success'))
                <div class="mb-4 bg-green-100 border border-green-200 text-green-700 px-4 py-3 rounded-md text-sm font-bold text-center">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Message d'information --}}
            <div class="mb-6 bg-blue-50 border border-blue-100 text-blue-700 px-4 py-3 rounded-md text-sm text-center">
                Un code de vérification a été envoyé à votre adresse e-mail. Veuillez le saisir ci-dessous pour continuer.
            </div>

            {{-- Formulaire OTP --}}
            <form method="POST" action="{{ route('otp.verify') }}" class="space-y-5">
                @csrf

                <div>
                    <label for="otp" class="block text-sm font-medium text-slate-700 mb-1">Code OTP</label>
                    <input
                        type="text"
                        id="otp"
                        name="otp"
                        maxlength="6"
                        placeholder="______"
                        autocomplete="one-time-code"
                        class="w-full p-3 bg-slate-50 border border-slate-200 rounded-xl font-bold text-xl text-center tracking-[0.5em] text-sonec-dark focus:ring-2 focus:ring-sonec-green outline-none"
                        required
                    >
                </div>

                <button
                    type="submit"
                    class="w-full bg-sonec-green text-white py-3 px-4 rounded-xl font-semibold hover:bg-sonec-dark transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sonec-green"
                >
                    Vérifier le code
                </button>
            </form>

            {{-- Renvoi OTP --}}
            <div class="mt-5 text-center">
                <p class="text-sm text-slate-500 mb-2">Vous n'avez pas reçu le code ?</p>

                {{-- Formulaire POST pour renvoyer le code --}}
                <form method="POST" action="{{ route('otp.resend') }}" id="resend-form">
                    @csrf
                    <button
                        type="submit"
                        id="resend-btn"
                        class="text-sm font-semibold text-sonec-green hover:underline disabled:opacity-50 disabled:cursor-not-allowed disabled:no-underline"
                    >
                        Renvoyer le code
                    </button>
                    <span id="countdown-text" class="text-sm text-slate-400 hidden">
                        Renvoyer dans <span id="countdown" class="font-semibold text-sonec-dark">60</span>s
                    </span>
                </form>
            </div>

            <a href="{{ url('/') }}" class="block mt-6 text-center text-sm text-sonec-green hover:underline">
                <i class="fas fa-arrow-left mr-2"></i> Retour au site
            </a>
        </div>
    </main>

    <script>
        // Compte à rebours après un renvoi OTP
        (function () {
            const btn           = document.getElementById('resend-btn');
            const countdownText = document.getElementById('countdown-text');
            const countdownEl   = document.getElementById('countdown');
            const STORAGE_KEY   = 'otp_resend_ts';
            const DELAY         = 60; // secondes

            function startCountdown(secondsLeft) {
                btn.classList.add('hidden');
                countdownText.classList.remove('hidden');

                const interval = setInterval(() => {
                    secondsLeft--;
                    countdownEl.textContent = secondsLeft;

                    if (secondsLeft <= 0) {
                        clearInterval(interval);
                        countdownText.classList.add('hidden');
                        btn.classList.remove('hidden');
                        localStorage.removeItem(STORAGE_KEY);
                    }
                }, 1000);
            }

            // Vérifier si un compte à rebours est déjà en cours (après rechargement de page)
            const savedTs = localStorage.getItem(STORAGE_KEY);
            if (savedTs) {
                const elapsed     = Math.floor((Date.now() - parseInt(savedTs)) / 1000);
                const secondsLeft = DELAY - elapsed;
                if (secondsLeft > 0) {
                    startCountdown(secondsLeft);
                } else {
                    localStorage.removeItem(STORAGE_KEY);
                }
            }

            // Au clic sur "Renvoyer"
            document.getElementById('resend-form').addEventListener('submit', function () {
                localStorage.setItem(STORAGE_KEY, Date.now().toString());
            });
        })();
    </script>

</body>
</html>