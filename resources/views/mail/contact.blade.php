<!DOCTYPE html>
<html lang="fr">
<head><meta charset="utf-8"></head>
<body style="margin:0; padding:40px 20px; background:#f4f4f4; font-family:Arial,sans-serif;">
<div style="max-width:600px; margin:auto; background:#fff; border-radius:12px; overflow:hidden; border:1px solid #e5e7eb;">

    <div style="background:#064e3b; padding:28px 40px;">
        <p style="color:rgba(255,255,255,0.6); font-size:11px; letter-spacing:0.1em; margin:0 0 8px; text-transform:uppercase;">SONEC Africa — Formulaire de contact</p>
        <h1 style="color:#fff; font-size:20px; font-weight:400; margin:0;">Nouveau message reçu</h1>
    </div>

    <div style="padding:28px 40px 0;">
        <p style="font-size:15px; color:#555; line-height:1.75; margin:0 0 20px;">
            Un visiteur vous a envoyé un message via le formulaire de contact du site.
        </p>
    </div>

    <div style="padding:0 40px 24px;">
        <div style="background:#f9fafb; border-radius:10px; padding:20px 24px; border:1px solid #e5e7eb;">
            <p style="font-size:11px; font-weight:600; letter-spacing:0.08em; color:#9ca3af; margin:0 0 14px; text-transform:uppercase;">Expéditeur</p>
            <table style="width:100%; font-size:14px; border-collapse:collapse;">
                <tr>
                    <td style="color:#6b7280; padding:5px 0; width:30%;">Nom complet</td>
                    <td style="color:#111827; font-weight:500; padding:5px 0;">{{ $contact['prenom'] }} {{ $contact['nom'] }}</td>
                </tr>
                <tr>
                    <td style="color:#6b7280; padding:5px 0;">Email</td>
                    <td style="padding:5px 0;"><a href="mailto:{{ $contact['email'] }}" style="color:#16a34a; text-decoration:none;">{{ $contact['email'] }}</a></td>
                </tr>
                <tr>
                    <td style="color:#6b7280; padding:5px 0;">Sujet</td>
                    <td style="color:#111827; font-weight:500; padding:5px 0;">{{ $contact['sujet'] }}</td>
                </tr>
            </table>
        </div>
    </div>

    <div style="padding:0 40px 28px;">
        <p style="font-size:11px; font-weight:600; letter-spacing:0.08em; color:#9ca3af; margin:0 0 10px; text-transform:uppercase;">Message</p>
        <div style="border-left:3px solid #16a34a; padding:14px 18px; background:#f9fafb; border-radius:0 8px 8px 0;">
            <p style="font-size:14px; line-height:1.85; color:#374151; margin:0; font-family:Georgia,serif; white-space:pre-line;">{{ $contact['message'] }}</p>
        </div>
    </div>

    <div style="padding:0 40px 28px;">
        <div style="background:#f0fdf4; border:1px solid #bbf7d0; border-radius:8px; padding:14px 18px;">
            <p style="font-size:13px; color:#065f46; margin:0; line-height:1.65;">
                &#9432;&nbsp; Pour répondre, utilisez directement le bouton "Répondre" de votre client mail — la réponse sera adressée à <strong>{{ $contact['email'] }}</strong>.
            </p>
        </div>
    </div>

    <div style="border-top:1px solid #e5e7eb; padding:18px 40px; display:flex; justify-content:space-between; background:#fafafa;">
        <div>
            <p style="font-size:13px; font-weight:600; color:#111827; margin:0;">SONEC Africa</p>
            <p style="font-size:12px; color:#9ca3af; margin:2px 0 0;">Formulaire de contact</p>
        </div>
        <p style="font-size:11px; color:#d1d5db; margin:0; align-self:center;">Généré automatiquement</p>
    </div>

</div>
</body>
</html>