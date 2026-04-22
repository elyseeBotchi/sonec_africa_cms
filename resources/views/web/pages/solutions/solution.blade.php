@extends('web.layout.websiteLayout')

@section('content')
    <main class="pt-20">
        <section id="hero-section" class="h-[700px] bg-white flex items-center">
            <div class="container mx-auto px-6">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <div class="flex gap-3 mb-6">
                            <span class="inline-flex items-center gap-2 bg-sonec-green/10 text-sonec-green px-4 py-2 rounded-full text-sm font-semibold">
                                <i class="fas fa-desktop"></i>
                                Disponible Web & Mobile
                            </span>
                            <span class="inline-flex items-center gap-2 bg-blue-50 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold">
                                <i class="fas fa-check-circle"></i>
                                Programme National
                            </span>
                        </div>
                        <h1 class="text-5xl lg:text-6xl font-bold text-sonec-dark mb-6 leading-tight">L'école de demain : Gestion administrative & Réussite scolaire</h1>
                        <p class="text-xl text-gray-600 mb-8 leading-relaxed">La seule plateforme qui combine pilotage de la vie scolaire et contenus pédagogiques enrichis par l'Intelligence Artificielle. Du Primaire au Lycée.</p>
                        <a href="#" class="inline-block bg-sonec-green text-white px-8 py-4 rounded-xl font-semibold hover:bg-sonec-dark transition-colors text-lg">
                            Demander une démo établissement
                        </a>
                    </div>
                    <div class="h-[500px] overflow-hidden rounded-2xl shadow-2xl">
                        <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/17a90fdeba-60be1a9291366e4fc93e.png" alt="modern african school students using tablets digital learning classroom bright natural light professional photography" />
                    </div>
                </div>
            </div>
        </section>

        <section id="gestion-etablissement" class="py-24 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <div class="inline-block bg-blue-100 text-blue-600 px-4 py-2 rounded-full text-sm font-semibold mb-4">
                        Pour les Directeurs & Administrateurs
                    </div>
                    <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-6">Simplifiez votre administration au quotidien</h2>
                    <p class="text-xl text-gray-600 max-w-3xl mx-auto">Gérez l'ensemble de votre établissement depuis une plateforme unique et intuitive</p>
                </div>

                <div class="grid md:grid-cols-3 gap-8">
                    <div id="pilotage-financier-card" class="bg-white p-10 rounded-2xl shadow-md hover:shadow-xl transition-shadow">
                        <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-chart-pie text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-sonec-dark mb-4">Pilotage Financier</h3>
                        <p class="text-gray-700 mb-6 leading-relaxed">Paiement des scolarités via Sonec Pay, suivi de trésorerie en temps réel, génération automatique de factures et relances.</p>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-gray-600">
                                <i class="fas fa-check text-sonec-green mt-1"></i>
                                <span>Paiements mobiles intégrés</span>
                            </li>
                            <li class="flex items-start gap-3 text-gray-600">
                                <i class="fas fa-check text-sonec-green mt-1"></i>
                                <span>Tableaux de bord financiers</span>
                            </li>
                            <li class="flex items-start gap-3 text-gray-600">
                                <i class="fas fa-check text-sonec-green mt-1"></i>
                                <span>Historique complet des transactions</span>
                            </li>
                        </ul>
                    </div>

                    <div id="vie-scolaire-card" class="bg-white p-10 rounded-2xl shadow-md hover:shadow-xl transition-shadow">
                        <div class="w-16 h-16 bg-gradient-to-br from-sonec-green to-green-600 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-school text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-sonec-dark mb-4">Vie Scolaire</h3>
                        <p class="text-gray-700 mb-6 leading-relaxed">Gestion des absences, bulletins de notes automatiques, emplois du temps dynamiques et suivi personnalisé de chaque élève.</p>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-gray-600">
                                <i class="fas fa-check text-sonec-green mt-1"></i>
                                <span>Gestion des présences</span>
                            </li>
                            <li class="flex items-start gap-3 text-gray-600">
                                <i class="fas fa-check text-sonec-green mt-1"></i>
                                <span>Bulletins numériques</span>
                            </li>
                            <li class="flex items-start gap-3 text-gray-600">
                                <i class="fas fa-check text-sonec-green mt-1"></i>
                                <span>Emplois du temps intelligents</span>
                            </li>
                        </ul>
                    </div>

                    <div id="communication-card" class="bg-white p-10 rounded-2xl shadow-md hover:shadow-xl transition-shadow">
                        <div class="w-16 h-16 bg-gradient-to-br from-purple-500 to-purple-600 rounded-2xl flex items-center justify-center mb-6">
                            <i class="fas fa-comments text-white text-3xl"></i>
                        </div>
                        <h3 class="text-2xl font-bold text-sonec-dark mb-4">Communication</h3>
                        <p class="text-gray-700 mb-6 leading-relaxed">Portail parents/profs, SMS et notifications en temps réel, messagerie intégrée et partage de documents sécurisé.</p>
                        <ul class="space-y-3">
                            <li class="flex items-start gap-3 text-gray-600">
                                <i class="fas fa-check text-sonec-green mt-1"></i>
                                <span>Notifications push instantanées</span>
                            </li>
                            <li class="flex items-start gap-3 text-gray-600">
                                <i class="fas fa-check text-sonec-green mt-1"></i>
                                <span>Messagerie sécurisée</span>
                            </li>
                            <li class="flex items-start gap-3 text-gray-600">
                                <i class="fas fa-check text-sonec-green mt-1"></i>
                                <span>Portail parents dédié</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section id="reussite-scolaire" class="py-24 bg-gradient-to-br from-green-50 to-gray-50">
            <div class="container mx-auto px-6">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div>
                        <div class="inline-block bg-sonec-green/10 text-sonec-green px-4 py-2 rounded-full text-sm font-semibold mb-6">
                            Pour les Parents & Élèves
                        </div>
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-6">Un tuteur digital pour chaque élève</h2>
                        <p class="text-xl text-gray-600 mb-8">Une plateforme complète qui accompagne la réussite scolaire de vos enfants avec des contenus de qualité et l'intelligence artificielle.</p>
                        
                        <div class="bg-white p-8 rounded-2xl shadow-md mb-8">
                            <h3 class="text-2xl font-bold text-sonec-green mb-4">Cours + Exercices + IA = Réussite assurée</h3>
                            <p class="text-gray-700">Notre formule gagnante combine des contenus pédagogiques certifiés avec l'intelligence artificielle pour un apprentissage personnalisé et efficace.</p>
                        </div>

                        <ul class="space-y-4">
                            <li id="couverture-complete" class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-sonec-green/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-book-open text-sonec-green text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sonec-dark text-lg mb-1">Couverture complète</h4>
                                    <p class="text-gray-600">Cours et exercices du CE1 à la Terminale conformes au Programme National. Toutes les matières disponibles.</p>
                                </div>
                            </li>
                            <li id="intelligence-artificielle" class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-sonec-green/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-brain text-sonec-green text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sonec-dark text-lg mb-1">Intelligence Artificielle</h4>
                                    <p class="text-gray-600">Assistant IA qui s'adapte au niveau de chaque élève, identifie les lacunes et propose des exercices ciblés.</p>
                                </div>
                            </li>
                            <li id="bibliotheque-numerique" class="flex items-start gap-4">
                                <div class="w-12 h-12 bg-sonec-green/10 rounded-xl flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-library text-sonec-green text-xl"></i>
                                </div>
                                <div>
                                    <h4 class="font-bold text-sonec-dark text-lg mb-1">Bibliothèque numérique</h4>
                                    <p class="text-gray-600">Annales, devoirs et ressources accessibles 24/7. Plus de 10 000 exercices et supports pédagogiques.</p>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="h-[600px] overflow-hidden rounded-2xl shadow-2xl">
                        <img class="w-full h-full object-cover" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/cc054d4b77-3b824acfa24d47ed1124.png" alt="african student using tablet educational app interface AI learning platform modern classroom bright colors" />
                    </div>
                </div>
            </div>
        </section>

        <section id="experience-mobile" class="py-24 bg-white">
            <div class="container mx-auto px-6">
                <div class="grid lg:grid-cols-2 gap-16 items-center">
                    <div class="h-[600px] overflow-hidden rounded-2xl flex items-center justify-center bg-gradient-to-br from-sonec-dark to-gray-900">
                        <img class="w-auto h-[550px] object-contain" src="https://storage.googleapis.com/uxpilot-auth.appspot.com/500edc76f0-8f21a78adb0e6f0cf119.png" alt="smartphone mockup african school app interface mobile student grades payments modern ui design" />
                    </div>
                    <div>
                        <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-6">L'école dans la poche</h2>
                        <p class="text-xl text-gray-600 mb-8">Suivez les notes, payez la scolarité et révisez les cours où que vous soyez. Une expérience mobile fluide et intuitive.</p>
                        
                        <div class="grid sm:grid-cols-2 gap-6 mb-8">
                            <div class="bg-gray-50 p-6 rounded-xl">
                                <div class="w-12 h-12 bg-sonec-green/10 rounded-lg flex items-center justify-center mb-4">
                                    <i class="fas fa-mobile-alt text-sonec-green text-2xl"></i>
                                </div>
                                <h4 class="font-bold text-sonec-dark mb-2">Application Native</h4>
                                <p class="text-gray-600 text-sm">iOS et Android pour une expérience optimale</p>
                            </div>
                            <div class="bg-gray-50 p-6 rounded-xl">
                                <div class="w-12 h-12 bg-sonec-green/10 rounded-lg flex items-center justify-center mb-4">
                                    <i class="fas fa-wifi text-sonec-green text-2xl"></i>
                                </div>
                                <h4 class="font-bold text-sonec-dark mb-2">Mode Hors-ligne</h4>
                                <p class="text-gray-600 text-sm">Accédez aux cours même sans connexion</p>
                            </div>
                            <div class="bg-gray-50 p-6 rounded-xl">
                                <div class="w-12 h-12 bg-sonec-green/10 rounded-lg flex items-center justify-center mb-4">
                                    <i class="fas fa-bell text-sonec-green text-2xl"></i>
                                </div>
                                <h4 class="font-bold text-sonec-dark mb-2">Notifications Push</h4>
                                <p class="text-gray-600 text-sm">Restez informé en temps réel</p>
                            </div>
                            <div class="bg-gray-50 p-6 rounded-xl">
                                <div class="w-12 h-12 bg-sonec-green/10 rounded-lg flex items-center justify-center mb-4">
                                    <i class="fas fa-lock text-sonec-green text-2xl"></i>
                                </div>
                                <h4 class="font-bold text-sonec-dark mb-2">Sécurité Maximale</h4>
                                <p class="text-gray-600 text-sm">Données cryptées et protégées</p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <a href="#" class="flex items-center gap-2 bg-black text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-800 transition-colors">
                                <i class="fab fa-apple text-2xl"></i>
                                <div class="text-left">
                                    <div class="text-xs">Télécharger sur</div>
                                    <div class="text-sm">App Store</div>
                                </div>
                            </a>
                            <a href="#" class="flex items-center gap-2 bg-black text-white px-6 py-3 rounded-xl font-semibold hover:bg-gray-800 transition-colors">
                                <i class="fab fa-google-play text-2xl"></i>
                                <div class="text-left">
                                    <div class="text-xs">Disponible sur</div>
                                    <div class="text-sm">Google Play</div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="preuve-sociale" class="py-24 bg-gray-50">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-6">Ils nous font confiance</h2>
                    <p class="text-xl text-gray-600">Plus de 150 établissements utilisent ÉcoleWeb au quotidien</p>
                </div>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 mb-16">
                    <div class="bg-white p-8 rounded-xl flex items-center justify-center h-32 shadow-sm">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-sonec-green mb-1">+10 000</div>
                            <div class="text-sm text-gray-600">Élèves connectés</div>
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-xl flex items-center justify-center h-32 shadow-sm">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-sonec-green mb-1">150+</div>
                            <div class="text-sm text-gray-600">Établissements</div>
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-xl flex items-center justify-center h-32 shadow-sm">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-sonec-green mb-1">95%</div>
                            <div class="text-sm text-gray-600">Satisfaction parents</div>
                        </div>
                    </div>
                    <div class="bg-white p-8 rounded-xl flex items-center justify-center h-32 shadow-sm">
                        <div class="text-center">
                            <div class="text-4xl font-bold text-sonec-green mb-1">+25%</div>
                            <div class="text-sm text-gray-600">Taux de réussite</div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-12 rounded-2xl shadow-md">
                    <h3 class="text-2xl font-bold text-sonec-dark mb-8 text-center">Nos écoles partenaires</h3>
                    <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-8 items-center opacity-60">
                        <div class="h-20 bg-gray-100 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400 font-semibold">École Excellence</span>
                        </div>
                        <div class="h-20 bg-gray-100 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400 font-semibold">Complexe Avenir</span>
                        </div>
                        <div class="h-20 bg-gray-100 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400 font-semibold">Lycée Moderne</span>
                        </div>
                        <div class="h-20 bg-gray-100 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400 font-semibold">Institut Savoir</span>
                        </div>
                        <div class="h-20 bg-gray-100 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400 font-semibold">Groupe Scolaire</span>
                        </div>
                        <div class="h-20 bg-gray-100 rounded-lg flex items-center justify-center">
                            <span class="text-gray-400 font-semibold">Académie Plus</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="testimonials" class="py-24 bg-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-5xl font-bold text-sonec-dark mb-6">Ce qu'ils disent de nous</h2>
                    <p class="text-xl text-gray-600">Des témoignages qui parlent d'eux-mêmes</p>
                </div>

                <div class="grid lg:grid-cols-3 gap-8">
                    <div class="bg-gray-50 p-8 rounded-2xl">
                        <div class="flex items-center gap-1 text-yellow-400 mb-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-700 mb-6 italic">"ÉcoleWeb a transformé notre établissement. La communication avec les parents est fluide et la gestion administrative simplifiée. Un outil indispensable."</p>
                        <div class="flex items-center gap-4">
                            <img src="https://storage.googleapis.com/uxpilot-auth.appspot.com/avatars/avatar-5.jpg" alt="Directrice" class="w-14 h-14 rounded-full object-cover">
                            <div>
                                <div class="font-bold text-sonec-dark">Mme Kouassi</div>
                                <div class="text-sm text-gray-600">Directrice, Complexe Scolaire Excellence</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-8 rounded-2xl">
                        <div class="flex items-center gap-1 text-yellow-400 mb-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-700 mb-6 italic">"Grâce à l'IA, mes élèves progressent plus vite. Les exercices personnalisés font vraiment la différence. Je recommande à tous les enseignants."</p>
                        <div class="flex items-center gap-4">
                            <img src="https://storage.googleapis.com/uxpilot-auth.appspot.com/avatars/avatar-2.jpg" alt="Enseignant" class="w-14 h-14 rounded-full object-cover">
                            <div>
                                <div class="font-bold text-sonec-dark">M. Traoré</div>
                                <div class="text-sm text-gray-600">Professeur de Mathématiques</div>
                            </div>
                        </div>
                    </div>

                    <div class="bg-gray-50 p-8 rounded-2xl">
                        <div class="flex items-center gap-1 text-yellow-400 mb-4">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p class="text-gray-700 mb-6 italic">"Je peux suivre la scolarité de mon fils en temps réel. Les paiements sont simples et je reçois toutes les infos importantes. Vraiment pratique!"</p>
                        <div class="flex items-center gap-4">
                            <img src="https://storage.googleapis.com/uxpilot-auth.appspot.com/avatars/avatar-6.jpg" alt="Parent" class="w-14 h-14 rounded-full object-cover">
                            <div>
                                <div class="font-bold text-sonec-dark">Mme Diallo</div>
                                <div class="text-sm text-gray-600">Parent d'élève</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="features-details" class="py-24 bg-gradient-to-br from-sonec-dark to-gray-900 text-white">
            <div class="container mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-4xl lg:text-5xl font-bold mb-6">Fonctionnalités avancées</h2>
                    <p class="text-xl text-gray-300">Tout ce dont vous avez besoin pour une gestion moderne de votre établissement</p>
                </div>

                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl">
                        <i class="fas fa-calendar-alt text-sonec-green text-3xl mb-4"></i>
                        <h4 class="font-bold text-lg mb-2">Emplois du temps</h4>
                        <p class="text-gray-300 text-sm">Gestion automatique des plannings et salles</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl">
                        <i class="fas fa-chart-bar text-sonec-green text-3xl mb-4"></i>
                        <h4 class="font-bold text-lg mb-2">Statistiques</h4>
                        <p class="text-gray-300 text-sm">Tableaux de bord et analytics détaillés</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl">
                        <i class="fas fa-file-invoice text-sonec-green text-3xl mb-4"></i>
                        <h4 class="font-bold text-lg mb-2">Facturation</h4>
                        <p class="text-gray-300 text-sm">Génération automatique des factures</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl">
                        <i class="fas fa-users text-sonec-green text-3xl mb-4"></i>
                        <h4 class="font-bold text-lg mb-2">Gestion RH</h4>
                        <p class="text-gray-300 text-sm">Suivi du personnel enseignant et administratif</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl">
                        <i class="fas fa-video text-sonec-green text-3xl mb-4"></i>
                        <h4 class="font-bold text-lg mb-2">Classes virtuelles</h4>
                        <p class="text-gray-300 text-sm">Enseignement à distance intégré</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl">
                        <i class="fas fa-clipboard-check text-sonec-green text-3xl mb-4"></i>
                        <h4 class="font-bold text-lg mb-2">Évaluations</h4>
                        <p class="text-gray-300 text-sm">Création et correction d'examens en ligne</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl">
                        <i class="fas fa-certificate text-sonec-green text-3xl mb-4"></i>
                        <h4 class="font-bold text-lg mb-2">Diplômes</h4>
                        <p class="text-gray-300 text-sm">Génération automatique de bulletins</p>
                    </div>
                    <div class="bg-white/10 backdrop-blur-sm p-6 rounded-xl">
                        <i class="fas fa-book-reader text-sonec-green text-3xl mb-4"></i>
                        <h4 class="font-bold text-lg mb-2">Bibliothèque</h4>
                        <p class="text-gray-300 text-sm">Gestion complète des ressources</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="cta-final" class="py-24 bg-white">
            <div class="container mx-auto px-6">
                <div class="max-w-5xl mx-auto bg-gradient-to-br from-sonec-green to-green-600 rounded-3xl p-16 text-center text-white relative overflow-hidden">
                    <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full -mr-32 -mt-32"></div>
                    <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full -ml-48 -mb-48"></div>
                    <div class="relative z-10">
                        <h2 class="text-4xl lg:text-5xl font-bold mb-6">Transformez votre établissement dès aujourd'hui</h2>
                        <p class="text-xl mb-10 text-white/90">Rejoignez les centaines d'écoles qui ont fait le choix de l'excellence avec ÉcoleWeb</p>
                        <div class="flex flex-col sm:flex-row gap-4 justify-center mb-12">
                            <a href="#" class="inline-block bg-white text-sonec-green px-10 py-4 rounded-xl font-bold hover:bg-gray-100 transition-colors text-lg">
                                Contacter notre équipe commerciale
                            </a>
                            <a href="#" class="inline-block bg-transparent border-2 border-white text-white px-10 py-4 rounded-xl font-bold hover:bg-white hover:text-sonec-green transition-colors text-lg">
                                Voir une démo en ligne
                            </a>
                        </div>
                        <div class="flex flex-col md:flex-row justify-center items-center gap-8 text-white">
                            <div class="flex items-center gap-3">
                                <i class="fas fa-phone-alt text-2xl"></i>
                                <div class="text-left">
                                    <div class="text-sm opacity-90">Appelez-nous</div>
                                    <div class="font-bold text-lg">+225 27 XX XX XX XX</div>
                                </div>
                            </div>
                            <div class="flex items-center gap-3">
                                <i class="fas fa-envelope text-2xl"></i>
                                <div class="text-left">
                                    <div class="text-sm opacity-90">Écrivez-nous</div>
                                    <div class="font-bold text-lg">ecoleweb@sonecafrica.com</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection