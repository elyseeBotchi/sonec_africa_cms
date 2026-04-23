<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nouvelle candidature spontanée — SONEC Africa</title>
</head>
<body style="margin:0; padding: 40px 20px; background-color: #f4f4f4; font-family: Arial, sans-serif; color: #333;">

    <div style="max-width: 600px; margin: auto; background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e5e7eb;">

        {{-- EN-TÊTE --}}
        <div style="background-color: #064e3b; padding: 32px 40px 28px;">
            <p style="color: rgba(255,255,255,0.7); font-size: 11px; letter-spacing: 0.1em; margin: 0 0 10px; text-transform: uppercase;">SONEC Africa — Ressources Humaines</p>
            <h1 style="color: #ffffff; font-size: 22px; font-weight: 400; margin: 0 0 6px; letter-spacing: -0.02em;">Nouvelle candidature spontanée</h1>
            <p style="color: rgba(255,255,255,0.55); font-size: 13px; margin: 0;">
                Reçue le {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }} à {{ \Carbon\Carbon::now()->format('H:i') }}
            </p>
        </div>

        {{-- INTRO --}}
        <div style="padding: 28px 40px 0;">
            <p style="font-size: 15px; color: #555; line-height: 1.75; margin: 0;">
                Bonjour,
            </p>
            <p style="font-size: 15px; color: #555; line-height: 1.75; margin: 12px 0 0;">
                Une nouvelle candidature spontanée vient d'être soumise via le formulaire en ligne de <strong style="color: #333;">SONEC Africa</strong>. Veuillez trouver ci-dessous les informations du candidat ainsi que sa lettre de motivation.
            </p>
        </div>

        {{-- FICHE CANDIDAT --}}
        <div style="padding: 24px 40px;">
            <p style="font-size: 11px; font-weight: 600; letter-spacing: 0.1em; color: #9ca3af; margin: 0 0 12px; text-transform: uppercase;">Profil du candidat</p>

            <div style="background: #f9fafb; border-radius: 10px; padding: 20px 24px; border: 1px solid #e5e7eb;">

                {{-- Avatar + nom --}}
                <div style="display: flex; align-items: center; gap: 14px; margin-bottom: 16px;">
                    <div style="width: 48px; height: 48px; border-radius: 50%; background-color: #064e3b; display: flex; align-items: center; justify-content: center; font-size: 17px; font-weight: 600; color: #ffffff; flex-shrink: 0;">
                        {{ strtoupper(substr($candidate->prenom, 0, 1)) }}{{ strtoupper(substr($candidate->nom, 0, 1)) }}
                    </div>
                    <div>
                        <p style="font-size: 17px; font-weight: 600; margin: 0 0 3px; color: #111827;">
                            {{ $candidate->prenom }} {{ $candidate->nom }}
                        </p>
                        <a href="mailto:{{ $candidate->email }}" style="font-size: 13px; color: #059669; text-decoration: none;">
                            {{ $candidate->email }}
                        </a>
                    </div>
                </div>

                <div style="border-top: 1px solid #e5e7eb; padding-top: 16px; display: grid; grid-template-columns: 1fr 1fr; gap: 12px;">
                    <div>
                        <p style="font-size: 11px; color: #9ca3af; margin: 0 0 3px; text-transform: uppercase; letter-spacing: 0.05em;">Nom complet</p>
                        <p style="font-size: 14px; color: #111827; margin: 0; font-weight: 500;">{{ $candidate->prenom }} {{ $candidate->nom }}</p>
                    </div>
                    <div>
                        <p style="font-size: 11px; color: #9ca3af; margin: 0 0 3px; text-transform: uppercase; letter-spacing: 0.05em;">Statut</p>
                        <span style="display: inline-block; font-size: 11px; font-weight: 600; padding: 3px 10px; border-radius: 20px; background: #d1fae5; color: #065f46; letter-spacing: 0.03em;">
                            Nouveau
                        </span>
                    </div>
                    {{-- @if($candidate->telephone ?? null)
                    <div>
                        <p style="font-size: 11px; color: #9ca3af; margin: 0 0 3px; text-transform: uppercase; letter-spacing: 0.05em;">Téléphone</p>
                        <p style="font-size: 14px; color: #111827; margin: 0; font-weight: 500;">{{ $candidate->telephone }}</p>
                    </div>
                    @endif --}}
                </div>
            </div>
        </div>

        {{-- LETTRE DE MOTIVATION --}}
        @if($candidate->lettre_motivation)
        <div style="padding: 0 40px 24px;">
            <p style="font-size: 11px; font-weight: 600; letter-spacing: 0.1em; color: #9ca3af; margin: 0 0 12px; text-transform: uppercase;">Lettre de motivation</p>
            <div style="border-left: 3px solid #059669; padding: 16px 20px; background: #f9fafb; border-radius: 0 8px 8px 0;">
                <p style="font-size: 14px; line-height: 1.85; color: #374151; margin: 0; font-family: Georgia, serif; font-style: italic;">
                    {!! $candidate->lettre_motivation !!}
                </p>
            </div>
        </div>
        @endif


        {{-- lien pour télécharger le CV --}}
        @if($candidate->cv)
        <div style="padding: 0 40px 24px;">
            <p style="font-size: 11px; font-weight: 600; letter-spacing: 0.1em; color: #9ca3af; margin: 0 0 12px; text-transform: uppercase;">CV</p>
            <div style="border-left: 3px solid #059669; padding: 16px 20px; background: #f9fafb; border-radius: 0 8px 8px 0;">
                <a href="{{ asset('storage/' . $candidate->cv) }}" style="font-size: 14px; color: #059669; text-decoration: none;" target="_blank">
                    Télécharger le CV
                </a>
            </div>
        </div>
        @endif

        {{-- NOTE D'ACTION --}}
        <div style="padding: 0 40px 28px;">
            <div style="background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 8px; padding: 14px 18px;">
                <p style="font-size: 13px; color: #065f46; margin: 0; line-height: 1.65;">
                    &#9432;&nbsp; Merci de traiter cette candidature dans les meilleurs délais. Pour toute question, vous pouvez contacter directement le candidat à l'adresse e-mail indiquée ci-dessus.
                </p>
            </div>
        </div>

        {{-- PIED DE PAGE --}}
        <div style="border-top: 1px solid #e5e7eb; padding: 20px 40px; display: flex; justify-content: space-between; align-items: center; background: #fafafa;">
            <div>
                <p style="font-size: 13px; font-weight: 600; color: #111827; margin: 0;">SONEC Africa</p>
                <p style="font-size: 12px; color: #9ca3af; margin: 2px 0 0;">Système de candidatures spontanées</p>
            </div>
            <p style="font-size: 11px; color: #d1d5db; margin: 0;">Généré automatiquement</p>
        </div>

    </div>

</body>
</html>