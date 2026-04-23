@extends('web.layout.websiteLayout')

@section('content')

    <main class="pt-20">

            <section class="bg-sonec-light py-12">
                <div class="container mx-auto px-4">
                    <h1 class="text-3xl font-bold text-center mb-8">Détails de l'offre d'emploi</h1>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-2xl font-bold mb-4">{!! $offre->title !!}</h2>
                        {{-- <p class="text-gray-700 mb-4">{{ $offre->description }}</p> --}}
                        <div class="flex items-center text-gray-500 mt-2 space-x-4">
                            <span class="flex items-center"><i class="fa-solid fa-briefcase mr-2 text-sonec-green"></i>{{ $offre->domaine }}</span>
                            <span class="flex items-center"><i class="fa-solid fa-map-marker-alt mr-2 text-sonec-green"></i>{{ $offre->lieu }}, {{ $offre->bureauPays->pays ?? '' }}</span>
                           @if(isset($offre->type_contrat)) <span class="flex items-center"><i class="fa-solid fa-briefcase mr-2 text-sonec-green"></i>{{ $offre->type_contrat }}</span> @endif
                           @if(isset($offre->niveau_experience)) <span class="flex items-center"><i class="fa-solid fa-user-graduate mr-2 text-sonec-green"></i>{{ $offre->niveau_experience }}</span> @endif
                           @if(isset($offre->salaire)) <span class="flex items-center"><i class="fa-solid fa-euro-sign mr-2 text-sonec-green"></i>{{ $offre->salaire }}</span> @endif
                           
                            <span class="flex items-center"><i class="fa-solid fa-calendar-days mr-2 text-sonec-green"></i>Publié le {{ $offre->created_at->locale('fr')->isoFormat('LL') }}</span>
                            <span class="flex items-center"><i class="fa-solid fa-hourglass-end mr-2 text-sonec-green"></i>Expire le {{ $offre->date_expiration->locale('fr')->isoFormat('LL') }}</span>
                        </div>
                    </div>
                </div>
            </section>
            {{-- Section description detaillé de l'offre --}}
            <section class="py-12">
                @if(isset($offre->description))
                <div class="container mx-auto px-4">
                    <h2 class="text-2xl font-bold mb-4">Description de l'offre</h2>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        {!! $offre->description !!}
                    </div>
                </div>
                @endif

                {{-- Responsabilités --}}
                @if(isset($offre->responsabilites))
                <div class="container mx-auto px-4 mt-8">
                    <h2 class="text-2xl font-bold mb-4">Responsabilités</h2>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        {!! $offre->responsabilites !!}
                    </div>
                </div>
                @endif

                {{-- Avantages --}}
                @if(isset($offre->avantages))

                <div class="container mx-auto px-4 mt-8">
                    <h2 class="text-2xl font-bold mb-4">Avantages</h2>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        {!! $offre->avantages !!}
                    </div>
                </div>
                @endif

                {{-- Profil recherché --}}
                @if(isset($offre->profil_recherche))
                <div class="container mx-auto px-4 mt-8">
                    <h2 class="text-2xl font-bold mb-4">Profil recherché</h2>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        {!! $offre->profil_recherche !!}
                    </div>
                </div>
                @endif

                {{-- Comment postuler avec texte et email de contact --}}
                @if(isset($offre->email_contact))
                <div class="container mx-auto px-4 mt-8">
                    <h2 class="text-2xl font-bold mb-4">Comment postuler</h2>
                    <div class="bg-white rounded-lg shadow-md p-6">
                        Pour postuler à cette offre, veuillez envoyer votre CV et lettre de motivation à l'adresse email suivante : <a href="mailto:{{ $offre->email_contact }}" class="text-sonec-green font-bold">{{ $offre->email_contact }}</a>
                    </div>
                </div>
                @endif

            </section>





    </main>

@endsection